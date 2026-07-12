/**
 * Prism WebGL Background — Vanilla JS (No React/OGL dependency)
 * Implements the original GLSL shader using plain WebGL API
 */
class PrismGL {
  constructor(container, options = {}) {
    this.container = container;
    this.opts = Object.assign({
      height: 3.5,
      baseWidth: 5.5,
      animationType: 'rotate',
      glow: 1,
      noise: 0,
      transparent: true,
      scale: 3.6,
      hueShift: 0,
      colorFrequency: 1,
      timeScale: 0.5,
      bloom: 1,
    }, options);

    this.raf = 0;
    this.t0 = performance.now();
    this._init();
  }

  _init() {
    const { opts } = this;
    const H       = Math.max(0.001, opts.height);
    const BW      = Math.max(0.001, opts.baseWidth);
    const BASE_HALF = BW * 0.5;

    const dpr = Math.min(2, window.devicePixelRatio || 1);
    const canvas = document.createElement('canvas');
    Object.assign(canvas.style, {
      position: 'absolute', inset: '0', width: '100%', height: '100%', display: 'block'
    });
    this.container.appendChild(canvas);
    this.canvas = canvas;

    const gl = canvas.getContext('webgl', { alpha: opts.transparent, antialias: false });
    if (!gl) { console.warn('WebGL not supported'); return; }
    this.gl = gl;
    this.dpr = dpr;

    gl.disable(gl.DEPTH_TEST);
    gl.disable(gl.CULL_FACE);

    // ── Shaders ──
    const vert = `
      attribute vec2 a_pos;
      void main(){ gl_Position = vec4(a_pos, 0.0, 1.0); }
    `;
    const frag = `
      precision highp float;
      uniform vec2  iResolution;
      uniform float iTime;
      uniform float uH;
      uniform float uBaseHalf;
      uniform float uGlow;
      uniform float uNoise;
      uniform float uSat;
      uniform float uScale;
      uniform float uHueShift;
      uniform float uColorFreq;
      uniform float uBloom;
      uniform float uCenterShift;
      uniform float uInvBH;
      uniform float uInvH;
      uniform float uMinAxis;
      uniform float uPxScale;
      uniform float uTimeScale;
      uniform mat3  uRot;
      uniform int   uWobble;

      vec4 tanh4(vec4 x){ vec4 e=exp(2.*x); return (e-1.)/(e+1.); }
      float rand(vec2 co){ return fract(sin(dot(co,vec2(12.9898,78.233)))*43758.5453123); }

      float sdOcta(vec3 p){
        vec3 q=vec3(abs(p.x)*uInvBH, abs(p.y)*uInvH, abs(p.z)*uInvBH);
        float m=q.x+q.y+q.z-1.0;
        return m*uMinAxis*0.5773502691896258;
      }
      float sdPyramid(vec3 p){ return max(sdOcta(p), -p.y); }

      mat3 hueRot(float a){
        float c=cos(a), s=sin(a);
        return mat3(
          0.299+0.701*c+0.168*s, 0.587-0.587*c+0.330*s, 0.114-0.114*c-0.497*s,
          0.299-0.299*c-0.328*s, 0.587+0.413*c+0.035*s, 0.114-0.114*c+0.292*s,
          0.299-0.300*c+1.250*s, 0.587-0.588*c-1.050*s, 0.114+0.886*c-0.203*s
        );
      }

      void main(){
        vec2 f=(gl_FragCoord.xy - 0.5*iResolution)*uPxScale;
        float z=5.0, d=0.0;
        vec3 p; vec4 o=vec4(0.0);
        float cf=uColorFreq;
        mat2 wob=mat2(1.0);
        if(uWobble==1){
          float t=iTime*uTimeScale;
          wob=mat2(cos(t),cos(t+33.),cos(t+11.),cos(t));
        }
        for(int i=0;i<100;i++){
          p=vec3(f,z);
          p.xz=p.xz*wob;
          p=uRot*p;
          vec3 q=p; q.y+=uCenterShift;
          d=0.1+0.2*abs(sdPyramid(q));
          z-=d;
          o+=(sin((p.y+z)*cf+vec4(0.,1.,2.,3.))+1.)/d;
        }
        o=tanh4(o*o*(uGlow*uBloom)/1e5);
        vec3 col=o.rgb;
        col+=(rand(gl_FragCoord.xy+vec2(iTime))-0.5)*uNoise;
        col=clamp(col,0.,1.);
        float L=dot(col,vec3(0.2126,0.7152,0.0722));
        col=clamp(mix(vec3(L),col,uSat),0.,1.);
        if(abs(uHueShift)>0.0001) col=clamp(hueRot(uHueShift)*col,0.,1.);
        gl_FragColor=vec4(col,o.a);
      }
    `;

    const vs = this._compile(gl.VERTEX_SHADER, vert);
    const fs = this._compile(gl.FRAGMENT_SHADER, frag);
    if (!vs || !fs) return;

    const prog = gl.createProgram();
    gl.attachShader(prog, vs); gl.attachShader(prog, fs); gl.linkProgram(prog);
    if (!gl.getProgramParameter(prog, gl.LINK_STATUS)) { console.error(gl.getProgramInfoLog(prog)); return; }
    gl.useProgram(prog);
    this.prog = prog;

    // Full-screen triangle
    const buf = gl.createBuffer();
    gl.bindBuffer(gl.ARRAY_BUFFER, buf);
    gl.bufferData(gl.ARRAY_BUFFER, new Float32Array([-1,-1, 3,-1, -1,3]), gl.STATIC_DRAW);
    const loc = gl.getAttribLocation(prog, 'a_pos');
    gl.enableVertexAttribArray(loc);
    gl.vertexAttribPointer(loc, 2, gl.FLOAT, false, 0, 0);

    // Uniforms
    this.u = {};
    ['iResolution','iTime','uH','uBaseHalf','uGlow','uNoise','uSat','uScale','uHueShift',
     'uColorFreq','uBloom','uCenterShift','uInvBH','uInvH','uMinAxis','uPxScale','uTimeScale',
     'uRot','uWobble'].forEach(n => { this.u[n] = gl.getUniformLocation(prog, n); });

    // Set static uniforms
    gl.uniform1f(this.u.uH,          H);
    gl.uniform1f(this.u.uBaseHalf,   BASE_HALF);
    gl.uniform1f(this.u.uGlow,       opts.glow);
    gl.uniform1f(this.u.uNoise,      opts.noise);
    gl.uniform1f(this.u.uSat,        opts.transparent ? 1.5 : 1.0);
    gl.uniform1f(this.u.uScale,      opts.scale);
    gl.uniform1f(this.u.uHueShift,   opts.hueShift);
    gl.uniform1f(this.u.uColorFreq,  opts.colorFrequency);
    gl.uniform1f(this.u.uBloom,      opts.bloom);
    gl.uniform1f(this.u.uCenterShift, H * 0.25);
    gl.uniform1f(this.u.uInvBH,      1 / BASE_HALF);
    gl.uniform1f(this.u.uInvH,       1 / H);
    gl.uniform1f(this.u.uMinAxis,    Math.min(BASE_HALF, H));
    gl.uniform1f(this.u.uTimeScale,  opts.timeScale);
    gl.uniform1i(this.u.uWobble,     opts.animationType === 'rotate' ? 1 : 0);

    // Identity matrix
    this._setRotation(1,0,0, 0,1,0, 0,0,1);

    // Resize observer
    this.ro = new ResizeObserver(() => this._resize());
    this.ro.observe(this.container);
    this._resize();

    // Rotation state for '3drotate'
    this._rotState = { yaw: 0, wY: 0.3 + Math.random() * 0.6 };

    this._startRAF();
  }

