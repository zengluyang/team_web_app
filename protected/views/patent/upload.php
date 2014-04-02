<?php
/**
 * Created by PhpStorm.
 * User: ZLY
 * Date: 13-12-31
 * Time: 下午2:52
 */

$this->breadcrumbs=array(
    '专利'=>array('index'),
    '导入专利',
);

$this->menu=array(
    array('label'=>'全部专利', 'url'=>array('index')),
    array('label'=>'增加专利', 'url'=>array('create')),
    array('label'=>'管理专利', 'url'=>array('admin')),
);
?>
<h1>选择Excel文件</h1>
<form method="POST" enctype="multipart/form-data">
<input type="file" name="spreedSheet" value=""/>
<input type="submit" value="Upload File"/>'
</form>
