@extends('layouts.app')

@section('title', 'إضافة جهاز جديد')

@section('content')
    <div class="bg-gray-50 min-h-screen py-6">
        <div class="max-w-2xl mx-auto p-6 bg-white rounded-xl shadow-2xl ring-1 ring-gray-100">

            {{-- العنوان باللون الجديد --}}
            <h2 class="text-3xl font-extrabold text-teal-700 border-b-4 border-teal-300 pb-1 mb-6">
                إضافة جهاز جديد
            </h2>

            <form action="{{ route('devices.store') }}" method="POST">
                @csrf

                {{-- حقل رقم الجهاز --}}
                <div class="mb-5 p-4 bg-teal-50 rounded-lg border-l-4 border-teal-300"> {{-- إضافة خلفية وحافة يسارية --}}
                    <label for="device_number" class="block text-sm font-bold text-gray-700 mb-2">رقم الجهاز</label>
                    <input type="number" name="device_number" id="device_number" value="{{ old('device_number') }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-teal-300 focus:border-teal-500 transition shadow-sm @error('device_number') border-red-500 @enderror"
                           required>
                    @error('device_number')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- حقل اختيار الفرع --}}
                <div class="mb-8 p-4 bg-teal-50 rounded-lg border-l-4 border-teal-300">
                    <label for="branch_id" class="block text-sm font-bold text-gray-700 mb-2">الفرع التابع له</label>
                    <select name="branch_id" id="branch_id"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-teal-300 focus:border-teal-500 transition shadow-sm @error('branch_id') border-red-500 @enderror"
                            required>
                        <option value="">-- اختر الفرع --</option>
                        @foreach($branches as $branch)
                            <option value="{{ $branch->id }}" {{ old('branch_id') == $branch->id ? 'selected' : '' }}>
                                {{ $branch->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('branch_id')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- أزرار الإرسال والإلغاء --}}
                <div class="flex justify-end gap-3">
                    <button type="submit"
                            class="bg-teal-600 text-white font-semibold px-6 py-2 rounded-lg hover:bg-teal-700 transition shadow-md">
                        حفظ الجهاز
                    </button>
                    <a href="{{ route('devices.index') }}"
                       class="bg-gray-400 text-white font-semibold px-6 py-2 rounded-lg hover:bg-gray-500 transition shadow-md">
                        إلغاء
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
