<?php
/*
 *CWebapplication的配置文件,所有的配置都在此配置
 *
 */
define('CONFIG_PATH', realpath(dirname(__FILE__)));
define('LOG_DIR', realpath(CONFIG_PATH.'/../runtime'));
return array(
    'params'     => array(
        // CGI性能上报开关
        'enableCgiPerform' => TRUE,
        'enableUriXss'     => TRUE,
        'modPath'          => '/data/php/framework',
        //微信相关内容
    ),
    'basePath'   => CONFIG_PATH.DIRECTORY_SEPARATOR.'..',
    // 应用中文名
    'name'       => '社区交友平台',
    // 应用英文名，用来唯一标识应用
    'id'         => 'jiaoyou',
    // 应用编码（html、db等）
    'charset'    => 'utf-8',
    // 语言包选择，默认为英语
    'language'   => 'zh_cn',
    // 预加载的组件，
    'preload'    => array('log'),
    /**
     * 这里如果定义了theme,那么视图的渲染就会去找webroot下的themes目录
     * 如下定义了theme为bootstrap,框架在webroot/themes/bootstrap/views目录下查找
     * 视图文件，如果不存在，再查找protected/views目录
     */
    //'theme'=>'bootstrap',
    // 默认导入类型
    'import'     => array(
        /**
         * application表示webroot的protected目录路径
         */
        'application.models.*',
        'application.components.*',
    ),
    // 默认的controller,
    //'defaultController'=>'site',

    // 组件配置, 通过key引用（如：Mod::app()->bootstrap);
    'components' => array(
//        'weixin'=>array('class'=>CWaeWeixin,'conf'=>
//            array('mp'=>array('token'=>'dayuwang','appid'=>
//                'wx0b333f05745c8886','secret'=> '3a9a4773b86a65a9b113153c051ceb7b'))),
        //url管理组件
        'urlManager' => require(CONFIG_PATH.'/url.conf.php'),
        // 日志配置，必须预加载生效
        'log'        => array(
            'class'  => 'CLogRouter',
            'routes' => array(
                array(
                    'class'       => 'CFileLogRoute', // 写入
                    'levels'      => '', // 记录所有级别的
                    'LogDir'      => LOG_DIR, //此目录可配置,在此目录下，每天一个文件夹
                    'logFileName' => 'all.log' //记录日志的文件名可配置
                )
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


        'messages'   => array(
            'class'    => 'CPhpMessageSource',
            'basePath' => realpath(CONFIG_PATH.'/../extensions/messages'),
        ),
    ),
    'modules'=>array(
        'auth'=>array(
            'useFake'=>TRUE
        ),     //认证
        'home',     //主页
    ),

);