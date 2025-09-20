@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="max-w-4xl mx-auto">
    <h1 class="text-4xl font-bold text-center mb-8">Welcome to Beet Tofer System</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
            <h2 class="text-xl font-semibold mb-4 text-blue-600">Import Transactions</h2>
            <p class="text-gray-600 mb-4">Upload Excel files to import transaction data from devices.</p>
            <a href="{{ route('transaction.import.show') }}" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">
                Import Transactions
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
            <h2 class="text-xl font-semibold mb-4 text-green-600">Cashier Data Entry</h2>
            <p class="text-gray-600 mb-4">Enter cashier information across all branches with our 15-section form.</p>
            <a href="{{ route('cashier.input.index') }}" class="bg-green-600 text-white py-2 px-4 rounded hover:bg-green-700">
                Data Entry
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
            <h2 class="text-xl font-semibold mb-4 text-purple-600">Export Reports</h2>
            <p class="text-gray-600 mb-4">Generate Excel reports of cashier data by date.</p>
            <a href="{{ route('cashier.export.show') }}" class="bg-purple-600 text-white py-2 px-4 rounded hover:bg-purple-700">
                Export Reports
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
            <h2 class="text-xl font-semibold mb-4 text-green-600">Cashier Data Entry</h2>
            <p class="text-gray-600 mb-4">Generate Excel reports of cashier data by date.</p>
            <a href="{{ route('cashierentry.export.show') }}" class="bg-green-600 text-white py-2 px-4 rounded hover:bg-green-700">
                Export cash Entry
            </a>
        </div>

    </div>

    <div class="mt-12 bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-semibold mb-4">System Overview</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-lg font-semibold mb-2">Database Structure</h3>
                <ul class="space-y-1 text-gray-600">
                    <li>• Branches: 10 pre-configured branches</li>
                    <li>• Devices: Multiple devices per branch</li>
                    <li>• Transactions: Imported from Excel files</li>
                    <li>• Cashier Inputs: Manual data entry</li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold mb-2">Features</h3>
                <ul class="space-y-1 text-gray-600">
                    <li>• Excel import with validation</li>
                    <li>• Dynamic form sections</li>
                    <li>• Date-based reporting</li>
                    <li>• Responsive design</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
