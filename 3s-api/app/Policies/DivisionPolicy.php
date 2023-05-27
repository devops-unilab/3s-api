<?php

namespace App\Policies;

use App\Models\Division;
use App\Models\User;
use Illuminate\Auth\Access\Response;
class DivisionPolicy
{

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        if ($user->type == 'admin') {
            return Response::allow();
        }
        return Response::deny("Funcionalidade restrita a usuários administradores");
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Division $division): Response
    {

        if ($user->type == 'admin') {
            return Response::allow();
        }
        return Response::deny("Funcionalidade restrita a usuários administradores");
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        if ($user->type == 'admin') {
            return Response::allow();
        }
        return Response::deny("Funcionalidade restrita a usuários administradores");
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Division $division): Response
    {
        if($user->role === 'admin') {
            return Response::allow();
        }
        return Response::deny("Funcionalidade restrita a usuários administradores");
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Division $division): Response
    {
        if($user->role === 'admin') {
            return Response::allow();
        }
        return Response::deny("Funcionalidade restrita a usuários administradores");
    }


}
