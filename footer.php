<footer>
    <!-- <p>To jest footer Sunnycode</p> -->
</footer>

<?php wp_footer(); ?>

<script>
document.addEventListener('DOMContentLoaded', function () {

  const c = document.querySelector('.sunnycode-c-svg');
  if (!c) return;

  let angle = 0;        // aktualny kąt
  let velocity = 0;     // prędkość obrotu
  const stiffness = 0.02; // sprężystość (im większa, tym szybciej wraca)
  const damping = 0.92;   // tłumienie (im mniejsze, tym szybciej się uspokaja)

  let lastScrollY = window.scrollY;

  window.addEventListener('scroll', () => {
    const delta = window.scrollY - lastScrollY;
    lastScrollY = window.scrollY; 

    // nadaj impuls zależny od siły scrolla
    velocity += delta * 0.05;
  });

  function animate() {
    // siła sprężystości (powrót do 0)
    const force = -angle * stiffness;

    velocity += force;
    velocity *= damping;
    angle += velocity;

    c.style.transform = `rotate(${angle}deg)`;

    // mikro-cień reagujący na wychylenie
    const shadowX = -angle * 0.6;      // przeciwny kierunek
    const shadowY = Math.abs(angle) * 0.4; 
    const blur = 4 + Math.abs(angle) * 0.3;

    c.style.filter = `drop-shadow(${shadowX}px ${shadowY}px ${blur}px rgba(0,0,0,0.08))`;

    const brightness = 1 + Math.abs(angle) * 0.01;
        c.style.filter = `
        drop-shadow(${shadowX}px ${shadowY}px ${blur}px rgba(0,0,0,0.08))
        brightness(${brightness})
        `;

    requestAnimationFrame(animate);
  }

  animate();
});
</script>


</body>
</html>