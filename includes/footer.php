<style>
.dr-footer{
    font-family:Arial,Helvetica,sans-serif;
    color:#fff;
}
.dr-footer-top{
    background:linear-gradient(90deg,#9b7ad7,#ec3e8d);
    padding:95px 15px 80px;
}
.dr-footer-container{
    max-width:1200px;
    margin:auto;
    display:grid;
    grid-template-columns:1.3fr .8fr .9fr 1.4fr;
    gap:70px;
}
.dr-footer-logo{
    background:#fff;
    padding:8px 14px;
    border-radius:12px;
    display:inline-block;
    margin-bottom:25px;
}
.dr-footer-logo img{
    height:35px;
    width:auto;
}
.dr-footer p{
    line-height:1.8;
    font-size:15px;
    margin:0;
}
.dr-footer h4{
    font-size:20px;
    margin:0 0 35px;
    font-weight:800;
}
.dr-footer ul{
    list-style:none;
    padding:0;
    margin:0;
}
.dr-footer li{
    margin-bottom:18px;
}
.dr-footer a{
    color:#fff;
    text-decoration:none;
    font-size:15px;
    font-weight:600;
}
.dr-footer a:hover{
    color:#fff200;
}
.dr-footer-contact p{
    margin-bottom:20px;
}
.dr-footer-social{
    display:flex;
    gap:16px;
    margin-top:25px;
}
.dr-footer-social a{
    color:#fff200;
    font-size:17px;
}
.dr-footer-bottom{
    background:#052342;
    padding:28px 15px;
}
.dr-footer-bottom-inner{
    max-width:1200px;
    margin:auto;
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:20px;
    flex-wrap:wrap;
    color:#fff;
    font-size:15px;
    font-weight:700;
}
.dr-footer-bottom a{
    color:#fff;
    text-decoration:none;
    margin:0 10px;
}
.dr-footer-bottom span{
    color:#fff200;
}
.dr-footer-whatsapp{
    position:fixed;
    left:20px;
    bottom:18px;
    background:#18c34a;
    color:#fff!important;
    padding:12px 18px;
    border-radius:30px;
    font-weight:800;
    text-decoration:none;
    z-index:9999;
}
.dr-footer-top-btn{
    position:fixed;
    right:50px;
    bottom:48px;
    width:46px;
    height:46px;
    border:2px solid #004cff;
    border-radius:50%;
    color:red!important;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:26px!important;
    z-index:9999;
}
@media(max-width:991px){
    .dr-footer-container{
        grid-template-columns:1fr 1fr;
        gap:40px;
    }
}
@media(max-width:575px){
    .dr-footer-top{
        padding:55px 18px;
    }
    .dr-footer-container{
        grid-template-columns:1fr;
        gap:35px;
    }
    .dr-footer-bottom-inner{
        text-align:center;
        justify-content:center;
    }
}
</style>

<footer class="dr-footer">
    <div class="dr-footer-top">
        <div class="dr-footer-container">

            <div>
                <a class="dr-footer-logo" href="index.php">
                    <img src="assets/images/logo.png" alt="DR Academy">
                </a>
                <p>
                    DR Academy, founded by Mr. P. Devender Reddy (DR Sir) and his team,
                    is a growing Hyderabad courses & for +2, CET, NEET, and JEE coaching.
                    With dedicated directors and expert faculty, it aims to build confident,
                    well-prepared students.
                </p>
            </div>

            <div>
                <h4>Pages</h4>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="gallery.html">Gallery</a></li>
                    <li><a href="contact.html">Contact Us</a></li>
                </ul>
            </div>

            <div>
                <h4>Our Campuses</h4>
                <ul>
                    <li><a href="miyapur.html">Miyapur</a></li>
                    <li><a href="mallampet.html">Mallampet</a></li>
                </ul>
            </div>

            <div class="dr-footer-contact">
                <h4>Contact Details</h4>
                <p>Plot No. 87, Mathrusree Nagar, Hafeezpet,<br>Hyderabad, Telangana 500049</p>
                <p><b>Phone :</b> +91-8977548426<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+91-8977548029<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+91-8977754109
                </p>
                <p><b>Email :</b> hyd@dracademy.co.in</p>

                <div class="dr-footer-social">
                    <a href="#">f</a>
                    <a href="#">♥</a>
                    <a href="#">in</a>
                    <a href="#">p</a>
                    <a href="#">♥</a>
                </div>
            </div>

        </div>
    </div>

    <div class="dr-footer-bottom">
        <div class="dr-footer-bottom-inner">
            <div>© Copyrights 2026 All Rights Reserved- <span>DR ACADEMY</span></div>
            <div>
                <a href="faq.html">Trams & Condition</a> |
                <a href="contact.html">Privacy Policy</a> |
                <a href="contact.html">Contact Us</a>
            </div>
        </div>
    </div>
</footer>

<a href="https://wa.me/918977548029" target="_blank" class="dr-footer-whatsapp">☘ WhatsApp Us</a>
<a href="#" class="dr-footer-top-btn">↑</a>