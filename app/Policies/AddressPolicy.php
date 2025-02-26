<?php

namespace Modules\Address\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Address\Models\Address;
use Modules\User\Models\User;

class AddressPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine whether the user can view the address.
     */
    public function view(User $user, Address $address): bool
    {
        // Ensure the address belongs to the user
        return $address->created_by === $user->id;
    }

    /**
     * Determine whether the user can create addresses.
     */
    public function create(User $user): bool
    {
        // Any authenticated user can create an address
        return true;
    }

    /**
     * Determine whether the user can update the address.
     */
    public function update(User $user, Address $address): bool
    {
        // Ensure the address belongs to the user
        return $address->created_by === $user->id;
    }

    /**
     * Determine whether the user can delete the address.
     */
    public function delete(User $user, Address $address): bool
    {
        // Ensure the address belongs to the user
        return $address->created_by === $user->id;
    }
}
