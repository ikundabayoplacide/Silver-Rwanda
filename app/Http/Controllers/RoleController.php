<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\AdminRole;

class RoleController extends Controller
{

    
    public function list(){
        // this will help us to display data at web
        $getrecord = AdminRole::all();
        return view("role.list", ['getrecord' => $getrecord]);
       
    }
    public function add(){
        return view("role.add");
    }
    public function store(Request $request){
        $save=new AdminRole();
        $save->name=$request->name;
        $save->role=$request->role;
        $save->save();
   return redirect("role/list")->with("success","role successfly saved");
    
    }

    public function edit($id){
        $data['getrecord']=AdminRole::getSingle($id);
        return view("role.edit",$data);
    }
    public function update($id,Request $request){
        $save=AdminRole::getSingle($id);
        $save->name=$request->name;
        $save->role=$request->role;
        $save->save();
   return redirect("role/list")->with("success","Role updated successfly ");
    
    }
    public function delete($id,Request $request){
        $save=AdminRole::getSingle($id);

        $save->delete();
   return redirect("role/list")->with("success","Role deleted successfly ");
    
    }
}
