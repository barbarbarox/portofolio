/**
 * magic-bento.js — MagicBento Vanilla JS
 * Ported from React reference (animasi_yang_mau_diterapkan.txt L992-L1891)
 *
 * Applies: GlobalSpotlight + ParticleCard effects to .bento-section
 * Config via data attributes on .bento-section:
 *   data-glow-color="99,102,241"   (RGB, no spaces around commas)
 *   data-spotlight-radius="400"
 *   data-particle-count="12"
 */

'use strict';

(function initMagicBento() {

  /* ── Config defaults ─────────────────────────────────── */
  const GLOW_COLOR       = '99, 102, 241';
  const SPOTLIGHT_RADIUS = 400;
  const PARTICLE_COUNT   = 12;
  const MOBILE_BP        = 768;

  const isMobile = () => window.innerWidth <= MOBILE_BP;

  /* ── Utility: create a floating particle element ─────── */
  function createParticle(x, y, color) {
    const el = document.createElement('div');
    el.className = 'particle';
    el.style.cssText = [
      `position:absolute`,
      `width:4px`,
      `height:4px`,
      `border-radius:50%`,
      `background:rgba(${color},1)`,
      `box-shadow:0 0 6px rgba(${color},0.55)`,
      `pointer-events:none`,
      `z-index:100`,
      `left:${x}px`,
      `top:${y}px`,
    ].join(';');
    return el;
  }

  /* ── Spotlight ────────────────────────────────────────── */
  function createSpotlight(section, glowColor, radius) {
    if (isMobile()) return () => {};

    const spotlight = document.createElement('div');
    spotlight.className = 'global-spotlight';
    spotlight.style.cssText = [
      'position:fixed',
      'width:700px',
      'height:700px',
      'border-radius:50%',
      'pointer-events:none',
      `background:radial-gradient(circle,rgba(${glowColor},0.14) 0%,rgba(${glowColor},0.07) 15%,rgba(${glowColor},0.03) 30%,rgba(${glowColor},0.01) 55%,transparent 70%)`,
      'z-index:200',
      'opacity:0',
      'transform:translate(-50%,-50%)',
      'mix-blend-mode:screen',
      'will-change:transform,opacity',
      'transition:opacity 0.3s ease',
    ].join(';');
    document.body.appendChild(spotlight);

    const proximity   = radius * 0.5;
    const fadeDist    = radius * 0.75;
    const cards       = section.querySelectorAll('.magic-bento-card');
    let isInside      = false;

    function onMove(e) {
      const sRect = section.getBoundingClientRect();
      isInside = (e.clientX >= sRect.left && e.clientX <= sRect.right &&
                  e.clientY >= sRect.top  && e.clientY <= sRect.bottom);

      /* move spotlight */
      spotlight.style.left = e.clientX + 'px';
      spotlight.style.top  = e.clientY + 'px';

      if (!isInside) {
        spotlight.style.opacity = '0';
        cards.forEach(c => c.style.setProperty('--glow-intensity', '0'));
        return;
      }

      let minDist = Infinity;
      cards.forEach(card => {
        const r       = card.getBoundingClientRect();
        const cx      = r.left + r.width  / 2;
        const cy      = r.top  + r.height / 2;
        const dist    = Math.max(0, Math.hypot(e.clientX - cx, e.clientY - cy) - Math.max(r.width, r.height) / 2);
        minDist       = Math.min(minDist, dist);

        let glow = 0;
        if (dist <= proximity)             glow = 1;
        else if (dist <= fadeDist)         glow = (fadeDist - dist) / (fadeDist - proximity);

        const relX = ((e.clientX - r.left) / r.width  * 100).toFixed(1) + '%';
        const relY = ((e.clientY - r.top)  / r.height * 100).toFixed(1) + '%';
        card.style.setProperty('--glow-x',         relX);
        card.style.setProperty('--glow-y',         relY);
        card.style.setProperty('--glow-intensity', glow.toFixed(3));
        card.style.setProperty('--glow-radius',    radius + 'px');
      });

      let targetOpacity = 0;
      if      (minDist <= proximity) targetOpacity = 0.8;
      else if (minDist <= fadeDist)  targetOpacity = ((fadeDist - minDist) / (fadeDist - proximity)) * 0.8;
      spotlight.style.opacity = targetOpacity;
    }

    function onLeave() {
      spotlight.style.opacity = '0';
      cards.forEach(c => c.style.setProperty('--glow-intensity', '0'));
    }

    document.addEventListener('mousemove', onMove, { passive: true });
    document.addEventListener('mouseleave', onLeave);

    /* Return cleanup */
    return () => {
      document.removeEventListener('mousemove', onMove);
      document.removeEventListener('mouseleave', onLeave);
      spotlight.parentNode?.removeChild(spotlight);
    };
  }

  /* ── ParticleCard ─────────────────────────────────────── */
  function initCard(card, config) {
    if (isMobile()) return;

    const { glowColor, particleCount } = config;
    let particles      = [];
    let timeouts       = [];
    let isHovered      = false;
    let memoParticles  = null;

    function initMemo() {
      if (memoParticles) return;
      const { width, height } = card.getBoundingClientRect();
      memoParticles = Array.from({ length: particleCount }, () =>
        createParticle(Math.random() * width, Math.random() * height, glowColor)
      );
    }

    function clearAll() {
      timeouts.forEach(clearTimeout);
      timeouts = [];
      particles.forEach(p => {
        /* simple fade out without GSAP */
        p.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
        p.style.opacity = '0';
        p.style.transform = 'scale(0)';
        setTimeout(() => p.parentNode?.removeChild(p), 350);
      });
      particles = [];
    }

    function animateParticles() {
      if (!isHovered) return;
      initMemo();
      memoParticles.forEach((tmpl, i) => {
        const tid = setTimeout(() => {
          if (!isHovered) return;
          const clone = tmpl.cloneNode(true);
          card.appendChild(clone);
          particles.push(clone);

          /* Animate with CSS custom properties + transitions */
          clone.style.opacity   = '0';
          clone.style.transform = 'scale(0)';
          clone.style.transition = 'opacity 0.3s ease, transform 0.3s ease';

          requestAnimationFrame(() => {
            clone.style.opacity   = '1';
            clone.style.transform = 'scale(1)';
          });

          /* Float around */
          function floatStep() {
            if (!isHovered || !clone.parentNode) return;
            const dx = (Math.random() - 0.5) * 90;
            const dy = (Math.random() - 0.5) * 90;
            const dur = 2000 + Math.random() * 2000;
            clone.style.transition = `transform ${dur}ms ease-in-out, opacity ${dur}ms ease-in-out`;
            clone.style.transform  = `translate(${dx}px,${dy}px) scale(${0.5 + Math.random() * 0.8})`;
            clone.style.opacity    = (0.2 + Math.random() * 0.8).toFixed(2);
            setTimeout(floatStep, dur);
          }
          setTimeout(floatStep, 300);
        }, i * 100);
        timeouts.push(tid);
      });
    }

    /* Click ripple */
    function onClickRipple(e) {
      const rect = card.getBoundingClientRect();
      const x    = e.clientX - rect.left;
      const y    = e.clientY - rect.top;
      const maxD = Math.max(
        Math.hypot(x, y),
        Math.hypot(x - rect.width, y),
        Math.hypot(x, y - rect.height),
        Math.hypot(x - rect.width, y - rect.height)
      );
      const ripple = document.createElement('div');
      const sz     = maxD * 2;
      ripple.style.cssText = [
        'position:absolute',
        `width:${sz}px`,
        `height:${sz}px`,
        'border-radius:50%',
        `background:radial-gradient(circle,rgba(${glowColor},0.35) 0%,rgba(${glowColor},0.15) 35%,transparent 65%)`,
        `left:${x - maxD}px`,
        `top:${y - maxD}px`,
        'pointer-events:none',
        'z-index:1000',
        'transform:scale(0)',
        'opacity:1',
        'transition:transform 0.75s ease-out,opacity 0.75s ease-out',
      ].join(';');
      card.appendChild(ripple);
      requestAnimationFrame(() => {
        ripple.style.transform = 'scale(1)';
        ripple.style.opacity   = '0';
      });
      setTimeout(() => ripple.parentNode?.removeChild(ripple), 800);
    }

    card.addEventListener('mouseenter', () => {
      isHovered = true;
      animateParticles();
    });
    card.addEventListener('mouseleave', () => {
      isHovered = false;
      clearAll();
    });
    card.addEventListener('click', onClickRipple);
  }

  /* ── Init all bento sections ─────────────────────────── */
  document.querySelectorAll('.bento-section').forEach(section => {
    const glowColor      = section.dataset.glowColor      || GLOW_COLOR;
    const spotlightRadius= parseInt(section.dataset.spotlightRadius || SPOTLIGHT_RADIUS, 10);
    const particleCount  = parseInt(section.dataset.particleCount  || PARTICLE_COUNT,   10);

    /* Apply glow color CSS var to cards */
    section.querySelectorAll('.magic-bento-card').forEach(card => {
      card.style.setProperty('--glow-color', glowColor);
    });

    /* Spotlight */
    createSpotlight(section, glowColor, spotlightRadius);

    /* Cards */
    section.querySelectorAll('.magic-bento-card').forEach(card => {
      initCard(card, { glowColor, particleCount });
    });
  });

})();
