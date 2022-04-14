<?php

namespace App\Http\Controllers;
use App\Models\Roll;

use Illuminate\Http\Request;

class RollController extends Controller
{
    // public function index(){
    //     return view('index',[
    //         'rolls' => Roll::latest()->paginate()
    //     ]);
    // }
    public function indexold(){
        return view('home');
    }

    public function index()
    {
     
        //return Roll::all();
        //console.log "asdfas";
        $rolls = Roll::all();
        
        return response()->json(compact('rolls'));
    }

    public function store(Request $request)
    {
        $roll = Roll::create($request->all());

        return response()->json(compact('roll'));
    }

    public function delete($roll) {
        $roll->delete();
        return response()->json(compact('roll'));

    }

    public function destroyRoll(Roll $roll)
    {
        //$rolls = User::find($user->id)->rolls;
        //foreach($rolls as $roll){
           $roll->delete();

    }
        
   

}
