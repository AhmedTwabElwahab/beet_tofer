@extends('layouts.app')

@section('title', 'تصدير تقارير الكاشيرات')

@section('content')
    <div class="flex justify-center py-10 bg-gray-100">
        <div class="w-full max-w-md bg-white shadow-lg rounded-xl p-6 border border-gray-200">

            <h2 class="text-2xl font-bold mb-5 text-center text-green-700">
                📦 تصدير تقارير الكاشيرات
            </h2>

            <form action="{{ route('cashieraudits.export') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="date" class="block text-sm font-medium text-gray-700 mb-1">
                        📅 اختر التاريخ
                    </label>
                    <input
                        type="date"
                        id="date"
                        name="date"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 text-gray-800"
                        value="{{ date('Y-m-d') }}"
                    >
                </div>

                <div class="flex gap-3">
                    {{-- زر تحميل بتاريخ محدد --}}
                    <button
                        type="submit"
                        name="export_type"
                        value="single"
                        class="flex-1 bg-green-600 hover:bg-green-700 text-white py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 transition">
                        ⬇️ بتاريخ محدد
                    </button>

                    {{-- زر تحميل كل التواريخ --}}
                    <button
                        type="submit"
                        name="export_type"
                        value="all"
                        class="flex-1 bg-gray-500 hover:bg-gray-600 text-white py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-400 transition">
                        📁 كل التواريخ
                    </button>
                </div>
            </form>

            <div class="mt-6 bg-green-50 border border-green-200 p-4 rounded-md">
                <h3 class="font-semibold text-green-800 mb-1">📋 محتويات التقرير:</h3>
                <ul class="text-sm text-green-700 space-y-1">
                    <li>• التاريخ</li>
                    <li>• رقم الكاشير</li>
                    <li>• رقم الفرع</li>
                    <li>• الرصيد</li>
                    <li>• الكاش</li>
                    <li>• الشبكة</li>
                    <li>• المرتجع</li>
                </ul>
            </div>

        </div>
    </div>
@endsection
