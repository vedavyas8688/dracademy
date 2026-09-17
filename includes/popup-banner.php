<?php
// =============================
// POPUP SETTINGS
// =============================
$popupEnabled = true;
$popupImage   = 'includes/popup-hyd.png';
$visitLink    = 'https://dracademy.co.in/form';
$popupTitle   = 'NEET LONGTERM 1ST BATCH STARTED';
?>

<?php if ($popupEnabled) { ?>
<div id="drPopupOverlayBox" class="dr-popup-overlay" style="display:none;">
    <div class="dr-popup-backdrop"></div>

    <div class="dr-popup-wrap" role="dialog" aria-modal="true" aria-labelledby="drPopupHeading">
        <button type="button" class="dr-popup-close" id="drPopupCloseBtn" aria-label="Close Popup">&times;</button>
        <div class="dr-popup-animated-border"></div>

        <div class="dr-popup-content">
            <div class="dr-popup-top">
                <div class="dr-popup-badge">New Update</div>
                <div class="dr-popup-timer-box">
                    Auto close in <span id="drPopupTimerText">25</span>s
                </div>
            </div>

            <h2 class="dr-popup-title" id="drPopupHeading">
                <?php echo htmlspecialchars($popupTitle, ENT_QUOTES, 'UTF-8'); ?>
            </h2>

            <a href="<?php echo htmlspecialchars($visitLink, ENT_QUOTES, 'UTF-8'); ?>"
               target="_blank"
               rel="noopener noreferrer"
               class="dr-popup-image-link">
                <img
                    src="<?php echo htmlspecialchars($popupImage, ENT_QUOTES, 'UTF-8'); ?>"
                    alt="Popup Image"
                    class="dr-popup-image"
                >
            </a>

            <a href="<?php echo htmlspecialchars($visitLink, ENT_QUOTES, 'UTF-8'); ?>"
               target="_blank"
               rel="noopener noreferrer"
               class="dr-popup-visit-btn">
                Apply Now
            </a>
        </div>
    </div>
</div>

<style>
#drPopupOverlayBox,
#drPopupOverlayBox * {
    box-sizing: border-box;
}

.dr-popup-overlay {
    position: fixed;
    inset: 0;
    width: 100%;
    height: 100%;
    z-index: 999999;
    align-items: center;
    justify-content: center;
    padding: 10px;
}

.dr-popup-overlay.dr-popup-show {
    display: flex !important;
    animation: drPopupFadeIn 0.35s ease;
}

.dr-popup-backdrop {
    position: absolute;
    inset: 0;
    background: rgba(10, 16, 30, 0.34);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
}

