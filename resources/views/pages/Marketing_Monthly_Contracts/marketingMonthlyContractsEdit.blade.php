@extends('layouts.app')

@section('title', 'Edit Marketing Monthly Contract')

@section('content')
<div class="form-container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <h2>Edit Marketing Monthly Contract</h2>
    <form method="POST" action="{{ url('/marketingMonthlyContractsEdit/' . $item->id) }}">
        @csrf
        <input type="date" name="date" value="{{ $item->date }}" required>
        <select name="market" required>
            @foreach(['اللاذقية', 'حماة', 'السويداء', 'جرمانا', 'جبلة', 'دمشق', 'بانياس', 'حلب', 'طرطوس', 'حمص'] as $market)
                <option value="{{ $market }}" {{ $item->market == $market ? 'selected' : '' }}>{{ $market }}</option>
            @endforeach
        </select>
        <input type="text" name="shop" value="{{ $item->shop }}" required>
        <input type="number" step="0.01" name="value" value="{{ $item->value }}" required>
        <button type="submit" class="btn btn-primary">Update Item</button>
    </form>
</div>
@endsection
