#!/bin/bash
# ============================================================
# YiiCms 生产环境部署脚本
# s 账号和 www-data 同组，用 ug=rwX 替代 777
# 用法: su - s -c "bash deploy.sh"
# ============================================================
set -e

REPO_URL="https://gitee.com/templi/yiicms.git"
PROJECT_DIR="/var/www/yiicms"
BRANCH="${1:-master}"

echo "=========================================="
echo " YiiCms 生产环境部署"
echo " 分支: ${BRANCH}"
echo "=========================================="

# ---- 1. 拉取代码 ----
echo "[1/5] 拉取代码..."
if [ -d "${PROJECT_DIR}/.git" ]; then
    cd "${PROJECT_DIR}"
    git fetch origin
    git reset --hard "origin/${BRANCH}"
else
    git clone -b "${BRANCH}" "${REPO_URL}" "${PROJECT_DIR}"
    cd "${PROJECT_DIR}"
fi

# ---- 2. 安装依赖 ----
echo "[2/5] 安装 Composer 依赖..."
if [ ! -f composer.phar ]; then
    curl -sS https://getcomposer.org/installer | php
fi
php composer.phar config allow-plugins.yiisoft/yii2-composer true
php composer.phar config policy.advisories.block false
php composer.phar update --no-dev --optimize-autoloader -n
# ---- 3. bower-asset ----
echo "[3/5] bower-asset 资源..."
php composer.phar require \
    bower-asset/jquery:'3.7.*@stable' \
    bower-asset/yii2-pjax:'~2.0.1' \
    bower-asset/bootstrap:'~3.4.1' \
    bower-asset/inputmask:'^5.0.8' \
    bower-asset/punycode:'^2.2' \
    --no-update -n 2>/dev/null || true
php composer.phar update --no-dev --optimize-autoloader -n
php composer.phar config --unset policy.advisories.block

mkdir -p vendor/bower
ln -sf bower vendor/bower-asset 2>/dev/null || true

# ---- 4. 权限（s:www-data 同组，ug=rwX）----
echo "[3/5] 设置权限..."
sudo chown -R s:www-data "${PROJECT_DIR}"
sudo chmod -R ug=rwX,o=rX "${PROJECT_DIR}"
# runtime / assets / uploads 需要 web 可写
sudo chmod -R ug=rwX "${PROJECT_DIR}/runtime"
sudo chmod -R ug=rwX "${PROJECT_DIR}/web/assets"
sudo chmod -R ug=rwX "${PROJECT_DIR}/web/uploads"
sudo mkdir -p "${PROJECT_DIR}/runtime/cache" "${PROJECT_DIR}/runtime/config"

# ---- 5. 清理 ----
echo "[4/5] 清理缓存..."
sudo rm -rf "${PROJECT_DIR}/web/assets/"*
sudo rm -rf "${PROJECT_DIR}/runtime/cache/"*

echo ""
echo "=========================================="
echo " 部署完成!"
echo " 所有者: s:www-data"
echo "=========================================="
