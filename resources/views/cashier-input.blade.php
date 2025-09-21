@extends('layouts.app')

@section('title', 'Cashier Data Entry')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-3xl font-bold mb-8 text-center">Cashier Data Entry System</h2>
    <p class="text-center text-gray-600 mb-8">Enter cashier information for all branches. Each section contains 9 inputs arranged in 3 rows.</p>

    <form action="{{ route('cashier.input.store') }}" method="POST" id="cashierForm">
        @csrf

        <div class="mb-6 bg-blue-50 p-4 rounded-lg">
            <label class="text-lg font-medium text-gray-700 mb-2">Select Date for All Records</label>
            <input type="date" name="global_date"
                   class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                   value="{{ date('Y-m-d') }}" required>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @for($section = 1; $section <= 15; $section++)
            <div class="border border-gray-200 rounded-lg p-4">
                <h3 class="text-lg font-semibold mb-4 text-center">Section {{ $section }}</h3>

                <div class="mb-4">
                    <label class="text-sm font-medium text-gray-600 mb-2">Branch for Section {{ $section }}</label>
                    <select name="branch_ids[{{ $section }}]"
                            class="w-full px-2 py-1 text-sm border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500">
                        @foreach($branches as $index => $branch)
                            <option @if($index === $section) selected @endif value="{{ $branch->id }}">{{ $branch->name }}</option>
                        @endforeach
                    </select>
                </div>

                @for($row = 1; $row <= 3; $row++)
                <div class="mb-4 border border-gray-200 p-3 rounded" data-row="{{ $row }}">
                    <div class="text-sm font-medium text-gray-600 mb-2">Row {{ $row }}</div>
                    <div class="grid grid-cols-3 gap-2">
                        <div>
                            <label class="text-xs text-gray-500">Cashier Number</label>
                            <input type="text" name="cashier_numbers[{{ $section }}][{{ $row }}]"
                                   class="w-full px-2 py-1 text-sm border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500"
                                   placeholder="C{{ $section }}{{ $row }}">
                        </div>
                        <div>
                            <label class="text-xs text-gray-500">Cash Value</label>
                            <input type="number" step="0.01" name="cash_values[{{ $section }}][{{ $row }}]"
                                   class="w-full px-2 py-1 text-sm border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500"
                                   placeholder="0.00">
                        </div>
                        <div>
                            <label class="text-xs text-gray-500">Network Value</label>
                            <input type="number" step="0.01" name="network_values[{{ $section }}][{{ $row }}]"
                                   class="w-full px-2 py-1 text-sm border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500"
                                   placeholder="0.00">
                        </div>
                    </div>
                </div>
                @endfor

                <button type="button" onclick="addRow({{ $section }})"
                        class="w-full bg-blue-500 text-white py-1 px-2 rounded text-sm hover:bg-blue-600 focus:outline-none focus:ring-1 focus:ring-blue-500">
                    Add 3 More Inputs
                </button>
            </div>
            @endfor
        </div>

        <div class="text-center">
            <button type="submit" class="bg-green-600 text-white py-3 px-8 rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 text-lg font-semibold">
                Submit All Data
            </button>
        </div>
    </form>
</div>

<script>
function addRow(section) {
    // Find the section container
    const sections = document.querySelectorAll('.border.border-gray-200.rounded-lg.p-4');
    const sectionDiv = sections[section - 1]; // Array is 0-indexed

    if (!sectionDiv) return;

    // Get all rows with data-row attribute in this section
    const existingRows = sectionDiv.querySelectorAll('[data-row]');
    const lastRow = existingRows[existingRows.length - 1];

    if (!lastRow) return;

    // Get the next row number
    const nextRowNumber = existingRows.length + 1;

    // Clone the last row
    const newRow = lastRow.cloneNode(true);

    // Update the row number and data attribute
    newRow.setAttribute('data-row', nextRowNumber);
    newRow.querySelector('.text-sm.font-medium.text-gray-600').textContent = `Row ${nextRowNumber}`;

    // Update all input names to use the new row number
    newRow.querySelectorAll('input').forEach(input => {
        const name = input.name;
        input.name = name.replace(/\[\d+\]$/, `[${nextRowNumber}]`);
        input.value = '';
        input.placeholder = input.placeholder.replace(/\d+$/, nextRowNumber);
    });

    // Insert the new row before the button
    const button = sectionDiv.querySelector('button');
    button.parentNode.insertBefore(newRow, button);
}
</script>

<script>
    document.addEventListener("keydown", function(event) {
        if (event.key === "Enter") {
            event.preventDefault(); // يمنع الـ submit

            // العناصر القابلة للتركيز (input, select, textarea, button)
            const focusable = Array.from(document.querySelectorAll("input, select, textarea, button"))
                .filter(el => !el.disabled && el.type !== "hidden");

            const index = focusable.indexOf(document.activeElement);

            // لو مش آخر عنصر → انقل للبعضه
            if (index > -1 && index < focusable.length - 1) {
                focusable[index + 1].focus();
            }
        }
    });
</script>
@endsection
