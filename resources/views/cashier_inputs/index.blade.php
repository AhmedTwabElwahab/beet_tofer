@extends('layouts.app')

@section('title', 'إدارة مدخلات الكاشيرات')

@section('content')
    {{-- 1. تقليل المسافة العمودية للصفحة من py-10 إلى py-6 --}}
    <div class="bg-gray-50 min-h-screen py-6">

        {{-- 2. تقليل المسافة الداخلية للبطاقة من p-8 إلى p-6 --}}
        <div class="max-w-7xl mx-auto p-6 bg-white rounded-xl shadow-2xl ring-1 ring-gray-100">

            {{-- العنوان + فلتر + إضافة جديد --}}
            {{-- 3. تقليل المسافة السفلية من mb-8 إلى mb-6 --}}
            <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                <h2 class="text-3xl font-extrabold text-indigo-800 border-b-4 border-indigo-300 pb-1">
                    إدارة مدخلات الكاشيرات
                </h2>

                <div class="flex flex-col sm:flex-row gap-3 items-center">
                    {{-- فلتر بالتاريخ + الأيقونات --}}
                    <form method="GET" action="{{ route('cashier.input.index') }}" class="flex gap-2 items-center">
                        <input type="date" name="filter_date" value="{{ request('filter_date') }}"
                               class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-300 focus:border-indigo-500 transition shadow-sm">

                        <button type="submit" class="bg-indigo-600 text-white p-2 rounded-lg hover:bg-indigo-700 transition shadow-md hover:shadow-lg" title="فلتر البيانات">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        <a href="{{ route('cashier.input.index') }}"
                           class="bg-slate-500 text-white p-2 rounded-lg hover:bg-slate-600 transition shadow-md" title="إزالة الفلتر">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </form>

                    <a href="{{ route('cashier.input.create') }}"
                       class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded-lg flex items-center gap-2 transition shadow-lg hover:shadow-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        إضافة جديد
                    </a>
                </div>
            </div>

            {{-- رسائل النجاح --}}
            {{-- 4. تقليل المسافة السفلية من mb-6 إلى mb-4 --}}
            @if(session('success'))
                <div class="mb-4 p-4 rounded-xl bg-green-50 text-green-700 border border-green-300 shadow-md">
                    <p class="font-medium">{{ session('success') }}</p>
                </div>
            @endif

            {{-- جدول البيانات (لا توجد تغييرات على الجدول نفسه) --}}
            <div class="overflow-x-auto border border-gray-200 rounded-xl shadow-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50 border-b-2 border-indigo-100">
                    <tr class="text-gray-700 text-xs uppercase tracking-wider">
                        <th class="px-4 py-4 text-left font-semibold">#</th>
                        <th class="px-4 py-4 text-left font-semibold">التاريخ</th>
                        <th class="px-4 py-4 text-left font-semibold">الفرع</th>
                        <th class="px-4 py-4 text-left font-semibold">رقم الكاشير</th>
                        <th class="px-4 py-4 text-left font-semibold">كاش</th>
                        <th class="px-4 py-4 text-left font-semibold">شبكة</th>
                        <th class="px-4 py-4 text-left font-semibold">مرتجع</th>
                        <th class="px-4 py-4 text-center font-semibold">الإجراءات</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100 text-sm">
                    @forelse($cashierInputs as $input)
                        <tr class="hover:bg-indigo-50 transition">
                            <td class="px-4 py-3 font-medium text-gray-800">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3">{{ \Carbon\Carbon::parse($input->input_date)->format('Y-m-d') }}</td>
                            <td class="px-4 py-3">{{ $input->branch->name ?? '-' }}</td>
                            <td class="px-4 py-3 font-mono text-indigo-600">{{ $input->cashier_number }}</td>
                            <td class="px-4 py-3 text-green-700 font-medium">{{ number_format($input->cash_value ?? 0, 2) }}</td>
                            <td class="px-4 py-3 text-blue-700 font-medium">{{ number_format($input->network_value ?? 0, 2) }}</td>
                            <td class="px-4 py-3 text-red-700 font-medium">{{ number_format($input->sales_return ?? 0, 2) }}</td>
                            <td class="px-4 py-3 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('cashier.input.edit', $input->id) }}"
                                       class="bg-yellow-500 text-white p-1.5 rounded-full hover:bg-yellow-600 transition shadow-md"
                                       title="تعديل المدخل">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>

                                    <form action="{{ route('cashier.input.destroy', $input->id) }}" method="POST"
                                          onsubmit="return confirm('هل أنت متأكد من حذف هذا المدخل نهائياً؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="bg-red-500 text-white p-1.5 rounded-full hover:bg-red-600 transition shadow-md"
                                                title="حذف المدخل">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-8 text-center text-gray-500 bg-gray-50">لا توجد بيانات حالياً.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            {{-- ترقيم الصفحات --}}
            {{-- 5. تقليل المسافة العلوية من mt-8 إلى mt-6 --}}
            <div class="mt-6">
                {{ $cashierInputs->links() }}
            </div>

        </div>
    </div>
@endsection
