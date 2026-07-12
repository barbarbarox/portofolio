/**
 * card-swap.js — CardSwap Vanilla JS (GSAP elastic)
 * Ported from React reference (animasi_yang_mau_diterapkan.txt L2780-L3024)
 *
 * Usage: add class="cs-container" to wrapper, class="cs-card" to each card
 * Attributes on .cs-container:
 *   data-card-distance="60"
 *   data-vertical-distance="70"
 *   data-delay="5000"
 *   data-skew="6"
 *   data-easing="elastic"  (or "power")
 */

'use strict';

(function initCardSwap() {
  if (typeof gsap === 'undefined') {
    console.warn('CardSwap: GSAP not loaded');
    return;
  }

  document.querySelectorAll('.card-swap-container').forEach(container => {
    const cards   = Array.from(container.querySelectorAll('.cs-card'));
    const total   = cards.length;
    if (total < 2) return;

    const cardDist  = parseFloat(container.dataset.cardDistance   || 60);
    const vertDist  = parseFloat(container.dataset.verticalDistance || 70);
    const delay     = parseInt(container.dataset.delay            || 5000, 10);
    const skewAmt   = parseFloat(container.dataset.skew           || 6);
    const easing    = container.dataset.easing || 'elastic';

    const cfg = easing === 'elastic' ? {
      ease:           'elastic.out(0.6,0.9)',
      durDrop:        2,
      durMove:        2,
      durReturn:      2,
      promoteOverlap: 0.9,
      returnDelay:    0.05,
    } : {
      ease:           'power1.inOut',
      durDrop:        0.8,
      durMove:        0.8,
      durReturn:      0.8,
      promoteOverlap: 0.45,
      returnDelay:    0.2,
    };

    function makeSlot(i) {
      return {
        x:      i * cardDist,
        y:     -i * vertDist,
        z:     -i * cardDist * 1.5,
        zIndex: total - i,
      };
    }

    function place(el, slot) {
      gsap.set(el, {
        x:           slot.x,
        y:           slot.y,
        z:           slot.z,
        xPercent:   -50,
        yPercent:   -50,
        skewY:       skewAmt,
        transformOrigin: 'center center',
        zIndex:      slot.zIndex,
        force3D:     true,
      });
    }

    /* Initial placement */
    let order = cards.map((_, i) => i);
    cards.forEach((card, i) => place(card, makeSlot(i)));

    let activeTl = null;

    function swap() {
      if (order.length < 2) return;
      const [front, ...rest] = order;
      const elFront = cards[front];
      const tl = gsap.timeline();
      activeTl = tl;

      /* Drop front card down */
      tl.to(elFront, { y: '+=500', duration: cfg.durDrop, ease: cfg.ease });

      /* Promote rest cards forward */
      const promoteAt = `-=${cfg.durDrop * cfg.promoteOverlap}`;
      tl.addLabel('promote', promoteAt);
      rest.forEach((idx, i) => {
        const el   = cards[idx];
        const slot = makeSlot(i);
        tl.set(el, { zIndex: slot.zIndex }, 'promote');
        tl.to(el, {
          x: slot.x, y: slot.y, z: slot.z,
          duration: cfg.durMove,
          ease:     cfg.ease,
        }, `promote+=${i * 0.15}`);
      });

      /* Return front card to back */
      const backSlot  = makeSlot(total - 1);
      const returnAt  = `promote+=${cfg.durMove * cfg.returnDelay}`;
      tl.addLabel('return', returnAt);
      tl.call(() => gsap.set(elFront, { zIndex: backSlot.zIndex }), undefined, 'return');
      tl.to(elFront, {
        x: backSlot.x, y: backSlot.y, z: backSlot.z,
        duration: cfg.durReturn,
        ease:     cfg.ease,
      }, 'return');

      tl.call(() => { order = [...rest, front]; });
    }

    /* Auto-swap interval */
    swap();
    const interval = setInterval(swap, delay);

    /* Pause on hover */
    container.addEventListener('mouseenter', () => { activeTl?.pause(); clearInterval(interval); });
    container.addEventListener('mouseleave', () => {
      activeTl?.play();
      setInterval(swap, delay);
    });
  });

})();
