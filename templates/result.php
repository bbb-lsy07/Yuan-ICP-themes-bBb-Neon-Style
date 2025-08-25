<?php extract($data); ?>
<div class="header">
    <h1 class="holographic-text">备案申请结果</h1>
</div>
<div class="content card-effect" style="max-width: 700px;">
    <?php if ($application['status'] === 'pending'): ?>
        <h2><i class="fas fa-check-circle" style="color: #2ecc71;"></i> 申请已提交</h2>
        <p>您的备案号是：<strong><?php echo htmlspecialchars($application['number']); ?></strong></p>
        <p>状态：<span class="pending">待审核</span> (通过后将在公示页面显示)</p>
        <p>请将以下代码添加到您的网站页脚 (点击下方代码框即可复制)：</p>
        <!-- 修改后的代码容器 -->
        <div class="code-container" onclick="copyCodeToClipboard(this)">
            <pre id="html_code_display"><?php
                // 更健壮的 site_url 处理逻辑
                $site_url = !empty($config['site_url']) ? $config['site_url'] : '';

                // 如果 site_url 没有 http/https, 则自动添加
                if (!empty($site_url) && !preg_match("~^(?:f|ht)tps?://~i", $site_url)) {
                    // 默认使用 https
                    $site_url = "https://" . $site_url;
                }

                // 如果 site_url 为空, 则从当前 URL 动态生成
                if (empty($site_url)) {
                    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
                    $domain_name = $_SERVER['HTTP_HOST'];
                    $site_url = $protocol . $domain_name;
                }
                
                // 生成最终的链接代码
                echo htmlspecialchars('<a href="' . rtrim($site_url, '/') . '/query.php?icp_number=' . urlencode($application['number']) . '" target="_blank">' . htmlspecialchars($application['number']) . '</a>');
            ?></pre>
            <!-- 移除了复制按钮 -->
            <span class="copy-feedback"></span> <!-- 用于显示复制成功提示 -->
        </div>
        <p class="note">审核将在 2~4 个工作日内完成，请耐心等待。</p>
    <?php else: ?>
        <h2><i class="fas fa-info-circle" style="color: var(--neon-color);"></i> 备案状态</h2>
        <p>您的备案申请状态已更新。</p>
    <?php endif; ?>
    <!-- 为底部按钮添加一个容器，使用flex布局进行居中和间距调整 -->
    <div style="margin-top: 30px; display: flex; justify-content: center; gap: 15px; flex-wrap: wrap;">
        <a href="index.php" class="glow-button page-transition-link">返回首页</a>
        <a href="query.php?icp_number=<?php echo urlencode($application['number']); ?>" class="glow-button page-transition-link">查询我的备案</a>
    </div>
</div>
<script>
    function copyCodeToClipboard(container) {
        const textToCopy = container.querySelector('pre').innerText;
        const feedback = container.querySelector('.copy-feedback');
        
        navigator.clipboard.writeText(textToCopy).then(() => {
            feedback.textContent = '已复制!';
            container.classList.add('copied');
            setTimeout(() => {
                feedback.textContent = '';
                container.classList.remove('copied');
            }, 2000);
        }, () => {
            feedback.textContent = '复制失败!';
        });
    }
</script>
