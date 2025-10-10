@extends('layouts.app')

@section('title', 'Edit Balance Audit')

@section('content')
    <div class="bg-gray-50 min-h-screen flex items-start justify-center py-10">

        {{-- Form Card --}}
        <div class="max-w-2xl w-full mx-auto bg-white rounded-xl shadow-2xl p-8 ring-1 ring-gray-100 border-t-4 border-sky-500">

            <h2 class="text-3xl font-extrabold mb-8 text-center text-slate-800">
                Edit Balance Audit Entry #{{ $balanceAudit->id }}
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

            <form action="{{ route('balance-audits.update', $balanceAudit) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT') {{-- Required for update --}}

                {{-- Grid for side-by-side fields --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                    {{-- Date --}}
                    <div>
                        <label for="date" class="block text-sm font-medium text-gray-700 mb-2">Date</label>
                        <input type="date" id="date" name="date"
                               value="{{ old('date', $balanceAudit->date) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500 transition" required>
                    </div>

                    {{-- Cashier Number --}}
                    <div>
                        <label for="cashier_number" class="block text-sm font-medium text-gray-700 mb-2">Cashier Number</label>
                        <input type="text" id="cashier_number" name="cashier_number"
                               value="{{ old('cashier_number', $balanceAudit->cashier_number) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500 transition" required>
                    </div>

                    {{-- Branch ID --}}
                    <div>
                        <label for="branch_id" class="block text-sm font-medium text-gray-700 mb-2">Branch ID</label>
                        <input type="number" id="branch_id" name="branch_id"
                               value="{{ old('branch_id', $balanceAudit->branch_id) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500 transition" required>
                    </div>

                    {{-- User ID (Auditor) --}}
                    <div>
                        <label for="user_id" class="block text-sm font-medium text-gray-700 mb-2">User ID (Auditor)</label>
                        <input type="number" id="user_id" name="user_id"
                               value="{{ old('user_id', $balanceAudit->user_id) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500 transition" required>
                    </div>
                </div>

                {{-- Balance Field (Full Width) --}}
                <div>
                    <label for="balance" class="block text-sm font-medium text-gray-700 mb-2">Balance Amount</label>
                    <input type="number" step="0.01" id="balance" name="balance"
                           value="{{ old('balance', $balanceAudit->balance) }}"
                           class="w-full px-4 py-2 text-xl font-semibold border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500 transition" required>
                </div>

                {{-- Submit Button --}}
                <button type="submit"
                        class="w-full bg-sky-600 text-white py-3 px-4 rounded-lg font-semibold text-lg hover:bg-sky-700 transition shadow-lg focus:outline-none focus:ring-4 focus:ring-sky-300 flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zm-5.604 10.43l1.897-.62a1 1 0 01.996 0l4.134 1.701L14 16H6v-4h2.586l.598.598zM16 12H4V4h12v8z" />
                    </svg>
                    Update Audit Entry
                </button>
            </form>
        </div>
    </div>
@endsection
