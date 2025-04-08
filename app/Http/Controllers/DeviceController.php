<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function storeToken(Request $request) {
        //return response()->json(['status' => 'success', 'token' => $request->token]);
        $validated = $request->validate([
            'user_cv' => 'required',
            'device_name' => 'required',
            'token' => 'required'
        ]);

        $device = Device::where([
                'user_cv' => $validated['user_cv'],
                'device_name' => $validated['device_name']
            ]);
        if ($device->count() != 0) {
            $device->update($validated);
        } else {
            $device = Device::create($validated);
        }

        return response()->json(['status' => 'success', 'token' => $request->token]);


    }
}
