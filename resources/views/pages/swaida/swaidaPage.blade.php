@extends('layouts.app')

@section('title', 'Swaida')

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
    <h2>New Table Data</h2>
    <form method="POST" action="{{ url('/swaidaFilter') }}" class="filter-form" id="swaidaForm">
        @csrf
        <div class="form-group">
            <!-- Specific value filter -->
            <select name="submarket" id="submarket">
                <option value="all" {{ request('submarket') == 'all' ? 'selected' : '' }}>All Submarket</option>
                @foreach($dynamicSubmarket as $data)
                    <option value="{{ $data->submarket }}" {{ request('submarket') == $data->submarket ? 'selected' : '' }}>{{ $data->submarket }}</option>
                @endforeach
            </select>
            
            <select name="country" id="country">
                <option value="all" {{ request('country') == 'all' ? 'selected' : '' }}>All Countries</option>
                @foreach($dynamicCountry as $data)
                    <option value="{{ $data->country }}" {{ request('country') == $data->country ? 'selected' : '' }}>{{ $data->country }}</option>
                @endforeach
            </select>
            
            <select name="payment_method" id="payment_method">
                <option value="all" {{ request('payment_method') == 'all' ? 'selected' : '' }}>All Payment Methods</option>
                @foreach($dynamicPaymentMethod as $data)
                    <option value="{{ $data->payment_method }}" {{ request('payment_method') == $data->payment_method ? 'selected' : '' }}>{{ $data->payment_method }}</option>
                @endforeach
            </select>
            
            <select name="market_name_app" id="market_name_app">
                <option value="all" {{ request('market_name_app') == 'all' ? 'selected' : '' }}>All Market Names (App)</option>
                @foreach($dynamicMarketNameApp as $data)
                    <option value="{{ $data->market_name_app }}" {{ request('market_name_app') == $data->market_name_app ? 'selected' : '' }}>{{ $data->market_name_app }}</option>
                @endforeach
            </select>
            
            <select name="category" id="category">
                <option value="all" {{ request('category') == 'all' ? 'selected' : '' }}>All Categories</option>
                @foreach($dynamicCategory as $data)
                    <option value="{{ $data->category }}" {{ request('category') == $data->category ? 'selected' : '' }}>{{ $data->category }}</option>
                @endforeach
            </select>
            
            <select name="pre_order" id="pre_order">
                <option value="all" {{ request('pre_order') == 'all' ? 'selected' : '' }}>All Kinds of Orders</option>
                @foreach($dynamicPreOrder as $data)
                    <option value="{{ $data->pre_order }}" {{ request('pre_order') == $data->pre_order ? 'selected' : '' }}>{{ $data->pre_order }}</option>
                @endforeach
            </select>
            
            <select name="employee" id="employee">
                <option value="all" {{ request('employee') == 'all' ? 'selected' : '' }}>All Employees</option>
                @foreach($dynamicEmployee as $data)
                    <option value="{{ $data->employee }}" {{ request('employee') == $data->employee ? 'selected' : '' }}>{{ $data->employee }}</option>
                @endforeach
            </select>
            
            <select name="client_type" id="client_type">
                <option value="all" {{ request('client_type') == 'all' ? 'selected' : '' }}>All Types of Clients</option>
                @foreach($dynamicClientType as $data)
                    <option value="{{ $data->client_type }}" {{ request('client_type') == $data->client_type ? 'selected' : '' }}>{{ $data->client_type }}</option>
                @endforeach
            </select>
            
            <!-- Amount filter inputs -->
            <input type="number" name="total_amount_from" id="total_amount_from" placeholder="Total Amount From" value="{{ request('total_amount_from') }}">
            <input type="number" name="total_amount_to" id="total_amount_to" placeholder="Total Amount To" value="{{ request('total_amount_to') }}">
            
            <!-- Date filter inputs -->
            <input type="date" name="date_from" id="date_from" placeholder="Date From" value="{{ request('date_from') }}">
            <input type="date" name="date_to" id="date_to" placeholder="Date To" value="{{ request('date_to') }}">
            
            <!-- Search input -->
            <input type="text" name="search" id="search" placeholder="Search" value="{{ request('search') }}">            

            <button type="submit" class="btn btn-primary">Search</button>
            <a href="{{ url('/swaidaPage') }}" class="btn btn-secondary">Reset Filters</a>
            <a href="{{ url('/swaidaAdd') }}" class="btn btn-secondary">Add Item</a>
            <button type="submit" form="bulkDeleteForm" class="btn btn-danger">Delete Selected</button>
            <a href="{{ url('/swaida/downloadcsv') }}?{{ http_build_query(request()->all()) }}" class="btn btn-download">Download CSV</a>
        </div>
    </form>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form method="POST" action="{{ url('/swaidaBulkDelete') }}" id="bulkDeleteForm" style="display: inline;">
        @csrf
    <table>
        <thead>
            <tr>
                <th><input type="checkbox" id="checkAll"></th>
                <th>ID</th>
                <th>Date</th>
                <th>Name of Client</th>
                <th>Submarket</th>
                <th>Country</th>
                <th>Total Amount</th>
                <th>Delivery Cost</th>
                <th>Payment Method</th>
                <th>Market Name (App)</th>
                <th>Market Name (Order)</th>
                <th>Cost in SYP</th>
                <th>Delivery Cost in SYP</th>
                <th>Delivery Area</th>
                <th>Category</th>
                <th>Amount</th>
                <th>Notes</th>
                <th>Client Type</th>
                <th>Source</th>
                <th>Employee</th>
                <th>Pre-order</th>
                <th>Delivery Date</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="swaidaTable">
            @foreach($items as $item)
            <tr>
                <td><input type="checkbox" name="selected_ids[]" value="{{ $item->id }}"></td>
                <td>{{ $item->id }}</td>
                <td>{{ $item->date }}</td>
                <td>{{ $item->name_of_client }}</td>
                <td>{{ $item->submarket }}</td>
                <td>{{ $item->country }}</td>
                <td>{{ $item->total_amount }}</td>
                <td>{{ $item->delivery_cost }}</td>
                <td>{{ $item->payment_method }}</td>
                <td>{{ $item->market_name_app }}</td>
                <td>{{ $item->market_name_order }}</td>
                <td>{{ $item->cost_in_syp }}</td>
                <td>{{ $item->delivery_cost_syp }}</td>
                <td>{{ $item->delivery_area }}</td>
                <td>{{ $item->category }}</td>
                <td>{{ $item->amount }}</td>
                <td>{{ $item->notes }}</td>
                <td>{{ $item->client_type }}</td>
                <td>{{ $item->source }}</td>
                <td>{{ $item->employee }}</td>
                <td>{{ $item->pre_order }}</td>
                <td>{{ $item->delivery_date }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->phone_number }}</td>
                <td>
                    <a href="{{ url('/swaidaEdit/' . $item->id) }}" class="edit-btn" title="Edit">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="{{ url('/swaidaDelete/' . $item->id) }}" class="delete-btn" title="Delete">
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