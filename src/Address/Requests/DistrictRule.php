<?php

namespace Jason\Address\Requests;

use Illuminate\Contracts\Validation\Rule;
use Jason\Address\Models\Area;

class DistrictRule implements Rule
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
        $district = Area::find($value);
        if ($district->depth != 3) {
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
        return '区县信息选择有误';
    }

}
