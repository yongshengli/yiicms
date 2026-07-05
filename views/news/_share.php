<style>
.share-buttons {
    display: flex;
    gap: 8px;
    align-items: center;
}
.share-btn {
    position: relative;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    color: white;
    text-decoration: none;
    font-size: 16px;
    transition: opacity 0.2s;
}
.share-btn:hover {
    opacity: 0.8;
}
.share-btn-wechat {
    background-color: #07c160;
}
.share-btn-weibo {
    background-color: #e6162d;
}
.share-btn-qzone {
    background-color: #ffd20d;
    color: #333;
}
.share-btn-copy {
    background-color: #6c757d;
}
.share-btn .tooltip {
    position: absolute;
    bottom: 100%;
    left: 50%;
    transform: translateX(-50%);
    padding: 4px 8px;
    margin-bottom: 6px;
    font-size: 12px;
    color: white;
    background-color: rgba(0, 0, 0, 0.8);
    border-radius: 4px;
    white-space: nowrap;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.15s, visibility 0.15s;
    pointer-events: none;
    z-index: 100;
}
.share-btn:hover .tooltip {
    opacity: 1;
    visibility: visible;
}
.share-btn .tooltip::after {
    content: '';
    position: absolute;
    top: 100%;
    left: 50%;
    transform: translateX(-50%);
    border: 5px solid transparent;
    border-top-color: rgba(0, 0, 0, 0.8);
}
</style>

<div class="share-buttons">
    <a href="javascript:void(0)" onclick="shareToWeixin()" class="share-btn share-btn-wechat">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
            <path d="M8.691 2.188C3.891 2.188 0 5.476 0 9.53c0 2.212 1.17 4.203 3.002 5.55a.59.59 0 0 1 .213.665l-.39 1.48c-.019.07-.048.141-.048.213 0 .163.13.295.29.295a.326.326 0 0 0 .167-.054l1.903-1.114a.864.864 0 0 1 .717-.098 10.16 10.16 0 0 0 2.837.403c.276 0 .543-.027.811-.05-.857-2.578.157-4.972 1.932-6.446 1.703-1.415 3.882-1.98 5.853-1.838-.576-3.583-4.196-6.348-8.596-6.348zM5.785 5.991c.642 0 1.162.529 1.162 1.18a1.17 1.17 0 0 1-1.162 1.178A1.17 1.17 0 0 1 4.623 7.17c0-.651.52-1.18 1.162-1.18zm5.813 0c.642 0 1.162.529 1.162 1.18a1.17 1.17 0 0 1-1.162 1.178 1.17 1.17 0 0 1-1.162-1.178c0-.651.52-1.18 1.162-1.18zm5.34 2.867c-1.797-.052-3.746.512-5.28 1.786-1.72 1.428-2.687 3.72-1.78 6.22.942 2.453 3.666 4.229 6.884 4.229.826 0 1.622-.12 2.361-.336a.722.722 0 0 1 .598.082l1.584.926a.272.272 0 0 0 .14.047c.134 0 .24-.111.24-.247 0-.06-.023-.12-.038-.177l-.322-1.223a.582.582 0 0 1-.023-.156.49.49 0 0 1 .201-.398C23.024 18.48 24 16.82 24 14.98c0-3.21-2.931-5.837-6.656-6.088V8.89c-.135-.01-.27-.03-.407-.032zm-2.53 3.274c.535 0 .969.44.969.982a.976.976 0 0 1-.969.983.976.976 0 0 1-.969-.983c0-.542.434-.982.97-.982zm4.844 0c.535 0 .969.44.969.982a.976.976 0 0 1-.969.983.976.976 0 0 1-.969-.983c0-.542.434-.982.969-.982z"/>
        </svg>
        <span class="tooltip">分享到微信</span>
    </a>
    <a href="javascript:void(0)" onclick="shareToWeibo()" class="share-btn share-btn-weibo">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
        </svg>
        <span class="tooltip">分享到微博</span>
    </a>
    <a href="javascript:void(0)" onclick="shareToQzone()" class="share-btn share-btn-qzone">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/>
        </svg>
        <span class="tooltip">分享到QQ空间</span>
    </a>
    <a href="javascript:void(0)" onclick="copyLink()" class="share-btn share-btn-copy">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
            <path d="M16 1H4c-1.1 0-2 .9-2 2v14h2V3h12V1zm3 4H8c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h11c1.1 0 2-.9 2-2V7c0-1.1-.9-2-2-2zm0 16H8V7h11v14z"/>
        </svg>
        <span class="tooltip">复制链接</span>
    </a>
</div>

<script>
function shareToQzone() {
    var url = encodeURIComponent(window.location.href);
    var title = encodeURIComponent(document.title);
    window.open('https://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=' + url + '&title=' + title, '_blank', 'width=600,height=400');
}

function shareToWeixin() {
    var url = window.location.href;
    if (navigator.share) {
        navigator.share({ title: document.title, url: url });
    } else {
        alert('请使用微信浏览器打开或手动复制链接分享');
        copyLink();
    }
}

function shareToWeibo() {
    var url = encodeURIComponent(window.location.href);
    var title = encodeURIComponent(document.title);
    window.open('https://service.weibo.com/share/share.php?url=' + url + '&title=' + title, '_blank', 'width=600,height=400');
}

function copyLink() {
    var url = window.location.href;
    if (navigator.clipboard) {
        navigator.clipboard.writeText(url).then(function() {
            alert('链接已复制到剪贴板');
        });
    } else {
        var textarea = document.createElement('textarea');
        textarea.value = url;
        document.body.appendChild(textarea);
        textarea.select();
        document.execCommand('copy');
        document.body.removeChild(textarea);
        alert('链接已复制到剪贴板');
    }
}
</script>