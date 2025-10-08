@extends('layouts.app')

@section('title', 'Import Balance')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6">
    <h2 class="text-2xl font-bold mb-6 text-center">Import Balance from Excel</h2>

    <form action="{{ route('balance.import') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label for="file" class="block text-sm font-medium text-gray-700 mb-2">Select Excel File</label>
            <input type="file" id="file" name="file" accept=".xlsx,.xls,.csv"
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div class="bg-blue-50 p-4 rounded-md">
            <h3 class="font-semibold text-blue-800 mb-2">Excel Format Requirements:</h3>
            <ul class="text-sm text-blue-700 space-y-1">
                <li>• Column 1: user_id</li>
                <li>• Column 2: Balance</li>
                <li>• Column 3: date</li>
            </ul>
        </div>

        <button type="submit" class="w-full bg-red-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            Import Balance
        </button>
    </form>
</div>
@endsection
