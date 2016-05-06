<?php if(!defined('__BASE_DIR__')) exit('403');

# 载入设置
$app['autoload'] = new ArrayObject(array(
    __BASE_DIR__.'/app/libraries/',
    __BASE_DIR__.'/app/helpers/',
));

$app['app.name'] = 'lime';
$app['session.name'] = 'LIMESESSION';

$pathinfo = route_url($app['base_url']);
$app['route'] = empty($pathinfo) ? '/' : $pathinfo;

$app['config.begin_point'] = microtime();

//二维码生成库
$app->service("qrcode", function(){
    $obj = new Endroid\QrCode\QrCode();
    return $obj;
});

?>
