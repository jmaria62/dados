<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Roll;
use Illuminate\Http\Request;
use App\Http\Resources\v1\RollResource;
use App\Http\Resources\v1\RollCollection;

class RollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
        //return Roll::all();
        
        $rolls = Roll::all();
        //console.log("juasn");
        
        
        return response()->json(compact('rolls'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $roll = Roll::create($request->all());

        return response()->json(compact('roll'));
    }

    public function delete($roll) {
        $roll->delete();
        return response()->json(compact('roll'));

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Roll  $roll
     * @return \Illuminate\Http\Response
     */
    public function show(Roll $roll)
    {
        return $roll;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Roll  $roll
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Roll $roll)    
    {
       //return $roll; 
        $roll->update($request->all());
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Roll  $roll
     * @return \Illuminate\Http\Response
     */
    public function destroy(Roll $roll)
    {
        $roll->delete();
        return response()->json([
            'message' => 'success'
        ],204);
    }

    public function rollDice ($user_id){
        $roll = new Roll;
        $roll->user_id = $user_id;
        $roll->value1 = rand(1,6);
        $roll->value2 = rand(1,6);
        $roll->save();

       
    }

    public function destroyRoll(Roll $roll) {
        //$rolls = User::find($user->id)->rolls;
        //foreach($rolls as $roll){
           $roll->delete();

        
        
        //return response()->json([
       //     'message' => 'success'
        //],204);
    }
}
