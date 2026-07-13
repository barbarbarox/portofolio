/**
 * main.js — Portfolio Core Logic (Rombak Total)
 * Akbar Maulana | Full Stack & CyberSec
 *
 * Contains:
 *  1. LightRays WebGL Background (ported from OGL React reference)
 *  2. PillNav with GSAP hover bubble
 *  3. Mobile nav popover
 *  4. Typed text animation
 *  5. Scroll reveal (IntersectionObserver)
 *  6. Stat counter
 *  7. Skill bar animation
 *  8. Tilted card (about photo)
 *  9. Copy email on click
 * 10. Active nav link tracking
 */

'use strict';

/* ══════════════════════════════════════════════════════════
   1. LightRays WebGL Background
   ══════════════════════════════════════════════════════════ */
(function initLightRays() {
  const container = document.getElementById('lightrays-bg');
  if (!container) return;

  /* --- WebGL bootstrap --- */
  const canvas = document.createElement('canvas');
  container.appendChild(canvas);

  const gl = canvas.getContext('webgl', { alpha: true, premultipliedAlpha: false });
  if (!gl) { console.warn('WebGL not supported — LightRays disabled'); return; }

  /* --- Shader sources --- */
  const vert = `
    attribute vec2 position;
    varying   vec2 vUv;
    void main() {
      vUv        = position * 0.5 + 0.5;
      gl_Position = vec4(position, 0.0, 1.0);
    }
  `;

  const frag = `
    precision highp float;
    uniform float iTime;
    uniform vec2  iResolution;
    uniform vec2  rayPos;
    uniform vec2  rayDir;
    uniform vec3  raysColor;
    uniform float raysSpeed;
    uniform float lightSpread;
    uniform float rayLength;
    uniform float fadeDistance;
    uniform vec2  mousePos;
    uniform float mouseInfluence;

    float rayStrength(vec2 src, vec2 refDir, vec2 coord, float sA, float sB, float spd) {
      vec2  toCoord   = coord - src;
      vec2  dirNorm   = normalize(toCoord);
      float cosA      = dot(dirNorm, refDir);
      float spread    = pow(max(cosA, 0.0), 1.0 / max(lightSpread, 0.001));
      float dist      = length(toCoord);
      float maxDist   = iResolution.x * rayLength;
      float lenFall   = clamp((maxDist - dist) / maxDist, 0.0, 1.0);
      float fadeFall  = clamp((iResolution.x * fadeDistance - dist) / (iResolution.x * fadeDistance), 0.5, 1.0);
      float base      = clamp(
        (0.45 + 0.15 * sin(cosA * sA + iTime * spd)) +
        (0.30 + 0.20 * cos(-cosA * sB + iTime * spd)),
        0.0, 1.0);
      return base * lenFall * fadeFall * spread;
    }

    void main() {
      vec2 coord = vec2(gl_FragCoord.x, iResolution.y - gl_FragCoord.y);

      vec2 finalDir = rayDir;
      if (mouseInfluence > 0.0) {
        vec2 mScreen  = mousePos * iResolution.xy;
        vec2 mDir     = normalize(mScreen - rayPos);
        finalDir      = normalize(mix(rayDir, mDir, mouseInfluence));
      }

      float r1 = rayStrength(rayPos, finalDir, coord, 36.2214, 21.1135, 1.5 * raysSpeed);
      float r2 = rayStrength(rayPos, finalDir, coord, 22.3991, 18.0234, 1.1 * raysSpeed);
      vec4  col = vec4(1.0) * (r1 * 0.65 + r2 * 0.55);

      float brightness = 1.0 - (coord.y / iResolution.y);
      col.x *= 0.15 + brightness * 0.85;
      col.y *= 0.4  + brightness * 0.6;
      col.z *= 0.6  + brightness * 0.4;
      col.rgb *= raysColor * 1.5;

      gl_FragColor = col;
    }
  `;

  /* --- Compile shaders --- */
  function compile(type, src) {
    const s = gl.createShader(type);
    gl.shaderSource(s, src);
    gl.compileShader(s);
    if (!gl.getShaderParameter(s, gl.COMPILE_STATUS)) {
      console.warn('Shader error:', gl.getShaderInfoLog(s));
      return null;
    }
    return s;
  }
  const vs = compile(gl.VERTEX_SHADER,   vert);
  const fs = compile(gl.FRAGMENT_SHADER, frag);
  if (!vs || !fs) return;

  const prog = gl.createProgram();
  gl.attachShader(prog, vs);
  gl.attachShader(prog, fs);
  gl.linkProgram(prog);
  if (!gl.getProgramParameter(prog, gl.LINK_STATUS)) {
    console.warn('Program link error:', gl.getProgramInfoLog(prog));
    return;
  }
  gl.useProgram(prog);

  /* --- Full-screen triangle --- */
  const buf = gl.createBuffer();
  gl.bindBuffer(gl.ARRAY_BUFFER, buf);
  gl.bufferData(gl.ARRAY_BUFFER, new Float32Array([-1,-1, 3,-1, -1,3]), gl.STATIC_DRAW);
  const posLoc = gl.getAttribLocation(prog, 'position');
  gl.enableVertexAttribArray(posLoc);
  gl.vertexAttribPointer(posLoc, 2, gl.FLOAT, false, 0, 0);

  /* --- Uniform locations --- */
  const U = {
    iTime:          gl.getUniformLocation(prog, 'iTime'),
    iResolution:    gl.getUniformLocation(prog, 'iResolution'),
    rayPos:         gl.getUniformLocation(prog, 'rayPos'),
    rayDir:         gl.getUniformLocation(prog, 'rayDir'),
    raysColor:      gl.getUniformLocation(prog, 'raysColor'),
    raysSpeed:      gl.getUniformLocation(prog, 'raysSpeed'),
    lightSpread:    gl.getUniformLocation(prog, 'lightSpread'),
    rayLength:      gl.getUniformLocation(prog, 'rayLength'),
    fadeDistance:   gl.getUniformLocation(prog, 'fadeDistance'),
    mousePos:       gl.getUniformLocation(prog, 'mousePos'),
    mouseInfluence: gl.getUniformLocation(prog, 'mouseInfluence'),
  };

  /* --- Config --- */
  const cfg = {
    color:          [0.5, 0.7, 1.0],   /* bright cyan-blue */
    speed:          0.9,
    lightSpread:    0.45,
    rayLength:      2.8,
    fadeDistance:   1.0,
    mouseInfluence: 0.18,
  };

  /* --- State --- */
  let W = 0, H = 0;
  let mouse  = { x: 0.5, y: 0.5 };
  let smooth = { x: 0.5, y: 0.5 };
  let raf    = null;
  let visible = false;

  function resize() {
    const dpr = Math.min(window.devicePixelRatio, 2);
    W = container.clientWidth;
    H = container.clientHeight;
    canvas.width  = W * dpr;
    canvas.height = H * dpr;
    gl.viewport(0, 0, canvas.width, canvas.height);
  }

  function setUniforms(t) {
    gl.uniform1f(U.iTime,          t);
    gl.uniform2f(U.iResolution,    canvas.width, canvas.height);
    gl.uniform3fv(U.raysColor,     cfg.color);
    gl.uniform1f(U.raysSpeed,      cfg.speed);
    gl.uniform1f(U.lightSpread,    cfg.lightSpread);
    gl.uniform1f(U.rayLength,      cfg.rayLength);
    gl.uniform1f(U.fadeDistance,   cfg.fadeDistance);
    gl.uniform1f(U.mouseInfluence, cfg.mouseInfluence);
    /* ray origin: top-center */
    gl.uniform2f(U.rayPos, canvas.width * 0.5, -0.2 * canvas.height);
    gl.uniform2f(U.rayDir, 0.0, 1.0);
    gl.uniform2f(U.mousePos, smooth.x, smooth.y);
  }

  function loop(ts) {
    if (!visible) { raf = requestAnimationFrame(loop); return; }

    const t = ts * 0.001;
    smooth.x = smooth.x * 0.93 + mouse.x * 0.07;
    smooth.y = smooth.y * 0.93 + mouse.y * 0.07;

    gl.clearColor(0, 0, 0, 0);
    gl.clear(gl.COLOR_BUFFER_BIT);
    setUniforms(t);
    gl.drawArrays(gl.TRIANGLES, 0, 3);
    raf = requestAnimationFrame(loop);
  }

  /* IntersectionObserver — pause when not visible */
  new IntersectionObserver(entries => {
    visible = entries[0].isIntersecting;
  }, { threshold: 0.05 }).observe(container);

  /* Mouse tracking */
  window.addEventListener('mousemove', e => {
    const rect = container.getBoundingClientRect();
    mouse.x = (e.clientX - rect.left) / rect.width;
    mouse.y = (e.clientY - rect.top)  / rect.height;
  }, { passive: true });

  resize();
  window.addEventListener('resize', resize, { passive: true });

  gl.enable(gl.BLEND);
  gl.blendFunc(gl.SRC_ALPHA, gl.ONE_MINUS_SRC_ALPHA);

  raf = requestAnimationFrame(loop);
})();


