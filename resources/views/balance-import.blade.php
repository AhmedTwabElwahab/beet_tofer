@extends('layouts.app')

@section('title', 'Import Balance')

@section('content')
    {{-- Main Container and Background --}}
    <div class="bg-gray-50 min-h-screen flex items-start justify-center py-10">

        {{-- Card Container (Wider than before for better space) --}}
        <div class="max-w-xl w-full mx-auto bg-white rounded-xl shadow-2xl p-8 ring-1 ring-gray-100">

            {{-- Title - Using Slate color from Dashboard style --}}
            <h2 class="text-3xl font-extrabold mb-8 text-center text-slate-800 border-b-2 border-sky-300 pb-2">
                Import Balance from Excel
            </h2>

            <form action="{{ route('balance.import') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                {{-- File Input --}}
                <div class="p-4 bg-sky-50 rounded-lg border border-sky-200">
                    <label for="file" class="block text-sm font-bold text-gray-700 mb-3">
                        Select Excel File (.xlsx, .xls, .csv)
                    </label>
                    <input type="file" id="file" name="file" accept=".xlsx,.xls,.csv"
                           class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-sky-500 file:text-white hover:file:bg-sky-600 transition duration-300 cursor-pointer"
                           required>
                    @error('file')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Excel Format Requirements --}}
                <div class="bg-gray-100 p-5 rounded-lg border border-gray-200 shadow-inner">
                    <h3 class="font-bold text-lg text-slate-700 mb-3 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-sky-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Required Excel Format:
                    </h3>
                    <ul class="text-sm text-gray-600 space-y-2 font-mono">
                        <li class="p-1 rounded bg-white shadow-sm border border-gray-100">
                            **Column A (1):** `user_id`
                        </li>
                        <li class="p-1 rounded bg-white shadow-sm border border-gray-100">
                            **Column B (2):** `Balance`
                        </li>
                        <li class="p-1 rounded bg-white shadow-sm border border-gray-100">
                            **Column C (3):** `date` (Format: YYYY-MM-DD)
                        </li>
                    </ul>
                </div>

                {{-- Submit Button (Using Sky Blue/Primary Color) --}}
                <button type="submit"
                        class="w-full bg-sky-600 text-white py-3 px-4 rounded-lg font-semibold text-lg hover:bg-sky-700 transition shadow-lg focus:outline-none focus:ring-4 focus:ring-sky-300">
                    <div class="flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                        </svg>
                        Import Balance Data
                    </div>
                </button>
            </form>
        </div>
    </div>
@endsection
