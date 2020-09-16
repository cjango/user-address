<?php

namespace Jason\Address\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{

    /**
     * Notes: 上级地区
     * @Author: <C.Jason>
     * @Date: 2019/11/19 3:01 下午
     * @return mixed
     */
    public function parent()
    {
        return $this->belongsTo(__CLASS__, 'parent_id');
    }

    /**
     * Notes: 下级地区
     * @Author: <C.Jason>
     * @Date: 2019/11/19 3:01 下午
     * @return mixed
     */
    public function children()
    {
        return $this->hasMany(__CLASS__, 'parent_id');
    }

}