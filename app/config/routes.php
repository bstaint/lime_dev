<?php if(!defined('__BASE_DIR__')) exit('403');

$app->get('/', function(){
    return sprintf('Hello World<br />'.
        '<p><a href="%s">QR二维码测试</a> [使用endroid/QrCode]</p>'.
        '<p><a href="%s">表单验证</a> [使用php-simple-form-validation]</p>'.
        '%smsec %s',
        $this->baseUrl('/qrcode'),
        $this->baseUrl('/form'),
        $this->elapsed_time, $this->memory_usage
    );
});

$app->get('/qrcode', function(){
    $this->response->mime = 'png';

    return $this['qrcode']
        ->setText("Life is too short to be generating QR codes")
        ->setSize(300)
        ->setPadding(10)
        ->setErrorCorrection('high')
        ->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
        ->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))
        ->setLabel('My label')
        ->setLabelFontSize(16)
        ->render();
});

$app->get('/form', function(){
    $html = <<<EOF
<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>表单测试</title>
    </head>
    <body>
    <form action="%s" method="POST">
        <p><span>账号：</span><input type="text" name="username"/></p>
        <p><span>密码：</span><input type="password" name="password"/></p>
        <input type="submit" />
    </form>
    </body>
</html>
EOF;
    return sprintf($html, $this->baseUrl('/valid'));
});

$app->post('/valid', function(){
    $data = input_post();
    $this->response->mime = 'json';

    $message = array(
        'status' => 'success',
        'msec' => $this->elapsed_time,
        'mem' => $this->memory_usage,
    );

    $filter = array(
        array('username', 'required', '请输入用户名'),
        array('username', 'regexp', '/^\w{6,12}$/i', '用户名必须为6-12位数字或字符串'),
        array('password', 'required', '请输入密码'),
    );

    if (!Validator::execute($data, $filter)) {
        $message['status'] = 'error';
        $message['error'] = array_values(Validator::getAllError());
    }

    return $message;
});
