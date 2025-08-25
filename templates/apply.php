<?php extract($data); ?>
<div class="header">
<h1 class="holographic-text">申请备案 - 步骤 1/3</h1>
</div>
<div class="form-container">
<div class="step-indicator">
<div class="step active"><div class="step-number">1</div><div class="step-title">填写信息</div></div>
<div class="step"><div class="step-number">2</div><div class="step-title">选择号码</div></div>
<div class="step"><div class="step-number">3</div><div class="step-title">完成申请</div></div>
</div>
<?php if ($error): ?>
<p class="error"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>
<form action="apply.php" method="POST" class="neon-form">
<input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
<input type="text" name="site_name" class="search-input" placeholder="请输入网站名称" required>
<input type="text" name="domain" class="search-input" placeholder="请输入网站域名（无需https://）" required>
<textarea name="description" class="search-input" placeholder="请输入网站描述" required></textarea>
<input type="text" name="contact_name" class="search-input" placeholder="请输入联系人姓名（选填）">
<input type="email" name="contact_email" class="search-input" placeholder="请输入联系邮箱" required>
<button type="submit" class="glow-button">
<span>下一步</span><div class="glow"></div>
</button>
</form>
</div>