.dr-popup-wrap {
    position: relative;
    width: min(92vw, 430px);
    max-height: 94vh;
    border-radius: 26px;
    padding: 3px;
    overflow: hidden;
    background: linear-gradient(135deg, #2d7dff, #ff4db8, #5a4dff, #2d7dff);
    background-size: 300% 300%;
    animation: drPopupGradientMove 4s linear infinite, drPopupScaleIn 0.35s ease forwards;
    box-shadow: 0 30px 80px rgba(0,0,0,0.28);
    transform: scale(0.92) translateY(20px);
    z-index: 2;
}

.dr-popup-animated-border {
    position: absolute;
    inset: 0;
    border-radius: 26px;
    pointer-events: none;
    box-shadow: inset 0 0 0 1px rgba(255,255,255,0.35);
    z-index: 1;
}

.dr-popup-content {
    position: relative;
    z-index: 3;
    background: linear-gradient(180deg, #ffffff, #f8faff);
    border-radius: 23px;
    padding: 16px;
    padding-top: 26px;
    overflow: hidden;
}

.dr-popup-content:before,
.dr-popup-content:after {
    content: "";
    position: absolute;
    width: 150px;
    height: 150px;
    pointer-events: none;
    z-index: 0;
}

.dr-popup-content:before {
    right: -60px;
    top: -60px;
    background: radial-gradient(circle, rgba(255,77,184,0.16), transparent 70%);
}

.dr-popup-content:after {
    left: -60px;
    bottom: -60px;
    background: radial-gradient(circle, rgba(45,125,255,0.16), transparent 70%);
}

.dr-popup-close {
    position: absolute;
    right: 12px;
    top: 12px;
    width: 38px;
    height: 38px;
    border: none;
    border-radius: 50%;
    background: rgba(12,18,38,0.88);
    color: #ffffff;
    font-size: 26px;
    line-height: 1;
    cursor: pointer;
    z-index: 9999;
    transition: all 0.25s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.dr-popup-close:hover {
    background: #ff4db8;
    transform: rotate(90deg);
}

.dr-popup-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 8px;
    margin-bottom: 10px;
    padding-right: 52px;
    position: relative;
    z-index: 4;
}

.dr-popup-badge {
    display: inline-block;
    padding: 7px 13px;
    border-radius: 999px;
    background: linear-gradient(135deg, #2d7dff, #ff4db8);
    color: #ffffff;
    font-size: 13px;
    font-weight: 700;
    white-space: nowrap;
}

.dr-popup-timer-box {
    background: #eef3ff;
    color: #24324f;
    font-size: 13px;
    font-weight: 700;
    padding: 7px 11px;
    border-radius: 999px;
    white-space: nowrap;
}

#drPopupTimerText {
    color: #ff2d98;
    min-width: 16px;
    display: inline-block;
    text-align: center;
}

.dr-popup-title {
    margin: 0 0 12px 0;
    text-align: center;
    font-size: clamp(20px, 4.2vw, 29px);
    line-height: 1.12;
    font-weight: 900;
    color: #121b35;
    position: relative;
    z-index: 4;
}

.dr-popup-image-link {
    display: block;
    text-decoration: none;
    position: relative;
    z-index: 5;
    cursor: pointer;
}

.dr-popup-image {
    width: 100%;
    height: auto;
    max-height: 56vh;
    display: block;
    aspect-ratio: 1080 / 1350;
    object-fit: contain;
    border-radius: 16px;
    border: 1px solid rgba(0,0,0,0.06);
    background: #f3f5fb;
    box-shadow: 0 14px 34px rgba(0,0,0,0.14);
    transition: transform 0.35s ease, box-shadow 0.35s ease;
}

.dr-popup-image-link:hover .dr-popup-image {
    transform: scale(1.01);
    box-shadow: 0 18px 40px rgba(0,0,0,0.20);
}

.dr-popup-visit-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    min-height: 48px;
    margin-top: 12px;
    border-radius: 14px;
    text-decoration: none;
    color: #ffffff;
    font-size: 16px;
    font-weight: 800;
    background: linear-gradient(135deg, #2d7dff, #ff4db8);
    box-shadow: 0 14px 30px rgba(74, 87, 255, 0.26);
    transition: all 0.25s ease;
    position: relative;
    z-index: 5;
    cursor: pointer;
}

.dr-popup-visit-btn:hover {
    transform: translateY(-2px);
    opacity: 0.96;
}

@keyframes drPopupGradientMove {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

@keyframes drPopupFadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes drPopupScaleIn {
    from { transform: scale(0.92) translateY(20px); }
    to { transform: scale(1) translateY(0); }
}

@media (max-width: 768px) {
    .dr-popup-wrap {
        width: min(92vw, 420px);
    }

    .dr-popup-image {
        max-height: 55vh;
    }
}

@media (max-width: 575px) {
    .dr-popup-overlay {
        padding: 8px;
    }

    .dr-popup-wrap {
        width: 92vw;
        border-radius: 22px;
    }

    .dr-popup-content {
        border-radius: 19px;
        padding: 12px;
        padding-top: 24px;
    }

    .dr-popup-animated-border {
        border-radius: 22px;
    }

    .dr-popup-close {
        width: 36px;
        height: 36px;
        font-size: 24px;
    }

    .dr-popup-top {
        margin-bottom: 8px;
        padding-right: 48px;
    }

    .dr-popup-badge,
    .dr-popup-timer-box {
        font-size: 12px;
        padding: 7px 10px;
    }

    .dr-popup-title {
        font-size: clamp(19px, 6vw, 25px);
        margin-bottom: 10px;
    }

    .dr-popup-image {
        max-height: 53vh;
        border-radius: 14px;
    }

    .dr-popup-visit-btn {
        min-height: 45px;
        margin-top: 10px;
        font-size: 16px;
    }
}

@media (max-width: 390px) {
    .dr-popup-wrap {
        width: 91vw;
    }

    .dr-popup-content {
        padding: 10px;
        padding-top: 24px;
    }

    .dr-popup-title {
        font-size: 18px;
        margin-bottom: 8px;
    }

    .dr-popup-badge,
    .dr-popup-timer-box {
        font-size: 11px;
        padding: 6px 8px;
    }

    .dr-popup-image {
        max-height: 51vh;
    }

    .dr-popup-visit-btn {
        min-height: 42px;
        font-size: 15px;
    }
}

@media (max-height: 700px) {
    .dr-popup-content {
        padding: 10px;
        padding-top: 22px;
    }

    .dr-popup-title {
        font-size: 20px;
        margin-bottom: 8px;
    }

    .dr-popup-top {
        margin-bottom: 7px;
    }

    .dr-popup-image {
        max-height: 48vh;
    }

    .dr-popup-visit-btn {
        min-height: 42px;
        margin-top: 8px;
    }
}

@media (max-height: 600px) {
    .dr-popup-title {
        font-size: 18px;
    }

    .dr-popup-badge,
    .dr-popup-timer-box {
        font-size: 11px;
        padding: 5px 8px;
    }

    .dr-popup-image {
        max-height: 43vh;
    }

    .dr-popup-visit-btn {
        min-height: 38px;
        font-size: 14px;
    }
}
</style>

<script>
(function () {
    var popupOverlay   = document.getElementById('drPopupOverlayBox');
    var popupCloseBtn  = document.getElementById('drPopupCloseBtn');
    var popupTimerText = document.getElementById('drPopupTimerText');

    if (!popupOverlay) {
        return;
    }

    var popupSeconds = 25;
    var popupInterval = null;
    var popupClosed = false;

    function openPopupBox() {
        popupOverlay.style.display = 'flex';
        popupOverlay.classList.add('dr-popup-show');
        document.body.style.overflow = 'hidden';
        startPopupCountdown();
    }

    function closePopupBox() {
        if (popupClosed) {
            return;
        }

        popupClosed = true;

        if (popupInterval) {
            clearInterval(popupInterval);
        }

        popupOverlay.style.display = 'none';
        popupOverlay.classList.remove('dr-popup-show');
        document.body.style.overflow = '';
    }

    function startPopupCountdown() {
        if (popupTimerText) {
            popupTimerText.innerHTML = popupSeconds;
        }

        popupInterval = setInterval(function () {
            popupSeconds--;

            if (popupTimerText) {
                popupTimerText.innerHTML = popupSeconds;
            }

            if (popupSeconds <= 0) {
                clearInterval(popupInterval);
                closePopupBox();
            }
        }, 1000);
    }

    if (popupCloseBtn) {
        popupCloseBtn.onclick = function (e) {
            e.preventDefault();
            e.stopPropagation();
            closePopupBox();
            return false;
        };
    }

    popupOverlay.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('dr-popup-backdrop')) {
            closePopupBox();
        }
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            closePopupBox();
        }
    });

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', openPopupBox);
    } else {
        openPopupBox();
    }
})();
</script>
<?php } ?>