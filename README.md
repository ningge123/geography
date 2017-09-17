# geography

根据ip地址获取地址位置信息,这是基于百度api开放接口，使用前需要[申请密钥（AK）](http://lbsyun.baidu.com/apiconsole/key?application=key).

# 使用

这是一个标准的`composer`包:

``
composer require cocoyo/geography
``

laravel中使用:

```
 在cofig/services.php中添加配置
 
 'baidu' => [
         'ak' => '你的ak'
     ],

 Cocoyo\Geography\GeographyServiceProvider::class,注册服务提供者
 
 app('geography')->position($ip);
 
 或者使用依赖注入形式使用
```

一般项目中使用:

```
require './vendor/autoload.php';

$gegoraphy = new \Cocoyo\Geography\Geography(['ak' => '你的ak']);

$info = $gegoraphy->position('220.181.108.99');

```

返回内容

```
Array
(
    [address_detail] => Array
        (
            [province] => 广东省
            [city] => 深圳市
            [district] => 
            [street] => 
            [street_number] => 
            [city_code] => 340
        )

    [address] => 广东省深圳市
    [point] => Array
        (
            [y] => 2560682.35
            [x] => 12693451.44
        )

)
```

嗯！暂时还没做单元测试，后期补上。。