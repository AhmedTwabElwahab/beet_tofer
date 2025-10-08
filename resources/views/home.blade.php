@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="max-w-6xl mx-auto py-8 px-4">
        <h1 class="text-3xl font-bold text-center mb-8 text-gray-800">
            Beet Tofer System
        </h1>

        {{-- الأقسام الرئيسية --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            {{-- Import Transactions --}}
            <div class="bg-white border border-gray-100 rounded-2xl shadow-sm hover:shadow-lg p-6 transition-all duration-200">
                <h2 class="text-xl font-semibold mb-3 text-blue-600">📥 Import Transactions</h2>
                <p class="text-gray-600 mb-4">Upload Excel files to import transaction data from devices.</p>
                <a href="{{ route('transaction.import.show') }}" class="inline-block bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700">
                    Import Transactions
                </a>
            </div>

            {{-- Cashier Data Entry --}}
            <div class="bg-white border border-gray-100 rounded-2xl shadow-sm hover:shadow-lg p-6 transition-all duration-200">
                <h2 class="text-xl font-semibold mb-3 text-green-600">🧾 Cashier Data Entry</h2>
                <p class="text-gray-600 mb-4">Enter cashier information across all branches with our 15-section form.</p>
                <a href="{{ route('cashier.input.index') }}" class="inline-block bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-700">
                    Data Entry
                </a>
            </div>

            {{-- Export Reports --}}
            <div class="bg-white border border-gray-100 rounded-2xl shadow-sm hover:shadow-lg p-6 transition-all duration-200">
                <h2 class="text-xl font-semibold mb-3 text-purple-600">📊 Export Reports</h2>
                <p class="text-gray-600 mb-4">Generate Excel reports of cashier data by date.</p>
                <a href="{{ route('cashier.export.show') }}" class="inline-block bg-purple-600 text-white py-2 px-4 rounded-lg hover:bg-purple-700">
                    Export Reports
                </a>
            </div>

            {{-- Export Cash Entry --}}
            <div class="bg-white border border-gray-100 rounded-2xl shadow-sm hover:shadow-lg p-6 transition-all duration-200">
                <h2 class="text-xl font-semibold mb-3 text-green-600">💰 Export Cash Entry</h2>
                <p class="text-gray-600 mb-4">Generate Excel reports of cashier data by date.</p>
                <a href="{{ route('cashierentry.export.show') }}" class="inline-block bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-700">
                    Export Cash Entry
                </a>
            </div>

            {{-- Import Balance --}}
            <div class="bg-white border border-gray-100 rounded-2xl shadow-sm hover:shadow-lg p-6 transition-all duration-200">
                <h2 class="text-xl font-semibold mb-3 text-blue-600">💼 Import Balance</h2>
                <p class="text-gray-600 mb-4">Upload Excel files to import Balance data from users.</p>
                <a href="{{ route('balance.import.show') }}" class="inline-block bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700">
                    Import Balances
                </a>
            </div>

            {{-- Export Boxes Reports --}}
            <div class="bg-white border border-gray-100 rounded-2xl shadow-sm hover:shadow-lg p-6 transition-all duration-200">
                <h2 class="text-xl font-semibold mb-3 text-purple-600">📦 Export Boxes Reports</h2>
                <p class="text-gray-600 mb-4">Generate Excel reports of cashier data by date.</p>
                <a href="{{ route('cashieraudits.index') }}" class="inline-block bg-purple-600 text-white py-2 px-4 rounded-lg hover:bg-purple-700">
                    Export Reports
                </a>
            </div>
        </div>
    </div>
@endsection
