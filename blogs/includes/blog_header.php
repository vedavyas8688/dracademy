<?php
$currentPage = basename($_SERVER['PHP_SELF']);

function dra_is_active($pages = []) {
    global $currentPage;
    return in_array($currentPage, $pages, true) ? 'dra-active' : '';
}
?>

<style>
:root{
    --dra-primary:#123d7a;
    --dra-primary-dark:#0d2d5a;
    --dra-secondary:#2d7ef7;
    --dra-accent:#f5a623;
    --dra-text:#1f2d3d;
    --dra-muted:#66788f;
    --dra-white:#ffffff;
    --dra-border:#e4ebf3;
    --dra-soft:#f7faff;
    --dra-shadow:0 10px 28px rgba(18,61,122,0.10);
    --dra-radius:16px;
}

.dra-header-wrap *{
    box-sizing:border-box;
}

.dra-header-wrap{
    position:sticky;
    top:0;
    left:0;
    width:100%;
    z-index:9999;
    background:rgba(255,255,255,0.96);
    backdrop-filter:blur(12px);
    border-bottom:1px solid var(--dra-border);
    box-shadow:0 4px 18px rgba(18,61,122,0.05);
    font-family:Arial, Helvetica, sans-serif;
}

.dra-header-container{
    max-width:1280px;
    margin:0 auto;
    padding:0 18px;
}

.dra-header-row{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:20px;
    min-height:88px;
}

.dra-brand{
    display:flex;
    align-items:center;
    flex-shrink:0;
    text-decoration:none;
}

.dra-brand img{
    height:64px;
    width:auto;
    display:block;
}

.dra-nav{
    display:flex;
    align-items:center;
    gap:6px;
    margin-left:auto;
}

.dra-nav-list{
    list-style:none;
    display:flex;
    align-items:center;
    gap:4px;
    margin:0;
    padding:0;
}

.dra-nav-item{
    position:relative;
}

.dra-nav-link,
.dra-dropdown-toggle{
    display:flex;
    align-items:center;
    gap:8px;
    padding:12px 16px;
    text-decoration:none;
    color:var(--dra-text);
    font-size:15px;
    font-weight:700;
    border-radius:12px;
    transition:all .25s ease;
    background:transparent;
    border:none;
    cursor:pointer;
}

.dra-nav-link:hover,
.dra-dropdown-toggle:hover,
.dra-nav-item.dra-open > .dra-dropdown-toggle{
    color:var(--dra-primary);
    background:var(--dra-soft);
}

.dra-active > .dra-nav-link,
.dra-active > .dra-dropdown-toggle{
    color:var(--dra-primary);
    background:var(--dra-soft);
}

.dra-active > .dra-nav-link::after,
.dra-active > .dra-dropdown-toggle::after{
    content:"";
    position:absolute;
    left:14px;
    right:14px;
    bottom:6px;
    height:2px;
    border-radius:2px;
    background:linear-gradient(90deg,var(--dra-primary),var(--dra-secondary));
}

.dra-arrow{
    width:9px;
    height:9px;
    border-right:2px solid currentColor;
    border-bottom:2px solid currentColor;
    transform:rotate(45deg);
    transition:transform .25s ease;
    margin-top:-3px;
}

.dra-nav-item.dra-open .dra-arrow{
    transform:rotate(-135deg);
    margin-top:3px;
}

.dra-dropdown-menu{
    position:absolute;
    top:calc(100% - 6px); /* ✅ FIX: removes hover gap */
    left:0;
    min-width:260px;
    background:var(--dra-white);
    border:1px solid var(--dra-border);
    border-radius:16px;
    box-shadow:var(--dra-shadow);
    padding:10px;
    opacity:0;
    visibility:hidden;
    transform:translateY(10px);
    transition:opacity .28s ease, transform .28s ease, visibility .28s ease;
    pointer-events:none;
}

/* ✅ KEEP DROPDOWN OPEN WHEN HOVERING MENU OR BUTTON */
.dra-nav-item:hover > .dra-dropdown-menu,
.dra-nav-item.dra-open > .dra-dropdown-menu{
    opacity:1;
    visibility:visible;
    transform:translateY(0);
    pointer-events:auto;
}

