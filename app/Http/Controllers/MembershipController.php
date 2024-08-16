<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use Illuminate\Http\Request;

class MembershipController
extends Controller
{
    public function index()
    {
        $memberships = Membership::paginate(7);

        return
            view('memberships.index', compact('memberships'));
    }
    
    // public function searching(Request $request){
    //     $searching = $request->search;

    //     $memberships = MembershipController::where(function($query) use ($searching){
    //         $query->where('member_name', 'like', "%$searching%")
    //               ->orWhere('cooperative_name', 'like', "%$searching%");
    //     });  
    //     return view('memberships.index', compact('memberships', 'searching'));
    //   }
    public function create()
    {
        return view('memberships.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'member_name' => 'required',
            'cooperative_name' => 'required',
            'location' => 'required',
        ]);

        Membership::create($request->all());

        return redirect()->route('memberships.index')->with('success', 'Membership created successfully.');
    }

    public function show(Membership $membership)
    {
        return view('memberships.show', compact('membership'));
    }

    public function edit(Membership $membership)
    {
        return view('memberships.edit', compact('membership'));
    }

    public function update(Request $request, Membership $membership)
    {
        $request->validate([
            'member_name' => 'required',
            'cooperative_name' => 'required',
            'location' => 'required',
        ]);

        $membership->update($request->all());

        return redirect()->route('memberships.index')->with('success', 'Membership updated successfully.');
    }

    public function destroy(Membership $membership)
    {
        $membership->delete();

        return redirect()->route('memberships.index')->with('success', 'Membership deleted successfully.');
    }
}