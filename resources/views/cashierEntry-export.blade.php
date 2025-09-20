@extends('layouts.app')

@section('title', 'Export Cashier Reports')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6">
    <h2 class="text-2xl font-bold mb-6 text-center">Export Entry Cashier Report</h2>

    <form action="{{ route('cashierentry.export') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="date" class="block text-sm font-medium text-gray-700 mb-2">Select Date</label>
            <input type="date" id="date" name="date"
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                   value="{{ date('Y-m-d') }}" required>
        </div>

        <button type="submit" class="w-full bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
            Download Excel Report
        </button>
    </form>

    <div class="mt-6 bg-green-50 p-4 rounded-md">
        <h3 class="font-semibold text-green-800 mb-2">Report Contents:</h3>
        <ul class="text-sm text-green-700 space-y-1">
            <li>• Date</li>
        </ul>
    </div>
</div>
@endsection