.dra-dropdown-menu a{
    display:block;
    text-decoration:none;
    color:var(--dra-text);
    font-size:14px;
    font-weight:600;
    padding:12px 14px;
    border-radius:12px;
    transition:all .22s ease;
}

.dra-dropdown-menu a:hover{
    background:var(--dra-soft);
    color:var(--dra-primary);
    transform:translateX(4px);
}

.dra-header-actions{
    display:flex;
    align-items:center;
    gap:10px;
    flex-shrink:0;
}

.dra-call-btn,
.dra-cta-btn{
    text-decoration:none;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    padding:11px 18px;
    border-radius:12px;
    font-size:14px;
    font-weight:800;
    transition:all .25s ease;
    white-space:nowrap;
}

.dra-call-btn{
    color:var(--dra-primary);
    background:#eef5ff;
}

.dra-call-btn:hover{
    color:var(--dra-primary-dark);
    transform:translateY(-2px);
}

.dra-cta-btn{
    color:#fff;
    background:linear-gradient(135deg,var(--dra-primary),var(--dra-secondary));
    box-shadow:0 10px 20px rgba(45,126,247,0.20);
}

.dra-cta-btn:hover{
    color:#fff;
    transform:translateY(-2px);
}

.dra-mobile-toggle{
    display:none;
    width:46px;
    height:46px;
    border:none;
    background:var(--dra-soft);
    border-radius:12px;
    cursor:pointer;
    padding:0;
    align-items:center;
    justify-content:center;
    flex-direction:column;
    gap:5px;
}

.dra-mobile-toggle span{
    display:block;
    width:22px;
    height:2px;
    background:var(--dra-primary);
    border-radius:2px;
    transition:all .25s ease;
}

.dra-mobile-toggle.dra-open span:nth-child(1){
    transform:translateY(7px) rotate(45deg);
}
.dra-mobile-toggle.dra-open span:nth-child(2){
    opacity:0;
}
.dra-mobile-toggle.dra-open span:nth-child(3){
    transform:translateY(-7px) rotate(-45deg);
}

@media (max-width: 1024px){
    .dra-mobile-toggle{
        display:flex;
    }

    .dra-nav{
        position:absolute;
        top:100%;
        left:0;
        right:0;
        background:rgba(255,255,255,0.98);
        backdrop-filter:blur(10px);
        border-bottom:1px solid var(--dra-border);
        box-shadow:0 14px 28px rgba(18,61,122,0.08);
        padding:14px 18px 18px;
        opacity:0;
        visibility:hidden;
        transform:translateY(-10px);
        transition:all .28s ease;
    }

    .dra-nav.dra-show{
        opacity:1;
        visibility:visible;
        transform:translateY(0);
    }

    .dra-nav-list{
        width:100%;
        flex-direction:column;
        align-items:stretch;
    }

    .dra-nav-item{
        width:100%;
    }

    .dra-nav-link,
    .dra-dropdown-toggle{
        width:100%;
        justify-content:space-between;
        padding:14px 14px;
    }

    .dra-dropdown-menu{
        position:static;
        min-width:100%;
        margin-top:8px;
        opacity:1;
        visibility:visible;
        transform:none;
        pointer-events:auto;
        display:none;
        box-shadow:none;
        border:1px solid var(--dra-border);
        background:#fbfdff;
    }

    .dra-nav-item.dra-open > .dra-dropdown-menu{
        display:block;
    }

    .dra-header-actions{
        display:none;
    }

    .dra-header-row{
        min-height:80px;
    }

    .dra-brand img{
        height:56px;
    }
}

@media (max-width: 575px){
    .dra-header-container{
        padding:0 12px;
    }

    .dra-brand img{
        height:50px;
    }
}
</style>

