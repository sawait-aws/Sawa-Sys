<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MarketingMonthlyContract;
use Symfony\Component\HttpFoundation\StreamedResponse;

class MarketingMonthlyContractsController extends Controller
{
    protected $navItems = [
        ['name' => 'Swaida', 'url' => 'swaidaPage', 'icon' => 'fas fa-table'],
        ['name' => 'Marketing Earnings', 'url' => 'marketingEarnings', 'icon' => 'fas fa-table'],
        ['name' => 'Marketing Monthly Contracts', 'url' => 'marketingMonthlyContractsPage', 'icon' => 'fas fa-table'],
    ];

    public function index()
    {
        $query = MarketingMonthlyContract::orderBy('id', 'desc');
        $itemCount = $query->count();
        $totalValueSum = $query->sum('value');
        $items = $query->paginate(20)->withPath('/marketingMonthlyContractsPage');

        $dynamicMarket = MarketingMonthlyContract::select('market')->distinct()->get();

        return view('pages.marketing_monthly_contracts.marketingMonthlyContractsPage', [
            'navItems' => $this->navItems,
            'items' => $items,
            'dynamicMarket' => $dynamicMarket,
            'itemCount' => $itemCount,
            'totalValueSum' => $totalValueSum
        ]);
    }

    public function filter(Request $request)
    {
        $query = MarketingMonthlyContract::query();

        // Specific value filters
        if ($request->has('market') && $request->market != 'all') {
            $query->where('market', $request->market);
        }

        // From-to filters for value
        if ($request->has('value_from') && $request->value_from != null) {
            $query->where('value', '>=', $request->value_from);
        }

        if ($request->has('value_to') && $request->value_to != null) {
            $query->where('value', '<=', $request->value_to);
        }

        // From-to filters for dates
        if ($request->has('date_from') && $request->date_from != null) {
            $query->where('date', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to != null) {
            $query->where('date', '<=', $request->date_to);
        }

        // Search functionality
        if ($request->has('search') && $request->search != null) {
            $query->where('shop', 'LIKE', '%' . $request->search . '%');
        }

        $itemCount = $query->count();
        $totalValueSum = $query->sum('value');
        $items = $query->orderBy('id', 'desc')->paginate(20)->withPath('/marketingMonthlyContractsFilter')->appends($request->all());

        $dynamicMarket = MarketingMonthlyContract::select('market')->distinct()->get();

        return view('pages.marketing_monthly_contracts.marketingMonthlyContractsPage', [
            'navItems' => $this->navItems,
            'items' => $items,
            'dynamicMarket' => $dynamicMarket,
            'itemCount' => $itemCount,
            'totalValueSum' => $totalValueSum
        ]);
    }

    public function showAddForm()
    {
        return view('pages.marketing_monthly_contracts.marketingMonthlyContractsAdd', ['navItems' => $this->navItems]);
    }

    public function addItem(Request $request)
    {
        MarketingMonthlyContract::create([
            'date' => $request->date,
            'market' => $request->market,
            'shop' => $request->shop,
            'value' => $request->value
        ]);

        return redirect('/marketingMonthlyContractsPage')->with('success', 'Item added successfully!');
    }

    public function deleteItem($id)
    {
        $item = MarketingMonthlyContract::findOrFail($id);
        $item->delete();

        return redirect('/marketingMonthlyContractsPage')->with('success', 'Item deleted successfully!');
    }

    public function showEditForm($id)
    {
        $item = MarketingMonthlyContract::findOrFail($id);
        $navItems = $this->navItems;

        return view('pages.marketing_monthly_contracts.marketingMonthlyContractsEdit', compact('item', 'navItems'));
    }

    public function editItem(Request $request, $id)
    {
        $item = MarketingMonthlyContract::findOrFail($id);
        $item->update($request->all());

        return redirect('/marketingMonthlyContractsPage')->with('success', 'Item updated successfully!');
    }

    public function bulkDelete(Request $request)
    {
        if ($request->has('selected_ids')) {
            MarketingMonthlyContract::whereIn('id', $request->selected_ids)->delete();
        }
        return redirect('/marketingMonthlyContractsPage')->with('success', 'Selected items deleted successfully!');
    }

    public function downloadCsv(Request $request)
    {
        $query = MarketingMonthlyContract::query();

        // Specific value filters
        if ($request->has('market') && $request->market != 'all') {
            $query->where('market', $request->market);
        }

        // From-to filters for value
        if ($request->has('value_from') && $request->value_from != null) {
            $query->where('value', '>=', $request->value_from);
        }

        if ($request->has('value_to') && $request->value_to != null) {
            $query->where('value', '<=', $request->value_to);
        }

        // From-to filters for dates
        if ($request->has('date_from') && $request->date_from != null) {
            $query->where('date', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to != null) {
            $query->where('date', '<=', $request->date_to);
        }

        // Search functionality
        if ($request->has('search') && $request->search != null) {
            $query->where('shop', 'LIKE', '%' . $request->search . '%');
        }

        $filteredItems = $query->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="marketing_monthly_contracts_data.csv"',
        ];

        $callback = function () use ($filteredItems) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Date', 'Market', 'Shop', 'Value']);

            foreach ($filteredItems as $item) {
                fputcsv($file, [
                    $item->id,
                    $item->date,
                    $item->market,
                    $item->shop,
                    $item->value
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
