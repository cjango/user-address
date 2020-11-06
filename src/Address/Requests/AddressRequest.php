<?php

namespace Jason\Address\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
{

    /**
     * Notes: 验证规则
     * @Author: <C.Jason>
     * @Date  : 2020/11/5 5:55 下午
     * @return array
     */
    public function rules()
    {
        return [
            'name'        => 'required|min:2|max:16',
            'mobile'      => ['required', 'numeric', 'regex:/^1[3|4|5|6|7|8|9][0-9]{9}$/'],
            'province_id' => ['required', 'numeric', new ProvinceRule()],
            'city_id'     => ['required', 'numeric', new CityRule()],
            'district_id' => ['required', 'numeric', new DistrictRule()],
            'address'     => 'required|min:2|max:255',
        ];
    }

    /**
     * Notes: 验证错误提示信息
     * @Author: <C.Jason>
     * @Date  : 2020/11/6 9:33 上午
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'        => '收件人必须填写',
            'name.min'             => '收件人姓名至少:min位字符',
            'name.max'             => '收件人姓名最多:max位字符',
            'mobile.required'      => '手机号码必须填写',
            'mobile.numeric'       => '手机号码必须是数字',
            'mobile.regex'         => '手机号码格式不正确',
            'province_id.required' => '所在省份必须填写',
            'province_id.numeric'  => '所在省份格式不正确',
            'city_id.required'     => '所在城市必须填写',
            'city_id.numeric'      => '所在城市格式不正确',
            'district_id.required' => '所在区县必须填写',
            'district_id.numeric'  => '所在区县格式不正确',
            'address.required'     => '详细地址必须填写',
            'address.min'          => '详细地址至少:min位字符',
            'address.max'          => '详细地址最多:max位字符',
        ];
    }

}