<header class="dra-header-wrap">
    <div class="dra-header-container">
        <div class="dra-header-row">
            <a href="https://dracademy.co.in/" class="dra-brand">
                <img src="logo.png" alt="DR Academy Logo">
            </a>

            <nav class="dra-nav" id="draMainNav">
                <ul class="dra-nav-list">
                    <!--<li class="dra-nav-item <?php echo dra_is_active(['index.php']); ?>">-->
                    <!--    <a href="index.php" class="dra-nav-link">Home</a>-->
                    <!--</li>-->

                    <li class="dra-nav-item <?php echo dra_is_active(['about-us.php']); ?>">
                        <a href="https://dracademy.co.in/about.php" class="dra-nav-link">About Us</a>
                    </li>

                    <li class="dra-nav-item <?php echo dra_is_active(['courses.php','neet-coaching.php','jee-coaching.php','kcet-coaching.php','pu-science.php']); ?>">
                        <button type="button" class="dra-dropdown-toggle">
                            Sample Papers & Solutions
                            <span class="dra-arrow"></span>
                        </button>
                        <div class="dra-dropdown-menu">
                            <a href="https://dracademy.co.in/neet_question_papers.php" target="_blank">NEET</a>
                            <a href="https://dracademy.co.in/kcet_question_papers.php" target="_blank">KCET</a>
                        </div>
                    </li>

                    <li class="dra-nav-item <?php echo dra_is_active(['courses.php','neet-coaching.php','jee-coaching.php','kcet-coaching.php','pu-science.php']); ?>">
                        <button type="button" class="dra-dropdown-toggle">
                            Results
                            <span class="dra-arrow"></span>
                        </button>
                        <div class="dra-dropdown-menu">
                            <a href="https://dracademy.co.in/pu_results.php" target="_blank">PUC</a>
                            <a href="https://dracademy.co.in/jee.php" target="_blank">JEE</a>
                            <a href="https://dracademy.co.in/neet_results.php" target="_blank">NEET</a>
                            <a href="https://dracademy.co.in/kcet.php" target="_blank">KCET</a>
                        </div>
                    </li>

                    <li class="dra-nav-item <?php echo dra_is_active(['contact-us.php']); ?>">
                        <a href="https://dracademy.co.in/contact.php" class="dra-nav-link" target="_blank">Contact</a>
                    </li>
                </ul>
            </nav>

            <div class="dra-header-actions">
                <a href="tel:+919008030463" class="dra-call-btn">Call Now</a>
                <a href="https://dracademy.co.in/onlineform.html" class="dra-cta-btn">Admissions Open</a>
            </div>

            <button class="dra-mobile-toggle" id="draMobileToggle" type="button" aria-label="Toggle menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>
</header>

<script>
(function () {
    const mobileToggle = document.getElementById('draMobileToggle');
    const nav = document.getElementById('draMainNav');
    const dropdownToggles = document.querySelectorAll('.dra-dropdown-toggle');

    if (mobileToggle && nav) {
        mobileToggle.addEventListener('click', function () {
            mobileToggle.classList.toggle('dra-open');
            nav.classList.toggle('dra-show');
        });
    }

    dropdownToggles.forEach(function (toggle) {
        toggle.addEventListener('click', function (e) {
            const parent = toggle.closest('.dra-nav-item');

            if (window.innerWidth <= 1024) {
                e.preventDefault();

                document.querySelectorAll('.dra-nav-item.dra-open').forEach(function (item) {
                    if (item !== parent) {
                        item.classList.remove('dra-open');
                    }
                });

                parent.classList.toggle('dra-open');
            }
        });
    });

    document.addEventListener('click', function (e) {
        document.querySelectorAll('.dra-nav-item.dra-open').forEach(function (item) {
            if (!item.contains(e.target)) {
                item.classList.remove('dra-open');
            }
        });
    });

    window.addEventListener('resize', function () {
        if (window.innerWidth > 1024) {
            if (nav) nav.classList.remove('dra-show');
            if (mobileToggle) mobileToggle.classList.remove('dra-open');
            document.querySelectorAll('.dra-nav-item.dra-open').forEach(function (item) {
                item.classList.remove('dra-open');
            });
        }
    });
})();
</script>