<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use appxq\sdii\helpers\SDNoty;
use appxq\sdii\helpers\SDHtml;

?>

<div class="student-form">
<?php if($model->isNewRecord):?>
    <?php $form = ActiveForm::begin([
        'id' => $model->formName(),
        'enableAjaxValidation' => true,
        'validationUrl' => \Yii::$app->urlManager->createUrl('/student/validate')
    ]); ?>
    <?php else:?>
    <?php $form = ActiveForm::begin([
            'id' => $model->formName(),
            'enableAjaxValidation' => true,
        ]); ?>
    <?php endif; ?>

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="itemModalLabel"><i class="fa fa-user"></i> จัดการนักเรียน</h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-3">
                <?php
                echo $form->field($model, 'image')->widget(\trntv\filekit\widget\Upload::classname(), [
                    'url' => ['/core/file-storage/avatar-upload'],
                    'id' => 'upload'
                ])->label(false);
                ?>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-12">
                        <div class='col-md-6'><?= $form->field($model, 'id')->textInput() ?></div>
                        <div class='col-md-6'><?= $form->field($model, 'password')->passwordInput() ?></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class='col-md-12'><?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class='col-md-4 col-sm-4 col-xs-4'><?= $form->field($model, 'number')->textInput() ?></div>
            <div class='col-md-4 col-sm-4 col-xs-4'>
                <?php
                $item = ['1' => 'ชาย', '2' => 'หญิง'];
                ?>
                <?= $form->field($model, 'sex')->dropDownList($item, ['prompt' => '--เลือกเพศ--']) ?>
            </div>
        </div>
        <?= $form->field($model, 'tel')->widget(\yii\widgets\MaskedInput::classname(),[
            'mask' => '9999999999'
        ]);?>
    </div>

    <div class="modal-footer">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'เพิ่ม') : Yii::t('app', 'แก้ไข'), ['class' => $model->isNewRecord ? 'btn btn-success btn-lg btn-block' : 'btn btn-primary btn-lg btn-block']) ?>

            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php \richardfan\widget\JSRegister::begin([
    //'key' => 'bootstrap-modal',
    'position' => \yii\web\View::POS_READY
]); ?>
<script>
    // JS script
    $('form#<?= $model->formName()?>').on('beforeSubmit', function (e) {
        var $form = $(this);
        $.post(
            $form.attr('action'), //serialize Yii2 form
            $form.serialize()
        ).done(function (result) {
            if (result.status == 'success') {
                <?= SDNoty::show('result.message', 'result.status')?>
                $(document).find('#modal-student').modal('hide');
                setTimeout(function(){
                    location.reload();
                },1000);
            } else {
                <?= SDNoty::show('result.message', 'result.status')?>
            }
        }).fail(function () {
            <?= SDNoty::show("'" . SDHtml::getMsgError() . "Server Error'", '"error"')?>
            console.log('server error');
        });
        return false;
    });
</script>
<?php \richardfan\widget\JSRegister::end(); ?>
