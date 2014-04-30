<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link type="text/css" href="<?php echo HOME_CSS?>" rel="stylesheet">
    <script src="http://jiaoyou.qq.com<?php echo LOCAL_JQUERY?>"></script>
</head>
<body>
<div id="header">
    <div class="header_unit" id="lastLogin"><span>按最近登陆排序</span></div>
    <div class="header_unit" id="beWatch"><span>按查看次数最多排序</span></div>
    <div class="header_unit" id="beConcerned"><span>按被关注最多排列</span></div>
    <div id="header_home"><span>个人中心</span></div>
</div>
<div id="sex">
    <div ></div>
    <div class="sex_unit"><span>不限</span></div>
    <div class="sex_unit"><span>女</span></div>
    <div class="sex_unit"><span>男</span></div>
</div>
    <?php echo $content; ?>

</body>
</html>
<script>
    $('#header_unit').click(function(){
        alert(123);
    })
</script>
