/**
 * ProfileCard — Vanilla JS tilt effect
 * Converted from React component. Uses CSS custom properties.
 */
class ProfileCard {
  constructor(container) {
    this.wrap  = container;
    this.shell = container.querySelector('.pc-card-shell');
    if (!this.shell) return;

    this._currentX = 0; this._currentY = 0;
    this._targetX  = 0; this._targetY  = 0;
    this._rafId    = null;
    this._lastTs   = 0;
    this._running  = false;
    this._initialUntil = 0;

    this._bind();
    this._kickInitial();
  }

  _clamp(v, min = 0, max = 100) { return Math.min(Math.max(v, min), max); }
  _round(v, p = 3) { return parseFloat(v.toFixed(p)); }
  _adjust(v, fMin, fMax, tMin, tMax) {
    return this._round(tMin + ((tMax - tMin) * (v - fMin)) / (fMax - fMin));
  }

  _setVars(x, y) {
    const { wrap, shell } = this;
    const w = shell.clientWidth  || 1;
    const h = shell.clientHeight || 1;
    const px = this._clamp((100 / w) * x);
    const py = this._clamp((100 / h) * y);
    const cx = px - 50, cy = py - 50;
    const props = {
      '--pointer-x':          `${px}%`,
      '--pointer-y':          `${py}%`,
      '--background-x':       `${this._adjust(px, 0, 100, 35, 65)}%`,
      '--background-y':       `${this._adjust(py, 0, 100, 35, 65)}%`,
      '--pointer-from-center':`${this._clamp(Math.hypot(py - 50, px - 50) / 50, 0, 1)}`,
      '--pointer-from-top':   `${py / 100}`,
      '--pointer-from-left':  `${px / 100}`,
      '--rotate-x':           `${this._round(-(cx / 5))}deg`,
      '--rotate-y':           `${this._round(cy / 4)}deg`,
      '--card-opacity':       '1',
    };
    for (const [k, v] of Object.entries(props)) wrap.style.setProperty(k, v);
  }

  _step(ts) {
    if (!this._running) return;
    if (this._lastTs === 0) this._lastTs = ts;
    const dt = (ts - this._lastTs) / 1000;
    this._lastTs = ts;
    const tau = ts < this._initialUntil ? 0.6 : 0.14;
    const k = 1 - Math.exp(-dt / tau);
    this._currentX += (this._targetX - this._currentX) * k;
    this._currentY += (this._targetY - this._currentY) * k;
    this._setVars(this._currentX, this._currentY);
    const far = Math.abs(this._targetX - this._currentX) > 0.05 ||
                Math.abs(this._targetY - this._currentY) > 0.05;
    if (far || document.hasFocus()) {
      this._rafId = requestAnimationFrame(t => this._step(t));
    } else {
      this._running = false; this._lastTs = 0;
    }
  }

  _start() {
    if (this._running) return;
    this._running = true; this._lastTs = 0;
    this._rafId = requestAnimationFrame(t => this._step(t));
  }

  _setTarget(x, y) { this._targetX = x; this._targetY = y; this._start(); }
  _toCenter() { this._setTarget(this.shell.clientWidth / 2, this.shell.clientHeight / 2); }

  _getOffset(e) {
    const r = this.shell.getBoundingClientRect();
    return { x: e.clientX - r.left, y: e.clientY - r.top };
  }

  _bind() {
    this.shell.addEventListener('pointerenter', e => {
      this.shell.classList.add('active', 'entering');
      setTimeout(() => this.shell.classList.remove('entering'), 180);
      const { x, y } = this._getOffset(e);
      this._setTarget(x, y);
    });
    this.shell.addEventListener('pointermove', e => {
      const { x, y } = this._getOffset(e);
      this._setTarget(x, y);
    });
    this.shell.addEventListener('pointerleave', () => {
      this._toCenter();
      const check = () => {
        const dx = Math.abs(this._targetX - this._currentX);
        const dy = Math.abs(this._targetY - this._currentY);
        if (dx < 0.6 && dy < 0.6) {
          this.shell.classList.remove('active');
        } else {
          requestAnimationFrame(check);
        }
      };
      requestAnimationFrame(check);
    });
  }

  _kickInitial() {
    const s = this.shell;
    const ix = (s.clientWidth  || 260) - 70;
    const iy = 60;
    this._currentX = ix; this._currentY = iy;
    this._setVars(ix, iy);
    this._setTarget(s.clientWidth / 2, s.clientHeight / 2);
    this._initialUntil = performance.now() + 1200;
    this._start();
  }
}

window.ProfileCard = ProfileCard;

// Auto-init all ProfileCard wrappers on page
document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.pc-card-wrapper').forEach(el => new ProfileCard(el));
});
