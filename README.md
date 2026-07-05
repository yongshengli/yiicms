# YiiCms 企业站管理系统

基于 **Yii 2.0.55** 开发的开源企业网站内容管理系统。

前台采用 Bootstrap 3 + 现代化 CSS 变量体系，后台基于 AdminLTE + RBAC 权限管理。

> GitHub: https://github.com/yongshengli/yiicms/

---

## 主要功能

| 模块 | 说明 |
|------|------|
| 新闻管理 | 新闻分类、发布、编辑、删除，支持批量操作 |
| 产品管理 | 产品分类、图文展示、参数配置 |
| 图片管理 | 企业相册分类、Pjax 分页浏览 |
| 下载管理 | 文件下载分类、上传管理 |
| 单页管理 | 关于我们、联系我们等独立页面 |
| RBAC 权限 | 基于 mdmsoft/yii2-admin 的角色权限控制 |
| 菜单自定义 | 前台导航菜单、后台管理菜单均可配置 |
| 多模板 | 内置 3 套主题（默认/company/tradition） |
| 多语言 | 中文简体/繁体/英文 |
| 友情链接 | 首页底部友情链接管理 |
| 广告管理 | 首页轮播广告管理 |
| 皮肤切换 | 后台 12 种 AdminLTE 皮肤，支持持久化 |

---

## 系统要求

- PHP >= 7.4.0
- MySQL >= 5.7（推荐 8.0）
- Composer 2.x
- 需要 `pdo_mysql`、`gd`、`mbstring`、`fileinfo` 等 PHP 扩展

---

## 快速开始

### 1. 克隆项目

```bash
git clone https://github.com/yongshengli/yiicms.git
cd yiicms
```

### 2. 安装依赖

```bash
composer install --no-plugins
```

> **注意**：项目使用 [asset-packagist.org](https://asset-packagist.org) 管理前端资源，不再需要 `fxp/composer-asset-plugin`。

### 3. 配置数据库

```bash
cp config/db.php.default config/db.php
# 编辑 config/db.php，填入您的数据库信息
```

或通过环境变量配置（推荐）：

```bash
export DB_DSN="mysql:host=localhost;dbname=yiicms"
export DB_USERNAME="your_user"
export DB_PASSWORD="your_password"
```

### 4. 导入数据库

```bash
mysql -u your_user -p yiicms < yiicms.sql
```

### 5. 启动开发服务器

```bash
# 前台和后台（开发模式，开启调试工具栏）
YII_DEBUG=true YII_ENV=dev php -S 0.0.0.0:8888 -t web/ router.php

# 生产模式
php -S 0.0.0.0:8888 -t web/ router.php
```

### 6. 访问

| 地址 | 说明 |
|------|------|
| `http://localhost:8888/` | 前台首页 |
| `http://localhost:8888/backend/default/login.html` | 后台登录 |

> 后台默认账号：`admin` / `123456`

---

## 环境变量

生产环境推荐通过环境变量配置敏感信息：

| 变量 | 用途 | 默认值 |
|------|------|--------|
| `YII_DEBUG` | 调试模式 | `false`（生产安全） |
| `YII_ENV` | 运行环境 | `prod` |
| `DB_DSN` | 数据库 DSN | `mysql:host=localhost;dbname=yiicms` |
| `DB_USERNAME` | 数据库用户名 | `root` |
| `DB_PASSWORD` | 数据库密码 | `123456` |
| `COOKIE_VALIDATION_KEY` | Cookie 加密密钥 | 内置默认值 |
| `MAIL_FILE_TRANSPORT` | 邮件存文件模式 | `true`（设为 `false` 真实发信） |

---

## Docker 部署

```bash
docker build -t sheng/yiicms .
docker-compose up
```

---

## 目录结构

```
├── assets/             # 全局静态资源（site.css 等）
├── commands/           # Yii 命令行控制器
├── components/         # 自定义组件（UrlManager、UploadBehavior 等）
├── config/             # 应用配置
│   ├── web.php         # Web 应用配置
│   ├── db.php          # 数据库配置（建议环境变量）
│   └── params.php      # 全局参数（导航菜单、站点名称等）
├── controllers/        # 前台控制器
├── helpers/            # 工具类（StringHelper、CategoryHelper）
├── mail/               # 邮件模板
├── messages/           # 多语言翻译文件（en-US、zh-TW）
├── models/             # 数据模型（Content、News、Product 等）
├── modules/
│   └── backend/        # 后台管理模块
│       ├── actions/    # 自定义 Action（批量审核、删除）
│       ├── assets/     # 后台 CSS/JS（backend.css、skin.js）
│       ├── controllers/
│       ├── models/     # AdminUser 等后台模型
│       └── views/      # 后台视图模板
├── router.php          # PHP 内置服务器路由脚本
├── runtime/            # 运行时文件（缓存、日志）
├── themes/             # 前台主题（默认、company、tradition）
│   └── */assets/css/   # 主题样式覆盖
├── views/              # 前台视图
│   ├── layouts/        # 主布局（导航栏、页脚）
│   ├── site/           # 首页、搜索、联系我们
│   ├── news/           # 新闻列表、详情
│   ├── products/       # 产品列表、详情
│   ├── photos/         # 相册列表、详情
│   └── downloads/      # 下载列表、详情
├── web/                # 网站根目录（入口文件）
├── widgets/            # 前台小组件（导航、侧边栏、最新新闻）
├── composer.json
├── docker-compose.yml
├── Dockerfile
└── yiicms.sql          # 数据库初始化脚本
```

---

## URL 美化

项目默认启用 `.html` 后缀的伪静态 URL：

```
/                         首页
/products/list.html       产品列表
/products/list/2.html     产品分类 2
/news/list.html           新闻列表
/news/5.html              新闻详情 id=5
/photos/list.html         企业相册
/downloads/list.html      下载中心
/contact.html             联系我们
/search.html?keyword=xxx  搜索
/page/1.html              单页 id=1
/backend/default/login.html 后台登录
```

---

## 注意事项

1. **密码安全**：密码使用 bcrypt 哈希（Yii Security 组件），兼容旧 MD5 密码自动升级
2. **开发模式**：生产环境请关闭 `YII_DEBUG`
3. **数据库权限**：生产环境请创建专用数据库用户，不要使用 root
4. **上传安全**：图片上传包含 MIME 类型白名单校验（jpg/png/gif/webp）
5. **CSS 体系**：前台使用 CSS 变量驱动的现代设计体系（`assets/css/site.css`），支持 5 色主题导航

---

## 许可证

GPL-3.0 - 详见 [LICENSE.md](LICENSE.md)
