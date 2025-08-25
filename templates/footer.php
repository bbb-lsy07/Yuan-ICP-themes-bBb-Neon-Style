    </div> <!-- .container -->
    <div class="footer">
        <a href="index.php" class="page-transition-link">主页</a>
        <a href="apply.php" class="page-transition-link">申请</a>
        <a href="query.php" class="page-transition-link">查询</a>
        <a href="announcements.php" class="page-transition-link">公示</a>
        <a href="leap.php" class="page-transition-link">迁跃</a>
        <br>
        <p style="margin-top:10px; margin-bottom: 0;">
            版权所有 © <?php echo date('Y'); ?> <?php echo htmlspecialchars($config['site_name'] ?? 'Yuan-ICP'); ?>.
        </p>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.body.classList.add('loaded');
            
            document.querySelectorAll('a.page-transition-link').forEach(link => {
                link.addEventListener('click', (e) => {
                    const href = e.currentTarget.href;
                    // 阻止在新标签页中打开的链接和锚点链接触发动画
                    if (e.currentTarget.target === '_blank' || href.includes('#')) return;

                    e.preventDefault();
                    if (href === window.location.href) return;
                    document.body.classList.remove('loaded');
                    setTimeout(() => { window.location.href = href; }, 400);
                });
            });

            const particleContainer = document.getElementById('particle-container');
            if (particleContainer) {
                const particleCount = 50;
                for (let i = 0; i < particleCount; i++) {
                    let particle = document.createElement('div');
                    particle.classList.add('particle');
                    particle.style.left = `${Math.random() * 100}%`;
                    const size = Math.random() * 2.5 + 1;
                    particle.style.width = `${size}px`;
                    particle.style.height = `${size}px`;
                    const duration = Math.random() * 15 + 10;
                    const delay = Math.random() * 10;
                    particle.style.animation = `move-particles ${duration}s linear ${delay}s infinite`;
                    particleContainer.appendChild(particle);
                }
            }
        });

        // 监听 pageshow 事件，修复浏览器 bfcache 导致的后退黑屏问题
        window.addEventListener('pageshow', function(event) {
            if (event.persisted) {
                // 如果页面从缓存中恢复，强制重新应用 loaded 类
                document.body.classList.remove('loaded');
                setTimeout(() => {
                     document.body.classList.add('loaded');
                }, 50); // 短暂延迟确保渲染
            }
        });
    </script>
</body>
</html>