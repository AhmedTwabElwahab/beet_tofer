@extends('layouts.app')

@section('title', 'إضافة كاشير جديد')

@section('content')
    <div class="min-h-screen bg-gray-100 flex flex-col">
        {{-- المسافة العلوية لضمان التناسق مع الهيدر --}}
        <main class="flex-grow py-8 px-4 sm:px-6 lg:px-8">

            <div class="max-w-3xl mx-auto">
                {{-- كرت النموذج --}}
                <div class="bg-white shadow-md rounded-xl border border-gray-200 overflow-hidden">

                    {{-- هيدر الكرت --}}
                    <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/50">
                        <h1 class="text-2xl font-bold text-gray-900">إضافة كاشير جديد</h1>
                        <p class="text-sm text-gray-500 mt-1">قم بتعبئة البيانات التالية لربط المستخدم بالفرع.</p>
                    </div>

                    <div class="p-8">
                        <form action="{{ route('cashiers.store') }}" method="POST">
                            @csrf

                            <div class="space-y-6">

                                {{-- رقم المستخدم - Input كبير --}}
                                <div>
                                    <label for="user_id" class="block text-sm font-bold text-gray-700 mb-2">رقم المستخدم (User ID)</label>
                                    <input type="number" name="user_id" id="user_id" value="{{ old('user_id') }}" required
                                           placeholder="أدخل رقم المستخدم هنا..."
                                           class="w-full text-lg px-4 py-4 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all outline-none">
                                    @error('user_id') <p class="text-red-500 text-xs mt-2 font-semibold">{{ $message }}</p> @enderror
                                </div>

                                {{-- الفرع - Select كبير --}}
                                <div>
                                    <label for="branch_id" class="block text-sm font-bold text-gray-700 mb-2">الفرع المختص</label>
                                    <select name="branch_id" id="branch_id" required
                                            class="w-full text-lg px-4 py-4 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all outline-none bg-white">
                                        <option value="" disabled selected>اختر الفرع من القائمة...</option>
                                        @foreach($branches as $branch)
                                            <option value="{{ $branch->id }}" {{ old('branch_id') == $branch->id ? 'selected' : '' }}>
                                                {{ $branch->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('branch_id') <p class="text-red-500 text-xs mt-2 font-semibold">{{ $message }}</p> @enderror
                                </div>

                                {{-- رقم الكاشير - Input كبير --}}
                                <div>
                                    <label for="cashier_number" class="block text-sm font-bold text-gray-700 mb-2">رقم الكاشير</label>
                                    <input type="text" name="cashier_number" id="cashier_number" value="{{ old('cashier_number') }}" required
                                           placeholder="مثال: CASH-101"
                                           class="w-full text-lg px-4 py-4 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all outline-none">
                                    @error('cashier_number') <p class="text-red-500 text-xs mt-2 font-semibold">{{ $message }}</p> @enderror
                                </div>

                                {{-- أزرار التحكم --}}
                                <div class="flex items-center justify-end gap-4 pt-6 mt-6 border-t border-gray-100">
                                    <a href="{{ route('cashiers.index') }}"
                                       class="px-6 py-3 text-sm font-bold text-gray-500 hover:text-gray-700 transition-colors">
                                        إلغاء التراجع
                                    </a>
                                    <button type="submit"
                                            class="px-8 py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-lg rounded-lg shadow-lg shadow-indigo-100 transition-all transform hover:-translate-y-0.5">
                                        حفظ البيانات
                                    </button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
