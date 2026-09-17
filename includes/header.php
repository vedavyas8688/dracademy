<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<style>
*{
    box-sizing:border-box;
}

body{
    padding-top:100px!important;
    margin:0;
}

.dr-main-header{
    position:fixed;
    top:0;
    left:0;
    width:100%;
    z-index:99999;
    font-family:Arial,Helvetica,sans-serif;
}

.dr-topbar{
    width:100%;
    background:linear-gradient(90deg,#9b6fd3,#ec3b8d);
    color:#fff;
    transition:all .35s ease;
}

.dr-topbar.hide{
    transform:translateY(-100%);
    opacity:0;
    height:0;
    overflow:hidden;
}

.dr-topbar-inner{
    width:100%;
    min-height:52px;
    display:flex;
    align-items:center;
    justify-content:center;
    gap:25px;
    flex-wrap:wrap;
    padding:6px 20px;
    font-size:14px;
    font-weight:700;
}

.dr-topbar a{
    color:#fff;
    text-decoration:none;
}

.dr-nav-wrap{
    width:100%;
    background:#fff;
    box-shadow:0 2px 10px rgba(0,0,0,.08);
}

.dr-nav-inner{
    width:100%;
    min-height:80px;
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:0 40px;
}

.dr-logo img{
    width:auto;
    height:55px;
    display:block;
}

.dr-menu{
    display:flex;
    align-items:center;
    justify-content:flex-end;
    gap:28px;
    margin:0;
    padding:0;
    list-style:none;
}

.dr-menu li{
    position:relative;
}

.dr-menu a{
    text-decoration:none;
    color:#092744;
    font-size:14px;
    font-weight:800;
    transition:.25s;
    text-transform:uppercase;
}

.dr-menu a:hover,
.dr-menu .active>a{
    color:#007bff;
}

.dr-menu-exam-btn a{
    background:linear-gradient(135deg,#0066ff,#7b2ff7);
    color:#fff!important;
    padding:12px 20px;
    border-radius:40px;
    box-shadow:0 8px 18px rgba(0,102,255,.20);
}

.dr-menu-exam-btn a:hover{
    color:#fff!important;
    transform:translateY(-1px);
}

.dr-dropdown > a{
    display:flex;
    align-items:center;
    gap:6px;
}

.dr-arrow{
    font-size:12px;
    transition:.25s;
}

.dr-dropdown:hover .dr-arrow{
    transform:rotate(180deg);
}

.dr-dropdown-menu{
    position:absolute;
    top:100%;
    left:0;
    min-width:220px;
    background:#fff;
    box-shadow:0 10px 30px rgba(0,0,0,.15);
    padding:10px 0;
    list-style:none;
    margin:18px 0 0;
    opacity:0;
    visibility:hidden;
    transform:translateY(12px);
    transition:.25s;
    z-index:999999;
    border-radius:8px;
}

.dr-dropdown:hover .dr-dropdown-menu{
    opacity:1;
    visibility:visible;
    transform:translateY(0);
}

.dr-dropdown-menu li a{
    display:block;
    padding:12px 18px;
    white-space:nowrap;
    font-size:13px;
    color:#092744;
    background:#fff;
}

.dr-dropdown-menu li a:hover{
    background:#f3f7ff;
    color:#007bff;
}

.dr-mobile-btn{
    display:none;
    background:none;
    border:0;
    width:42px;
    height:36px;
    cursor:pointer;
    padding:0;
}

.dr-mobile-btn span{
    display:block;
    height:3px;
    background:#092744;
    margin:7px 0;
    border-radius:5px;
    transition:.25s;
}

.dr-mobile-btn.active span:nth-child(1){
    transform:translateY(10px) rotate(45deg);
}

.dr-mobile-btn.active span:nth-child(2){
    opacity:0;
}

.dr-mobile-btn.active span:nth-child(3){
    transform:translateY(-10px) rotate(-45deg);
}

@media(max-width:1199px){

    .dr-nav-inner{
        padding:0 24px;
    }

    .dr-menu{
        gap:18px;
    }

    .dr-menu a{
        font-size:13px;
    }
}

@media(max-width:991px){

    /* HIDE TOP BAR IN MOBILE */
    .dr-topbar{
        display:none!important;
    }

    body{
        padding-top:76px!important;
    }

    .dr-nav-inner{
        min-height:76px;
        padding:0 16px;
    }

    .dr-logo img{
        height:44px;
    }

    .dr-mobile-btn{
        display:block;
    }

    .dr-menu{
        position:absolute;
        top:100%;
        left:0;
        width:100%;
        background:#fff;
        display:none;
        flex-direction:column;
        align-items:flex-start;
        gap:0;
        padding:12px 18px 20px;
        box-shadow:0 10px 22px rgba(0,0,0,.14);
        max-height:calc(100vh - 76px);
        overflow-y:auto;
        border-top:1px solid #edf0f5;
    }

    .dr-menu.show{
        display:flex;
    }

    .dr-menu li{
        width:100%;
    }

    .dr-menu a{
        display:flex;
        justify-content:space-between;
        align-items:center;
        padding:14px 0;
        width:100%;
        font-size:14px;
        border-bottom:1px solid #edf0f5;
    }

    .dr-menu-exam-btn{
        order:-1;
    }

    .dr-menu-exam-btn a{
        justify-content:center;
        border-bottom:0;
        margin:4px 0 10px;
        padding:14px 16px;
        border-radius:12px;
    }

    .dr-dropdown.open .dr-arrow{
        transform:rotate(180deg);
    }

    .dr-dropdown-menu{
        position:static;
        opacity:1;
        visibility:visible;
        transform:none;
        box-shadow:none;
        margin:0;
        padding:0 0 0 12px;
        display:none;
        width:100%;
        border-radius:0;
    }

    .dr-dropdown.open .dr-dropdown-menu{
        display:block;
    }

    .dr-dropdown-menu li a{
        padding:11px 12px;
        font-size:13px;
        background:#f7f9fc;
        margin-bottom:5px;
        border-radius:6px;
        border-bottom:0;
    }
}

@media(max-width:575px){

    body{
        padding-top:72px!important;
    }

    .dr-logo img{
        height:40px;
    }

    .dr-nav-inner{
        min-height:72px;
        padding:0 14px;
    }

    .dr-menu{
        max-height:calc(100vh - 72px);
        padding:10px 16px 18px;
    }
}
</style>

<header class="dr-main-header">

    <div class="dr-topbar">
        <div class="dr-topbar-inner">
            <span>☎ +91-8977548426 | +91-8977548029 | +91-8977754109</span>
            <a href="mailto:hyd@dracademy.co.in">✉ hyd@dracademy.co.in</a>
        </div>
    </div>

    <div class="dr-nav-wrap">
        <div class="dr-nav-inner">

            <a href="index.php" class="dr-logo">
                <img src="assets/images/logo.png" alt="DR Academy">
            </a>

            <button class="dr-mobile-btn" id="drMobileBtn" type="button">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <ul class="dr-menu" id="drMenu">

                <li class="<?php echo ($current_page=='index.php')?'active':''; ?>">
                    <a href="index.php">HOME</a>
                </li>

                <li class="<?php echo ($current_page=='about.php')?'active':''; ?>">
                    <a href="about.php">ABOUT US</a>
                </li>

                <li class="dr-dropdown <?php echo in_array($current_page,['miyapur.php','mallampet.php'])?'active':''; ?>">
                    <a href="javascript:void(0)">OUR CAMPUSES <span class="dr-arrow">▾</span></a>

                    <ul class="dr-dropdown-menu">
                        <li><a href="miyapur.php">MIYAPUR</a></li>
                        <li><a href="mallampet.php">MALLAMPET</a></li>
                        <li><a href="https://dracademy.co.in/" target="_blank">BENGALURU</a></li>
                    </ul>
                </li>

                <li class="dr-dropdown <?php echo in_array($current_page,['neet_results.php','jee.php','eapcet.php'])?'active':''; ?>">
                    <a href="javascript:void(0)">RESULTS <span class="dr-arrow">▾</span></a>

                    <ul class="dr-dropdown-menu">
                        <li><a href="neet_results.php">NEET</a></li>
                        <li><a href="jee.php">JEE</a></li>
                        <li><a href="eapcet.php">EAPCET</a></li>
                    </ul>
                </li>

                <li class="dr-dropdown <?php echo in_array($current_page,['neet_question_papers.php'])?'active':''; ?>">
                    <a href="javascript:void(0)">DOWNLOADS <span class="dr-arrow">▾</span></a>

                    <ul class="dr-dropdown-menu">
                        <li><a href="neet_question_papers.php">NEET QUESTION PAPERS</a></li>
                    </ul>
                </li>

                <li class="<?php echo ($current_page=='blog.php')?'active':''; ?>">
                    <a href="blog.php">BLOG</a>
                </li>

                <li class="<?php echo ($current_page=='contact.php')?'active':''; ?>">
                    <a href="contact.php">CONTACT</a>
                </li>

                <li class="dr-menu-exam-btn">
                    <a href="https://exam.dracademy.co.in/candidate/login" target="_blank">ONLINE EXAMS</a>
                </li>

            </ul>

        </div>
    </div>

</header>

<script>
(function(){

    const menu = document.getElementById('drMenu');
    const btn = document.getElementById('drMobileBtn');

    btn.addEventListener('click', function(){

        menu.classList.toggle('show');
        btn.classList.toggle('active');

    });

    document.querySelectorAll('.dr-dropdown > a').forEach(function(link){

        link.addEventListener('click', function(e){

            if(window.innerWidth <= 991){

                e.preventDefault();
                this.parentElement.classList.toggle('open');

            }

        });

    });

})();
</script>