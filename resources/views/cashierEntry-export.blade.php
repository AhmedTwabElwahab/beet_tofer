@extends('layouts.app')

@section('title', 'Export Cash Entry Reports')

@section('content')
    {{-- Main Container and Background --}}
    <div class="bg-gray-50 min-h-screen flex items-start justify-center py-10">

        {{-- Card Container (Compact and clean design) --}}
        <div class="max-w-md w-full mx-auto bg-white rounded-xl shadow-2xl p-7 ring-1 ring-gray-100 border-r-4 border-yellow-500">

            {{-- Title --}}
            <h2 class="text-3xl font-extrabold mb-7 text-center text-slate-800">
                Export Cash Entry Report
            </h2>

            <form action="{{ route('cashierentry.export') }}" method="POST" class="space-y-6">
                @csrf

                {{-- Date Input Section --}}
                <div class="p-4 bg-yellow-50 rounded-lg border border-yellow-200">
                    <label for="date" class="block text-sm font-bold text-gray-700 mb-3">
                        <span class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Select Date for Report
                        </span>
                    </label>
                    <input type="date" id="date" name="date"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 transition duration-150"
                           value="{{ date('Y-m-d') }}" required>
                </div>

                {{-- Download Button (Using Yellow/Primary Color) --}}
                <button type="submit"
                        class="w-full bg-yellow-600 text-white py-3 px-4 rounded-lg font-semibold text-lg hover:bg-yellow-700 transition shadow-lg focus:outline-none focus:ring-4 focus:ring-yellow-300">
                    <div class="flex items-center justify-center gap-2">
                        {{-- الأيقونة المذكورة في لوحة التحكم (Export Cash Entry) --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V6m0 2v4m0 4v2m-6 2h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Download Excel Report
                    </div>
                </button>
            </form>

            {{-- Report Contents (Using the modern bordered list style) --}}
            <div class="mt-8 p-5 rounded-lg border-2 border-yellow-200 shadow-sm bg-yellow-50">
                <h3 class="font-bold text-lg text-yellow-800 mb-3 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m0 0l-1 1h8m-9-9h9m-9 0V6a2 2 0 012-2h4l4 4v4m-4 4h4" />
                    </svg>
                    Report Contents:
                </h3>
                <ul class="text-sm text-yellow-700 space-y-2">
                    <li class="flex justify-between items-center py-1 border-b border-yellow-200 last:border-b-0">
                        <span class="font-semibold text-gray-800">Date:</span> <span>`date`</span>
                    </li>
                    <li class="flex justify-between items-center py-1 border-b border-yellow-200 last:border-b-0">
                        <span class="font-semibold text-gray-800">Account Number:</span> <span>`account_number`</span>
                    </li>
                    <li class="flex justify-between items-center py-1 border-b border-yellow-200 last:border-b-0">
                        <span class="font-semibold text-gray-800">Description (Des):</span> <span>`Des`</span>
                    </li>
                    <li class="flex justify-between items-center py-1 border-b border-yellow-200 last:border-b-0">
                        <span class="font-semibold text-gray-800">Cost Center:</span> <span>`cost_center`</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
