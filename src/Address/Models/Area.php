<?php

namespace Jason\Address\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{

    public $timestamps = false;

    /**
     * Notes: 上级地区
     * @Author: <C.Jason>
     * @Date  : 2019/11/19 3:01 下午
     * @return mixed
     */
    public function parent()
    {
        return $this->belongsTo(__CLASS__, 'parent_id');
    }

    /**
     * Notes: 下级地区
     * @Author: <C.Jason>
     * @Date  : 2019/11/19 3:01 下午
     * @return mixed
     */
    public function children()
    {
        return $this->hasMany(__CLASS__, 'parent_id');
    }

    /**
     * Notes: 获取区划层级名称
     * @Author: <C.Jason>
     * @Date  : 2020/11/6 11:00 上午
     */
    public function getDepthNameAttribute()
    {
        switch ($this->depth) {
            case 0:
                return '国家级';
                break;
            case 1:
                return '省级';
                break;
            case 2:
                return '市级';
                break;
            case 3:
                return '区县';
                break;
        }
    }

}
