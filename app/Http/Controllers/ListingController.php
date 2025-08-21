<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreListingRequest;
use App\Http\Requests\UpdateListingRequest;
use App\Models\Listing;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // sleep(1);
        $listings=Listing::whereHas('user',function(Builder $query){
            $query->where('role','!=','suspended'); //si le role de l'utilisateur n'est pas suspendu alors on affiche ses listing
        })
        ->with('user')
        ->where('approved',true) //affiche uniquement les cards approuve
        // ->where('title','like','%' .$request->search. '%') // on va rechercher celon la column title
        ->filter(request((['search','user_id','tag']))) //vient de listing.php
        ->latest()
        ->paginate(6) //pour afficher 6 paginate avec le nom d'utilisateur
        ->withQueryString(); //pour concerver l'element recherche 
        return Inertia::render('Home',[
            'listings'=>$listings,
            'searchTerm'=>$request->search,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreListingRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateListingRequest $request, Listing $listing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        //
    }
}
