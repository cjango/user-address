<?php

namespace Jason\Address\Requests;

use Illuminate\Contracts\Validation\Rule;
use Jason\Address\Models\Area;

class CityRule implements Rule
{

    /**
     * Notes: 判断是否通过验证规则
     * @Author: <C.Jason>
     * @Date  : 2020/11/6 9:56 上午
     * @param string $attribute
     * @param mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $city = Area::find($value);
        if ($city->depth != 2) {
            return false;
        }

        return true;
    }

    /**
     * 获取校验错误信息
     * @return string
     */
    public function message()
    {
        return '市区信息选择有误';
    }

}
