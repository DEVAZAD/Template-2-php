// ============================================================
//  main.js  —  Public site scripts
// ============================================================

document.addEventListener('DOMContentLoaded', () => {

  /* ── Mobile nav toggle ── */
  const hamburger = document.querySelector('.hamburger');
  const navLinks  = document.querySelector('.nav-links');
  hamburger?.addEventListener('click', () => {
    navLinks?.classList.toggle('open');
  });
  document.querySelectorAll('.nav-links a').forEach(a =>
    a.addEventListener('click', () => navLinks?.classList.remove('open'))
  );

  /* ── Hero Slider ── */
  const track = document.querySelector('.slider-track');
  const slides = document.querySelectorAll('.slide');
  const dots   = document.querySelectorAll('.dot');
  let current  = 0, timer;

  function goTo(n) {
    current = (n + slides.length) % slides.length;
    track.style.transform = `translateX(-${current * 100}%)`;
    dots.forEach((d, i) => d.classList.toggle('active', i === current));
    clearInterval(timer);
    timer = setInterval(() => goTo(current + 1), 4000);
  }

  dots.forEach((d, i) => d.addEventListener('click', () => goTo(i)));
  if (slides.length) goTo(0);

  /* ── Counter animation ── */
  function animateCounter(el, duration = 1400) {
    const target = Number(el.dataset.to) || 0;
    const start  = performance.now();
    const tick   = now => {
      const p = Math.min((now - start) / duration, 1);
      el.textContent = Math.floor(p * target).toLocaleString();
      if (p < 1) requestAnimationFrame(tick);
    };
    requestAnimationFrame(tick);
  }

  if ('IntersectionObserver' in window) {
    const io = new IntersectionObserver((entries, obs) => {
      entries.forEach(e => {
        if (e.isIntersecting) { animateCounter(e.target); obs.unobserve(e.target); }
      });
    }, { threshold: 0.4 });
    document.querySelectorAll('[data-to]').forEach(el => io.observe(el));
  } else {
    document.querySelectorAll('[data-to]').forEach(el => animateCounter(el));
  }

});
