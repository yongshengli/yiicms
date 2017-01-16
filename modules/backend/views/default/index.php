<?php
/** @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '后台首页';
?>
<div class="backend-default-index">
    <div class="row">
        <div class="col-md-4">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">系统信息</h3>
                </div>
                <!-- /.box-header -->

                <div class="box-body no-padding">
                    <table class="table table-condensed">
                        <tbody>
                        <tr>
                            <th style="width: 150px">Yii 版本</th>
                            <td><?= Yii::getVersion() ?></td>
                        </tr>
                        <tr>
                            <th>Yii ENV</th>
                            <td><?= YII_ENV; ?></td>
                        </tr>
                        <tr>
                            <th>Yii DUBUG</th>
                            <td><?= YII_DEBUG; ?></td>
                        </tr>
                        <tr>
                            <th>操作系统</th>
                            <td><?= PHP_OS ?></td>
                        </tr>
                        <tr>
                            <th>PHP 版本</th>
                            <td><?= PHP_VERSION ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">快捷入口</h3>
                </div>
                <!-- /.box-header -->

                <div class="box-body no-padding">
                    <table class="table table-condensed">
                        <tbody>
                        <tr>
                            <td style="width: 150px"><a href="<?=Url::to('/backend/products/create')?>">添加产品</a></td>
                            <td><a href="<?=Url::to('/backend/news/create')?>">添加新闻</a></td>
                        </tr>
                        <tr>
                            <td><a href="<?=Url::to('/backend/downloads/create')?>">添加下载</a></td>
                            <td><a href="<?=Url::to('/backend/photos/create')?>">添加相册</a></td>
                        </tr>
                        <tr>
                            <td><a href="<?=Url::to('/backend/config/base-config')?>">网站配置</a></td>
                            <td><a href="<?=Url::to('/backend/rbac/assignment/index')?>">权限配置</a></td>
                        </tr>
                        <tr>
                            <td><a href="<?=Url::to('/backend/page/index')?>">页面管理</a></td>
                            <td><a href="<?=Url::to('/backend/page/create')?>">添加页面</a></td>
                        </tr>
                        <tr>
                            <td><a href="<?=Url::to('/backend/blogroll/index')?>">友情链接</a></td>
                            <td><a href="<?=Url::to('/backend/blogroll/create')?>">添加友情链接</a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
