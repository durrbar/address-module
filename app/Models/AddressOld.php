<?php

declare(strict_types=1);

namespace Modules\Address\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Address\Observers\AddressObserver;
use Modules\User\Models\User;

// use Modules\Address\Database\Factories\AddressFactory;

#[ObservedBy([AddressObserver::class])]
#[Fillable([
    'name',
    'email',
    'phone',
    'country',
    'state',
    'city',
    'zip_code',
    'address',
    'primary',
    'address_type',
    'created_by',
])]
class AddressOld extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    // protected static function newFactory(): AddressFactory
    // {
    //     // return AddressFactory::new();
    // }

    /**
     * Relationship to the user who created the address.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Scope to filter primary addresses.
     */
    #[Scope]
    public function primary($query)
    {
        return $query->where('primary', true);
    }

    /**
     * Scope to filter by address category (e.g., home, office).
     */
    #[Scope]
    public function ofType($query, $addressType)
    {
        return $query->where('address_type', $addressType);
    }
}
