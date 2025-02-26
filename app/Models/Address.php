<?php

namespace Modules\Address\Models;

use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Address\Observers\AddressObserver;
use Modules\User\Models\User;

// use Modules\Address\Database\Factories\AddressFactory;

#[ObservedBy([AddressObserver::class])]
class Address extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
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
        'created_by'
    ];

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
    public function scopePrimary($query)
    {
        return $query->where('primary', true);
    }

    /**
     * Scope to filter by address category (e.g., home, office).
     */
    public function scopeOfType($query, $addressType)
    {
        return $query->where('address_type', $addressType);
    }
}
