<?php extract($data); ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <title><?php echo htmlspecialchars($page_title ?? ($config['site_name'] ?? 'Yuan-ICP')); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($config['seo_description'] ?? ''); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($config['seo_keywords'] ?? ''); ?>">
    <link rel="icon" href="https://www.dmoe.cc/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="<?php echo get_theme_url(); ?>/style.css">
</head>
<body>
    <!-- 新增页面加载动画 -->
    <div id="page-loader">
        <div class="loader-spinner"></div>
        <p class="loader-text">正在迁跃至新的时空象限...</p>
    </div>
    
    <div id="particle-container"></div>
    <div class="github-corner">
        <a href="<?php echo htmlspecialchars($config['github_url'] ?? 'https://github.com/bbb-lsy07/Yuan-ICP'); ?>" target="_blank" class="github-link">开源地址</a>
    </div>
    <div class="container page-transition">