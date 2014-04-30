<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>userinfo</title>
    <script src="<?php echo LOCAL_JQUERY?>"></script>
</head>
<body>
    <img width=100% src="<?php echo PIC_SAVE_RELATIVE_PATH.$userinfo->photo?>">
    <button >关注</button>
    <span id=concern style="color: red"></span>
    <table>
    <?php
        foreach($userinfo as $k=>$v){
            $key=UserinfoModel::chkey($k);
            if(!is_null($key)&& !is_null($v)){
    ?>
        <tr>
        <th><?php echo $key?></th>
        <td><?php echo $v;?></td>
        </tr>
    <?php
            }
        }
    ?>
    </table>
</body>
</html>
<script>
    function concern(){
        var $url='/home/home/concern?con=0&id='+<?php echo $userinfo['id']?>;
        $.ajax({
            url:$url,
            type:'get',
            success:function(response){
                var res=eval(response);
                $('#concern').html(res[0].tip);
            }

        });
    }
    concern();
    $('button').click(function(){
        var $url='/home/home/concern?con=1&id='+<?php echo $userinfo['id']?>;
        $.ajax({
            url:$url,
            type:'get',
            success:function(response){
                var res=eval(response);
                $('#concern').html(res[0].tip);
            }
        });
    });
</script>