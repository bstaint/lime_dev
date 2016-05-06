<?php if(!defined('__BASE_DIR__')) exit('403');

// 脚本执行时间
$app->service('elapsed_time', function() use($app){
    list($sm, $ss) = explode(' ', $app['config.begin_point']);
    list($em, $es) = explode(' ', microtime());

    return number_format(($em + $es) - ($sm + $ss), 2);
});

// 脚本运行内存
$app->service('memory_usage', function(){
    return  ( ! function_exists('memory_get_usage')) ? '0' : round(memory_get_usage()/1024/1024, 2).'MB'; 
});

// 获取GET数组
function input_get($value = ''){
    if(empty($value)) return $_GET;
    return array_key_exists($value, $_GET) ? $_GET[$value] : '';
}

// 获取POST数组
function input_post($value = ''){
    if(empty($value)) return $_POST;
    return array_key_exists($value, $_POST) ? $_POST[$value] : '';
}

# nginx可以采用request_uri代替path_info
function route_url($base_url){
    $uris = parse_url($_SERVER['REQUEST_URI']);
    $uri_fix = $base_url.'/index.php';

    if ($uri_fix === substr($uris['path'], 0, strlen($uri_fix))){
        return substr($uris['path'], strlen($uri_fix));
    }else{
        return substr($uris['path'], strlen($base_url));
    }
}

?>
