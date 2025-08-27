<?php

namespace App\Policies;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ListingPolicy
{

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, Listing $listing): bool
    {
        // on ajoute le qustion mark pour dire l'utilisateur n'est pas null car on veut authoriser a l'utilisateur non connecte de pouvoir se connecter
        return $listing->user->role !=='suspended' &&  $listing->approved; //on va se rediriger vers listingcontroller dans la methode show
    }

    /**
     * Determine whether the user can create models.
     * si l'utilisateur est suspendu il n'a pas besion d'acceder a la created page
     */
    public function create(User $user): bool
    {
        return $user->role !== 'suspended';
    }


    /**
     * Determine whether the user can permanently delete the model.
     * on determine ici si un utilisateur peut modifeir ou suprimer 
     */
    public function modify(User $user, Listing $listing): bool
    {
        return $user->role !=='suspended' && $user->id === $listing->user_id;
    }
}
