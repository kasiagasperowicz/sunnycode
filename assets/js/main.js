// Główny plik skryptów motywu Sunnycode

document.addEventListener('DOMContentLoaded', function () {
  const hamburger = document.getElementById('hamburger');
  const nav       = document.getElementById('site-nav');

  if (!hamburger || !nav) return;

  hamburger.addEventListener('click', function () {
    const isOpen = nav.classList.toggle('is-open');
    hamburger.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
  });

  // Zamknij menu po kliknięciu w link
  nav.querySelectorAll('a').forEach(function (link) {
    link.addEventListener('click', function () {
      nav.classList.remove('is-open');
      hamburger.setAttribute('aria-expanded', 'false');
    });
  });
});

  // ── Parallax ────────────────────────────────────────────────
  (function () {
    var section = document.getElementById('parallax-section');
    var bg      = document.getElementById('parallax-bg');

    if (!section || !bg) return;

    // Wyłącz na mobile (max 768px) — obsługuje CSS
    var mq = window.matchMedia('(max-width: 768px)');

    var ticking = false;

    function updateParallax() {
      if (mq.matches) return;

      var rect   = section.getBoundingClientRect();
      var viewH  = window.innerHeight;

      // Czy sekcja jest w widoku?
      if (rect.bottom < 0 || rect.top > viewH) return;

      // progress: 0 gdy dolna krawędź sekcji wchodzi z dołu,
      //           1 gdy górna krawędź wychodzi górą
      var progress = 1 - (rect.bottom / (viewH + rect.height));
      // Przesunięcie max ±15% wysokości sekcji
      var shift = (progress - 0.5) * section.offsetHeight * 0.3;

      bg.style.transform = 'translateY(' + shift.toFixed(2) + 'px)';
    }

    window.addEventListener('scroll', function () {
      if (!ticking) {
        window.requestAnimationFrame(function () {
          updateParallax();
          ticking = false;
        });
        ticking = true;
      }
    }, { passive: true });

    updateParallax();
  }());
