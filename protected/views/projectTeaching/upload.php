<?php
/**
 * Created by PhpStorm.
 * User: ZLY
 * Date: 13-12-31
 * Time: 下午2:52
 */

$this->breadcrumbs=array(
    '教改项目'=>array('index'),
    '导入',
);

$this->menu=array(
    array('label'=>'列出', 'url'=>array('index')),
    array('label'=>'增加', 'url'=>array('create')),
    array('label'=>'管理', 'url'=>array('admin')),
);
?>
<h1>选择Excel文件</h1>
<form method="POST" enctype="multipart/form-data">
<input type="file" name="spreedSheet" value=""/>
<input type="submit" value="上传文件"/>
</form>