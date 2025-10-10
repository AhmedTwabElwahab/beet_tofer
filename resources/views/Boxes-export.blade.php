@extends('layouts.app')

@section('title', 'Export Cashier Audit Reports')

@section('content')
    {{-- Main Container and Background --}}
    <div class="bg-gray-50 min-h-screen flex items-start justify-center py-10">

        {{-- Card Container (Using modern shadow and Red for Auditing/Critical Data) --}}
        <div class="max-w-md w-full mx-auto bg-white rounded-xl shadow-2xl p-7 ring-1 ring-gray-100 border-l-4 border-red-500">

            {{-- Title --}}
            <h2 class="text-3xl font-extrabold mb-7 text-center text-slate-800">
                Export Cashier Audit Report
            </h2>

            <form action="{{ route('cashieraudits.export') }}" method="POST" class="space-y-6">
                @csrf

                {{-- Date Input Section --}}
                <div class="p-4 bg-red-50 rounded-lg border border-red-200">
                    <label for="date" class="block text-sm font-bold text-gray-700 mb-3">
                        <span class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Select Specific Date
                        </span>
                    </label>
                    <input
                        type="date"
                        id="date"
                        name="date"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 text-gray-800 transition duration-150"
                        value="{{ date('Y-m-d') }}"
                    >
                </div>

                {{-- Action Buttons (Using Flex and different colors for export options) --}}
                <div class="flex gap-4 pt-2">

                    {{-- Export for Single Date --}}
                    <button
                        type="submit"
                        name="export_type"
                        value="single"
                        class="flex-1 bg-red-600 hover:bg-red-700 text-white py-3 rounded-lg font-semibold text-base focus:outline-none focus:ring-4 focus:ring-red-300 transition shadow-lg">
                        <div class="flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            Download By Date
                        </div>
                    </button>

                    {{-- Export All Dates (Secondary action, uses Gray/Neutral color) --}}
                    <button
                        type="submit"
                        name="export_type"
                        value="all"
                        class="flex-1 bg-gray-600 hover:bg-gray-700 text-white py-3 rounded-lg font-semibold text-base focus:outline-none focus:ring-4 focus:ring-gray-300 transition shadow-lg">
                        <div class="flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                            </svg>
                            Export All Data
                        </div>
                    </button>
                </div>
            </form>

            {{-- Report Contents (Modern bordered list style) --}}
            <div class="mt-8 p-5 rounded-lg border-2 border-red-200 shadow-sm bg-red-50">
                <h3 class="font-bold text-lg text-red-800 mb-3 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10m-8-4l8 4m-8-4v-2" />
                    </svg>
                    Report Contents:
                </h3>
                <ul class="text-sm text-red-700 space-y-2">
                    <li class="flex justify-between items-center py-1 border-b border-red-200 last:border-b-0">
                        <span class="font-semibold text-gray-800">Date:</span> <span>`date`</span>
                    </li>
                    <li class="flex justify-between items-center py-1 border-b border-red-200 last:border-b-0">
                        <span class="font-semibold text-gray-800">Cashier No:</span> <span>`cashier_number`</span>
                    </li>
                    <li class="flex justify-between items-center py-1 border-b border-red-200 last:border-b-0">
                        <span class="font-semibold text-gray-800">Branch No:</span> <span>`branch_id`</span>
                    </li>
                    <li class="flex justify-between items-center py-1 border-b border-red-200 last:border-b-0">
                        <span class="font-semibold text-gray-800">Balance:</span> <span>`balance`</span>
                    </li>
                    <li class="flex justify-between items-center py-1 border-b border-red-200 last:border-b-0">
                        <span class="font-semibold text-gray-800">Cash:</span> <span>`cash`</span>
                    </li>
                    <li class="flex justify-between items-center py-1 border-b border-red-200 last:border-b-0">
                        <span class="font-semibold text-gray-800">Network:</span> <span>`network`</span>
                    </li>
                    <li class="flex justify-between items-center py-1 border-b border-red-200 last:border-b-0">
                        <span class="font-semibold text-gray-800">Returned:</span> <span>`returned`</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
