@extends('layouts.app')

@section('title', 'Add New Marketing Monthly Earnings Entry')

@section('content')
<div class="form-container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <h2>Add New Item</h2>
    <form method="POST" action="{{ url('/marketingEarningsAdd') }}">
        @csrf
        <input type="date" name="date" placeholder="Date" required>

        <select name="market" required>
            <option value="" disabled selected>Select Market</option>
            <option value="اللاذقية">اللاذقية</option>
            <option value="حماة">حماة</option>
            <option value="السويداء">السويداء</option>
            <option value="جرمانا">جرمانا</option>
            <option value="جبلة">جبلة</option>
            <option value="دمشق">دمشق</option>
            <option value="بانياس">بانياس</option>
            <option value="حلب">حلب</option>
            <option value="طرطوس">طرطوس</option>
            <option value="حمص">حمص</option>
        </select>

        <select name="category" required>
            <option value="" disabled selected>Select Category</option>
            <option value="حلويات">حلويات</option>
            <option value="مواد غذائية">مواد غذائية</option>
            <option value="هدايا">هدايا</option>
            <option value="مطاعم">مطاعم</option>
            <option value="خدمات">خدمات</option>
        </select>

        <select name="publishing_from" required>
            <option value="" disabled selected>Select Publishing From</option>
            <option value="تطبيق سوا">تطبيق سوا</option>
            <option value="صدى السويداء">صدى السويداء</option>
        </select>

        <input type="text" name="shop" placeholder="Shop" required>

        <select name="ad_kind" required>
            <option value="" disabled selected>Select Ad Kind</option>
            <option value="بنر اعلاني واجهة">بنر اعلاني واجهة</option>
            <option value="فتح متجر على التطبيق">فتح متجر على التطبيق</option>
            <option value="بوست فيسبوك وانستغرام">بوست فيسبوك وانستغرام</option>
            <option value="بوست فيسبوك">بوست فيسبوك</option>
            <option value="عقد شهري">عقد شهري</option>
            <option value="ستوري فيسبوك">ستوري فيسبوك</option>
            <option value="ريل من الشركة">ريل من الشركة</option>
            <option value="كتالوغ">كتالوغ</option>
            <option value="ادارة صفحة">ادارة صفحة</option>
        </select>

        <input type="number" step="0.01" name="amount" placeholder="Amount" required>
        <input type="number" step="0.01" name="value" placeholder="Value" required>
        <textarea name="notes" placeholder="Notes (optional)"></textarea>

        <button type="submit" class="btn btn-primary">Add Item</button>
    </form>
</div>
@endsection
