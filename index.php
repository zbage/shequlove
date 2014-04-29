<?php
// 定义根目录
define("ROOT_DIR", dirname(__FILE__));
require(ROOT_DIR . "/protected/components/Environment.php");
require(ROOT_DIR."/protected/components/Constant.php");
// 创建环境配置对象
$env = new Environment(null, array('life_time'=>30));
//var_dump($env);
// 设置输出编码，效果同php.ini中配置default_charset
header('Content-type:text/html;charset='.$env->get('charset'));
// 创建一个Web应用实例并执行
//echo $env->getModPath();
//exit;
require($env->getModPath().'/Mod.php');
//$modPath="/var/www/seal/Mod.php";
//echo $modPath."123";
//require($modPath);
Mod::createWebApplication($env->getConfig())->run();
