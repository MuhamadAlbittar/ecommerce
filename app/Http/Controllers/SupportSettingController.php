<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupportSetting;

class SupportSettingController extends Controller
{
    public function index()
    {
        $settings = SupportSetting::first();
        return view('adminPanal.support.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = SupportSetting::first();

        $settings->update($request->all());

        return back()->with('success', 'Support settings updated successfully');
    }
}

