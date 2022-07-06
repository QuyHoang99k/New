<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class AdminSettingController extends Controller
{
    public function index()
    {
        $setting_data = Setting::where('id', 1)->first();
        return view('admin.setting.index', compact('setting_data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'new_ticker_total' => 'required',
        ], [
            'new_ticker_total.required' => 'Tên Tin Hots không được bỏ trống',
        ]);
        $setting = Setting::where('id', $id)->first();

        $setting->new_ticker_total = $request->new_ticker_total;
        $setting->status = $request->status;

        $setting->update();
        return redirect()->route('admin_setting')->with('success', 'Cập Nhật Tin Hot Thành Công');
    }
}
