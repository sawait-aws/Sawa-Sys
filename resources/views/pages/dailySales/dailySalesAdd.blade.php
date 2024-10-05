@extends('layouts.app')

@section('title', 'Add New Daily Sales Entry')

@section('content')
<div class="form-container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <h2>Add New Daily Sale Entry</h2>
    <form method="POST" action="{{ url('/dailySalesAdd') }}">
        @csrf
        <input type="number" step="0.01" name="request_id" placeholder="Request ID" required>
        <input type="date" name="date" placeholder="Date" required>
        <input type="text" name="client_name" placeholder="Client's Name" required>

        <select name="market" required>
            <option value="">Select Market</option>
            <option value="Syria">Syria</option>
            <option value="Lebanon">Lebanon</option>
            <option value="Venezuela">Venezuela</option>
            <option value="UAE">UAE</option>
            <option value="Jordan">Jordan</option>
            <option value="Kuwait">Kuwait</option>
            <option value="Saudi Arabia">Saudi Arabia</option>
        </select>

        <select name="submarket" required>
            <option value="">Select Submarket</option>
            <option value="Swaida">Swaida</option>
            <option value="Salkad">Salkad</option>
            <option value="Shahba">Shahba</option>
            <option value="Aleppo">Aleppo</option>
            <option value="Draa">Draa</option>
            <option value="Izraa">Izraa</option>
            <option value="Damascus">Damascus</option>
            <option value="Jaramana">Jaramana</option>
            <option value="Kalamon">Kalamon</option>
            <option value="Sehnaya">Sehnaya</option>
            <option value="El-Tal">El-Tal</option>
            <option value="Homs">Homs</option>
            <option value="Nassara Valley">Nassara Valley</option>
            <option value="Latakia">Latakia</option>
            <option value="Jableh">Jableh</option>
            <option value="Tartoos">Tartoos</option>
            <option value="Safita">Safita</option>
            <option value="Banias">Banias</option>
            <option value="Hamah">Hamah</option>
            <option value="Salamiah">Salamiah</option>
            <option value="Hasaki">Hasaki</option>
            <option value="Kameshli">Kameshli</option>
            <option value="Der Alzor">Der Alzor</option>
            <option value="Lebanon">Lebanon</option>
            <option value="Beirut">Beirut</option>
            <option value="Sayda">Sayda</option>
            <option value="Tarablus">Tarablus</option>
            <option value="Ali">Ali</option>
        </select>

        <input type="text" name="client_country" placeholder="Client's Country" required>
        <input type="number" step="0.01" name="total_amount" placeholder="Total Amount" required>
        <input type="number" step="0.01" name="delivery_cost" placeholder="Delivery Cost" required>

        <select name="payment_method" required>
            <option value="">Select Payment Method</option>
            <option value="Stripe">Stripe</option>
            <option value="Tap">Tap</option>
            <option value="Paypal">Paypal</option>
            <option value="Transaction">Transaction</option>
            <option value="Hand">Hand</option>
            <option value="Western">Western</option>
            <option value="Anas account">Anas's account</option>
            <option value="Ola account">Ola's account</option>
        </select>

        <input type="text" name="store_name_app" placeholder="Store's Name on App" required>
        <input type="text" name="store_request" placeholder="Store Request" required>
        <input type="number" step="0.01" name="amount_in_syp" placeholder="Amount in SYP" required>
        <input type="number" step="0.01" name="delivery_cost_syp" placeholder="Delivery Cost in SYP" required>
        <input type="text" name="delivery_area" placeholder="Delivery Area" required>
        <input type="text" name="category" placeholder="Category" required>

        <select name="item_quantity" required>
            <option value="Single">Single</option>
            <option value="Multi">Multi</option>
        </select>

        <input type="number" step="0.01" name="rate" placeholder="Rate" required>

        <select name="client_request_method" required>
            <option value="CS">CS</option>
            <option value="App">App</option>
        </select>

        <input type="number" step="0.01" name="commission_quantity" placeholder="Commission Quantity" required>
        <input type="number" step="0.01" name="delivery_quantity" placeholder="Delivery Quantity" required>

        <select name="best_seller" required>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select>

        <input type="text" name="product" placeholder="Product" required>

        <select name="client_type" required>
            <option value="Old">Old</option>
            <option value="New">New</option>
        </select>

        <input type="text" name="discovery_method" placeholder="Way of Discovering the App" required>
        <input type="text" name="employee_name" placeholder="Employee Name" required>

        <select name="pre_order" id="pre_order" required>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select>

        <input type="datetime-local" name="delivery_date" id="delivery_date" placeholder="Delivery Date (if Pre Order)" required>
        <input type="text" name="client_phone" placeholder="Client's Phone Number" required>
        <input type="text" name="notes" placeholder="Notes" >
        
        <button type="submit" class="btn btn-primary">Add Entry</button>
    </form>
</div>
@endsection