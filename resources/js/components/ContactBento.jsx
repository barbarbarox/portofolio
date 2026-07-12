import React, { useRef } from 'react';
import { ParticleCard, GlobalSpotlight } from './MagicBento';
import './MagicBento.css';

export default function ContactBento({ socials = [] }) {
  const gridRef = useRef(null);

  return (
    <div className="bento-section w-full h-full" style={{ position: 'relative' }}>
      <GlobalSpotlight
        gridRef={gridRef}
        enabled={true}
        spotlightRadius={350}
        glowColor="0, 255, 136"
      />
      <div className="flex flex-col gap-6 w-full h-full" ref={gridRef}>
        
        {/* Social Links Card */}
        <ParticleCard
          className="magic-bento-card magic-bento-card--border-glow w-full flex-grow"
          style={{ backgroundColor: 'rgba(255,255,255,0.02)' }}
          glowColor="0, 255, 136"
          enableTilt={true}
          enableMagnetism={true}
        >
          <div style={{ position:'relative', zIndex:5, width:'100%' }}>
            <p className="text-xs font-mono text-slate-500 mb-5">// connect_with_me</p>
            {socials.length > 0 ? socials.map((link, idx) => (
              <a href={link.url} target="_blank" rel="noreferrer" key={idx}
                 className="flex items-center gap-3 p-3 rounded-xl hover:bg-white/5 transition group mb-2 border border-transparent hover:border-white/10"
                 style={{ textDecoration:'none' }}>
                <div className="w-9 h-9 rounded-lg flex items-center justify-center text-base font-bold flex-shrink-0"
                     style={{ background:`${link.accent_color}15`, border:`1px solid ${link.accent_color}30`, color:link.accent_color }}>
                  {link.platform.charAt(0).toUpperCase()}
                </div>
                <div>
                  <p className="text-xs text-slate-500 font-mono m-0">{link.platform}</p>
                  <p className="text-sm text-slate-300 group-hover:text-white transition m-0 mt-0.5">{link.label}</p>
                </div>
              </a>
            )) : (
              <a href="https://wa.me/6289636926578" target="_blank" rel="noreferrer" className="flex items-center gap-3 p-3 rounded-xl hover:bg-white/5 transition group border border-transparent hover:border-white/10" style={{ textDecoration:'none' }}>
                <div className="w-9 h-9 rounded-lg flex items-center justify-center font-bold" style={{ background:'rgba(37,211,102,0.1)', border:'1px solid rgba(37,211,102,0.2)', color:'#25d366' }}>W</div>
                <div>
                  <p className="text-xs text-slate-500 font-mono m-0">WhatsApp</p>
                  <p className="text-sm text-slate-300 m-0 mt-0.5">+62 896-3692-6578</p>
                </div>
              </a>
            )}
          </div>
        </ParticleCard>

        {/* Terminal Card */}
        <ParticleCard
          className="magic-bento-card magic-bento-card--border-glow w-full flex-grow"
          style={{ backgroundColor: 'rgba(255,255,255,0.02)' }}
          glowColor="0, 212, 255"
          enableTilt={true}
          enableMagnetism={true}
        >
          <div style={{ position:'relative', zIndex:5, width:'100%', display:'flex', flexDirection:'column', justifyContent:'center', minHeight:'120px' }}>
            <div className="terminal-header mb-4" style={{ display:'flex', alignItems:'center', gap:'8px', paddingBottom:'12px', borderBottom:'1px solid rgba(255,255,255,0.05)' }}>
              <div style={{ width:'12px', height:'12px', borderRadius:'50%', background:'#ef4444' }}></div>
              <div style={{ width:'12px', height:'12px', borderRadius:'50%', background:'#eab308' }}></div>
              <div style={{ width:'12px', height:'12px', borderRadius:'50%', background:'#22c55e' }}></div>
              <span className="ml-2 text-xs text-slate-500 font-mono">status.sh</span>
            </div>
            <div className="font-mono text-sm space-y-3" style={{ lineHeight: '1.6' }}>
              <p className="m-0"><span className="text-slate-600">$</span> <span className="text-cyan-400">availability</span> <span className="text-green-400">-- open</span></p>
              <p className="m-0"><span className="text-slate-600">$</span> <span className="text-cyan-400">response_time</span> <span className="text-slate-300">-- &lt;24h</span></p>
              <p className="m-0"><span className="text-slate-600">$</span> <span className="text-cyan-400">remote</span> <span className="text-slate-300">-- yes</span></p>
            </div>
          </div>
        </ParticleCard>

      </div>
    </div>
  );
}
