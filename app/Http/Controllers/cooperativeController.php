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
    {   $cooperatives = Cooperative::paginate(5);
        $memberships = Membership::paginate(10);

        $farmers = Farmer::all(); // Get all farmers

        return view('cooperatives.index', compact('cooperatives', 'farmers'));
    }

    public function searching(Request $request){
        $searching = $request->search;

        $cooperatives = cooperative::where(function($query) use ($searching){
            $query->where('name', 'like', "%$searching%")
                  ->orWhere('location', 'like', "%$searching%")
                  ->orWhere('services_offered','like',"%$searching");
        })->paginate(5);

        return view('cooperatives.index', compact('cooperatives', 'searching'));
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
// This is About Details



    public function showAssignForm()
    {

        $cooperatives = Cooperative::all();
        $farmers = Farmer::all();


        return view('cooperatives.assign', compact('cooperatives', 'farmers'));
    }


    public function assignFarmerToCooperative(Request $request)
    {
        $request->validate([
            'cooperative_id' => 'required|exists:cooperatives,id',
            'farmer_id' => 'required|exists:farmers,id',
        ]);

        $cooperative = Cooperative::findOrFail($request->cooperative_id);
        $dataInfo = Farmer::findOrFail($request->farmer_id);



        $assignmentData = [
            'member_name' => $dataInfo->name,
            'cooperative_name' => $cooperative->name,
            'location' => $cooperative->location,
        ];

        membership::create($assignmentData);

        $details=membership::all();
        // $memberships=membership::all();
        $memberships = Membership::paginate(10);




        // return redirect()->route('cooperatives.showAssignmentDetails')
        //     ->with('success', 'Farmer assigned successfully.')
        //     ->with('details', $details);

            return view('memberships.index', compact('details','memberships'));



    }

    public function showAssignmentDetails()
    {
        $details = session('details', []);
        return view('cooperatives.assignment_details', compact('details'));
    }


}