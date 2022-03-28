<?php

namespace App\Http\Controllers;
use App\Models\Roll;

use Illuminate\Http\Request;

class RollController extends Controller
{
    public function index(){
        return view('index',[
            'rolls' => Roll::latest()->paginate()
        ]);
    }
    
}
