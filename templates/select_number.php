<?php extract($data); ?>
<div class="header">
    <h1 class="holographic-text">选择备案号 - 步骤 2/3</h1>
</div>
<div class="form-container">
    <div class="step-indicator">
        <div class="step completed"><div class="step-number"><i class="fas fa-check"></i></div><div class="step-title">填写信息</div></div>
        <div class="step active"><div class="step-number">2</div><div class="step-title">选择号码</div></div>
        <div class="step"><div class="step-number">3</div><div class="step-title">完成申请</div></div>
    </div>
    <?php if ($error): ?>
        <p class="error"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <div class="content card-effect">
        <div id="number-grid-container" class="number-grid">
            <p>正在加载号码...</p>
        </div>
        
        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 1.5rem; gap: 20px; flex-wrap: wrap;">
            <button type="button" class="glow-button" id="refresh-numbers">
                <span><i class="fas fa-sync-alt"></i> 换一批</span><div class="glow"></div>
            </button>
            
            <form method="post" id="number-form" style="margin: 0; display: flex; align-items: center; gap: 15px;">
                <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
                <input type="hidden" name="number" id="selected_number" required>
                <div id="selected-display" style="font-size: 1.2rem; min-width: 120px;">请选择号码</div>
                <button type="submit" id="submit-btn" class="glow-button" disabled>
                    <span>确认选择</span><div class="glow"></div>
                </button>
            </form>
        </div>

        <!-- 靓号说明提示 -->
        <div id="premium-notice" class="premium-notice">
            <i class="fas fa-info-circle"></i> 您选择了靓号，可能需要额外费用。详情请见下方说明。
        </div>

        <?php if (!empty($sponsor_message)): ?>
        <div class="card-effect" style="margin-top: 1.5rem; background: rgba(255, 215, 0, 0.1); border-color: #ffd700;">
            <h5 style="color: #ffd700;"><i class="fas fa-gem"></i> 靓号说明</h5>
            <p><?php echo nl2br(htmlspecialchars($sponsor_message)); ?></p>
        </div>
        <?php endif; ?>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const grid = document.getElementById('number-grid-container');
    const refreshBtn = document.getElementById('refresh-numbers');
    const selectedInput = document.getElementById('selected_number');
    const selectedDisplay = document.getElementById('selected-display');
    const submitBtn = document.getElementById('submit-btn');

    async function fetchNumbers() {
        grid.innerHTML = '<p>正在加载号码...</p>';
        submitBtn.disabled = true;
        selectedDisplay.textContent = '请点击上方选择一个号码';
        selectedInput.value = '';

        // --- Bug修复 ---
        // 在加载新号码之前，总是隐藏靓号提示
        const premiumNotice = document.getElementById('premium-notice');
        premiumNotice.classList.remove('visible'); 
        // --- Bug修复结束 ---

        try {
            const response = await fetch('api/get_numbers.php');
            const data = await response.json();
            grid.innerHTML = '';
            if (data.success && data.numbers.length > 0) {
                data.numbers.forEach(num => {
                    const card = document.createElement('div');
                    card.className = 'number-card card-effect';
                    if (num.is_premium) {
                        card.classList.add('premium');
                        card.innerHTML = `<div class="number">${num.number}</div><div class="premium-badge"><i class="fas fa-gem"></i> 靓号</div>`;
                    } else {
                        card.innerHTML = `<div class="number">${num.number}</div>`;
                    }
                    card.addEventListener('click', () => selectNumber(card, num.number));
                    grid.appendChild(card);
                });
            } else {
                grid.innerHTML = '<p>暂无可用号码。</p>';
            }
        } catch (e) {
            grid.innerHTML = '<p class="error">加载号码失败。</p>';
        }
    }

    function selectNumber(card, number) {
        document.querySelectorAll('.number-card').forEach(c => c.classList.remove('selected'));
        card.classList.add('selected');
        selectedInput.value = number;
        selectedDisplay.textContent = `已选择: ${number}`;
        submitBtn.disabled = false;

        // Show premium notice if it's a premium number
        const premiumNotice = document.getElementById('premium-notice');
        if (card.classList.contains('premium')) {
            premiumNotice.classList.add('visible');
        } else {
            premiumNotice.classList.remove('visible');
        }
    }

    refreshBtn.addEventListener('click', fetchNumbers);
    fetchNumbers();
});
</script>
