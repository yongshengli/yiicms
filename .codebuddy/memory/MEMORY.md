# 项目记忆

## 项目概况
- 项目名：yiicms 企业站管理系统
- 框架：Yii 2.0.55
- PHP 要求：>=7.4.0
- 前端：Bootstrap 3 + 自定义现代化 CSS（CSS 变量体系）

## 技术要点
- bower 资源位于 `vendor/bower/`，有软链接 `vendor/bower-asset -> bower`
- Composer 全局配置使用腾讯云镜像 `mirrors.cloud.tencent.com/composer/`
- 旧的 fxp/composer-asset-plugin 已禁用，改用 asset-packagist.org
- `yiisoft/yii2-swiftmailer` 依赖已废弃的 SwiftMailer，PHP 8.x 下需注意

## UI/样式体系
- 前台主样式：`assets/css/site.css`（CSS 变量驱动的现代工业级设计）
- 后台主样式：`modules/backend/assets/backend.css`（AdminLTE 增强）
- 5 色主题导航：blue/red/yellow/green/purple（渐变背景 + 白色文字）
- 卡片系统：`.panel` 面板 + `.thumbnail` 产品卡片（hover 悬浮效果）
- 全局回到顶部按钮、平滑滚动
- 深色渐变页脚（4 列网格布局）
