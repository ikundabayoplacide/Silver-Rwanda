<?php

namespace App\Http\Controllers;

use App\Models\DeviceData;
use Illuminate\Support\Facades\Hash;
use App\Models\Farmer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Import logging
use App\Notifications\NewFarmerNotification; // Import the
class FarmersController extends Controller
{
    public function index()
    {
        // $farmers=Farmer::all();
         $farmers= Farmer::paginate(10);

        return view('farmers.index', compact('farmers'));
    }
   public function search(Request $request){
    $search=$request->search;
    $farmers=Farmer::where(function($query) use ($search){
        $query->where('name','like',"%$search%")
                ->orWhere('email','like',"%$search%");
    })->paginate(10);

    return view('farmers.index',compact('farmers','search'));


   }
    public function create(Request $request)
    {
        // $devices = DeviceData::all();
        $devices = DeviceData::select('DEVICE_ID')->distinct()->get()->pluCk('DEVICE_ID');
        // dd($devices)
        return view('farmers.register', compact('devices'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'district' => 'required',
            'phone' => 'required',
            'password' => 'required',
            'gender' => 'required',
        ]);

        $farmer = Farmer::create([
            'name' => $request->name,
            'email' => $request->email,
            'district' => $request->district,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
        ]);

        // Find the device using DEVICE_ID
        $device = DeviceData::where('DEVICE_ID', $request->device_id)->first();
        if ($device) {
            $device->farmer_id = $farmer->id;
            $device->device_state = 1;
            $device->save();
        }

        return redirect()->route('farmers.index')->with('success', 'Farmer created successfully');
    }

    public function update(Request $request, Farmer $farmers)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'district' => 'required',
            'phone' => 'required',
        ]);

        $farmers->update($request->all());

        // Find the device using DEVICE_ID
        $device = DeviceData::where('DEVICE_ID', $request->device_id)->first();
        if ($device) {
            $device->farmer_id = $farmers->id;
            $device->device_state = 1;
            $device->save();
        } else {
            return redirect()
                ->back()
                ->with('error', 'Device not found.');
        }

        return redirect()->route('farmers.index')->with('success', 'Farmer updated successfully');
    }

    public function destroy(Farmer $farmers)
    {
        $farmers->delete();

        return redirect()
            ->route('farmers.index')
            ->with('success', 'Farmer has been deleted successfully.');
    }

    public function notifications(Request $request)
    {
        $notifications = $request->user()->notifications;

        return view('notifications.index', compact('notifications'));
    }
}