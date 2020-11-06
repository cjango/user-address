<?php

namespace Jason\Address\Controller;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Jason\Address\Models\Address;
use Jason\Address\Models\Area;
use Jason\Address\Requests\AddressRequest;
use Jason\Address\Resources\AddressResource;
use Jason\Api;
use Jason\Api\Traits\ApiResponse;

class AddressController extends Controller
{

    use ApiResponse;

    /**
     * Notes: 地址列表
     * @Author: <C.Jason>
     * @Date  : 2020/11/5 5:09 下午
     * @return mixed
     */
    public function index()
    {
        $user = Api::user();

        return $this->success(AddressResource::collection($user->addresses));
    }

    /**
     * Notes: 创建地址，展示地区联动数据
     * @Author: <C.Jason>
     * @Date  : 2020/11/5 5:10 下午
     */
    public function create(Request $request)
    {
        $parentId = $request->get('parent_id', 1);

        $list = Area::where('parent_id', $parentId)->get();

        return $this->success($list);
    }

    /**
     * Notes: 保存地址
     * @Author: <C.Jason>
     * @Date  : 2020/11/5 5:13 下午
     * @param \Illuminate\Http\Request $request
     */
    public function store(AddressRequest $request)
    {
        $user = Api::user()->addresses()->create([
            'name'        => $request->name,
            'mobile'      => $request->mobile,
            'province_id' => $request->province_id,
            'city_id'     => $request->city_id,
            'district_id' => $request->district_id,
            'address'     => $request->address,
            'is_default'  => $request->is_default,
        ]);

        return $this->success([]);
    }

    /**
     * Notes: 地址详情，如果不是自己的地址，不显示
     * @Author: <C.Jason>
     * @Date  : 2020/11/5 5:31 下午
     * @param \Jason\Address\Models\Address $address
     * @return mixed
     */
    public function show(Address $address)
    {
        if ($address->user_id != Api::id()) {
            return $this->failed('', 404);
        }

        return $this->success(new AddressResource($address));
    }

    /**
     * Notes: 设置默认地址
     * @Author: <C.Jason>
     * @Date  : 2020/11/5 5:34 下午
     * @param \Jason\Address\Models\Address $address
     * @return mixed
     */
    public function setDefault(Address $address)
    {
        if ($address->user_id != Api::id()) {
            return $this->failed('', 404);
        }
        try {
            $address->setDefault();

            return $this->success([]);
        } catch (\Exception $exception) {
            return $this->failed('');
        }
    }

    /**
     * Notes: 更新地址
     * @Author: <C.Jason>
     * @Date  : 2020/11/5 5:40 下午
     */
    public function update(AddressRequest $request, Address $address)
    {
        if ($address->user_id != Api::id()) {
            return $this->failed('', 404);
        }

        $address->update([
            'name'        => $request->name,
            'mobile'      => $request->mobile,
            'province_id' => $request->province_id,
            'city_id'     => $request->city_id,
            'district_id' => $request->district_id,
            'address'     => $request->address,
            'is_default'  => $request->is_default,
        ]);

        return $this->success([]);
    }

    /**
     * Notes: 删除地址
     * @Author: <C.Jason>
     * @Date  : 2020/11/5 5:52 下午
     * @param \Jason\Address\Models\Address $address
     * @return mixed
     */
    public function destroy(Address $address)
    {
        if ($address->user_id != Api::id()) {
            return $this->failed('', 404);
        }

        try {
            $address->delete();

            return $this->success([]);
        } catch (\Exception$exception) {
            return $this->failed('');
        }
    }

}
