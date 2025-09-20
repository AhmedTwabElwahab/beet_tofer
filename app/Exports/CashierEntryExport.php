<?php

namespace App\Exports;


use App\Models\cashierEntry;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
class CashierEntryExport implements FromCollection, WithHeadings, WithEvents
{
    protected $date;

    public function __construct($date = null)
    {
        $this->date = $date;
    }

    public function collection()
    {

        $network = cashierEntry::where('due_date', $this->date)->get();

        $rows = collect();

        foreach ($network as $networkEntry) {
            $rows->push([
                $networkEntry->account_number, // رقم الحساب
                $networkEntry->analytical_account ?? '', // الحساب التحليلي
                $networkEntry->description ?? '', // البيان
                $networkEntry->debit_local ?? '', // مدين محلي
                '', // مدين أجنبي
                $networkEntry->credit_local ?? '', // دائن محلي
                '', // دائن أجنبي
                $networkEntry->currency ?? '', // العملة
                $networkEntry->cost_center ?? '', // مركز التكلفة
                '', // رقم المشروع
                '', // رقم النشاط
                '', // رقم المرجع
                '', // الفرع المستفيد
                '', // رقم المستفيد
                '', // رقم المديونية
                '', // طريقة احتساب الضريبة
                '', // رقم العقد
                '', // رقم الدفعة
                '', // المندوب
                '', // رقم المحصل
                '', // رقم المسوق
                $networkEntry->due_date  ? Carbon::parse($networkEntry->due_date)->format('j/m/Y') : '', // تاريخ الإستحقاق
            ]);
        }

        return $rows;
    }

    public function headings(): array
    {
        return [
            'رقم الحساب',
            'الحساب التحليلي',
            'البيان',
            'مدين محلي',
            'مدين أجنبي',
            'دائن محلي',
            'دائن أجنبي',
            'العملة',
            'مركز التكلفة',
            'رقم المشروع',
            'رقم النشاط',
            'رقم المرجع',
            'الفرع المستفيد',
            'رقم المستفيد',
            'رقم المديونية',
            'طريقة احتساب الضريبة',
            'رقم العقد',
            'رقم الدفعة',
            'المندوب',
            'رقم المحصل',
            'رقم المسوق',
            'تاريخ الإستحقاق',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                // نخلي الشيت RTL
                $event->sheet->getDelegate()->setRightToLeft(true);
            },
        ];
    }

}
