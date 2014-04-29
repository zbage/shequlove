<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>inputInfo</title>
</head>
<body>
<img style="width: 100%" src="<?php echo PIC_SAVE_RELATIVE_PATH.$_COOKIE['openid'].".jpg"?>">

    <?php $form = $this->beginWidget('CActiveForm',array(
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        )
    ));?>
    <table width="100%">
        <tr>
            <th><?php echo $form->label($userinfo,'qqnum');?></th>
            <td><?php echo $form->textField($userinfo,'qqnum',array('disabled'=>1,'value'=>$qqnum));?></td>
            <td><?php echo $form->error($userinfo,'qqnum')?></td>
        </tr>
        <tr>
            <th><?php echo $form->labelEx($userinfo,'nickname');?></th>
            <td><?php echo $form->textField($userinfo,'nickname');?></td>
            <td><?php echo $form->error($userinfo,'nickname')?></td>
        </tr>
        <tr>
            <th><?php echo $form->labelEx($userinfo,'location');?></th>
            <td><?php echo $form->DropDownList($userinfo,'location',$city);?></td>
            <td><?php echo $form->error($userinfo,'location')?></td>
        </tr>
        <tr>
            <th><?php echo $form->labelEx($userinfo,'age');?></th>
            <td><?php echo $form->textField($userinfo,'age');?></td>
            <td><?php echo $form->error($userinfo,'age')?></td>
        </tr>
        <tr>
            <th><?php echo $form->label($userinfo,'sex');?></th>
            <td><?php echo $form->RadioButtonList($userinfo,'sex',$sex);?></td>
            <td><?php echo $form->error($userinfo,'sex')?></td>
        </tr>
        <tr>
            <th><?php echo $form->label($userinfo,'height');?></th>
            <td><?php echo $form->textField($userinfo,'height');?><span>CM</span></td>
            <td><?php echo $form->error($userinfo,'height')?></td>
        </tr>
        <tr>
            <th><?php echo $form->label($userinfo,'profession');?></th>
            <td><?php echo $form->textField($userinfo,'profession');?></td>
            <td><?php echo $form->error($userinfo,'profession')?></td>
        </tr>
        <tr>
            <th><?php echo $form->label($userinfo,'income');?></th>
            <td><?php echo $form->DropDownList($userinfo,'income',$income);?></td>
            <td><?php echo $form->error($userinfo,'income')?></td>
        </tr>
        <tr>
            <th><?php echo $form->label($userinfo,'education');?></th>
            <td><?php echo $form->DropDownList($userinfo,'education',$education);?></td>
            <td><?php echo $form->error($userinfo,'education')?></td>
        </tr>
        <tr>
            <th><?php echo $form->label($userinfo,'house');?></th>
            <td><?php echo $form->RadioButtonList($userinfo,'house',$house);?></td>
            <td><?php echo $form->error($userinfo,'house')?></td>
        </tr>
        <tr>
            <th><?php echo $form->label($userinfo,'introduce');?></th>
            <td><?php echo $form->textArea($userinfo,'introduce',array('cols'=>20,'rows'=>5));?></td>
            <td><?php echo $form->error($userinfo,'introduce')?></td>
        </tr>
        <tr>
            <th><?php echo $form->label($userinfo,'request');?></th>
            <td><?php echo $form->textArea($userinfo,'request',array('cols'=>20,'rows'=>5));?></td>
            <td><?php echo $form->error($userinfo,'request')?></td>
        </tr>
        <tr>
            <th><?php echo $form->label($userinfo,'wxusername');?></th>
            <td><?php echo $form->textField($userinfo,'wxusername');?></td>
            <td><?php echo $form->error($userinfo,'wxusername')?></td>
        </tr>
        <tr>
            <th><?php echo $form->label($userinfo,'phone');?></th>
            <td><?php echo $form->textField($userinfo,'phone');?></td>
            <td><?php echo $form->error($userinfo,'phone')?></td>
        </tr>
        <tr>
            <td><input type="submit" value="注册"></td>
        </tr>
    </table>
    <?php $this->endWidget();?>
</body>
</html>