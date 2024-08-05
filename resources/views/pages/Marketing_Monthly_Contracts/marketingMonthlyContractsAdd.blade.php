@extends('layouts.app')

@section('title', 'Add New Marketing Monthly Contract')

@section('content')
<div class="form-container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <h2>Add New Marketing Monthly Contract</h2>
    <form method="POST" action="{{ url('/marketingMonthlyContractsAdd') }}">
        @csrf
        <input type="date" name="date" placeholder="Date" required>
        <select name="market" required>
            <option value="" disabled selected>Select Market</option>
            @foreach(['اللاذقية', 'حماة', 'السويداء', 'جرمانا', 'جبلة', 'دمشق', 'بانياس', 'حلب', 'طرطوس', 'حمص'] as $market)
                <option value="{{ $market }}">{{ $market }}</option>
            @endforeach
        </select>
        <input type="text" name="shop" placeholder="Shop" required>
        <input type="number" step="0.01" name="value" placeholder="Value" required>
        <button type="submit" class="btn btn-primary">Add Item</button>
    </form>
</div>
@endsection
