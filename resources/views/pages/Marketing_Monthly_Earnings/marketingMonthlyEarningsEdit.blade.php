@extends('layouts.app')

@section('title', 'Edit Marketing Monthly Earnings Entry')

@section('content')
<div class="form-container">
    <h2>Edit Marketing Monthly Earnings Item</h2>
    <form method="POST" action="{{ url('/marketingEarningsEdit/' . $item->id) }}">
        @csrf
        <input type="date" name="date" id="date" value="{{ $item->date }}" required>
        
        <select name="market" id="market" required>
            <option value="اللاذقية" {{ $item->market == 'اللاذقية' ? 'selected' : '' }}>اللاذقية</option>
            <option value="حماة" {{ $item->market == 'حماة' ? 'selected' : '' }}>حماة</option>
            <option value="السويداء" {{ $item->market == 'السويداء' ? 'selected' : '' }}>السويداء</option>
            <option value="جرمانا" {{ $item->market == 'جرمانا' ? 'selected' : '' }}>جرمانا</option>
            <option value="جبلة" {{ $item->market == 'جبلة' ? 'selected' : '' }}>جبلة</option>
            <option value="دمشق" {{ $item->market == 'دمشق' ? 'selected' : '' }}>دمشق</option>
            <option value="بانياس" {{ $item->market == 'بانياس' ? 'selected' : '' }}>بانياس</option>
            <option value="حلب" {{ $item->market == 'حلب' ? 'selected' : '' }}>حلب</option>
            <option value="طرطوس" {{ $item->market == 'طرطوس' ? 'selected' : '' }}>طرطوس</option>
            <option value="حمص" {{ $item->market == 'حمص' ? 'selected' : '' }}>حمص</option>
        </select>

        <select name="category" id="category" required>
            <option value="حلويات" {{ $item->category == 'حلويات' ? 'selected' : '' }}>حلويات</option>
            <option value="مواد غذائية" {{ $item->category == 'مواد غذائية' ? 'selected' : '' }}>مواد غذائية</option>
            <option value="هدايا" {{ $item->category == 'هدايا' ? 'selected' : '' }}>هدايا</option>
            <option value="مطاعم" {{ $item->category == 'مطاعم' ? 'selected' : '' }}>مطاعم</option>
            <option value="خدمات" {{ $item->category == 'خدمات' ? 'selected' : '' }}>خدمات</option>
        </select>

        <select name="publishing_from" id="publishing_from" required>
            <option value="تطبيق سوا" {{ $item->publishing_from == 'تطبيق سوا' ? 'selected' : '' }}>تطبيق سوا</option>
            <option value="صدى السويداء" {{ $item->publishing_from == 'صدى السويداء' ? 'selected' : '' }}>صدى السويداء</option>
        </select>

        <input type="text" name="shop" id="shop" value="{{ $item->shop }}" required>

        <select name="ad_kind" id="ad_kind" required>
            <option value="بنر اعلاني واجهة" {{ $item->ad_kind == 'بنر اعلاني واجهة' ? 'selected' : '' }}>بنر اعلاني واجهة</option>
            <option value="فتح متجر على التطبيق" {{ $item->ad_kind == 'فتح متجر على التطبيق' ? 'selected' : '' }}>فتح متجر على التطبيق</option>
            <option value="بوست فيسبوك وانستغرام" {{ $item->ad_kind == 'بوست فيسبوك وانستغرام' ? 'selected' : '' }}>بوست فيسبوك وانستغرام</option>
            <option value="بوست فيسبوك" {{ $item->ad_kind == 'بوست فيسبوك' ? 'selected' : '' }}>بوست فيسبوك</option>
            <option value="عقد شهري" {{ $item->ad_kind == 'عقد شهري' ? 'selected' : '' }}>عقد شهري</option>
            <option value="ستوري فيسبوك" {{ $item->ad_kind == 'ستوري فيسبوك' ? 'selected' : '' }}>ستوري فيسبوك</option>
            <option value="ريل من الشركة" {{ $item->ad_kind == 'ريل من الشركة' ? 'selected' : '' }}>ريل من الشركة</option>
            <option value="كتالوغ" {{ $item->ad_kind == 'كتالوغ' ? 'selected' : '' }}>كتالوغ</option>
            <option value="ادارة صفحة" {{ $item->ad_kind == 'ادارة صفحة' ? 'selected' : '' }}>ادارة صفحة</option>
        </select>

        <input type="number" name="amount" id="amount" value="{{ $item->amount }}" required>
        <input type="number" name="value" id="value" value="{{ $item->value }}" required>
        <textarea name="notes" id="notes" required>{{ $item->notes }}</textarea>

        <button type="submit" class="btn btn-primary">Update Item</button>
    </form>
</div>
@endsection
