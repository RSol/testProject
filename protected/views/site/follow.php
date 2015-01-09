<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Follow',
);


?>

<h1>Follow</h1>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'follow-form',
	'enableClientValidation'=>false,
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
		'validateOnChange'=>true,
	),
)); ?>


	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name'); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'city'); ?>
		<?php echo $form->textField($model,'city'); ?>
		<?php echo $form->error($model,'city'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'zip'); ?>
		<?php echo $form->textField($model,'zip'); ?>
		<?php echo $form->error($model,'zip'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'state'); ?>
		<?php echo $form->textField($model,'state', array('class'=>'state_field')); ?>
		<?php echo $form->error($model,'state'); ?>
	</div>
	<div class="row">
		<?php
		if (!empty($model->country)) {
			foreach ($country as $k => $v) {
				if ($model->country == $v) {
					$model->country = $k;
				}
			}
		}
		?>
		<?php echo $form->labelEx($model,'country'); ?>
		<?php echo $form->dropDownList($model,'country', CHtml::listData(Country::model()->findAllName(),'name', 'name'),
              array('empty' => '(Select a country)')); ?>
		<?php echo $form->error($model,'country'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email[0]', array('class'=>'mail_field')); ?>
		<div class="errorMessage" style="display: none;">Email is invalid.</div>
	</div>
	
	<div class="row">
		<script>
        var count = 0;        
         function addField()
        {
            $("#container").append('<div id="mail_field' + (++count) + '" class="row"><input type="text" name="Follow[email][' + count + ']" id="Follow_email" class="mail_field"><input onclick="delField(' + count + '); return false;" type="button" value="Delete" /><div class="errorMessage" style="display: none;">Email is invalid.</div><div>');
        }
        function delField(counter)
        {
            $("#mail_field" + counter).remove();
        }
        </script>
        <div id="container"></div>
	</div>
	
	<div class="row">
		<?php echo CHtml::Button('Add email', array('onclick' => 'addField(); return false;')); ?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->

<?php 

$this->widget('application.widget.cycleWidget.jQueryCycle',
		array('images'=>['/images/beach1.jpg',
						'/images/beach2.jpg',
						'/images/beach3.jpg' ],
			'fx'=>'turnDown',
			'sync'=>false,
			'delay'=>'-2000')); 
?>
<script>
	$(document).ready(function(){
		$('#follow-form').on('blur','.mail_field', function(){
			if($(this).val() != '') {
				var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
				if(pattern.test($(this).val())){
					$(this).parent('.row').removeClass('error');
					$(this).parent('.row').addClass('success');
					$(this).parent('.row').children('.errorMessage').hide();
				} else {
					$(this).parent('.row').removeClass('success');
					$(this).parent('.row').addClass('error');
					$(this).parent('.row').children('.errorMessage').show();
				}
			} else {
				$(this).parent('.row').removeClass('success');
				$(this).parent('.row').addClass('error');
				$(this).parent('.row').children('.errorMessage').show();
			}
		});
		$('#follow-form select').change(function(){
			if ($(this).val() == 'USA' && $('.state_field').val() == '') {
				$('.state_field').parent('.row').removeClass('success');
				$('.state_field').parent('.row').addClass('error');
				$('.state_field').next('.errorMessage').text('State cannot be blank.').show();
			} else {
				$('.state_field').parent('.row').removeClass('error');
				$('.state_field').next('.errorMessage').text('').hide();
			}
		});
	});
</script>