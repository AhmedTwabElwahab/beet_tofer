@extends('layouts.app')

@section('title', 'إدارة الأجهزة')

@section('content')
    {{-- استخدام Teal/Emerald بدلاً من Indigo/Blue --}}
    <div class="bg-gray-50 min-h-screen py-6">
        <div class="max-w-6xl mx-auto p-6 bg-white rounded-xl shadow-2xl ring-1 ring-gray-100">

            {{-- العنوان + زر الإضافة --}}
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-extrabold text-teal-700 border-b-4 border-teal-300 pb-1">
                    إدارة الأجهزة
                </h2>

                {{-- زر إضافة جديد --}}
                <a href="{{ route('devices.create') }}"
                   class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-4 py-2 rounded-lg flex items-center gap-2 transition shadow-lg hover:shadow-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    إضافة جهاز جديد
                </a>
            </div>

            {{-- رسائل النجاح --}}
            @if(session('success'))
                <div class="mb-6 p-4 rounded-xl bg-green-50 text-green-700 border border-green-300 shadow-md">
                    <p class="font-medium">{{ session('success') }}</p>
                </div>
            @endif

            {{-- عرض الأجهزة باستخدام نمط البطاقات --}}
            @forelse($devices as $device)
                {{-- البطاقة الرئيسية لكل جهاز --}}
                <div class="bg-white border-b border-gray-100 p-5 mb-4 rounded-lg shadow-md hover:shadow-lg transition duration-300 ease-in-out flex justify-between items-center ring-1 ring-gray-200 hover:ring-teal-300">

                    <div class="flex items-center gap-6">
                        {{-- أيقونة مميزة للجهاز --}}
                        <div class="p-3 bg-teal-100 rounded-full text-teal-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1v-3.25m-7.25-6.75h10.5a1 1 0 011 1v7a1 1 0 01-1 1H8.5a1 1 0 01-1-1v-7a1 1 0 011-1zm0 0l.25-1.5a2 2 0 012-2h6.5a2 2 0 012 2l.25 1.5M4.5 17h15" />
                            </svg>
                        </div>

                        {{-- تفاصيل الجهاز --}}
                        <div>
                            <p class="text-xs uppercase text-gray-500 font-semibold">الفرع التابع</p>
                            <p class="text-xl font-bold text-teal-600 mb-1">{{ $device->branch->name ?? 'غير محدد' }}</p>
                            <p class="text-sm text-gray-700 font-mono">رقم الجهاز: <span class="text-gray-900 font-extrabold">{{ $device->device_number }}</span></p>
                        </div>
                    </div>

                    {{-- الإجراءات (Actions) --}}
                    <div class="flex gap-2">
                        {{-- زر تعديل (Pencil Icon) --}}
                        <a href="{{ route('devices.edit', $device->id) }}"
                           class="bg-yellow-500 text-white p-2 rounded-full hover:bg-yellow-600 transition shadow-md"
                           title="تعديل الجهاز">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </a>

                        {{-- زر حذف (Trash Icon) --}}
                        <form action="{{ route('devices.destroy', $device->id) }}" method="POST"
                              onsubmit="return confirm('هل أنت متأكد من حذف هذا الجهاز نهائياً؟');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition shadow-md"
                                    title="حذف الجهاز">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </form>
                    </div>

                </div>
            @empty
                <div class="p-8 text-center text-gray-500 bg-gray-100 rounded-xl shadow-inner">
                    <p class="text-lg font-medium">لا توجد أجهزة مُضافة حالياً.</p>
                </div>
            @endforelse

            {{-- ترقيم الصفحات --}}
            <div class="mt-6">
                {{ $devices->links() }}
            </div>

        </div>
    </div>
@endsection
