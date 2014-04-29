<?php
return array(
    'params'     => array(
        'modPath' => realpath('/data/php/framework'),
    ),
    'components' => array(
        'log' => array(
            'routes' => array(
                array(
                    'class'       => 'CFileLogRoute', // 写入
                    'levels'      => 'error', // 记录所有级别的
                    'LogDir'      => LOG_DIR, //此目录可配置,在此目录下，每天一个文件夹
                    'logFileName' => 'error.log' //记录日志的文件名可配置
                ),
                array(
                    'class'       => 'CFileLogRoute', // 写入
                    'levels'      => '', // 记录所有级别的
                    'LogDir'      => LOG_DIR, //此目录可配置,在此目录下，每天一个文件夹
                    'logFileName' => 'all.log' //记录日志的文件名可配置
                ),
            ),
        ),
        'db'  => array(
            'class'              => 'CDbConnection',
            'charset'            => 'utf8',
            'tablePrefix'        => 'love_',
            'connectionString'   => 'mysql:host=localhost;port=3306;dbname=jiaoyou',
            'username'           => 'root',
            'password'           => 'redhat',
            'enableParamLogging' => TRUE
            // 开启表结构缓存（schema caching）提高性能
            // 'schemaCachingDuration'=>3600,
        ),
    ),
//    'modules'    => array(
//        'console' => array(
//            'forcePublish' => TRUE,
//            'modules'      => array(
//                'microhome' => array(
//                    'forcePublish' => TRUE,
//                ),
//                'auth'      => array(
//                    'useFake' => TRUE,
//                ),
//            ),
//        ),
//    )
);
?>
