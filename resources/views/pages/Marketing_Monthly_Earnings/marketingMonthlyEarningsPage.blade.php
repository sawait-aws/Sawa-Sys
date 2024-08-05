@extends('layouts.app')

@section('title', 'Marketing Monthly Earnings')

@section('content')

<div class="statistics-container">
    <div class="stat-box stat-box-blue">
        <div class="stat-number">{{ $itemCount }}</div>
        <div class="stat-label">Entries</div>
    </div>
    <div class="stat-box stat-box-green">
        <div class="stat-number">${{ number_format($totalValueSum, 2) }}</div>
        <div class="stat-label">Total Value</div>
    </div>
</div>

<div class="table-container">
    <h2>Marketing Monthly Earnings Data</h2>
    <form method="POST" action="{{ url('/marketingEarningsFilter') }}" class="filter-form" id="marketingEarningsForm">
        @csrf
        <div class="form-group">
            <!-- Specific value filter -->
            <select name="market" id="market">
                <option value="all" {{ request('market') == 'all' ? 'selected' : '' }}>All Markets</option>
                @foreach($dynamicMarket as $data)
                    <option value="{{ $data->market }}" {{ request('market') == $data->market ? 'selected' : '' }}>{{ $data->market }}</option>
                @endforeach
            </select>

            <select name="category" id="category">
                <option value="all" {{ request('category') == 'all' ? 'selected' : '' }}>All Categories</option>
                @foreach($dynamicCategory as $data)
                    <option value="{{ $data->category }}" {{ request('category') == $data->category ? 'selected' : '' }}>{{ $data->category }}</option>
                @endforeach
            </select>

            <select name="publishing_from" id="publishing_from">
                <option value="all" {{ request('publishing_from') == 'all' ? 'selected' : '' }}>All Publishing From</option>
                @foreach($dynamicPublishingFrom as $data)
                    <option value="{{ $data->publishing_from }}" {{ request('publishing_from') == $data->publishing_from ? 'selected' : '' }}>{{ $data->publishing_from }}</option>
                @endforeach
            </select>

            <select name="ad_kind" id="ad_kind">
                <option value="all" {{ request('ad_kind') == 'all' ? 'selected' : '' }}>All Ad Kinds</option>
                @foreach($dynamicAdKind as $data)
                    <option value="{{ $data->ad_kind }}" {{ request('ad_kind') == $data->ad_kind ? 'selected' : '' }}>{{ $data->ad_kind }}</option>
                @endforeach
            </select>

            <!-- Amount filter inputs -->
            <input type="number" name="value_from" id="value_from" placeholder="Value From" value="{{ request('value_from') }}">
            <input type="number" name="value_to" id="value_to" placeholder="Value To" value="{{ request('value_to') }}">

            <!-- Date filter inputs -->
            <input type="date" name="date_from" id="date_from" placeholder="Date From" value="{{ request('date_from') }}">
            <input type="date" name="date_to" id="date_to" placeholder="Date To" value="{{ request('date_to') }}">

            <!-- Search input -->
            <input type="text" name="search" id="search" placeholder="Search" value="{{ request('search') }}">

            <button type="submit" class="btn btn-primary">Search</button>
            <a href="{{ url('/marketingEarnings') }}" class="btn btn-secondary">Reset Filters</a>
            <a href="{{ url('/marketingEarningsAdd') }}" class="btn btn-secondary">Add Item</a>
            <button type="submit" form="bulkDeleteForm" class="btn btn-danger">Delete Selected</button>
            <a href="{{ url('/marketingEarnings/downloadcsv') }}?{{ http_build_query(request()->all()) }}" class="btn btn-download">Download CSV</a>
        </div>
    </form>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form method="POST" action="{{ url('/marketingEarningsBulkDelete') }}" id="bulkDeleteForm" style="display: inline;">
        @csrf
    <table>
        <thead>
            <tr>
                <th><input type="checkbox" id="checkAll"></th>
                <th>ID</th>
                <th>Date</th>
                <th>Market</th>
                <th>Category</th>
                <th>Publishing From</th>
                <th>Shop</th>
                <th>Ad Kind</th>
                <th>Amount</th>
                <th>Value</th>
                <th>Notes</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="marketingEarningsTable">
            @foreach($items as $item)
            <tr>
                <td><input type="checkbox" name="selected_ids[]" value="{{ $item->id }}"></td>
                <td>{{ $item->id }}</td>
                <td>{{ $item->date }}</td>
                <td>{{ $item->market }}</td>
                <td>{{ $item->category }}</td>
                <td>{{ $item->publishing_from }}</td>
                <td>{{ $item->shop }}</td>
                <td>{{ $item->ad_kind }}</td>
                <td>{{ $item->amount }}</td>
                <td>{{ $item->value }}</td>
                <td>{{ $item->notes }}</td>
                <td>
                    <a href="{{ url('/marketingEarningsEdit/' . $item->id) }}" class="edit-btn" title="Edit">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="{{ url('/marketingEarningsDelete/' . $item->id) }}" class="delete-btn" title="Delete">
                        <i class="fas fa-times"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </form>
    {{ $items->appends(request()->input())->links('vendor.pagination.custom') }}
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('checkAll').addEventListener('change', function() {
        var checkboxes = document.querySelectorAll('input[name="selected_ids[]"]');
        for (var checkbox of checkboxes) {
            checkbox.checked = this.checked;
        }
    });
</script>
<script>
   document.addEventListener('DOMContentLoaded', function() {
        var alert = document.querySelector('.alert-success');
        if (alert) {
            setTimeout(function() {
                alert.classList.add('alert-fade-out');
                setTimeout(function() {
                    alert.remove();
                }, 1000); // Match this duration with the CSS transition duration
            }, 3500); // 3500 milliseconds = 3.5 seconds
        }
    });
</script>
@endsection
