<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use Log;

class DeviceController extends Controller
{
    public function storeToken(Request $request)
    {
        Log::info(json_encode($request->all()));
        try {
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
            return response()->json(['status' => 'success', 'token' => $device->token]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}
