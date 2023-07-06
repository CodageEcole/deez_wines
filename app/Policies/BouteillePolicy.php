<?php

namespace App\Policies;

use App\Models\Bouteille;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\AuthorizationException;


class BouteillePolicy
{
    //* Seulement les admins peuvent créer, modifier ou supprimer des bouteilles.
    //* Les utilisateurs connectés peuvent voir les bouteilles. Le Response 
    //* retourne un message d'erreur à l'utilisateur s'il n'a droit d'
    //* effectuer l'action. Si oui, il est redirigé vers la page.

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->id !== null;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Bouteille $bouteille): bool
    {
        return $user->id !== null;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return $user->role === 'admin'
                    ? Response::allow()
                    : Response::deny('You must be an administrator.'); 
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Bouteille $bouteille): Response
    {
        return $user->role === 'admin'
                    ? Response::allow()
                    : Response::deny('You must be an administrator.'); 
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Bouteille $bouteille): Response
    {
        return $user->role === 'admin'
                    ? Response::allow()
                    : Response::deny('You must be an administrator.');   
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Bouteille $bouteille): Response
    {
        return $user->role === 'admin'
                    ? Response::allow()
                    : Response::deny('You must be an administrator.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Bouteille $bouteille): Response
    {
        return $user->role === 'admin'
                    ? Response::allow()
                    : Response::deny('You must be an administrator.');
    }
}