/* ══════════════════════════════════════════════════════════
   2. PillNav — GSAP hover bubble (Desktop)
   ══════════════════════════════════════════════════════════ */
(function initPillNav() {
  /* GSAP is loaded via CDN in the blade template */
  if (typeof gsap === 'undefined') return;

  const circleEls = document.querySelectorAll('.pill .hover-circle');
  const pills     = document.querySelectorAll('.pill');
  const tlMap     = new Map();
  const ease      = 'power3.easeOut';

  function layoutCircle(pill, circle) {
    if (!pill || !circle) return;
    const rect = pill.getBoundingClientRect();
    const w = rect.width, h = rect.height;
    const R = ((w * w / 4) + (h * h)) / (2 * h);
    const D = Math.ceil(2 * R) + 2;
    const delta = Math.ceil(R - Math.sqrt(Math.max(0, R * R - (w * w / 4)))) + 1;
    const originY = D - delta;

    circle.style.width  = D + 'px';
    circle.style.height = D + 'px';
    circle.style.bottom = (-delta) + 'px';

    gsap.set(circle, { xPercent: -50, scale: 0, transformOrigin: `50% ${originY}px` });

    const label = pill.querySelector('.pill-label');
    const hover = pill.querySelector('.pill-label-hover');
    if (label) gsap.set(label, { y: 0 });
    if (hover) gsap.set(hover, { y: h + 12, opacity: 0 });

    const tl = gsap.timeline({ paused: true });
    tl.to(circle, { scale: 1.2, xPercent: -50, duration: 2, ease, overwrite: 'auto' }, 0);
    if (label) tl.to(label, { y: -(h + 8), duration: 2, ease, overwrite: 'auto' }, 0);
    if (hover) {
      gsap.set(hover, { y: Math.ceil(h + 100), opacity: 0 });
      tl.to(hover, { y: 0, opacity: 1, duration: 2, ease, overwrite: 'auto' }, 0);
    }
    return tl;
  }

  function layout() {
    pills.forEach((pill, i) => {
      const circle = circleEls[i];
      if (!circle) return;
      const tl = layoutCircle(pill, circle);
      tlMap.set(pill, { tl, active: null });
    });
  }

  layout();
  window.addEventListener('resize', layout, { passive: true });
  if (document.fonts?.ready) document.fonts.ready.then(layout).catch(() => {});

  pills.forEach(pill => {
    pill.addEventListener('mouseenter', () => {
      const entry = tlMap.get(pill);
      if (!entry) return;
      entry.active?.kill();
      entry.active = entry.tl.tweenTo(entry.tl.duration(), { duration: 0.3, ease, overwrite: 'auto' });
    });
    pill.addEventListener('mouseleave', () => {
      const entry = tlMap.get(pill);
      if (!entry) return;
      entry.active?.kill();
      entry.active = entry.tl.tweenTo(0, { duration: 0.2, ease, overwrite: 'auto' });
    });
  });
})();


