<?php
/* @var $this PatentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'专利',
);
if(!Yii::app()->user->isGuest) {
    $this->menu=array(
        array('label'=>'增加专利', 'url'=>array('create')),
        array('label'=>'管理专利', 'url'=>array('admin')),
        array('label'=>'导入专利', 'url'=>array('upload')),
    );
}

?>

<h1>专利</h1>

<?php
    $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
    'itemsTagName'=>'ul',
    'tagName'=>'li',
    //'ajaxUpdate'=>false,
    //'enablePagination'=>false ,
));
?>
<script>
    $(document).ready(function(){
        $('.more').click(function (e) {
            e.preventDefault();
            //console.log(e);
            var text = ($(this).text() == "更多") ? "收起" : "更多";
            $(this).siblings('.abstract').fadeToggle();
            $(this).text(text);
        });
    })
    // $(document).on('click','.more',function(e) {
    //     e.preventDefault();
    //     var text = ($(this).text() == "更多") ? "收起" : "更多";
    //     $(this).siblings('.abstract').fadeToggle();
    //     $(this).text(text);
    // });
</script>
