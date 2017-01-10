<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\file\FileInput;
use kartik\file\CanvasBlobAsset;
use kartik\file\SortableAsset;
use kartik\file\DomPurifyAsset;
use kartik\file\FileInputAsset;
/* @var $this yii\web\View */
/* @var $model app\models\Photos */
/* @var $newPhotoDetail app\models\PhotosDetail */
/* @var $detailModelList array */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => '产品管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

FileInputAsset::register($this);
?>
<div class="content-view">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation"><?= Html::a('相册管理', ['index']) ?></li>
            <li role="presentation"><?= Html::a('添加相册', ['create']) ?></li>
            <li role="presentation" class="active"><?= Html::a('上传照片', ['#']) ?></li>
        </ul>
        <div class="tab-content">
            <p>
                <?= $this->render('_upload_form', [
                    'model' => $newPhotoDetail,
                ]) ?>
            </p>
            <div class="row">
                <div class="col-lg-3"><img src="<?= $model->image ?>"/></div>
            </div>
<!--            <div class="form-group">-->
                <?php if (isset($detailModelList) && is_array($detailModelList)):?>
            <div class="file-input" id="photo-list">
                <div class="file-preview">
                    <div class="file-drop-disabled">
                        <div class="file-preview-thumbnails">
                            <div class="file-initial-thumbs">
                                <div class="clearfix">
                                <?php foreach ($detailModelList as $item): ?>
                                    <?= $this->render('_detail_item', ['model' => $item]) ?>
                                <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<!--            </div>-->
            </div>
            <?php endif;?>
        </div>
    </div>
</div>
