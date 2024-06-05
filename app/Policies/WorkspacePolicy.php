<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Workspace;

class WorkspacePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function view(?User $user, Workspace $ws): bool
    {
        return $user?->id === $ws->user_id;
    }
}