/* ══════════════════════════════════════════════════════════
   3. Mobile Nav Popover
   ══════════════════════════════════════════════════════════ */
(function initMobileNav() {
  const burger  = document.getElementById('pillHamburger');
  const popover = document.getElementById('mobileNavPopover');
  if (!burger || !popover) return;

  let open = false;

  function toggle() {
    open = !open;
    popover.classList.toggle('open', open);
    const lines = burger.querySelectorAll('.hb-line');
    if (typeof gsap !== 'undefined') {
      if (open) {
        gsap.to(lines[0], { rotation: 45,  y: 3,  duration: 0.3, ease: 'power2.out' });
        gsap.to(lines[1], { rotation: -45, y: -3, duration: 0.3, ease: 'power2.out' });
      } else {
        gsap.to(lines[0], { rotation: 0, y: 0, duration: 0.3, ease: 'power2.out' });
        gsap.to(lines[1], { rotation: 0, y: 0, duration: 0.3, ease: 'power2.out' });
      }
    }
  }

  burger.addEventListener('click', toggle);
  popover.querySelectorAll('a').forEach(a => a.addEventListener('click', () => { open = true; toggle(); }));

  /* Close on outside click */
  document.addEventListener('click', e => {
    if (open && !burger.contains(e.target) && !popover.contains(e.target)) toggle();
  });
})();


