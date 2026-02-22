<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Sadece süper admin kullanıcı listesini görebilir.
     */
    public function viewAny(User $user): bool
    {
        return $user->isSuperAdmin();
    }

    /**
     * Sadece süper admin kullanıcı düzenleyebilir (rol ataması).
     */
    public function update(User $user, User $model): bool
    {
        return $user->isSuperAdmin();
    }
}
