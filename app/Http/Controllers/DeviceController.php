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
                'device_name' => $validated['device_name'],
                'token' => $validated['token']
            ]);
            if ($device->count() == 1) {
                Log::info(json_encode($device->first()));
                Log::info("Device already exists");
                return response()->json(['message' => 'Device already exists', 'token' => $device->first()->token]);
            }
            $device = Device::where([
                'user_cv' => $validated['user_cv'],
                'device_name' => $validated['device_name'],
            ])->first();
            if ($device) {
                $device->update($validated);
                return response()->json(['message' => 'Device updated successfully', 'token' => $device->token]);
            }

            Device::create($validated);

            return response()->json(['message' => 'Device added successfully', 'token' => $device->token]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}