/* ══════════════════════════════════════════════════════════
   4. Typed Text Animation
   ══════════════════════════════════════════════════════════ */
(function initTyped() {
  const el = document.querySelector('.typed-text');
  if (!el) return;

  let raw = el.dataset.words || '[]';
  let words;
  try { words = JSON.parse(raw); } catch { return; }
  if (!words.length) return;

  let wi = 0, ci = 0, deleting = false;
  const PAUSE = 2200, SPEED_TYPE = 80, SPEED_DEL = 45;

  function tick() {
    const word = words[wi];
    if (deleting) {
      ci--;
      el.textContent = word.slice(0, ci);
      if (ci === 0) { deleting = false; wi = (wi + 1) % words.length; setTimeout(tick, 400); return; }
      setTimeout(tick, SPEED_DEL);
    } else {
      ci++;
      el.textContent = word.slice(0, ci);
      if (ci === word.length) { deleting = true; setTimeout(tick, PAUSE); return; }
      setTimeout(tick, SPEED_TYPE);
    }
  }
  setTimeout(tick, 600);
})();


/* ══════════════════════════════════════════════════════════
   5. Scroll Reveal
   ══════════════════════════════════════════════════════════ */
(function initReveal() {
  const els = document.querySelectorAll('.reveal');
  if (!els.length) return;
  const io = new IntersectionObserver(entries => {
    entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); io.unobserve(e.target); } });
  }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
  els.forEach(el => io.observe(el));
})();


/* ══════════════════════════════════════════════════════════
   6. Stat Counter
   ══════════════════════════════════════════════════════════ */
