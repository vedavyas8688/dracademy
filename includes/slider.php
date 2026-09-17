<?php
$scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/'));
$projectBase = preg_replace('#/blogs$#', '', rtrim($scriptDir, '/'));
$drSliderBase = ($projectBase === '' || $projectBase === '.') ? '/' : $projectBase . '/';
?>

<style>
.dr-main-slider{
  width:100%;
  overflow:hidden;
  position:relative;
  border-radius:18px;
  background:#eef3fb;
  box-shadow:0 12px 30px rgba(0,0,0,.12);
}
.dr-main-slider-track{
  display:flex;
  transition:transform .75s cubic-bezier(.22,.61,.36,1);
  will-change:transform;
}
.dr-main-slider-slide{
  min-width:100%;
  position:relative;
}
.dr-main-slider-slide img{
  width:100%;
  height:auto;
  display:block;
  object-fit:cover;
  transition:transform 1.2s ease;
}
.dr-main-slider:hover img{
  transform:scale(1.015);
}
.dr-slider-arrow{
  position:absolute;
  top:50%;
  transform:translateY(-50%);
  width:42px;
  height:42px;
  border:none;
  border-radius:50%;
  background:rgba(255,255,255,.25);
  color:#fff;
  font-size:24px;
  cursor:pointer;
  z-index:10;
  opacity:0;
  visibility:hidden;
  backdrop-filter:blur(8px);
  box-shadow:0 8px 22px rgba(0,0,0,.18);
  transition:.3s ease;
}
.dr-main-slider:hover .dr-slider-arrow{
  opacity:1;
  visibility:visible;
}
.dr-slider-arrow:hover{
  background:rgba(255,255,255,.45);
  transform:translateY(-50%) scale(1.08);
}
.dr-slider-prev{left:14px;}
.dr-slider-next{right:14px;}

.dr-slider-dots{
  position:absolute;
  left:50%;
  bottom:12px;
  transform:translateX(-50%);
  display:flex;
  gap:7px;
  z-index:12;
  opacity:0;
  visibility:hidden;
  transition:.3s ease;
}
.dr-main-slider:hover .dr-slider-dots{
  opacity:1;
  visibility:visible;
}
.dr-slider-dot{
  width:8px;
  height:8px;
  border-radius:50%;
  border:none;
  background:rgba(255,255,255,.55);
  cursor:pointer;
  transition:.3s ease;
}
.dr-slider-dot.active{
  width:24px;
  border-radius:30px;
  background:#fff;
}

@media(max-width:576px){
  .dr-main-slider{border-radius:12px;}
  .dr-slider-arrow{
    width:34px;
    height:34px;
    font-size:18px;
    opacity:1;
    visibility:visible;
  }
  .dr-slider-dots{
    opacity:1;
    visibility:visible;
  }
}
</style>

<div class="dr-main-slider">
  <div class="dr-main-slider-track">
      
    <div class="dr-main-slider-slide">
      <img src="<?php echo $drSliderBase; ?>assets/neet_results/neet-2026-1.webp" alt="DR Academy">
    </div>
    
    <div class="dr-main-slider-slide">
      <img src="<?php echo $drSliderBase; ?>assets/neet_results/neet-2026-2.webp" alt="DR Academy">
    </div>
    
    <div class="dr-main-slider-slide">
      <img src="<?php echo $drSliderBase; ?>assets/neet_results/neet-2026-3.webp" alt="DR Academy">
    </div>

    <div class="dr-main-slider-slide">
      <img src="<?php echo $drSliderBase; ?>assets/eap-1.webp" alt="DR Academy">
    </div>

    <div class="dr-main-slider-slide">
      <img src="<?php echo $drSliderBase; ?>assets/eap-2.webp" alt="DR Academy">
    </div>

    <div class="dr-main-slider-slide">
      <img src="<?php echo $drSliderBase; ?>assets/eap-3.webp" alt="DR Academy">
    </div>

    <div class="dr-main-slider-slide">
      <img src="<?php echo $drSliderBase; ?>assets/inter1.jpg" alt="DR Academy">
    </div>

    <div class="dr-main-slider-slide">
      <img src="<?php echo $drSliderBase; ?>assets/inter2.jpg" alt="DR Academy">
    </div>

    <div class="dr-main-slider-slide">
      <img src="<?php echo $drSliderBase; ?>assets/inter3.jpg" alt="DR Academy">
    </div>

    <div class="dr-main-slider-slide">
      <img src="<?php echo $drSliderBase; ?>assets/inter4.jpg" alt="DR Academy">
    </div>

    <div class="dr-main-slider-slide">
      <img src="<?php echo $drSliderBase; ?>data1/images/jee-2026.jpg" alt="DR Academy">
    </div>

  </div>

  <button type="button" class="dr-slider-arrow dr-slider-prev">&#10094;</button>
  <button type="button" class="dr-slider-arrow dr-slider-next">&#10095;</button>
  <div class="dr-slider-dots"></div>
</div>

<script>
(function(){
  document.querySelectorAll('.dr-main-slider').forEach(function(slider){
    let index = 0;
    let timer = null;

    const track = slider.querySelector('.dr-main-slider-track');
    const slides = slider.querySelectorAll('.dr-main-slider-slide');
    const nextBtn = slider.querySelector('.dr-slider-next');
    const prevBtn = slider.querySelector('.dr-slider-prev');
    const dotsBox = slider.querySelector('.dr-slider-dots');

    if(!track || slides.length === 0) return;

    slides.forEach(function(_, i){
      const dot = document.createElement('button');
      dot.type = 'button';
      dot.className = 'dr-slider-dot' + (i === 0 ? ' active' : '');
      dot.addEventListener('click', function(){
        index = i;
        update();
        restart();
      });
      dotsBox.appendChild(dot);
    });

    const dots = dotsBox.querySelectorAll('.dr-slider-dot');

    function update(){
      track.style.transform = 'translateX(-' + (index * 100) + '%)';
      dots.forEach(function(dot, i){
        dot.classList.toggle('active', i === index);
      });
    }

    function next(){
      index = (index + 1) % slides.length;
      update();
    }

    function prev(){
      index = (index - 1 + slides.length) % slides.length;
      update();
    }

    function start(){
      timer = setInterval(next, 4000);
    }

    function stop(){
      clearInterval(timer);
    }

    function restart(){
      stop();
      start();
    }

    nextBtn.addEventListener('click', function(){
      next();
      restart();
    });

    prevBtn.addEventListener('click', function(){
      prev();
      restart();
    });

    slider.addEventListener('mouseenter', stop);
    slider.addEventListener('mouseleave', start);

    start();
  });
})();
</script>
