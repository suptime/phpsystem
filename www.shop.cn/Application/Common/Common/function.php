<?php

/**
 * 将模型错误信息变成一个有序列表字符串.
 * @param \Think\Model $model 模型.
 * @return string
 */
function get_error(\Think\Model $model) {
    $errors = $model->getError();
    if (!is_array($errors)) {
        $errors = [$errors];
    }
    $html = '<ol>';
    foreach ($errors as $error) {
        $html .= '<li>' . $error . '</li>';
    }
    $html.='</ol>';
    return $html;
}

/**
 * 将二维关联数组转换成下拉列表
 * @param array $data 二维数组.
 * @param string $value_field 值字段
 * @param string $name_field 文案提示字段
 * @param string $form_name 控件名字
 * @param string $select_value 默认选中的项
 * @return string 下拉列表的html代码.
 */
function arr2select(array $data, $value_field, $name_field, $form_name, $select_value) {
    $html = '<select name="' . $form_name . '" class="'.$form_name.'">';
    $html.='<option value="">--请选择--</option>';
    foreach ($data as $item) {
        if ($select_value == $item[$value_field]) {
            $html .= '<option value="' . $item[$value_field] . '" selected="selected">' . $item[$name_field] . '</option>';
        } else {
            $html .= '<option value="' . $item[$value_field] . '">' . $item[$name_field] . '</option>';
        }
    }

    $html .= '</select>';
    return $html;
}

/**
 * 加盐加密
 * @param string $password 原始密码.
 * @param string $salt     盐.
 * @return string 加盐加密后的结果.
 */
function salt_mcrypt($password,$salt){
    return md5(md5($password).$salt);
}


/**
 * 发送激活邮件
 */
function sendMail($address,$subject,$content) {
    //引入phpmail文件
    vendor('PhpMailer.PHPMailerAutoload');

    $mail = new \PHPMailer;
    $mail->isSMTP();                                        // Set mailer to use SMTP
    $mail->Host       = 'smtp.qq.com';                     // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                               // Enable SMTP authentication
    $mail->Username   = 'ucasp@qq.com';                 // SMTP username
    $mail->Password   = 'lbfjaxeojentbjaa';                           // SMTP password
    $mail->SMTPSecure = 'ssl';                              // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 465;                                // 465/587

    $mail->setFrom('ucasp@qq.com', '拉邦购');
    $mail->addAddress($address);                            // Add a recipient
    $mail->isHTML(true);                                    // Set email format to HTML

    $mail->Subject = $subject;
    $mail->Body    = $content;
    $mail->CharSet = 'UTF-8';

    //判断邮件是否发送成功
    if (!$mail->send()) {
        return array(
            'status' => false,
            'msg' => $mail->ErrorInfo
        );
    } else {
        return array(
            'status' => true,
            'msg' => '激活邮件发送成功',
        );
    }
}
