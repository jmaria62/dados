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
    //public function update(Request $request, User $user)
    public function update(User $user, $name)
    {
        
        /*
         return response()->json([
            'user auth id' => auth()->user()->id,
            'user ' => $user->id
        ],200);
        */
       
        if ((auth()->user()->id == $user->id) || (auth()->user()->administrator == 1)){
        
            $user->update(['name' => $name]);
            //return $user;
            return response()->json([
                'message' => 'name updated',
                'data' => $user
            ],200);
        
        }
        else {
            return response()->json([
                'message' => 'user denied'
            ],400);
        };

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ((auth()->user()->id == $user->id) || (auth()->user()->administrator == 1)){
        $user->delete();
        return response()->json([
            'message' => 'success'
        ],204);
        } else {
            return response()->json([
                'message' => 'user denied'
            ],400);

        }
    }

    public function rollDice(User $user, Request $request){

        if ((auth()->user()->id == $user->id) || (auth()->user()->administrator == 1)){
            $roll = new Roll;
            $roll->user_id = $user->id;
            $roll->value1 = rand(1,6);
            $roll->value2 = rand(1,6);
            $roll->save();
            return response()->json([
                'roll' => $roll,
                'token' => $request->bearerToken(),
                
            ]);
        } else {
            return response()->json([
                'message' => 'user denied'
            ],400);
        }

    

    }

    public function userAverage(User $user){
        $rolls = User::find($user->id)->rolls;
        //$rolls = $user->rolls();
        $win = 0;
        $count = 0;

        foreach($rolls as $roll){
            $count ++;
            $amount = $roll->value1 + $roll->value2;

            if ($amount == 7) $win++;

        }
        if ($count > 0) {
            $average = round($win/$count,2);
        } else {
            $average=0;        
        }
        return response()->json([
            'user' => $user->id,
            'win' => $win,
            'rolls' => $count,
            'average' => $average
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
                if ($count > 0) {
                    $average = round($win/$count,2);
                } else {
                    $average=0;        
                }

               
                $res[]=[
                    'user'=> $user->id,
                    'win' => $win,
                    'rolls' => $count,
                    'average' => $average ];

                
                

            }


            //return response()->json($res);
            return $res;
               

    }

    public function userLooser(){

        $resUsers = $this->usersAverage();
        $min = 100;
        $minUser = 0;
        foreach($resUsers as $resUser){
            if ($resUser['rolls'] > 0){
                $aux = $resUser['win']/$resUser['rolls'];
                if ($aux < $min) {
                    $min = $aux;
                    $minUser = $resUser;
                }
            }

        }

        return $minUser;


    }

    public function userWinner(){

        $resUsers = $this->usersAverage();
        $max = 0;
        $maxUser = 0;
        foreach($resUsers as $resUser){
            if ($resUser['rolls'] > 0){
                $aux = $resUser['win']/$resUser['rolls'];
                if ($aux > $max) {
                    $max = $aux;
                    $maxUser = $resUser;
                }
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

    public function userProfile(){
        return response()->json([
            'status' => 1,
            'messsage' => 'User Profile', 
            'data' => auth()->user(),
            'id' => auth()->user()->id
        ]);
    }

    public function logout(){
        auth()->user()->tokens()->delete();
        

        return response()->json([
            'status' => 1,
            'messsage' => 'logout', 
            
        ]);

    }

}


