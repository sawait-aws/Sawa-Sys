@extends('layouts.app')

@section('title', 'Add New Swaida Entry')

@section('content')
<div class="form-container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <h2>Add New Item</h2>
    <form method="POST" action="{{ url('/swaidaAdd') }}">
        @csrf
        <input type="date" name="date" placeholder="Date" required>
        <input type="text" name="name_of_client" placeholder="Name of Client" required>
        <input type="text" name="submarket" placeholder="Submarket" required>
        <input type="text" name="country" placeholder="Country" required>
        <input type="number" step="0.01" name="total_amount" placeholder="Total Amount" required>
        <input type="number" step="0.01" name="delivery_cost" placeholder="Delivery Cost" required>
        <input type="text" name="payment_method" placeholder="Payment Method" required>
        <input type="text" name="market_name_app" placeholder="Market Name (App)" required>
        <input type="text" name="market_name_order" placeholder="Market Name (Order)" required>
        <input type="number" step="0.01" name="cost_in_syp" placeholder="Cost in SYP" required>
        <input type="number" step="0.01" name="delivery_cost_syp" placeholder="Delivery Cost in SYP" required>
        <input type="text" name="delivery_area" placeholder="Delivery Area" required>
        <input type="text" name="category" placeholder="Category" required>
        <input type="text" name="amount" placeholder="Amount" required>
        <input type="text" name="notes" placeholder="Notes" required>
        <input type="text" name="client_type" placeholder="Client Type" required>
        <input type="text" name="source" placeholder="Source" required>
        <input type="text" name="employee" placeholder="Employee" required>
        <input type="text" name="pre_order" placeholder="Pre Order" required>
        <input type="datetime-local" name="delivery_date" placeholder="Delivery Date" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="phone_number" placeholder="Phone Number" required>
        <button type="submit" class="btn btn-primary">Add Item</button>
    </form>
</div>
@endsection
