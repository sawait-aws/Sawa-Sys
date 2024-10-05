<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DailySales;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DailySalesController extends Controller
{
    protected $navItems = [
        ['name' => 'Swaida', 'url' => 'swaidaPage', 'icon' => 'fas fa-table'],
        ['name' => 'Marketing Earnings', 'url' => 'marketingEarnings', 'icon' => 'fas fa-table'],
        ['name' => 'Marketing Monthly Contracts', 'url' => 'marketingMonthlyContractsPage', 'icon' => 'fas fa-table'],
        ['name' => 'Daily Sales', 'url' => 'dailySalesPage', 'icon' => 'fas fa-table'],
    ];
    public function index()
    {
        $query = DailySales::orderBy('request_id', 'desc');
        $itemCount = $query->count();
        $totalAmountSum = $query->sum('total_amount');
        $items = $query->paginate(20);

        // Fetch distinct values for filtering
        $dynamicMarket = DailySales::select('market')->distinct()->get();
        $dynamicSubmarket = DailySales::select('submarket')->distinct()->get();
        $dynamicPaymentMethod = DailySales::select('payment_method')->distinct()->get();
        $dynamicEmployee = DailySales::select('employee_name')->distinct()->get();
        $dynamicCategory = DailySales::select('category')->distinct()->get();
        $dynamicClientType = DailySales::select('client_type')->distinct()->get();

        return view('pages.dailySales.dailySalesPage', [
            'navItems' => $this->navItems,
            'items' => $items,
            'itemCount' => $itemCount,
            'totalAmountSum' => $totalAmountSum,
            'dynamicMarket' => $dynamicMarket,
            'dynamicSubmarket' => $dynamicSubmarket,
            'dynamicPaymentMethod' => $dynamicPaymentMethod,
            'dynamicEmployee' => $dynamicEmployee,
            'dynamicCategory' => $dynamicCategory,
            'dynamicClientType' => $dynamicClientType,
        ]);
    }
    public function showAddForm()
    {
        return view('pages.dailySales.dailySalesAdd', ['navItems' => $this->navItems]);
    }
    public function addItem(Request $request)
    {
        DailySales::create($request->all());
        return redirect('/dailySalesPage')->with('success', 'Entry added successfully!');
    }

    public function showEditForm($id)
    {
        $item = DailySales::findOrFail($id);
        $navItems = $this->navItems;
        return view('pages.dailySales.dailySalesEdit', compact('item', 'navItems'));
    }

    public function editItem(Request $request, $id)
    {
        $item = DailySales::findOrFail($id);
        $item->update($request->all());
        return redirect('/dailySalesPage')->with('success', 'Entry updated successfully!');
    }

    public function deleteItem($id)
    {
        $item = DailySales::findOrFail($id);
        $item->delete();
        return redirect('/dailySalesPage')->with('success', 'Entry deleted successfully!');
    }

    // Bulk Delete
    public function bulkDelete(Request $request)
    {
        if ($request->has('selected_ids')) {
            DailySales::whereIn('id', $request->selected_ids)->delete();
        }
        return redirect('/dailySalesPage')->with('success', 'Selected items deleted successfully!');
    }

    // Filter functionality
    public function filter(Request $request)
    {
        $query = DailySales::query();

        // Apply filters based on input from the form
        if ($request->has('market') && $request->market != 'all') {
            $query->where('market', $request->market);
        }

        if ($request->has('submarket') && $request->submarket != 'all') {
            $query->where('submarket', $request->submarket);
        }

        if ($request->has('payment_method') && $request->payment_method != 'all') {
            $query->where('payment_method', $request->payment_method);
        }

        if ($request->has('client_type') && $request->client_type != 'all') {
            $query->where('client_type', $request->client_type);
        }

        if ($request->has('employee_name') && $request->employee_name != 'all') {
            $query->where('employee_name', $request->employee_name);
        }

        if ($request->has('category') && $request->category != 'all') {
            $query->where('category', $request->category);
        }

        // Filter by date range
        if ($request->has('date_from') && $request->date_from != null) {
            $query->where('date', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to != null) {
            $query->where('date', '<=', $request->date_to);
        }

        // Filter by amount range
        if ($request->has('total_amount_from') && $request->total_amount_from != null) {
            $query->where('total_amount', '>=', $request->total_amount_from);
        }

        if ($request->has('total_amount_to') && $request->total_amount_to != null) {
            $query->where('total_amount', '<=', $request->total_amount_to);
        }

        // Search functionality
        if ($request->has('search') && $request->search != null) {
            $query->where(function($q) use ($request) {
                $q->where('client_name', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('email', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('client_phone', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('source', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('request_id', 'LIKE', '%' . $request->search . '%');
            });
        }

        // Apply pagination and sorting
        $itemCount = $query->count();
        $totalAmountSum = $query->sum('total_amount');
        $items = $query->orderBy('request_id', 'desc')->paginate(20)->appends($request->all());

        // Fetch distinct values for filtering
        $dynamicMarket = DailySales::select('market')->distinct()->get();
        $dynamicSubmarket = DailySales::select('submarket')->distinct()->get();
        $dynamicPaymentMethod = DailySales::select('payment_method')->distinct()->get();
        $dynamicEmployee = DailySales::select('employee_name')->distinct()->get();
        $dynamicCategory = DailySales::select('category')->distinct()->get();
        $dynamicClientType = DailySales::select('client_type')->distinct()->get();

        return view('pages.dailySales.dailySalesPage', [
            'navItems' => $this->navItems,
            'items' => $items,
            'itemCount' => $itemCount,
            'totalAmountSum' => $totalAmountSum,
            'dynamicMarket' => $dynamicMarket,
            'dynamicSubmarket' => $dynamicSubmarket,
            'dynamicPaymentMethod' => $dynamicPaymentMethod,
            'dynamicEmployee' => $dynamicEmployee,
            'dynamicCategory' => $dynamicCategory,
            'dynamicClientType' => $dynamicClientType,
        ]);
    }

    // CSV Download
    public function downloadCsv(Request $request)
    {
        $query = DailySales::query();

        // Apply the same filters as in the filter function
        if ($request->has('market') && $request->market != 'all') {
            $query->where('market', $request->market);
        }

        if ($request->has('submarket') && $request->submarket != 'all') {
            $query->where('submarket', $request->submarket);
        }

        if ($request->has('payment_method') && $request->payment_method != 'all') {
            $query->where('payment_method', $request->payment_method);
        }

        if ($request->has('client_type') && $request->client_type != 'all') {
            $query->where('client_type', $request->client_type);
        }

        if ($request->has('employee_name') && $request->employee_name != 'all') {
            $query->where('employee_name', $request->employee_name);
        }

        if ($request->has('category') && $request->category != 'all') {
            $query->where('category', $request->category);
        }

        // Apply date filters
        if ($request->has('date_from') && $request->date_from != null) {
            $query->where('date', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to != null) {
            $query->where('date', '<=', $request->date_to);
        }

        // Apply amount filters
        if ($request->has('total_amount_from') && $request->total_amount_from != null) {
            $query->where('total_amount', '>=', $request->total_amount_from);
        }

        if ($request->has('total_amount_to') && $request->total_amount_to != null) {
            $query->where('total_amount', '<=', $request->total_amount_to);
        }

        // Apply search filter
        if ($request->has('search') && $request->search != null) {
            $query->where(function($q) use ($request) {
                $q->where('client_name', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('email', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('client_phone', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('source', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('request_id', 'LIKE', '%' . $request->search . '%');
            });
        }

        $filteredItems = $query->get();

        // CSV export logic
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="daily_sales_data.csv"',
        ];

        $callback = function() use ($filteredItems) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Request ID', 'Date', 'Client Name', 'Market', 'Submarket', 'Client Country', 'Total Amount', 'Delivery Cost', 'Payment Method', 'Store Name (App)', 'Store Request', 'Amount in SYP', 'Delivery Cost in SYP', 'Delivery Area', 'Category', 'Item Quantity', 'Rate', 'Client Request Method', 'Commission Quantity', 'Delivery Quantity', 'Best Seller', 'Product', 'Client Type', 'Discovery Method', 'Employee Name', 'Pre-order', 'Delivery Date', 'Client Phone', 'Notes']);

            foreach ($filteredItems as $item) {
                fputcsv($file, [
                    $item->request_id,
                    $item->date,
                    $item->client_name,
                    $item->market,
                    $item->submarket,
                    $item->client_country,
                    $item->total_amount,
                    $item->delivery_cost,
                    $item->payment_method,
                    $item->store_name_app,
                    $item->store_request,
                    $item->amount_in_syp,
                    $item->delivery_cost_syp,
                    $item->delivery_area,
                    $item->category,
                    $item->item_quantity,
                    $item->rate,
                    $item->client_request_method,
                    $item->commission_quantity,
                    $item->delivery_quantity,
                    $item->best_seller,
                    $item->product,
                    $item->client_type,
                    $item->discovery_method,
                    $item->employee_name,
                    $item->pre_order,
                    $item->delivery_date,
                    $item->client_phone,
                    $item->notes
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}