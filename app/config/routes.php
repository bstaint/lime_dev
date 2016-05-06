<?php if(!defined('__BASE_DIR__')) exit('403');

$app->get('/', function(){
    return sprintf('Hello World<br />'.
        '%smsec %s',
        $this->elapsed_time, $this->memory_usage
    );
});
