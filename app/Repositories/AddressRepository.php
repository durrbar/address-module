<?php

namespace Modules\Address\Repositories;

use Modules\Address\Models\Address;
use Modules\Core\Repositories\BaseRepository;

class AddressRepository extends BaseRepository
{
    /**
     * Configure the Model
     **/
    public function model()
    {
        return Address::class;
    }
}
