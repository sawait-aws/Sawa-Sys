<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MarketingMonthlyEarning; 
use Symfony\Component\HttpFoundation\StreamedResponse;

class MarketingMonthlyEarningsController extends Controller
{
    protected $navItems = [
        ['name' => 'Swaida', 'url' => 'swaidaPage', 'icon' => 'fas fa-table'],
        ['name' => 'Marketing Earnings', 'url' => 'marketingEarnings', 'icon' => 'fas fa-table'],
        ['name' => 'Marketing Monthly Contracts', 'url' => 'marketingMonthlyContractsPage', 'icon' => 'fas fa-table'],
    ];

    public function index()
    {
        $query = MarketingMonthlyEarning::orderBy('id', 'desc');
        $itemCount = $query->count();
        $totalValueSum = $query->sum('value');
        $items = $query->paginate(20)->withPath('/marketingEarnings');

        $dynamicMarket = MarketingMonthlyEarning::select('market')->distinct()->get();
        $dynamicCategory = MarketingMonthlyEarning::select('category')->distinct()->get();
        $dynamicPublishingFrom = MarketingMonthlyEarning::select('publishing_from')->distinct()->get();
        $dynamicAdKind = MarketingMonthlyEarning::select('ad_kind')->distinct()->get();

        return view('pages.Marketing_Monthly_Earnings.marketingMonthlyEarningsPage', [
            'navItems' => $this->navItems,
            'items' => $items,
            'dynamicMarket' => $dynamicMarket,
            'dynamicCategory' => $dynamicCategory,
            'dynamicPublishingFrom' => $dynamicPublishingFrom,
            'dynamicAdKind' => $dynamicAdKind,
            'itemCount' => $itemCount,
            'totalValueSum' => $totalValueSum,
        ]);
    }

    public function filter(Request $request)
    {
        $query = MarketingMonthlyEarning::query();

        if ($request->has('market') && $request->market != 'all') {
            $query->where('market', $request->market);
        }

        if ($request->has('category') && $request->category != 'all') {
            $query->where('category', $request->category);
        }

        if ($request->has('publishing_from') && $request->publishing_from != 'all') {
            $query->where('publishing_from', $request->publishing_from);
        }

        if ($request->has('ad_kind') && $request->ad_kind != 'all') {
            $query->where('ad_kind', $request->ad_kind);
        }

        if ($request->has('value_from') && $request->value_from != null) {
            $query->where('value', '>=', $request->value_from);
        }

        if ($request->has('value_to') && $request->value_to != null) {
            $query->where('value', '<=', $request->value_to);
        }

        if ($request->has('date_from') && $request->date_from != null) {
            $query->where('date', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to != null) {
            $query->where('date', '<=', $request->date_to);
        }

        if ($request->has('search') && $request->search != null) {
            $query->where(function($q) use ($request) {
                $q->where('shop', 'LIKE', '%' . $request->search . '%');
            });
        }

        $itemCount = $query->count();
        $totalValueSum = $query->sum('value');
        $items = $query->orderBy('id', 'desc')->paginate(20)->withPath('/marketingEarningsFilter')->appends($request->all());

        $dynamicMarket = MarketingMonthlyEarning::select('market')->distinct()->get();
        $dynamicCategory = MarketingMonthlyEarning::select('category')->distinct()->get();
        $dynamicPublishingFrom = MarketingMonthlyEarning::select('publishing_from')->distinct()->get();
        $dynamicAdKind = MarketingMonthlyEarning::select('ad_kind')->distinct()->get();

        return view('pages.Marketing_Monthly_Earnings.marketingMonthlyEarningsPage', [
            'navItems' => $this->navItems,
            'items' => $items,
            'dynamicMarket' => $dynamicMarket,
            'dynamicCategory' => $dynamicCategory,
            'dynamicPublishingFrom' => $dynamicPublishingFrom,
            'dynamicAdKind' => $dynamicAdKind,
            'itemCount' => $itemCount,
            'totalValueSum' => $totalValueSum,
        ]);
    }

    public function showAddForm()
    {
        return view('pages.Marketing_Monthly_Earnings.marketingMonthlyEarningsAdd', ['navItems' => $this->navItems]);
    }

    public function addItem(Request $request)
    {
        MarketingMonthlyEarning::create([
            'date' => $request->date,
            'market' => $request->market,
            'category' => $request->category,
            'publishing_from' => $request->publishing_from,
            'shop' => $request->shop,
            'ad_kind' => $request->ad_kind,
            'amount' => $request->amount,
            'value' => $request->value,
            'notes' => $request->notes,
        ]);

        return redirect('/marketingEarnings')->with('success', 'Item added successfully!');
    }

    public function deleteItem($id)
    {
        $item = MarketingMonthlyEarning::findOrFail($id);
        $item->delete();

        return redirect('/marketingEarnings')->with('success', 'Item deleted successfully!');
    }

    public function showEditForm($id)
    {
        $item = MarketingMonthlyEarning::findOrFail($id);
        $navItems = $this->navItems;

        return view('pages.Marketing_Monthly_Earnings.marketingMonthlyEarningsEdit', compact('item', 'navItems'));
    }

    public function editItem(Request $request, $id)
    {
        $item = MarketingMonthlyEarning::findOrFail($id);
        $item->update($request->all());

        return redirect('/marketingEarnings')->with('success', 'Item updated successfully!');
    }

    public function bulkDelete(Request $request)
    {
        if ($request->has('selected_ids')) {
            MarketingMonthlyEarning::whereIn('id', $request->selected_ids)->delete();
        }
        return redirect('/marketingEarnings')->with('success', 'Selected items deleted successfully!');
    }

    public function downloadCsv(Request $request)
    {
        $query = MarketingMonthlyEarning::query();

        if ($request->has('market') && $request->market != 'all') {
            $query->where('market', $request->market);
        }

        if ($request->has('category') && $request->category != 'all') {
            $query->where('category', $request->category);
        }

        if ($request->has('publishing_from') && $request->publishing_from != 'all') {
            $query->where('publishing_from', $request->publishing_from);
        }

        if ($request->has('ad_kind') && $request->ad_kind != 'all') {
            $query->where('ad_kind', $request->ad_kind);
        }

        if ($request->has('value_from') && $request->value_from != null) {
            $query->where('value', '>=', $request->value_from);
        }

        if ($request->has('value_to') && $request->value_to != null) {
            $query->where('value', '<=', $request->value_to);
        }

        if ($request->has('date_from') && $request->date_from != null) {
            $query->where('date', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to != null) {
            $query->where('date', '<=', $request->date_to);
        }

        if ($request->has('search') && $request->search != null) {
            $query->where(function($q) use ($request) {
                $q->where('shop', 'LIKE', '%' . $request->search . '%');
            });
        }

        $filteredItems = $query->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="marketing_earnings.csv"',
        ];

        $callback = function() use ($filteredItems) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Date', 'Market', 'Category', 'Publishing From', 'Shop', 'Ad Kind', 'Amount', 'Value', 'Notes']);

            foreach ($filteredItems as $item) {
                fputcsv($file, [
                    $item->id,
                    $item->date,
                    $item->market,
                    $item->category,
                    $item->publishing_from,
                    $item->shop,
                    $item->ad_kind,
                    $item->amount,
                    $item->value,
                    $item->notes,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
