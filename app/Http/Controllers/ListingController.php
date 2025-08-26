<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreListingRequest;
use App\Http\Requests\UpdateListingRequest;
use App\Models\Listing;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // sleep(1);
        $listings = Listing::whereHas('user', function (Builder $query) {
            $query->where('role', '!=', 'suspended'); //si le role de l'utilisateur n'est pas suspendu alors on affiche ses listing
        })
            ->with('user')
            ->where('approved', true) //affiche uniquement les cards approuve
            // ->where('title','like','%' .$request->search. '%') // on va rechercher celon la column title
            ->filter(request((['search', 'user_id', 'tag']))) //vient de listing.php
            ->latest()
            ->paginate(6) //pour afficher 6 paginate avec le nom d'utilisateur
            ->withQueryString(); //pour concerver l'element recherche 
        return Inertia::render('Home', [
            'listings' => $listings,
            'searchTerm' => $request->search,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Listing/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // pour gerer la selection des tags
        // $newTags = explode(',', $request->tags);
        // pour gerer l'espacement 
        // $newTags = array_map('trim', $newTags);
        // pour gerer les virgules
        // $newTags = array_filter($newTags);
        // pour gerer les doublons d'elements
        // $newTags = array_unique($newTags);
        // transformer le tableau en chaine de caractere
        // $newTags=implode(',',$newTags);

        $fields = $request->validate([
            'title' => ['required', 'max:255'],
            'desc' => ['required', 'max:5000'],
            'tags' => ['nullable', 'string'],
            'email' => ['nullable', 'email'],
            'link' => ['nullable', 'url'],
            'image' => ['nullable', 'file', 'max:3072'],

        ]);

        // enregistrer dans la base de donnée
        if ($request->hasFile('image')) {
            $fields['image'] = Storage::disk('public')->put(
                'images/listing',
                $request->image
            ); //ou va etre enregistrer l'image
        };
        // gerer le filtrage de tags
        $fields['tags'] = implode(',', array_unique(array_filter(array_map('trim', explode(',', $request->tags)))));

        // listing vient de l user.php qui represent la fonction de laison entre user et listing
        $request->user()->listing()->create($fields);
        return redirect()->route('dashboard')->with('status', 'listing created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        return Inertia::render('Listing/Show', [
            'listing' => $listing,
            'user' => $listing->user->only(['name','id']) //pour limiter les infos sur l'utilisateur au nom et a l'id
        ]);
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
    public function update(Request $request, Listing $listing) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        //
    }
}
