<?php
/**
 * Created by PhpStorm.
 * User: ZLY
 * Date: 13-12-31
 * Time: 下午2:52
 */

$this->breadcrumbs=array(
    '论文'=>array('index'),
    '导入论文',
);

$this->menu=array(
    array('label'=>'列出论文', 'url'=>array('index')),
    array('label'=>'增加论文', 'url'=>array('create')),
    array('label'=>'管理论文', 'url'=>array('admin')),
	array('label'=>'导出全部论文', 'url'=>array('exportAll')),
);
?>
<h1>选择Excel文件</h1>
<form method="POST" enctype="multipart/form-data">
<input type="file" name="spreedSheet" value=""/>
<input type="submit" value="Upload File"/>'
</form>
