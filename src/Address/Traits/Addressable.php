<?php

namespace Jason\Address\Traits;

trait Addressable
{

    /**
     * 收件人姓名
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * 收件人电话
     * @return string
     */
    public function getMobile(): string
    {
        return $this->mobile;
    }

    /**
     * 收件人省份ID
     * @return int
     */
    public function getProvinceId(): int
    {
        return $this->province_id;
    }

    /**
     * 收件人城市ID
     * @return int
     */
    public function getCityId(): int
    {
        return $this->city_id;
    }

    /**
     * 收件人地区ID
     * @return int
     */
    public function getDistrictId(): int
    {
        return $this->district_id;
    }

    /**
     * 收件人地址
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * Notes: 收件人完整地址
     * @Author: <C.Jason>
     * @Date: 2019/11/21 11:35 上午
     * @param string $separators 分隔符
     * @return string
     */
    public function getFullAddress($separators = ' '): string
    {
        return
            $this->province->name . $separators .
            $this->city->name . $separators .
            $this->district->name . $separators .
            $this->address;
    }

}
