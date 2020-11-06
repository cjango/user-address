<?php

namespace Jason\Address\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jason\Address\Contracts\Addressbook;
use Jason\Address\Scopes\OrderScope;
use Jason\Address\Traits\Addressable;
use Jason\Address\Traits\HasArea;

class Address extends Model implements Addressbook
{

    use Addressable,
        HasArea,
        SoftDeletes;

    protected $casts = [
        'is_default' => 'boolean',
    ];

    /**
     * @var array
     */
    protected $guarded = [
        'created_at',
        'updated_at',
    ];

    public static function boot()
    {
        parent::boot();
        static::addGlobalScope(new OrderScope);

        /**
         * 如果当前地址为默认地址，取消其他地址的默认地址设置
         */
        self::saving(function ($model) {
            if ($model->is_default && $model->id) {
                Address::where('id', '<>', $model->id)
                       ->where('user_id', $model->user_id)
                       ->where('is_default', 1)
                       ->update(['is_default' => 0]);
            } else {
                Address::where('user_id', $model->user_id)
                       ->where('is_default', 1)
                       ->update(['is_default' => 0]);
            }
        });
    }

    /**
     * Notes: 保存默认地址时转换格式,非0的都转换成0
     * @Author: <C.Jason>
     * @Date  : 2020/11/5 5:23 下午
     * @param $value
     * @return mixed
     */
    protected function setIsDefaultAttribute($value)
    {
        if (strtolower($value) === 'false' || $value === '0') {
            return $this->attributes['is_default'] = 0;
        } else {
            return $this->attributes['is_default'] = !!$value;
        }
    }

    /**
     * Notes: 关联用户
     * @Author: <C.Jason>
     * @Date  : 2019/11/19 3:34 下午
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo(config('cart.user_model'));
    }

    /**
     * Notes: 将地址设置为默认地址
     * @Author: <C.Jason>
     * @Date  : 2019/11/19 3:31 下午
     */
    public function setDefault()
    {
        $this->is_default = 1;
        $this->save();
    }

}
