@extends('layouts.app')

@section('title', 'Daily Sales')

@section('content')
<div class="statistics-container">
    <div class="stat-box stat-box-blue">
        <div class="stat-number">{{ $itemCount }}</div>
        <div class="stat-label">Entries</div>
    </div>
    <div class="stat-box stat-box-green">
        <div class="stat-number">${{ number_format($totalAmountSum, 2) }}</div>
        <div class="stat-label">Total Amount</div>
    </div>
</div>

<div class="table-container">
    <h2>Daily Sales Data</h2>
    <form method="POST" action="{{ url('/dailySalesFilter') }}" class="filter-form" id="dailySalesForm">
        @csrf
        <div class="form-group">
        <!-- Filters dropdowns -->
        <select name="market" id="market">
            <option value="all" {{ request('market') == 'all' ? 'selected' : '' }}>All Markets</option>
            @foreach($dynamicMarket as $data)
                <option value="{{ $data->market }}" {{ request('market') == $data->market ? 'selected' : '' }}>{{ $data->market }}</option>
            @endforeach
        </select>

        <select name="submarket" id="submarket">
            <option value="all" {{ request('submarket') == 'all' ? 'selected' : '' }}>All Submarkets</option>
            @foreach($dynamicSubmarket as $data)
                <option value="{{ $data->submarket }}" {{ request('submarket') == $data->submarket ? 'selected' : '' }}>{{ $data->submarket }}</option>
            @endforeach
        </select>

        <select name="payment_method" id="payment_method">
            <option value="all" {{ request('payment_method') == 'all' ? 'selected' : '' }}>All Payment Methods</option>
            @foreach($dynamicPaymentMethod as $data)
                <option value="{{ $data->payment_method }}" {{ request('payment_method') == $data->payment_method ? 'selected' : '' }}>{{ $data->payment_method }}</option>
            @endforeach
        </select>

        <select name="client_type" id="client_type">
            <option value="all" {{ request('client_type') == 'all' ? 'selected' : '' }}>All Client Types</option>
            @foreach($dynamicClientType as $data)
                <option value="{{ $data->client_type }}" {{ request('client_type') == $data->client_type ? 'selected' : '' }}>{{ $data->client_type }}</option>
            @endforeach
        </select>

        <select name="employee_name" id="employee_name">
            <option value="all" {{ request('employee_name') == 'all' ? 'selected' : '' }}>All Employees</option>
            @foreach($dynamicEmployee as $data)
                <option value="{{ $data->employee_name }}" {{ request('employee_name') == $data->employee_name ? 'selected' : '' }}>{{ $data->employee_name }}</option>
            @endforeach
        </select>

        <input type="date" name="date_from" placeholder="Date From" value="{{ request('date_from') }}">
        <input type="date" name="date_to" placeholder="Date To" value="{{ request('date_to') }}">

        <input type="number" name="total_amount_from" placeholder="Total Amount From" value="{{ request('total_amount_from') }}">
        <input type="number" name="total_amount_to" placeholder="Total Amount To" value="{{ request('total_amount_to') }}">

        <input type="text" name="search" placeholder="Search" value="{{ request('search') }}">

        <button type="submit" class="btn btn-primary">Search</button>
        <a href="{{ url('/dailySalesPage') }}" class="btn btn-secondary">Reset Filters</a>
        <a href="{{ url('/dailySalesAdd') }}" class="btn btn-secondary">Add New Entry</a>
        <button type="submit" form="bulkDeleteForm" class="btn btn-danger">Delete Selected</button>
        <a href="{{ url('/dailySales/downloadcsv') }}?{{ http_build_query(request()->all()) }}" class="btn btn-download">Download CSV</a>
    </div>
    </form>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <!-- Bulk delete form -->
    <form method="POST" action="{{ url('/dailySalesBulkDelete') }}" id="bulkDeleteForm">
        @csrf
        <table>
            <thead>
                <tr>
                    <th><input type="checkbox" id="checkAll"></th>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Client's Name</th>
                    <th>Market</th>
                    <th>Submarket</th>
                    <th>Client Country</th>
                    <th>Total Amount</th>
                    <th>Delivery Cost</th>
                    <th>Payment Method</th>
                    <th>Delivery Area</th>
                    <th>Category</th>
                    <th>Item Quantity</th>
                    <th>Rate</th>
                    <th>Store Name (App)</th>
                    <th>Store Request</th>
                    <th>Amount in SYP</th>
                    <th>Delivery Cost in SYP</th>
                    <th>Commission Quantity</th>
                    <th>Delivery Quantity</th>
                    <th>Product</th>
                    <th>Client Type</th>
                    <th>Discovery Method</th>
                    <th>Employee Name</th>
                    <th>Pre-order</th>
                    <th>Delivery Date</th>
                    <th>Client Phone</th>
                    <th>Notes</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="dailySalesTable">
                @foreach($items as $item)
                <tr>
                    <td><input type="checkbox" name="selected_ids[]" value="{{ $item->id }}"></td>
                    <td>{{ $item->request_id }}</td>
                    <td>{{ $item->date }}</td>
                    <td>{{ $item->client_name }}</td>
                    <td>{{ $item->market }}</td>
                    <td>{{ $item->submarket }}</td>
                    <td>{{ $item->client_country }}</td>
                    <td>{{ $item->total_amount }}</td>
                    <td>{{ $item->delivery_cost }}</td>
                    <td>{{ $item->payment_method }}</td>
                    <td>{{ $item->delivery_area }}</td>
                    <td>{{ $item->category }}</td>
                    <td>{{ $item->item_quantity }}</td>
                    <td>{{ $item->rate }}</td>
                    <td>{{ $item->store_name_app }}</td>
                    <td>{{ $item->store_request }}</td>
                    <td>{{ $item->amount_in_syp }}</td>
                    <td>{{ $item->delivery_cost_syp }}</td>
                    <td>{{ $item->commission_quantity }}</td>
                    <td>{{ $item->delivery_quantity }}</td>
                    <td>{{ $item->product }}</td>
                    <td>{{ $item->client_type }}</td>
                    <td>{{ $item->discovery_method }}</td>
                    <td>{{ $item->employee_name }}</td>
                    <td>{{ $item->pre_order }}</td>
                    <td>{{ $item->delivery_date }}</td>
                    <td>{{ $item->client_phone }}</td>
                    <td>{{ $item->notes }}</td>
                    <td>
                        <a href="{{ url('/dailySalesEdit/' . $item->id) }}" class="edit-btn" title="Edit"><i class="fas fa-edit"></i></a>
                        <a href="{{ url('/dailySalesDelete/' . $item->id) }}" class="delete-btn" title="Delete"><i class="fas fa-times"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </form>

    <!-- Pagination -->
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