(function initStats() {
  const nums = document.querySelectorAll('.hero-stat-num[data-count]');
  if (!nums.length) return;

  const io = new IntersectionObserver(entries => {
    entries.forEach(e => {
      if (!e.isIntersecting) return;
      const el     = e.target;
      const target = parseInt(el.dataset.count, 10);
      const suffix = el.dataset.suffix || '';
      const dur    = 1600;
      const start  = performance.now();
      function step(now) {
        const p = Math.min((now - start) / dur, 1);
        const ease = 1 - Math.pow(1 - p, 3);
        el.textContent = Math.floor(ease * target) + suffix;
        if (p < 1) requestAnimationFrame(step);
        else el.textContent = target + suffix;
      }
      requestAnimationFrame(step);
      io.unobserve(el);
    });
  }, { threshold: 0.5 });
  nums.forEach(n => io.observe(n));
})();


/* ══════════════════════════════════════════════════════════
   7. Terminal Skill Hash Bars + Hover Blur Focus
   ══════════════════════════════════════════════════════════ */
(function initTerminalSkills() {
  const grid  = document.getElementById('terminalSkillsGrid');
  if (!grid) return;

  const cards = grid.querySelectorAll('.term-skill-card');

  /* ── Hover blur / focus effect ── */
  cards.forEach(card => {
    card.addEventListener('mouseenter', () => {
      grid.classList.add('has-hover');
      cards.forEach(c => c.classList.remove('is-focused'));
      card.classList.add('is-focused');
    });
    card.addEventListener('mouseleave', () => {
      card.classList.remove('is-focused');
      // small delay so transition plays before removing class
      setTimeout(() => {
        const anyFocused = grid.querySelector('.is-focused');
        if (!anyFocused) grid.classList.remove('has-hover');
      }, 50);
    });
  });

  /* ── Hash bar fill-in on scroll into view ── */
  const io = new IntersectionObserver(entries => {
    entries.forEach(e => {
      if (!e.isIntersecting) return;
      const card = e.target;
      const hashBars = card.querySelectorAll('.term-hash-bar');

      hashBars.forEach((bar, idx) => {
        const filled = parseInt(bar.dataset.filled, 10) || 0;
        const empty  = parseInt(bar.dataset.empty,  10) || 0;
        const fillEl = bar.querySelector('.term-hash-fill');
        const emptyEl= bar.querySelector('.term-hash-empty');
        if (!fillEl || !emptyEl) return;

        // Reset
        fillEl.textContent  = '';
        emptyEl.textContent = ' '.repeat(filled + empty);

        // Stagger start per item, then fill tick by tick
        const startDelay = idx * 80;        // ms between each skill
        const tickSpeed  = 55;              // ms per '#' char

        setTimeout(() => {
          let count = 0;
          const tick = setInterval(() => {
            count++;
            fillEl.textContent  = '#'.repeat(count);
            emptyEl.textContent = ' '.repeat(Math.max(0, filled + empty - count));
            if (count >= filled) clearInterval(tick);
          }, tickSpeed);
        }, startDelay);
      });

      io.unobserve(card);
    });
  }, { threshold: 0.25 });


  cards.forEach(c => io.observe(c));
})();

/* keep old skill bars working (if any remain on page) */
(function initSkillBars() {
  const bars = document.querySelectorAll('.skill-bar-fill[data-width]');
  if (!bars.length) return;
  const io = new IntersectionObserver(entries => {
    entries.forEach(e => {
      if (!e.isIntersecting) return;
      const bar = e.target;
      bar.style.width = bar.dataset.width;
      io.unobserve(bar);
    });
  }, { threshold: 0.3 });
  bars.forEach(b => io.observe(b));
})();



/* ══════════════════════════════════════════════════════════
   8. Tilted Card (About photo)
   ══════════════════════════════════════════════════════════ */
