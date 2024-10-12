@extends('layouts.app')

@section('title', 'Edit Daily Sales Entry')

@section('content')
<div class="form-container">
    <h2>Edit Daily Sales Entry</h2>
    <form method="POST" action="{{ url('/dailySalesEdit/' . $item->id) }}">
        @csrf
        <input type="number" step="0.01" name="request_id" value="{{ $item->request_id }}" placeholder="Request ID" required>
        <input type="date" name="date" value="{{ $item->date }}" required>
        <input type="text" name="client_name" value="{{ $item->client_name }}" placeholder="Client's Name" required>

        <select name="market" required>
            <option value="Syria" {{ $item->market == 'Syria' ? 'selected' : '' }}>Syria</option>
            <option value="Lebanon" {{ $item->market == 'Lebanon' ? 'selected' : '' }}>Lebanon</option>
            <option value="Venezuela" {{ $item->market == 'Venezuela' ? 'selected' : '' }}>Venezuela</option>
            <option value="UAE" {{ $item->market == 'UAE' ? 'selected' : '' }}>UAE</option>
            <option value="Jordan" {{ $item->market == 'Jordan' ? 'selected' : '' }}>Jordan</option>
            <option value="Kuwait" {{ $item->market == 'Kuwait' ? 'selected' : '' }}>Kuwait</option>
            <option value="Saudi Arabia" {{ $item->market == 'Saudi Arabia' ? 'selected' : '' }}>Saudi Arabia</option>
        </select>

        <select name="submarket" required>
            <option value="Swaida" {{ $item->submarket == 'Swaida' ? 'selected' : '' }}>Swaida</option>
            <option value="Salkad" {{ $item->submarket == 'Salkad' ? 'selected' : '' }}>Salkad</option>
            <option value="Shahba" {{ $item->submarket == 'Shahba' ? 'selected' : '' }}>Shahba</option>
            <option value="Aleppo" {{ $item->submarket == 'Aleppo' ? 'selected' : '' }}>Aleppo</option>
            <option value="Draa" {{ $item->submarket == 'Draa' ? 'selected' : '' }}>Draa</option>
            <option value="Izraa" {{ $item->submarket == 'Izraa' ? 'selected' : '' }}>Izraa</option>
            <option value="Damascus" {{ $item->submarket == 'Damascus' ? 'selected' : '' }}>Damascus</option>
            <option value="Jaramana" {{ $item->submarket == 'Jaramana' ? 'selected' : '' }}>Jaramana</option>
            <option value="Kalamon" {{ $item->submarket == 'Kalamon' ? 'selected' : '' }}>Kalamon</option>
            <option value="Sehnaya" {{ $item->submarket == 'Sehnaya' ? 'selected' : '' }}>Sehnaya</option>
            <option value="El-Tal" {{ $item->submarket == 'El-Tal' ? 'selected' : '' }}>El-Tal</option>
            <option value="Homs" {{ $item->submarket == 'Homs' ? 'selected' : '' }}>Homs</option>
            <option value="Nassara Valley" {{ $item->submarket == 'Nassara Valley' ? 'selected' : '' }}>Nassara Valley</option>
            <option value="Latakia" {{ $item->submarket == 'Latakia' ? 'selected' : '' }}>Latakia</option>
            <option value="Jableh" {{ $item->submarket == 'Jableh' ? 'selected' : '' }}>Jableh</option>
            <option value="Tartoos" {{ $item->submarket == 'Tartoos' ? 'selected' : '' }}>Tartoos</option>
            <option value="Safita" {{ $item->submarket == 'Safita' ? 'selected' : '' }}>Safita</option>
            <option value="Banias" {{ $item->submarket == 'Banias' ? 'selected' : '' }}>Banias</option>
            <option value="Hamah" {{ $item->submarket == 'Hamah' ? 'selected' : '' }}>Hamah</option>
            <option value="Salamiah" {{ $item->submarket == 'Salamiah' ? 'selected' : '' }}>Salamiah</option>
            <option value="Hasaki" {{ $item->submarket == 'Hasaki' ? 'selected' : '' }}>Hasaki</option>
            <option value="Kameshli" {{ $item->submarket == 'Kameshli' ? 'selected' : '' }}>Kameshli</option>
            <option value="Der Alzor" {{ $item->submarket == 'Der Alzor' ? 'selected' : '' }}>Der Alzor</option>
            <option value="Lebanon" {{ $item->submarket == 'Lebanon' ? 'selected' : '' }}>Lebanon</option>
            <option value="Beirut" {{ $item->submarket == 'Beirut' ? 'selected' : '' }}>Beirut</option>
            <option value="Sayda" {{ $item->submarket == 'Sayda' ? 'selected' : '' }}>Sayda</option>
            <option value="Tarablus" {{ $item->submarket == 'Tarablus' ? 'selected' : '' }}>Tarablus</option>
            <option value="Ali" {{ $item->submarket == 'Ali' ? 'selected' : '' }}>Ali</option>
        </select>

        <input type="text" name="client_country" value="{{ $item->client_country }}" placeholder="Client's Country" required>
        <input type="number" step="0.01" name="total_amount" value="{{ $item->total_amount }}" placeholder="Total Amount" required>
        <input type="number" step="0.01" name="delivery_cost" value="{{ $item->delivery_cost }}" placeholder="Delivery Cost" required>

        <select name="payment_method" required>
            <option value="Stripe" {{ $item->payment_method == 'Stripe' ? 'selected' : '' }}>Stripe</option>
            <option value="Tap" {{ $item->payment_method == 'Tap' ? 'selected' : '' }}>Tap</option>
            <option value="Paypal" {{ $item->payment_method == 'Paypal' ? 'selected' : '' }}>Paypal</option>
            <option value="Transaction" {{ $item->payment_method == 'Transaction' ? 'selected' : '' }}>Transaction</option>
            <option value="Hand" {{ $item->payment_method == 'Hand' ? 'selected' : '' }}>Hand</option>
            <option value="Western" {{ $item->payment_method == 'Western' ? 'selected' : '' }}>Western</option>
            <option value="Anas account" {{ $item->payment_method == "Anas's account" ? 'selected' : '' }}>Anas's account</option>
            <option value="Ola account" {{ $item->payment_method == "Ola's account" ? 'selected' : '' }}>Ola's account</option>
        </select>

        <input type="text" name="store_name_app" value="{{ $item->store_name_app }}" placeholder="Store's Name on App" required>
        <input type="text" name="store_request" value="{{ $item->store_request }}" placeholder="Store Request" required>
        <input type="number" step="0.01" name="amount_in_syp" value="{{ $item->amount_in_syp }}" placeholder="Amount in SYP" required>
        <input type="number" step="0.01" name="delivery_cost_syp" value="{{ $item->delivery_cost_syp }}" placeholder="Delivery Cost in SYP" required>
        <input type="text" name="delivery_area" value="{{ $item->delivery_area }}" placeholder="Delivery Area" required>
        <input type="text" name="category" value="{{ $item->category }}" placeholder="Category" required>

        <select name="item_quantity" required>
            <option value="Single" {{ $item->item_quantity == 'Single' ? 'selected' : '' }}>Single</option>
            <option value="Multi" {{ $item->item_quantity == 'Multi' ? 'selected' : '' }}>Multi</option>
        </select>

        <input type="number" step="0.01" name="rate" value="{{ $item->rate }}" placeholder="Rate" required>

        <select name="client_request_method" required>
            <option value="CS" {{ $item->client_request_method == 'CS' ? 'selected' : '' }}>CS</option>
            <option value="App" {{ $item->client_request_method == 'App' ? 'selected' : '' }}>App</option>
        </select>

        <input type="number" step="0.01" name="commission_quantity" value="{{ $item->commission_quantity }}" placeholder="Commission Quantity" required>
        <input type="number" step="0.01" name="delivery_quantity" value="{{ $item->delivery_quantity }}" placeholder="Delivery Quantity" required>

        <select name="best_seller" required>
            <option value="1" {{ $item->best_seller == '1' ? 'selected' : '' }}>Yes</option>
            <option value="0" {{ $item->best_seller == '0' ? 'selected' : '' }}>No</option>
        </select>

        <input type="text" name="product" value="{{ $item->product }}" placeholder="Product" required>

        <select name="client_type" required>
            <option value="Old" {{ $item->client_type == 'Old' ? 'selected' : '' }}>Old</option>
            <option value="New" {{ $item->client_type == 'New' ? 'selected' : '' }}>New</option>
        </select>

        <input type="text" name="discovery_method" value="{{ $item->discovery_method }}" placeholder="Way of Discovering the App" required>
        <input type="text" name="employee_name" value="{{ $item->employee_name }}" placeholder="Employee's Name" required>

        <select name="pre_order" id="pre_order" required>
            <option value="1" {{ $item->pre_order == '1' ? 'selected' : '' }}>Yes</option>
            <option value="0" {{ $item->pre_order == '0' ? 'selected' : '' }}>No</option>
        </select>

        <input type="datetime-local" name="delivery_date" value="{{ $item->delivery_date }}" placeholder="Delivery Date" required>

        <input type="text" name="client_phone" value="{{ $item->client_phone }}" placeholder="Client's Phone Number" required>
        <input type="text" name="notes" value="{{ $item->notes }}" placeholder="Notes" >

        <button type="submit" class="btn btn-primary">Update Entry</button>
    </form>
</div>
@endsection