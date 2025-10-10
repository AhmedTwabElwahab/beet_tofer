@extends('layouts.app')

@section('title', 'Balance Audits Management')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-extrabold text-slate-800">Balance Audits</h1>

            {{-- مجموعة الأزرار --}}
            <div class="flex space-x-3">

                {{-- زر التصدير --}}
                <a href="{{ route('cashieraudits.index') }}"
                   class="bg-green-600 text-white py-2 px-4 rounded-lg font-semibold hover:bg-green-700 transition shadow-md flex items-center gap-1"
                   title="Export All Current Records">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m0 0v1a2 2 0 002 2h2a2 2 0 002-2v-1m-8 0H9m4-4H9" />
                    </svg>
                    Export Audit
                </a>

                {{-- زر الإضافة --}}
                <a href="{{ route('balance-audits.create') }}"
                   class="bg-sky-600 text-white py-2 px-4 rounded-lg font-semibold hover:bg-sky-700 transition shadow-md flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Add New Audit
                </a>
            </div>
        </div>

        {{-- 2. نموذج الفلتر حسب اليوم (NEW FILTER FORM) --}}
        <div class="mb-6 bg-white p-4 rounded-xl shadow-md border border-gray-100">
            <form action="{{ route('balance-audits.index') }}" method="GET" class="flex items-end space-x-4">

                {{-- حقل اختيار التاريخ --}}
                <div class="flex-grow">
                    <label for="filter_date" class="block text-sm font-medium text-gray-700 mb-1">Filter by Date</label>
                    <input type="date" id="filter_date" name="filter_date"
                           value="{{ request('filter_date') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500 transition">
                </div>

                {{-- زر الفلتر --}}
                <button type="submit"
                        class="bg-indigo-500 text-white py-2 px-4 rounded-lg font-semibold hover:bg-indigo-600 transition shadow-md flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                    </svg>
                    Apply Filter
                </button>

                {{-- زر مسح الفلتر --}}
                @if(request('filter_date'))
                    <a href="{{ route('balance-audits.index') }}"
                       class="bg-gray-400 text-white py-2 px-4 rounded-lg font-semibold hover:bg-gray-500 transition shadow-md">
                        Clear Filter
                    </a>
                @endif
            </form>
        </div>

        {{-- جدول عرض البيانات --}}
        <div class="bg-white shadow-xl rounded-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        {{-- تم تغيير text-right إلى text-center --}}
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Cashier No.</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Branch ID</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Balance</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($audits as $audit)
                        <tr>
                            {{-- تم تغيير text-right إلى text-center --}}
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center text-gray-900">{{ $audit->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-600">{{ $audit->date }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-600">{{ $audit->cashier_number }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-600">{{ $audit->branch_id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-sky-600 font-semibold">${{ number_format($audit->balance, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-600">{{ $audit->user_id ?? 'N/A' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <a href="{{ route('balance-audits.edit', $audit) }}" class="text-indigo-600 hover:text-indigo-900 mr-3" title="Edit">
                                    Edit
                                </a>
                                <form action="{{ route('balance-audits.destroy', $audit) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900"
                                            onclick="return confirm('Are you sure you want to delete this audit?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="p-4">
                {{ $audits->appends(request()->except('page'))->links() }}
            </div>
        </div>
    </div>
@endsection