window.tiltCardMove = function(e, fig) {
  const inner = fig.querySelector('.tilted-card-inner');
  if (!inner) return;
  const rect = fig.getBoundingClientRect();
  const x = (e.clientX - rect.left) / rect.width  - 0.5;
  const y = (e.clientY - rect.top)  / rect.height - 0.5;
  inner.style.transform = `perspective(800px) rotateY(${x * 14}deg) rotateX(${-y * 14}deg) scale3d(1.02,1.02,1.02)`;
};
window.tiltCardEnter = function(fig) {
  const inner = fig.querySelector('.tilted-card-inner');
  if (inner) inner.style.transition = 'none';
};
window.tiltCardLeave = function(fig) {
  const inner = fig.querySelector('.tilted-card-inner');
  if (!inner) return;
  inner.style.transition = 'transform 0.5s ease';
  inner.style.transform  = 'perspective(800px) rotateY(0deg) rotateX(0deg) scale3d(1,1,1)';
};


/* ══════════════════════════════════════════════════════════
   9. Copy Email on click
   ══════════════════════════════════════════════════════════ */
(function initCopyEmail() {
  const el = document.querySelector('[data-copy-email]');
  if (!el) return;
  el.addEventListener('click', () => {
    const email = el.dataset.copyEmail;
    navigator.clipboard?.writeText(email).then(() => {
      const orig = el.textContent;
      el.textContent = 'Copied!';
      setTimeout(() => { el.textContent = orig; }, 1800);
    }).catch(() => {});
  });
})();


/* ══════════════════════════════════════════════════════════
   10. Active Nav Link Tracking
   ══════════════════════════════════════════════════════════ */
(function initActiveNav() {
  const links = document.querySelectorAll('.pill[data-section], .mobile-nav-link[data-section]');
  if (!links.length) return;
  const io = new IntersectionObserver(entries => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        links.forEach(a => a.classList.remove('is-active', 'active'));
        document.querySelectorAll(`[data-section="${e.target.id}"]`).forEach(a => a.classList.add('is-active', 'active'));
      }
    });
  }, { threshold: 0.4 });
  document.querySelectorAll('section[id]').forEach(s => io.observe(s));
})();


/* ══════════════════════════════════════════════════════════
   11. Splash Screen dismiss
   ══════════════════════════════════════════════════════════ */
(function initSplash() {
  const splash    = document.getElementById('splash-screen');
  const container = document.getElementById('splashText');
  if (!splash) return;

  const text = 'Welcome to Abarox World';
  if (container) {
    text.split(' ').forEach((word, i) => {
      const span = document.createElement('span');
      span.className = 'splash-word';
      span.textContent = word;
      span.style.transitionDelay = `${i * 0.14}s`;
      container.appendChild(span);
      setTimeout(() => span.classList.add('visible'), 400 + i * 140);
    });
  }
  setTimeout(() => splash.classList.add('hidden'), 3400);
})();


/* ══════════════════════════════════════════════════════════
   12. Bento big num counter
   ══════════════════════════════════════════════════════════ */
(function initBentoNum() {
  const nums = document.querySelectorAll('.bento-big-num[data-count], .bento-mini-bignum[data-count]');
  if (!nums.length) return;
  const io = new IntersectionObserver(entries => {
    entries.forEach(e => {
      if (!e.isIntersecting) return;
      const el = e.target;
      const target = parseInt(el.dataset.count, 10);
      const suffix = el.dataset.suffix || '+';
      let cur = 0;
      const step = () => {
        cur = Math.min(cur + Math.ceil(target / 30), target);
        el.textContent = cur + suffix;
        if (cur < target) requestAnimationFrame(step);
      };
      requestAnimationFrame(step);
      io.unobserve(el);
    });
  }, { threshold: 0.4 });
  nums.forEach(n => io.observe(n));
})();

/* ─── Auto-close Mobile Radial Menu on Click ──────────────── */
(function() {
  const menuItems = document.querySelectorAll('.mobile-radial-menu .menu-item');
  const menuToggle = document.getElementById('menu-open');
  
  if (menuToggle && menuItems.length > 0) {
    menuItems.forEach(item => {
      item.addEventListener('click', () => {
        // Uncheck the toggle to close the menu
        menuToggle.checked = false;
      });
    });
  }
})();
