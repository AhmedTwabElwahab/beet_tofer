@extends('layouts.app')

@section('title', 'تعديل بيانات مبيعات الكاشير')

@section('content')
    <div class="bg-white rounded-lg shadow-md p-6 max-w-3xl mx-auto">
        <h2 class="text-3xl font-bold mb-6 text-center">تعديل بيانات مبيعات الكاشير</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('cashier.input.update', $cashierInput->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-gray-700 mb-1">التاريخ</label>
                <input
                    type="date"
                    name="input_date"
                    value="{{ old('input_date', \Carbon\Carbon::parse($cashierInput->input_date)->format('Y-m-d')) }}"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-200">
            </div>

            <div>
                <label class="block text-gray-700 mb-1">الفرع</label>
                <select name="branch_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-200">
                    <option value="">-- اختر الفرع --</option>
                    @foreach($branches as $branch)
                        <option value="{{ $branch->id }}"
                            {{ $cashierInput->branch_id == $branch->id ? 'selected' : '' }}>
                            {{ $branch->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-gray-700 mb-1">رقم الكاشير</label>
                <input type="text" name="cashier_number" value="{{ old('cashier_number', $cashierInput->cashier_number) }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-200">
            </div>

            <div>
                <label class="block text-gray-700 mb-1">كاش</label>
                <input type="number" step="0.01" name="cash_value" value="{{ old('cash_value', $cashierInput->cash_value) }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-200">
            </div>

            <div>
                <label class="block text-gray-700 mb-1">شبكة</label>
                <input type="number" step="0.01" name="network_value" value="{{ old('network_value', $cashierInput->network_value) }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-200">
            </div>

            <div>
                <label class="block text-gray-700 mb-1">مرتجع</label>
                <input type="number" step="0.01" name="sales_return" value="{{ old('sales_return', $cashierInput->sales_return) }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-200">
            </div>

            <div>
                <label class="block text-gray-700 mb-1">رقم السند</label>
                <input type="number" step="0.01" name="bond_number" value="{{ old('bond_number', $cashierInput->bond_number) }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-200">
            </div>

            <div class="flex justify-between mt-6">
                <a href="{{ route('cashier.input.index') }}"
                   class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">
                    رجوع
                </a>
                <button type="submit"
                        class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                    حفظ التعديلات
                </button>
            </div>
        </form>
    </div>
@endsection
