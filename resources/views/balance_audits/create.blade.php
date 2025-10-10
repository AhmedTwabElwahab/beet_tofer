@extends('layouts.app')

@section('title', 'Create New Balance Audit')

@section('content')
    <div class="bg-gray-50 min-h-screen flex items-start justify-center py-10">

        {{-- Form Card (Similar to Import pages but wider for many fields) --}}
        <div class="max-w-2xl w-full mx-auto bg-white rounded-xl shadow-2xl p-8 ring-1 ring-gray-100 border-t-4 border-sky-500">

            <h2 class="text-3xl font-extrabold mb-8 text-center text-slate-800">
                Create New Balance Audit Entry
            </h2>

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="mb-6 p-4 rounded-xl bg-red-50 text-red-700 border border-red-300 shadow-sm">
                    <p class="font-bold mb-2">Please fix the following errors:</p>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('balance-audits.store') }}" method="POST" class="space-y-6">
                @csrf

                {{-- Grid for side-by-side fields --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                    {{-- Date --}}
                    <div>
                        <label for="date" class="block text-sm font-medium text-gray-700 mb-2">Date</label>
                        <input type="date" id="date" name="date"
                               value="{{ old('date', date('Y-m-d')) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500 transition" required>
                    </div>

                    {{-- Cashier Number --}}
                    <div>
                        <label for="cashier_number" class="block text-sm font-medium text-gray-700 mb-2">Cashier Number</label>
                        <input type="text" id="cashier_number" name="cashier_number"
                               value="{{ old('cashier_number') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500 transition" required>
                    </div>

                    {{-- Branch ID (Assuming a simple text input here, can be a dropdown if needed) --}}
                    <div>
                        <label for="branch_id" class="block text-sm font-medium text-gray-700 mb-2">Branch ID</label>
                        <input type="number" id="branch_id" name="branch_id"
                               value="{{ old('branch_id') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500 transition" required>
                    </div>

                    {{-- User ID (Hidden or selected based on current logged-in user) --}}
                    <div>
                        <label for="user_id" class="block text-sm font-medium text-gray-700 mb-2">User ID (Auditor)</label>
                        {{-- For simplicity, let's assume the user selects from a list --}}
                        <input type="number" id="user_id" name="user_id"
                               value="{{ old('user_id', auth()->id() ?? '') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500 transition" required>
                    </div>
                </div>

                {{-- Balance Field (Full Width) --}}
                <div>
                    <label for="balance" class="block text-sm font-medium text-gray-700 mb-2">Balance Amount</label>
                    <input type="number" step="0.01" id="balance" name="balance"
                           value="{{ old('balance') }}"
                           class="w-full px-4 py-2 text-xl font-semibold border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500 transition" required>
                </div>

                {{-- Submit Button --}}
                <button type="submit"
                        class="w-full bg-sky-600 text-white py-3 px-4 rounded-lg font-semibold text-lg hover:bg-sky-700 transition shadow-lg focus:outline-none focus:ring-4 focus:ring-sky-300 flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                    </svg>
                    Save Audit Entry
                </button>
            </form>
        </div>
    </div>
@endsection
