# YiiCms 生产环境部署指南

## 一、环境要求

| 项 | 最低版本 | 推荐版本 |
|---|----------|----------|
| PHP | 7.4.0 | 8.0+ |
| MySQL | 5.7 | 8.0 |
| Web Server | Nginx 1.18 / Apache 2.4 | Nginx 1.24 |
| Composer | 2.x | 2.x |

### PHP 扩展

```
pdo_mysql, gd (with FreeType), mbstring, fileinfo, curl, openssl
```

---

## 二、环境变量

项目通过环境变量控制安全和运行模式。生产环境**必须设置**以下变量：

```bash
# === 必设 ===
export YII_DEBUG=false              # 关闭调试模式（默认已关）
export YII_ENV=prod                 # 生产环境
export DB_DSN="mysql:host=your-host;dbname=yiicms"
export DB_USERNAME="your_db_user"
export DB_PASSWORD="your_strong_password"
export COOKIE_VALIDATION_KEY="生成一个32位随机字符串"

# === 可选 ===
export MAIL_FILE_TRANSPORT=false    # 设为 false 真实发邮件（需配 SMTP）
```

> ⚠️ 没有设 `COOKIE_VALIDATION_KEY` 的话会使用代码中的默认值，有安全风险。

生成随机密钥：`php -r "echo bin2hex(random_bytes(16));"`

---

## 三、部署步骤

### 1. 下载代码

```bash
git clone https://github.com/yongshengli/yiicms.git /var/www/yiicms
cd /var/www/yiicms
```

### 2. 安装依赖

```bash
# 生产环境不装 dev 依赖
composer install --no-dev --no-plugins --optimize-autoloader
```

### 3. 数据库配置

```bash
# 导入数据库
mysql -u your_user -p yiicms < yiicms.sql

# 创建专用数据库用户（不要用 root）
mysql -u root -p -e "
CREATE USER 'yiicms'@'localhost' IDENTIFIED BY 'your_password';
GRANT SELECT, INSERT, UPDATE, DELETE ON yiicms.* TO 'yiicms'@'localhost';
FLUSH PRIVILEGES;
"
```

### 4. 设置环境变量

在 `/etc/systemd/system/yiicms.env` 中写入：

```ini
YII_DEBUG=false
YII_ENV=prod
DB_DSN=mysql:host=localhost;dbname=yiicms
DB_USERNAME=yiicms
DB_PASSWORD=your_password
COOKIE_VALIDATION_KEY=your_random_32_hex_chars
```

### 5. 设置目录权限

```bash
chmod -R 755 /var/www/yiicms
chmod -R 777 /var/www/yiicms/runtime
chmod -R 777 /var/www/yiicms/web/assets
chmod -R 777 /var/www/yiicms/web/uploads
chown -R www-data:www-data /var/www/yiicms
```

### 6. 初始化运行时配置

首次运行后，后台可以动态修改站点名称、导航菜单等参数，系统会自动写入 `runtime/config/`。确保该目录可写：

```bash
chmod 777 /var/www/yiicms/runtime/config
```

### 7. 配置 Web Server

网站根目录为 `web/`。

#### Nginx

```nginx
server {
    listen 80;
    server_name your-domain.com;
    root /var/www/yiicms/web;
    index index.php;
    charset utf-8;

    # 安全：禁止访问敏感文件
    location ~ /\.(ht|git|env) { deny all; }
    location ~ (composer\.(json|lock)|README|LICENSE) { deny all; }

    # 静态文件直接返回
    location ~* \.(js|css|png|jpg|jpeg|gif|ico|svg|woff2?|ttf|eot)$ {
        expires 30d;
        add_header Cache-Control "public, immutable";
        try_files $uri =404;
    }

    # 上传文件
    location /uploads/ {
        expires 7d;
    }

    # PHP 处理
    location ~ \.php$ {
        try_files $uri =404;
        fastcgi_pass unix:/var/run/php/php-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

    # URL 美化：所有不存在文件的路由到 index.php
    location / {
        try_files $uri $uri/ /index.php?$args;
    }
}
```

#### Apache

网站根目录设为 `web/`，`.htaccess` 自动处理 URL 重写。

### 8. 启动 PHP-FPM

```bash
# systemd 示例，在 EnvironmentFile 引上一步的 env 文件
# /etc/systemd/system/php-fpm.service.d/override.conf
[Service]
EnvironmentFile=/etc/systemd/system/yiicms.env
```

---

## 四、安全加固清单

| 项 | 说明 | 状态 |
|----|------|------|
| DEBUG 关闭 | 环境变量 `YII_DEBUG=false` | ✅ 默认关闭 |
| 专用 DB 用户 | 不用 root，最小权限 | ⚠️ 需手动创建 |
| DB 密码强度 | 避免 `123456` | ⚠️ 需手动设置 |
| Cookie 密钥 | 使用环境变量，不与代码同仓库 | ⚠️ 需手动生成 |
| Gii / Debug | `allowedIPs` 仅本机 | ✅ 已限制 |
| 密码加密 | bcrypt 哈希 | ✅ 已升级 |
| 上传校验 | MIME 白名单（jpg/png/gif/webp） | ✅ 已启用 |
| HTTPS | 生产建议强制 HTTPS | 🔶 推荐 |
| 文件权限 | `runtime/` `uploads/` `assets/` 外禁止 777 | ⚠️ 部署后检查 |

---

## 五、性能优化说明

以下优化已在代码层面启用，无需额外配置：

| 优化 | 配置位置 | 说明 |
|------|----------|------|
| Schema Cache | `config/db.php` | 表结构缓存 3600s |
| Query Cache | `config/db.php` | 查询结果缓存 3600s |
| Eager Loading | `controllers/*.php` | 详情页预加载 detail |
| Widget Cache | `widgets/LastNews.php` `Category.php` | 侧边栏 600s 缓存 |
| Asset Timestamp | `config/web.php` | 资源文件版本戳 |

建议额外配置：

```bash
# Nginx 开启 gzip
gzip on;
gzip_types text/css application/javascript image/svg+xml;

# PHP OPcache
# php.ini
opcache.enable=1
opcache.memory_consumption=128
opcache.max_accelerated_files=10000
```

---

## 六、Docker 部署

项目自带 `Dockerfile` 和 `docker-compose.yml`：

```bash
# 构建镜像
docker build -t sheng/yiicms .

# 启动（MySQL + 应用）
docker-compose up -d
```

> **注意**：Docker 部署使用的是 `docker-compose.yml` 中的默认数据库密码。生产环境应通过环境变量或 `.env` 文件覆盖密码。

---

## 七、访问地址

| 地址 | 说明 |
|------|------|
| `http://your-domain.com/` | 前台首页 |
| `http://your-domain.com/backend/default/login.html` | 后台登录 |

默认管理员账号：`admin` / `123456`。**请第一时间修改密码！**

---

## 八、常见问题

**Q: 访问出现 500 错误？**
```bash
# 查看日志
tail -f /var/www/yiicms/runtime/logs/app.log
# 常见原因：数据库连接失败或 runtime 目录权限不足
```

**Q: 样式丢失？**
```bash
# 清除资源缓存
rm -rf /var/www/yiicms/web/assets/*
chmod 777 /var/www/yiicms/web/assets
```

**Q: URL 美化不生效？**
检查 Nginx `try_files $uri $uri/ /index.php?$args;` 配置是否正确，Apache 需要开启 `mod_rewrite`。

**Q: 上传图片失败？**
确保 `web/uploads/` 目录可写，且 PHP `fileinfo` 扩展已安装。
