@extends('layouts.app')

@section('title', 'إدارة مستخدمي الكاشير')

@section('content')
    <div class="bg-gray-50 min-h-screen py-6">
        <div class="max-w-6xl mx-auto px-4">
            <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">

                {{-- هيدر متوازن --}}
                <div class="px-6 py-4 bg-white border-b border-gray-100 flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-800">إدارة مستخدمي الكاشير</h2>
                    <a href="{{ route('cashiers.create') }}"
                       class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-md transition shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        إضافة كاشير
                    </a>
                </div>

                {{-- الجدول بمقاسات مريحة --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase">#</th>
                            <th class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase">رقم المستخدم</th>
                            <th class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase">الفرع</th>
                            <th class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase">رقم الكاشير</th>
                            <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase">الإجراءات</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                        @forelse($cashiers as $cashier)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-3 text-center text-sm text-gray-500">{{ $loop->iteration }}</td>
                                <td class="px-6 py-3 text-sm font-medium text-gray-900">{{ $cashier->user_id }}</td>
                                <td class="px-6 py-3 text-sm text-gray-600">{{ $cashier->branch->name ?? '---' }}</td>
                                <td class="px-6 py-3 text-sm font-mono text-indigo-600">{{ $cashier->cashier_number }}</td>
                                <td class="px-6 py-3 text-center">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('cashiers.edit', $cashier->id) }}" class="text-yellow-600 hover:text-yellow-700 p-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                        </a>
                                        <form action="{{ route('cashiers.destroy', $cashier->id) }}" method="POST" onsubmit="return confirm('حذف؟');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-700 p-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="px-6 py-10 text-center text-gray-400">لا يوجد بيانات.</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- ترقيم بسيط --}}
                @if($cashiers->hasPages())
                    <div class="px-6 py-3 bg-gray-50 border-t border-gray-100">
                        {{ $cashiers->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
