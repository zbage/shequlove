<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>home主页</title>
    <style>
        .userblock{
            width: 33%;
            float: left;
        }
        .touxiang{
            width: 100%;
            height: 200px;
        }
    </style>
</head>
<body>
    <?php foreach($usersBasicInfo as $user){?>
        <div class="userblock">
            <img class="touxiang" src="<?php echo PIC_SAVE_RELATIVE_PATH.$user['photo']?>">
            <span><?php echo $user['nickname']?></span><br>
            <span><?php echo $user['age']?></span><br>
            <span><?php echo $user['location']?></span><br>

        </div>

    <?php }?>

</body>
</html>