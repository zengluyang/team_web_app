<?php
/**
 * Created by PhpStorm.
 * User: ZLY
 * Date: 13-12-31
 * Time: 下午2:52
 */

$this->breadcrumbs=array(
    '项目'=>array('index'),
    '导入项目',
);

$this->menu=array(
    array('label'=>'全部项目', 'url'=>array('index')),
    array('label'=>'增加项目', 'url'=>array('create')),
    array('label'=>'管理项目', 'url'=>array('admin')),
);
?>
<h1>选择Excel文件</h1>
<form method="POST" enctype="multipart/form-data">
<input type="file" name="spreedSheet" value=""/>
<input type="submit" value="上传文件"/>'
</form>