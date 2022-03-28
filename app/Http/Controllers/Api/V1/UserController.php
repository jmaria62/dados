<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\v1\UserResource;
use App\Http\Resources\v1\UserCollection;
use App\Models\Roll;

class UserController extends Controller
{
     
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UserResource::collection(User::latest()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::create($request->all());

        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([
            'message' => 'success'
        ],204);
    }

    public function rollDice(User $user){

        //return $user;
        $roll = new Roll;
        $roll->user_id = $user->id;
        $roll->value1 = rand(1,6);
        $roll->value2 = rand(1,6);
        $roll->save();

        return $roll;

    }

    public function userAverage(User $user){
        $rolls = User::find($user->id)->rolls;
        //$rolls = $user->rolls();
        $win = 0;
        $count = 0;

        foreach($rolls as $roll){
            $count ++;
            $amount = $roll->value1 + $roll->value2;

            if ($amount = 7) $win++;

        }
        return response()->json([
            'user' => $user->id,
            'win' => $win,
            'rolls' => $count
        ]);
    }

        public function usersAverage(){
            $users = User::all();

            //$i = 0;
            $res=array();

            foreach($users as $user){            
                $rolls = User::find($user->id)->rolls;
                
                $win = 0;
                $count = 0;
    
                foreach($rolls as $roll){
                    $count ++;
                     $amount = $roll->value1 + $roll->value2;    
                    if ($amount == 7) $win++;
    
                }

               
                $res[]=[
                    'user'=> $user->id,
                    'win' => $win,
                    'rolls' => $count ];

                
                

            }


            //return response()->json($res);
            return $res;
               

    }

    public function userLooser(){

        $resUsers = $this->usersAverage();
        $min = 100;
        $minUser = 0;
        foreach($resUsers as $resUser){
            $aux = $resUser['win']/$resUser['rolls'];
            if ($aux < $min) {
                $min = $aux;
                $minUser = $resUser;
            }

        }

        return $minUser;


    }

    public function userWinner(){

        $resUsers = $this->usersAverage();
        $max = 0;
        $maxUser = 0;
        foreach($resUsers as $resUser){
            $aux = $resUser['win']/$resUser['rolls'];
            if ($aux > $max) {
                $max = $aux;
                $maxUser = $resUser;
            }

        }

        return $maxUser;
    }

    public function destroyUserRolls(User $user)
    {
        $rolls = User::find($user->id)->rolls;
        foreach($rolls as $roll){
           $roll->delete();

        }
        
        return response()->json([
            'message' => 'success'
        ],204);
    }

}


