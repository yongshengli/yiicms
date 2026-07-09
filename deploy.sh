#!/bin/bash
# ============================================================
# YiiCms 生产环境部署脚本
# 用法: bash deploy.sh
# ============================================================
set -e

# ---- 配置区 ----
REPO_URL="https://gitee.com/templi/yiicms.git"
PROJECT_DIR="/var/www/yiicms"
WEB_USER="www-data"
BRANCH="${1:-master}"

# 环境变量（按需修改）
export YII_DEBUG=false
export YII_ENV=prod

echo "=========================================="
echo " YiiCms 生产环境部署"
echo " 分支: ${BRANCH}"
echo " 目录: ${PROJECT_DIR}"
echo "=========================================="

# ---- 1. 拉取代码 ----
if [ -d "${PROJECT_DIR}/.git" ]; then
    echo "[1/5] 更新已有仓库..."
    cd "${PROJECT_DIR}"
    git fetch origin
    git reset --hard "origin/${BRANCH}"
else
    echo "[1/5] 克隆仓库..."
    git clone -b "${BRANCH}" "${REPO_URL}" "${PROJECT_DIR}"
    cd "${PROJECT_DIR}"
fi

# ---- 2. 安装依赖 ----
echo "[2/5] 安装 Composer 依赖 (--no-dev)..."
if [ ! -f composer.phar ]; then
    curl -sS https://getcomposer.org/installer | php
fi
cd "${PROJECT_DIR}"

# 非交互模式 + 允许 root 运行
export COMPOSER_ALLOW_SUPERUSER=1

# 允许 plugin + 跳过安全公告
php composer.phar config allow-plugins.yiisoft/yii2-composer true
php composer.phar config policy.advisories.block false

# update 重建锁文件（PHP 8.5 需要更新的依赖版本），不可加 --no-plugins
php composer.phar update --no-dev --optimize-autoloader -n

# 恢复
php composer.phar config --unset policy.advisories.block

# 补位：Bower 资源目录兼容（asset-packagist 不完整时兜底）
mkdir -p vendor/bower
if [ ! -d vendor/bower-asset ]; then
    ln -sf bower vendor/bower-asset
fi
# 兜底下载常用缺失包（先建目录再 curl）
if [ ! -f vendor/bower/jquery/dist/jquery.min.js ]; then
    echo "  下载 bower 缺失资源..."
    mkdir -p vendor/bower/jquery/dist
    mkdir -p vendor/bower/bootstrap/dist/css
    mkdir -p vendor/bower/bootstrap/dist/fonts
    curl -fsSLo vendor/bower/jquery/dist/jquery.min.js         "https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js" || true
    curl -fsSLo vendor/bower/bootstrap/dist/css/bootstrap.min.css         "https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" || true
    echo "  jquery + bootstrap 补位完成"
fi

# ---- 3. 目录权限 ----
echo "[3/5] 设置目录权限..."
chmod -R 755 "${PROJECT_DIR}"
chmod -R 777 "${PROJECT_DIR}/runtime"
chmod -R 777 "${PROJECT_DIR}/web/assets"
chmod -R 777 "${PROJECT_DIR}/web/uploads"
mkdir -p "${PROJECT_DIR}/runtime/cache" "${PROJECT_DIR}/runtime/config"
chmod -R 777 "${PROJECT_DIR}/runtime/cache" "${PROJECT_DIR}/runtime/config"

# ---- 4. 所有者递归改为 www-data ----
echo "[4/5] 修改所有者为 ${WEB_USER}..."
chown -R "${WEB_USER}:${WEB_USER}" "${PROJECT_DIR}"

# ---- 5. 清理 ----
echo "[5/5] 清理缓存..."
rm -rf "${PROJECT_DIR}/web/assets/"*
rm -rf "${PROJECT_DIR}/runtime/cache/"*

echo ""
echo "=========================================="
echo " 部署完成!"
echo " 项目目录: ${PROJECT_DIR}"
echo " 所有者:   ${WEB_USER}"
echo "=========================================="
