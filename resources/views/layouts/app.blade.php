<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Beet Tofer')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-600 text-white shadow-lg">
        <div class="container mx-auto flex flex-col sm:flex-row items-center justify-between px-6 py-4">
            {{-- شعار / عنوان النظام --}}
            <h1 class="text-2xl font-bold mb-3 sm:mb-0">Beet Tofer System</h1>

            {{-- الروابط --}}
            <div class="flex flex-wrap items-center gap-4 sm:gap-6 text-sm sm:text-base">
                <a href="/" class="hover:text-blue-200 transition-colors">Home</a>
                <a href="{{ route('transaction.import.show') }}" class="hover:text-blue-200 transition-colors">Import Transactions</a>
                <a href="{{ route('cashier.input.index') }}" class="hover:text-blue-200 transition-colors">Cashier Input</a>
                <a href="{{ route('cashier.export.show') }}" class="hover:text-blue-200 transition-colors">Export Reports</a>
                <a href="{{ route('cashierentry.export.show') }}" class="hover:text-blue-200 transition-colors">Export Entry Reports</a>
                <a href="{{ route('balance.import.show') }}" class="hover:text-blue-200 transition-colors">Import Balances</a>
                <a href="{{ route('cashieraudits.index') }}" class="hover:text-blue-200 transition-colors">Export Boxes Reports</a>
            </div>
        </div>
    </nav>


<main class="container mx-auto py-8">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
