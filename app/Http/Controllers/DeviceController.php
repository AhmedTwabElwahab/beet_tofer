<?php

namespace App\Http\Controllers;

use App\Models\Branch; // تأكد من استيراد نموذج Branch
use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    // عرض جميع الأجهزة
    public function index()
    {
        $devices = Device::with('branch')->orderBy('id', 'desc')->paginate(10);
        return view('devices.index', compact('devices'));
    }

    // عرض نموذج إنشاء جهاز جديد
    public function create()
    {
        $branches = Branch::all(); // جلب قائمة الفروع
        return view('devices.create', compact('branches'));
    }

    // حفظ جهاز جديد
    public function store(Request $request)
    {
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'device_number' => 'required|integer|unique:devices,device_number',
        ]);

        Device::create($request->all());

        return redirect()->route('devices.index')->with('success', 'تم إضافة الجهاز بنجاح!');
    }

    // عرض نموذج تعديل جهاز
    public function edit(Device $device)
    {
        $branches = Branch::all();
        return view('devices.edit', compact('device', 'branches'));
    }

    // تحديث جهاز موجود
    public function update(Request $request, Device $device)
    {
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'device_number' => 'required|integer|unique:devices,device_number,' . $device->id, // تجاهل الرقم الحالي للجهاز
        ]);

        $device->update($request->all());

        return redirect()->route('devices.index')->with('success', 'تم تحديث الجهاز بنجاح!');
    }

    // حذف جهاز
    public function destroy(Device $device)
    {
        $device->delete();
        return redirect()->route('devices.index')->with('success', 'تم حذف الجهاز بنجاح!');
    }
}
