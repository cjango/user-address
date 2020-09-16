<?php

namespace Jason\Address\Traits;

use Jason\Address\Models\Address;

trait UserHasAddress
{

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

}