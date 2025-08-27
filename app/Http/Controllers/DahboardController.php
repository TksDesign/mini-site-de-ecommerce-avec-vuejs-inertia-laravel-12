<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Inertia\Inertia;

class DahboardController extends Controller
{
    public function index(Request $request){
        // la fonnction listing vient de User.php
        $listing = $request->user()->role !=='suspended' ?
        $request->user()->listing()->latest()->paginate(3)
        :null;

        return Inertia::render('Dashboard',[
            'listings'=>$listing,
            'status'=>session('status')
        ]);
    }
}
