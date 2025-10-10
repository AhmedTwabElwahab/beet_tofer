@extends('layouts.app')

@section('title', 'Import Transactions')

@section('content')
    {{-- Main Container and Background --}}
    <div class="bg-gray-50 min-h-screen flex items-start justify-center py-10">

        {{-- Card Container (Slightly narrower than Balance for variety) --}}
        <div class="max-w-md w-full mx-auto bg-white rounded-xl shadow-2xl p-7 ring-1 ring-gray-100 border-t-4 border-indigo-500">

            {{-- Title - Using Slate color from Dashboard style --}}
            <h2 class="text-3xl font-extrabold mb-7 text-center text-slate-800">
                Import Transactions from Excel
            </h2>

            <form action="{{ route('transaction.import') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf

                {{-- File Input --}}
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <label for="file" class="block text-sm font-bold text-gray-700 mb-3">
                        Select Excel File (.xlsx, .xls, .csv)
                    </label>
                    {{-- File input styling using Indigo color --}}
                    <input type="file" id="file" name="file" accept=".xlsx,.xls,.csv"
                           class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-500 file:text-white hover:file:bg-indigo-600 transition duration-300 cursor-pointer"
                           required>
                    @error('file')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Excel Format Requirements - تصميم مختلف (Bordered List) --}}
                <div class="p-5 rounded-lg border-2 border-indigo-200 shadow-sm bg-indigo-50">
                    <h3 class="font-bold text-lg text-indigo-800 mb-3 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        Required Excel Format:
                    </h3>
                    {{-- استخدام flex لترتيب الأعمدة أفقياً على سطر واحد --}}
                    <div class="flex flex-col space-y-2 text-sm text-indigo-700 font-mono">
                        <div class="flex justify-between items-center py-1 border-b border-indigo-200 last:border-b-0">
                            <span class="font-semibold text-gray-800">Column A:</span> <span>`device_number`</span>
                        </div>
                        <div class="flex justify-between items-center py-1 border-b border-indigo-200 last:border-b-0">
                            <span class="font-semibold text-gray-800">Column B:</span> <span>`amount`</span>
                        </div>
                        <div class="flex justify-between items-center py-1 border-b border-indigo-200 last:border-b-0">
                            <span class="font-semibold text-gray-800">Column C:</span> <span>`date` (YYYY-MM-DD)</span>
                        </div>
                    </div>
                </div>

                {{-- Submit Button (Using Indigo/Primary Color) --}}
                <button type="submit"
                        class="w-full bg-indigo-600 text-white py-3 px-4 rounded-lg font-semibold text-lg hover:bg-indigo-700 transition shadow-lg focus:outline-none focus:ring-4 focus:ring-indigo-300">
                    <div class="flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                        </svg>
                        Import Transactions
                    </div>
                </button>
            </form>
        </div>
    </div>
@endsection
