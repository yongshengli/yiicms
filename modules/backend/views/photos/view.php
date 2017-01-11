<?php

use yii\helpers\Html;
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
            <div class="box box-solid">
                <p>
                    <div class="pull-left">
                        <img id="cover-image" src="<?= $model->image ?>" title="相册封面" class="img-thumbnail" style="width: 80px;height: 80px"/>
                    </div>
                    <div class="pull-left" style="margin-left: 20px">
                        <h4><?=$this->title?></h4>
                        <?= $this->render('_upload_form', [
                            'model' => $newPhotoDetail,
                        ]) ?>
                    </div>
                    <div class="clearfix"></div>
                </p>

                <div class="file-input">
                    <div class="file-drop-disabled">
                        <div class="file-preview-thumbnails">
                            <div class="file-initial-thumbs">
                                <div class="clearfix" id="photo-list">
                                    <?php if (isset($detailModelList) && is_array($detailModelList)):foreach ($detailModelList as $item): ?>
                                        <?= $this->render('_detail_item', ['model' => $item]) ?>
                                    <?php endforeach; endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="overlay dark" style="display: none">
                    <i class="fa fa-spinner fa-spin" style="font-size: 100px;color:#fff"></i>
                </div>
            </div>
        </div>
    </div>
</div>
