<?php

namespace Jason\Address;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

class Address
{

    /**
     * Notes: 接口路由
     * @Author: <C.Jason>
     * @Date  : 2020/11/5 5:07 下午
     * @param string $prefix
     */
    public static function routes(string $prefix = '')
    {
        Route::group([
            'namespace' => '\Jason\Address\Controller',
            'prefix'    => $prefix,
        ], function (Router $router) {
            $router->post('addresses/{address}/default', 'AddressController@setDefault');
            $router->resource('addresses', 'AddressController');
        });
    }

}
