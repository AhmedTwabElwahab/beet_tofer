<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Beet Tofer')</title>
    {{-- استخدام Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- يمكن إضافة خطوط Google Fonts هنا إذا أردت تصميم أكثر تميزًا --}}
</head>
<body class="bg-gray-50 font-sans antialiased">
{{-- الخلفية تم تعديلها من gray-100 إلى gray-50 لتكون أنظف وأكثر حداثة --}}

@include('layouts.nav')

<main>
    {{-- تنبيهات الرسائل (Messages/Alerts) --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
        @if(session('success'))
            <div class="bg-green-50 border border-green-300 text-green-700 px-4 py-3 rounded-lg shadow-md mb-4 flex items-center" role="alert">
                <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 border border-red-300 text-red-700 px-4 py-3 rounded-lg shadow-md mb-4 flex items-center" role="alert">
                <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="font-medium">{{ session('error') }}</span>
            </div>
        @endif
    </div>

    {{-- هنا سيتم تحميل محتوى كل صفحة، وستقوم الصفحات الداخلية بتحديد مساحتها (max-w-...) --}}
    @yield('content')
</main>
</body>
</html>
