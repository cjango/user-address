# AddressBook

> 收货地址组件

## 1.安装

```shell script
composer require "jasonc/address:^2.0"
```

## 2.初始化

```shell script
php artisan vendor:publish --provider="Jason\Address\ServiceProvider"

php artisan migrate

php artisan db:seed --class=AreaSeeder
```

## 3.使用

### 1.调整用户模型

```php
<?php

use Jason\Address\Traits\UserHasAddress;

class User {

    use UserHasAddress;
}
```

### 2.增加路由

```php
<?php

use Jason\Address\Address;

/**
 * $prefix string 路由前缀
 * 当前方法推荐放置于需授权的路由作用域内
 */
Address::routes('user');

```

## 4. 路由说明

### 1.地址列表

> GET: $PREFIX/addresses

| 响应参数                | 类型   | 说明                     | 版本  |
| ----------------------- | ------ | ------------------------ | ----- |
| data                    | array  |                          | 2.0.0 |
| data.address_id         | int    | 地址编号                 | 2.0.0 |
| data.name               | string | 出仓记录说明             | 2.0.0 |
| data.mobile             | string | 出仓时间                 | 2.0.0 |
| data.province           | array  |                          | 2.0.0 |
| data.province.id        | int    | 省份ID                   | 2.0.0 |
| data.province.parent_id | int    | 上级ID                   | 2.0.0 |
| data.province.name      | string | 省份名称                 | 2.0.0 |
| data.province.depth     | int    | 地区层级0国家1省2市3区县 | 2.0.0 |
| data.city               | array  | 同省份信息               | 2.0.0 |
| data.district           | array  | 同省份信息               | 2.0.0 |
| data.address            | string | 详细地址                 | 2.0.0 |
| data.full_address       | string | 完整地址，已拼接好的     | 2.0.0 |
| data.default            | bool   | 是否为默认地址           | 2.0.0 |
| data.created_at         | string | 地址的创建时间           | 2.0.0 |
| data.updated_at         | string | 地址最后更新的时间       | 2.0.0 |

```json
{
    "status": "SUCCESS",
    "status_code": 200,
    "data": [
        {
            "address_id": 1,
            "name": "Jason",
            "mobile": "15512341234",
            "province": {
                "id": 2,
                "parent_id": 1,
                "name": "北京市",
                "depth": 1
            },
            "city": {
                "id": 53,
                "parent_id": 3,
                "name": "天津城区",
                "depth": 2
            },
            "district": {
                "id": 425,
                "parent_id": 383,
                "name": "科尔沁左翼中旗",
                "depth": 3
            },
            "address": "255",
            "full_address": "北京市 天津城区 科尔沁左翼中旗 255",
            "default": true,
            "created_at": "2020-11-06 09:51:43",
            "updated_at": "2020-11-06 11:25:19"
        }
    ]
}
```



### 2.新增地址 

#### 1.获取省市区层级信息

>  GET: $PREFIX/addresses/create

| 请求参数  | 必填 | 类型 | 说明   | 版本  |
| --------- | ---- | ---- | ------ | ----- |
| parent_id | N    | int  | 地址ID | 2.0.0 |

```json
{
    "status": "SUCCESS",
    "status_code": 200,
    "data": [
        {
            "id": 36,
            "parent_id": 2,
            "name": "北京城区",
            "depth": 2
        }
    ]
}
```

| 响应参数       | 类型   | 说明                     | 版本  |
| -------------- | ------ | ------------------------ | ----- |
| data           | array  |                          | 2.0.0 |
| data.id        | int    | 区域id                   | 2.0.0 |
| data.parent_id | string | 上级区域id               | 2.0.0 |
| data.name      | string | 区域名称                 | 2.0.0 |
| data.depth     | array  | 地区层级0国家1省2市3区县 | 2.0.0 |

#### 2.新增地址

> POST: $PREFIX/addresses

| 请求参数    | 必填 | 类型              | 说明                       | 版本  |
| ----------- | ---- | ----------------- | -------------------------- | ----- |
| name        | Y    | string            | 收件人姓名                 | 2.0.0 |
| mobile      | Y    | string            | 手机号                     | 2.0.0 |
| province_id | Y    | int               | 省份ID                     | 2.0.0 |
| city_id     | Y    | int               | 市区ID                     | 2.0.0 |
| district_id | Y    | int               | 区县ID                     | 2.0.0 |
| address     | Y    | string            | 详细地址，不需要包含省市区 | 2.0.0 |
| is_default  | N    | int\|bool\|string | 是否为默认地址             | 2.0.0 |

### 3.地址详情

> GET: $PREFIX/addresses/{address_id}

| 响应参数         | 类型  | 说明 | 版本  |
| ---------------- | ----- | ---- | ----- |
| 参考地址列表信息 | array |      | 2.0.0 |

### 4.修改地址

> PUT: $PREFIX/addresses/{address_id}

| 请求参数         | 必填 | 类型 | 说明 | 版本  |
| ---------------- | ---- | ---- | ---- | ----- |
| 参考新增地址数据 |      |      |      | 2.0.0 |

### 5.删除地址

> DELETE: $PREFIX/addresses/{address_id}

### 6.设置默认地址

> POST: $PREFIX/addresses/{address_id}/default

