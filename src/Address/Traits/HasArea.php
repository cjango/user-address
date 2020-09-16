<?php

namespace Jason\Address\Traits;

use Jason\Address\Models\Area;

trait HasArea
{

    public function province()
    {
        return $this->belongsTo(Area::class, 'province_id', 'code');
    }

    public function city()
    {
        return $this->belongsTo(Area::class, 'city_id', 'code');
    }

    public function district()
    {
        return $this->belongsTo(Area::class, 'district_id', 'code');
    }

}
