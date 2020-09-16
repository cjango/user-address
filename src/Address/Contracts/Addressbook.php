<?php

namespace Jason\Address\Contracts;

/**
 * 用户地址 契约
 */
interface Addressbook
{

    /**
     * Notes: 收件人姓名
     * @Author: <C.Jason>
     * @Date: 2019/11/21 11:36 上午
     * @return string
     */
    public function getName(): string;

    /**
     * Notes: 收件人电话
     * @Author: <C.Jason>
     * @Date: 2019/11/21 11:36 上午
     * @return string
     */
    public function getMobile(): string;

    /**
     * Notes: 获取省份ID
     * @Author: <C.Jason>
     * @Date: 2019/11/21 11:36 上午
     * @return int
     */
    public function getProvinceId(): int;

    /**
     * Notes: 获取城市ID
     * @Author: <C.Jason>
     * @Date: 2019/11/21 11:34 上午
     * @return int
     */
    public function getCityId(): int;

    /**
     * Notes: 获取地区ID
     * @Author: <C.Jason>
     * @Date: 2019/11/21 11:34 上午
     * @return int
     */
    public function getDistrictId(): int;

    /**
     * Notes: 获取地址
     * @Author: <C.Jason>
     * @Date: 2019/11/21 11:34 上午
     * @return string
     */
    public function getAddress(): string;

    /**
     * Notes: 收件人完整地址
     * @Author: <C.Jason>
     * @Date: 2019/11/21 11:35 上午
     * @param null $separators 分隔符
     * @return string
     */
    public function getFullAddress($separators = null): string;

}
