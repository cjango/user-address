# AddressBook

## 1.安装
```shell script
composer require jasonc/address
```
## 2.初始化

```shell script
php artisan vendor:publish --provider="Jason\Address\ServiceProvider"

php artisan migrate

php artisan db:seed --class=AreaSeeder
```
## 3.使用

```php
<?php

use Jason\Address\Traits\UserHasAddress;

class User {

    use UserHasAddress;
}
```