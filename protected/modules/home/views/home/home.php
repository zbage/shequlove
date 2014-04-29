    <?php foreach($usersBasicInfo as $user){?>
        <div class="userblock">
            <a href="/home/home/showinfo?id=<?php echo $user['id']?>"><img class="touxiang" src="<?php echo PIC_SAVE_RELATIVE_PATH.$user['photo']?>"></a>
            <span><?php echo $user['nickname']?></span><br>
            <span><?php echo $user['sex']?></span><br>
            <span><?php echo $user['age']?></span><br>
            <span><?php echo $user['location']?></span><br>

        </div>

    <?php }?>

