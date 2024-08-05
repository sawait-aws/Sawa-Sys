@extends('layouts.app')

@section('title', 'Edit Swaida Entry')

@section('content')
<div class="form-container">
    <h2>Edit Swaida Item</h2>
    <form method="POST" action="{{ url('/swaidaEdit/' . $item->id) }}">
        @csrf
        <input type="date" name="date" id="date" value="{{ $item->date }}" required>
        <input type="text" name="name_of_client" id="name_of_client" value="{{ $item->name_of_client }}" required>
        <input type="text" name="submarket" id="submarket" value="{{ $item->submarket }}" required>
        <input type="text" name="country" id="country" value="{{ $item->country }}" required>
        <input type="number" name="total_amount" id="total_amount" value="{{ $item->total_amount }}" required>
        <input type="number" name="delivery_cost" id="delivery_cost" value="{{ $item->delivery_cost }}" required>
        <input type="text" name="payment_method" id="payment_method" value="{{ $item->payment_method }}" required>
        <input type="text" name="market_name_app" id="market_name_app" value="{{ $item->market_name_app }}" required>
        <input type="text" name="market_name_order" id="market_name_order" value="{{ $item->market_name_order }}" required>
        <input type="number" name="cost_in_syp" id="cost_in_syp" value="{{ $item->cost_in_syp }}" required>
        <input type="number" name="delivery_cost_syp" id="delivery_cost_syp" value="{{ $item->delivery_cost_syp }}" required>
        <input type="text" name="delivery_area" id="delivery_area" value="{{ $item->delivery_area }}" required>
        <input type="text" name="category" id="category" value="{{ $item->category }}" required>
        <input type="number" name="amount" id="amount" value="{{ $item->amount }}" required>
        <input type="text" name="notes" id="notes" value="{{ $item->notes }}" required>
        <input type="text" name="client_type" id="client_type" value="{{ $item->client_type }}" required>
        <input type="text" name="source" id="source" value="{{ $item->source }}" required>
        <input type="text" name="employee" id="employee" value="{{ $item->employee }}" required>
        <input type="text" name="pre_order" id="pre_order" value="{{ $item->pre_order }}" required>
        <input type="datetime-local" name="delivery_date" id="delivery_date" value="{{ $item->delivery_date }}" required>
        <input type="email" name="email" id="email" value="{{ $item->email }}" required>
        <input type="text" name="phone_number" id="phone_number" value="{{ $item->phone_number }}" required>
        <button type="submit" class="btn btn-primary">Update Item</button>
    </form>
</div>
@endsection
