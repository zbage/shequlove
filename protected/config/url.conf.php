<?php
return array(
    'urlFormat'      => 'path',
    //要不要显示url中的index.php
    'showScriptName' => false,
    //url对应的解析规则,类似于nginx和apache的rewite,支持正则
    'rules'          => array(
        // 默认路由
        '<_c:\w+>/<_a:\w+>' => '<_c>/<_a>',
    ),
);