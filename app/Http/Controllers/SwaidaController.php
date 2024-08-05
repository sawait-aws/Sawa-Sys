<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Swaida;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SwaidaController extends Controller
{
    protected $navItems = [
        ['name' => 'Swaida', 'url' => 'swaidaPage', 'icon' => 'fas fa-table'],
        ['name' => 'Marketing Earnings', 'url' => 'marketingEarnings', 'icon' => 'fas fa-table'],
        ['name' => 'Marketing Monthly Contracts', 'url' => 'marketingMonthlyContractsPage', 'icon' => 'fas fa-table'],
    ];

    public function index()
    {
        $query = Swaida::orderBy('id', 'desc');
        $itemCount = $query->count();
        $totalAmountSum = $query->sum('total_amount');
        $items = $query->paginate(20)->withPath('/swaidaPage');

        $dynamicSubmarket = Swaida::select('submarket')->distinct()->get(); 
        $dynamicCountry = Swaida::select('country')->distinct()->get(); 
        $dynamicPaymentMethod = Swaida::select('payment_method')->distinct()->get();
        $dynamicMarketNameApp = Swaida::select('market_name_app')->distinct()->get(); 
        $dynamicCategory = Swaida::select('category')->distinct()->get(); 
        $dynamicPreOrder = Swaida::select('pre_order')->distinct()->get(); 
        $dynamicEmployee = Swaida::select('employee')->distinct()->get();
        $dynamicClientType = Swaida::select('client_type')->distinct()->get();     

        return view('pages.swaida.swaidaPage', [
            'navItems' => $this->navItems,
            'items' => $items,
            'dynamicSubmarket' => $dynamicSubmarket,
            'dynamicCountry' => $dynamicCountry,
            'dynamicPaymentMethod' => $dynamicPaymentMethod,
            'dynamicMarketNameApp'=> $dynamicMarketNameApp,
            'dynamicCategory' => $dynamicCategory,
            'dynamicPreOrder'=> $dynamicPreOrder,
            'dynamicEmployee'=> $dynamicEmployee,
            'dynamicClientType' => $dynamicClientType,
            'itemCount' => $itemCount,
            'totalAmountSum' => $totalAmountSum
        ]);
    }

    public function filter(Request $request)
    {
        $query = Swaida::query();

        // Specific value filters
        if ($request->has('submarket') && $request->submarket != 'all') {
            $query->where('submarket', $request->submarket); 
        }

        if ($request->has('country') && $request->country != 'all') {
            $query->where('country', $request->country); 
        }

        if ($request->has('payment_method') && $request->payment_method != 'all') {
            $query->where('payment_method', $request->payment_method); 
        }

        if ($request->has('market_name_app') && $request->market_name_app != 'all') {
            $query->where('market_name_app', $request->market_name_app); 
        }

        if ($request->has('category') && $request->category != 'all') {
            $query->where('category', $request->category);
        }

        if ($request->has('pre_order') && $request->pre_order != 'all') {
            $query->where('pre_order', $request->pre_order); 
        }

        if ($request->has('employee') && $request->employee != 'all') {
            $query->where('employee', $request->employee); 
        }

        if ($request->has('client_type') && $request->client_type != 'all') {
            $query->where('client_type', $request->client_type); 
        }
        // From-to filters for dates
        if ($request->has('date_from') && $request->date_from != null) {
            $query->where('date', '>=', $request->date_from); 
        }

        if ($request->has('date_to') && $request->date_to != null) {
            $query->where('date', '<=', $request->date_to); 
        }

        if ($request->has('total_amount_from') && $request->total_amount_from != null) {
            $query->where('total_amount', '>=', $request->total_amount_from); 
        }

        if ($request->has('total_amount_to') && $request->total_amount_to != null) {
            $query->where('total_amount', '<=', $request->total_amount_to); 
        }

        // Search functionality
        if ($request->has('search') && $request->search != null) {
            $query->where(function($q) use ($request) {
                $q->where('name_of_client', 'LIKE', '%' . $request->search . '%') 
                  ->orWhere('email', 'LIKE', '%' . $request->search . '%') 
                  ->orWhere('phone_number', 'LIKE', '%' . $request->search . '%') 
                  ->orWhere('source', 'LIKE', '%' . $request->search . '%'); 
            });
        }
        
        $itemCount = $query->count();
        $totalAmountSum = $query->sum('total_amount');
        $items = $query->orderBy('id', 'desc')->paginate(20)->withPath('/swaidaFilter')->appends($request->all());;

        $dynamicSubmarket = Swaida::select('submarket')->distinct()->get(); 
        $dynamicCountry = Swaida::select('country')->distinct()->get(); 
        $dynamicPaymentMethod = Swaida::select('payment_method')->distinct()->get(); 
        $dynamicMarketNameApp = Swaida::select('market_name_app')->distinct()->get(); 
        $dynamicCategory = Swaida::select('category')->distinct()->get(); 
        $dynamicPreOrder = Swaida::select('pre_order')->distinct()->get(); 
        $dynamicEmployee = Swaida::select('employee')->distinct()->get(); 
        $dynamicClientType = Swaida::select('client_type')->distinct()->get();      
   
        return view('pages.swaida.swaidaPage', [
            'navItems' => $this->navItems,
            'items' => $items,
            'dynamicSubmarket' => $dynamicSubmarket,
            'dynamicCountry' => $dynamicCountry,
            'dynamicPaymentMethod' => $dynamicPaymentMethod,
            'dynamicMarketNameApp'=> $dynamicMarketNameApp,
            'dynamicCategory' => $dynamicCategory,
            'dynamicPreOrder'=> $dynamicPreOrder,
            'dynamicEmployee'=> $dynamicEmployee,
            'dynamicClientType' => $dynamicClientType,
            'itemCount' => $itemCount,
            'totalAmountSum' => $totalAmountSum
        ]);
    }

    public function showAddForm()
    {
        return view('pages.swaida.swaidaAdd', ['navItems' => $this->navItems]);
    }

    public function addItem(Request $request)
    {
        Swaida::create([
        'date' => $request->date,
        'name_of_client' => $request->name_of_client,
        'submarket' => $request->submarket,
        'country' => $request->country,
        'total_amount' => $request->total_amount,
        'delivery_cost' => $request->delivery_cost,
        'payment_method' => $request->payment_method,
        'market_name_app' => $request->market_name_app,
        'market_name_order' => $request->market_name_order,
        'cost_in_syp' => $request->cost_in_syp,
        'delivery_cost_syp' => $request->delivery_cost_syp,
        'delivery_area' => $request->delivery_area,
        'category' => $request->category,
        'amount' => $request->amount,
        'notes' => $request->notes,
        'client_type' => $request->client_type,
        'source' => $request->source,
        'employee' => $request->employee,
        'pre_order' => $request->pre_order,
        'delivery_date' => $request->delivery_date,
        'email' => $request->email,
        'phone_number' => $request->phone_number
        ]);

        return redirect('/swaidaPage')->with('success', 'Item added successfully!'); 
    }

    public function deleteItem($id)
    {
        $item = Swaida::findOrFail($id);
        $item->delete();

        return redirect('/swaidaPage')->with('success', 'Item deleted successfully!');
    }

    public function showEditForm($id)
    {
        $item = Swaida::findOrFail($id);
        $navItems = $this->navItems;

        return view('pages.swaida.swaidaEdit', compact('item', 'navItems'));
    }

    public function editItem(Request $request, $id)
    {
        $item = Swaida::findOrFail($id);
        $item->update($request->all());

        return redirect('/swaidaPage')->with('success', 'Item updated successfully!');
    }

    public function bulkDelete(Request $request)
    {
        if ($request->has('selected_ids')) 
        {
        Swaida::whereIn('id', $request->selected_ids)->delete();
        }
        return redirect('/swaidaPage')->with('success', 'Selected items deleted successfully!');
    }

    public function downloadCsv(Request $request)
{
    $query = Swaida::query();

    // Specific value filters
    if ($request->has('submarket') && $request->submarket != 'all') {
        $query->where('submarket', $request->submarket);
    }

    if ($request->has('country') && $request->country != 'all') {
        $query->where('country', $request->country);
    }

    if ($request->has('payment_method') && $request->payment_method != 'all') {
        $query->where('payment_method', $request->payment_method);
    }

    if ($request->has('market_name_app') && $request->market_name_app != 'all') {
        $query->where('market_name_app', $request->market_name_app);
    }

    if ($request->has('category') && $request->category != 'all') {
        $query->where('category', $request->category);
    }

    if ($request->has('pre_order') && $request->pre_order != 'all') {
        $query->where('pre_order', $request->pre_order);
    }

    if ($request->has('employee') && $request->employee != 'all') {
        $query->where('employee', $request->employee);
    }

    if ($request->has('client_type') && $request->client_type != 'all') {
        $query->where('client_type', $request->client_type);
    }

    // From-to filters for amounts
    if ($request->has('total_amount_from') && $request->total_amount_from != null) {
        $query->where('total_amount', '>=', $request->total_amount_from);
    }

    if ($request->has('total_amount_to') && $request->total_amount_to != null) {
        $query->where('total_amount', '<=', $request->total_amount_to);
    }

    if ($request->has('date_from') && $request->date_from != null) {
        $query->where('date', '>=', $request->date_from);
    }

    if ($request->has('date_to') && $request->date_to != null) {
        $query->where('date', '<=', $request->date_to);
    }

    // Search functionality
    if ($request->has('search') && $request->search != null) {
        $query->where(function($q) use ($request) {
            $q->where('name_of_client', 'LIKE', '%' . $request->search . '%')
              ->orWhere('email', 'LIKE', '%' . $request->search . '%')
              ->orWhere('phone_number', 'LIKE', '%' . $request->search . '%')
              ->orWhere('source', 'LIKE', '%' . $request->search . '%');
        });
    }

    $filteredItems = $query->get();

    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="swaida_data.csv"',
    ];

    $callback = function() use ($filteredItems) {
        $file = fopen('php://output', 'w');
        fputcsv($file, ['ID', 'Date', 'Name of Client', 'Submarket', 'Country', 'Total Amount', 'Delivery Cost', 'Payment Method', 'Market Name (App)', 'Market Name (Order)', 'Cost in SYP', 'Delivery Cost in SYP', 'Delivery Area', 'Category', 'Amount', 'Notes', 'Client Type', 'Source', 'Employee', 'Pre-order', 'Delivery Date', 'Email', 'Phone Number']);

        foreach ($filteredItems as $item) {
            fputcsv($file, [
                $item->id,
                $item->date,
                $item->name_of_client,
                $item->submarket,
                $item->country,
                $item->total_amount,
                $item->delivery_cost,
                $item->payment_method,
                $item->market_name_app,
                $item->market_name_order,
                $item->cost_in_syp,
                $item->delivery_cost_syp,
                $item->delivery_area,
                $item->category,
                $item->amount,
                $item->notes,
                $item->client_type,
                $item->source,
                $item->employee,
                $item->pre_order,
                $item->delivery_date,
                $item->email,
                $item->phone_number,
            ]);
        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}

}
