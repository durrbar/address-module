<?php

namespace Modules\Address\Observers;

use Illuminate\Support\Facades\DB;
use Modules\Address\Models\Address;

class AddressObserver
{
    /**
     * Handle the Address "creating" event.
     *
     * @return void
     */
    public function creating(Address $address)
    {
        $this->ensureOnlyOnePrimary($address);
    }

    /**
     * Handle the Address "created" event.
     */
    public function created(Address $address): void
    {
        //
    }

    /**
     * Handle the Address "updating" event.
     *
     * @return void
     */
    public function updating(Address $address)
    {
        $this->ensureOnlyOnePrimary($address);
    }

    /**
     * Handle the Address "updated" event.
     */
    public function updated(Address $address): void
    {
        //
    }

    /**
     * Handle the Address "deleted" event.
     */
    public function deleted(Address $address): void
    {
        //
    }

    /**
     * Handle the Address "restored" event.
     */
    public function restored(Address $address): void
    {
        //
    }

    /**
     * Handle the Address "force deleted" event.
     */
    public function forceDeleted(Address $address): void
    {
        //
    }

    /**
     * Ensures that only one primary address exists for the same creator (user).
     *
     * @param  Address  $address
     * @return void
     */
    protected function ensureOnlyOnePrimary(Address $address): void
    {
        // Ensure the address has a valid creator
        if (!$address->created_by) {
            return; // Skip if no creator is associated
        }

        // If the address is marked as primary, reset all other primary addresses
        if ($address->primary) {
            DB::transaction(function () use ($address) {
                Address::where('created_by', $address->created_by)
                    ->where('primary', true)
                    ->where('id', '!=', $address->id) // Exclude the current address
                    ->update(['primary' => false]);
            });
        }
    }
}
