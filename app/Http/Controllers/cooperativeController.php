<?php

namespace App\Http\Controllers;

use App\Models\cooperative;
use App\Models\Farmer;
use App\Models\membership;
use Illuminate\Http\Request;

class cooperativeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cooperatives = Cooperative::all();
        return view('cooperatives.index', compact('cooperatives'));
    }

    public function create()
    {
        $farmers=Farmer::all();
        // dd($farmers);
        return view('cooperatives.create',compact('farmers'));
    }

    public function store(Request $request)
    {

        Cooperative::create($request->all());
        return redirect()->route('cooperatives.index');

    }

    public function show(Cooperative $cooperative)
    {
        return view('cooperatives.show', compact('cooperative'));
    }

    public function edit(Cooperative $cooperative)
    {
        return view('cooperatives.edit', compact('cooperative'));
    }

    public function update(Request $request, Cooperative $cooperative)
    {
        $cooperative->update($request->all());
        return redirect()->route('cooperatives.index');
    }

    public function destroy(Cooperative $cooperative)
    {
        $cooperative->delete();
        return redirect()->route('cooperatives.index');
    }

    public function showAssignForm()
    {
        // dd("hello world");
        $cooperatives = Cooperative::all();
        $farmers = Farmer::all();
        // dd('farmers and cooperatives'.$cooperatives);

        return view('cooperatives.assign', compact('cooperatives', 'farmers'));
    }

    // Handle the form submission
    public function assignFarmerToCooperative(Request $request)
    {
        $request->validate([
            'cooperative_id' => 'required|exists:cooperatives,id',
            'farmer_id' => 'required|exists:farmers,id',
        ]);

        $cooperative = Cooperative::findOrFail($request->cooperative_id);
        $dataInfo = Farmer::findOrFail($request->farmer_id);
        // $farmerId = $request->farmer_id;
        // dd('cooperative = ' . $cooperative);

        $assignmentData = [
            'member_name' => $dataInfo->name,
            'cooperative_name' => $cooperative->name,
            'location' => $cooperative->location,
        ];

        membership::create($assignmentData);
        $details=membership::all();

        // dd('data of membership = ' . $details);

        // return redirect()->route('cooperatives.index')->with('success', 'Farmer assigned successfully.');
        return redirect()->route('cooperatives.showAssignmentDetails')
            ->with('success', 'Farmer assigned successfully.')
            ->with('details', $details);


    }

    public function showAssignmentDetails()
    {
        $details = session('details', []);
        return view('cooperatives.assignment_details', compact('details'));
    }


}
