<?php

namespace Modules\Address\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\User\Models\User;

class Address extends Model
{
    use HasUuids;
    
    protected $table = 'address';

    public $guarded = [];

    protected $casts = [
        'address' => 'json',
        'location' => 'json',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
}
