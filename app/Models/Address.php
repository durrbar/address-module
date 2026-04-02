<?php

declare(strict_types=1);

namespace Modules\Address\Models;

use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\Unguarded;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Address\Policies\AddressPolicy;
use Modules\User\Models\User;

#[Table('address')]
#[Unguarded]
#[UsePolicy(AddressPolicy::class)]
class Address extends Model
{
    use HasUuids;

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    protected function casts(): array
    {
        return [
            'address' => 'json',
            'location' => 'json',
        ];
    }
}
