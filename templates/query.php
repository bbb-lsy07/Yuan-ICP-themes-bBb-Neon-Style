<?php extract($data); ?>
<div class="header">
    <h1 class="holographic-text">查询备案信息</h1>
</div>
<div class="search-box">
    <!-- 修改：移除包裹的 input-group-wrapper div -->
    <form action="query.php" method="GET" class="neon-form">
        <!-- 移除了外层的 .input-group-wrapper div -->
        <input type="text" name="icp_number" class="search-input" placeholder="请输入备案号" value="<?php echo htmlspecialchars($icp_number ?? ''); ?>">
        <span class="note">或</span>
        <input type="text" name="domain" class="search-input" placeholder="请输入网站域名" value="<?php echo htmlspecialchars($domain ?? ''); ?>">
        
        <button type="submit" class="glow-button">
            <span>查询</span><div class="glow"></div>
        </button>
    </form>
</div>
<?php if (isset($error) && !empty($error)): ?>
    <p class="error card-effect" style="max-width: 700px; margin: 20px auto;"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>
<?php if (isset($result) && $result): ?>
<div class="content card-effect" style="max-width: 700px; margin: 20px auto;">
    <h2 class="holographic-text">备案详情</h2>
    <dl style="display: grid; grid-template-columns: auto 1fr; gap: 10px 20px;">
        <dt style="font-weight: bold; color: var(--neon-color); text-align: right;">备案号</dt>
        <dd style="margin: 0; word-break: break-all;"><?php echo htmlspecialchars($result['number']); ?></dd>
        <dt style="font-weight: bold; color: var(--neon-color); text-align: right;">网站名称</dt>
        <dd style="margin: 0; word-break: break-all;"><?php echo htmlspecialchars($result['website_name']); ?></dd>
        <dt style="font-weight: bold; color: var(--neon-color); text-align: right;">网站地址</dt>
        <dd style="margin: 0; word-break: break-all;"><a href="https://<?php echo htmlspecialchars($result['domain']); ?>" target="_blank"><?php echo htmlspecialchars($result['domain']); ?></a></dd>
        <dt style="font-weight: bold; color: var(--neon-color); text-align: right;">简介</dt>
        <dd style="margin: 0; word-break: break-all;"><?php echo nl2br(htmlspecialchars($result['description'])); ?></dd>
        <dt style="font-weight: bold; color: var(--neon-color); text-align: right;">审核时间</dt>
        <dd style="margin: 0; word-break: break-all;"><?php echo date('Y-m-d H:i', strtotime($result['reviewed_at'])); ?></dd>
    </dl>
</div>
<?php endif; ?>
