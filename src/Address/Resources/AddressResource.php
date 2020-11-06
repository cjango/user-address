<?php

namespace Jason\Address\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'address_id'   => $this->id,
            'name'         => $this->name,
            'mobile'       => $this->mobile,
            'province'     => $this->province,
            'city'         => $this->city,
            'district'     => $this->district,
            'address'      => $this->address,
            'full_address' => $this->getFullAddress(),
            'default'      => $this->is_default,
            'created_at'   => (string)$this->created_at,
            'updated_at'   => (string)$this->updated_at,
        ];
    }

}