  _compile(type, src) {
    const s = this.gl.createShader(type);
    this.gl.shaderSource(s, src);
    this.gl.compileShader(s);
    if (!this.gl.getShaderParameter(s, this.gl.COMPILE_STATUS)) {
      console.error(this.gl.getShaderInfoLog(s));
      return null;
    }
    return s;
  }

  _resize() {
    const { gl, canvas, dpr, container, opts } = this;
    const w = container.clientWidth  || 1;
    const h = container.clientHeight || 1;
    canvas.width  = Math.round(w * dpr);
    canvas.height = Math.round(h * dpr);
    gl.viewport(0, 0, canvas.width, canvas.height);
    gl.uniform2f(this.u.iResolution, canvas.width, canvas.height);
    gl.uniform1f(this.u.uPxScale, 1 / ((canvas.height || 1) * 0.1 * opts.scale));
  }

  _setRotation(...m) {
    this.gl.uniformMatrix3fv(this.u.uRot, false, new Float32Array(m));
  }

  _startRAF() {
    if (this.raf) return;
    this.raf = requestAnimationFrame(t => this._render(t));
  }

  _render(ts) {
    const { gl, opts, u } = this;
    const time = (ts - this.t0) * 0.001;
    gl.uniform1f(u.iTime, time);

    if (opts.animationType === '3drotate') {
      const tS = time * opts.timeScale;
      const yaw = tS * this._rotState.wY;
      const cy = Math.cos(yaw), sy = Math.sin(yaw);
      this._setRotation(cy,0,sy, 0,1,0, -sy,0,cy);
    }

    gl.drawArrays(gl.TRIANGLES, 0, 3);
    this.raf = requestAnimationFrame(t => this._render(t));
  }

  destroy() {
    if (this.raf) { cancelAnimationFrame(this.raf); this.raf = 0; }
    if (this.ro) this.ro.disconnect();
    if (this.canvas && this.canvas.parentElement) this.canvas.remove();
  }
}

window.PrismGL = PrismGL;
