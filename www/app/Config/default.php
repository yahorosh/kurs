<?php

$config['project_name'] = "Isinst";
$config['basepath'] = "/";
$domain['domain']=$_SERVER['HTTP_HOST'];
$config['db_host'] = "localhost";
$config['db_name'] = "kurs";
$config['db_user'] = "root";
$config['db_pass'] = "defender";
$config['admin_pass'] = "privet";



$config['messages']['validator']['FW\Validator::check_digit'] = 'The field "%1$s" must be digits.';
$config['messages']['validator']['FW\Validator::check_len'] = 'The field "%1$s" must has min %3$s and max %4$s symbols.';

