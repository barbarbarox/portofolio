import React from 'react';
import { createRoot } from 'react-dom/client';
import Orb from './components/Orb';
import ProfileCard from './components/ProfileCard';
import CardSwap, { Card } from './components/CardSwap';
import MagicBento from './components/MagicBento';
import BorderGlow from './components/BorderGlow';
import ContactBento from './components/ContactBento';

// ── Orb background ──────────────────────────────────────────────────────────
const orbRoot = document.getElementById('orb-root');
if (orbRoot) {
    createRoot(orbRoot).render(
        <Orb hoverIntensity={1.5} rotateOnHover backgroundColor="#030712" />
    );
}

// ── MagicBento for Skills ─────────────────────────────────────────────────────
const bentoRoot = document.getElementById('magic-bento-root');
if (bentoRoot) {
    let skills = [];
    try { skills = JSON.parse(bentoRoot.dataset.skills || '[]'); } catch(e) {}
    createRoot(bentoRoot).render(
        <MagicBento 
            cards={skills}
            textAutoHide={true}
            enableStars={true}
            enableSpotlight={true}
            enableBorderGlow={true}
            enableTilt={true}
            enableMagnetism={true}
            clickEffect={true}
            glowColor="0, 212, 255"
        />
    );
}

// ── ProfileCard in About section ─────────────────────────────────────────────
const pcRoot = document.getElementById('profile-card-root');
if (pcRoot) {
    const name    = pcRoot.dataset.name    || 'Akbar Maulana';
    const tagline = pcRoot.dataset.tagline || 'Information System Security Enthusiast';
    createRoot(pcRoot).render(
        <ProfileCard
            name={name}
            title={tagline}
            handle="akbarmaulana"
            status="Online"
            contactText="Contact Me"
            avatarUrl="/images/profile.png"
            showUserInfo
            enableTilt
            behindGlowColor="rgba(0,212,255,0.5)"
            innerGradient="linear-gradient(145deg,#0d253a 0%,#0a1a1a 100%)"
            onContactClick={() => {
                document.getElementById('contact')?.scrollIntoView({ behavior: 'smooth' });
            }}
        />
    );
}

// ── BorderGlow Info Grid in About section ────────────────────────────────────
const aboutInfoRoot = document.getElementById('about-info-root');
if (aboutInfoRoot) {
    let infos = [];
    try { infos = JSON.parse(aboutInfoRoot.dataset.infos || '[]'); } catch(e) {}
    createRoot(aboutInfoRoot).render(
        <BorderGlow
            edgeSensitivity={30}
            glowColor="40 80 80"
            backgroundColor="#120F17"
            borderRadius={20}
            glowRadius={40}
            glowIntensity={1.0}
            coneSpread={25}
            animated={true}
            colors={['#00d4ff', '#00ff88', '#b44fff']}
            className="w-full"
        >
            <div className="flex flex-row flex-wrap w-full gap-3 p-5">
                {infos.map((info, idx) => (
                    <div key={idx} className="flex-1 min-w-[130px]" style={{ background:'rgba(255,255,255,0.03)', padding:'16px', borderRadius:'12px', border:'1px solid rgba(255,255,255,0.05)' }}>
                        <p style={{ fontSize:'12px', color:'#64748b', fontFamily:'monospace', marginBottom:'4px' }}>{info.label}</p>
                        <p style={{ fontSize:'14px', color:'#e2e8f0', fontWeight:'600' }}>{info.value}</p>
                    </div>
                ))}
            </div>
        </BorderGlow>
    );
}

// ── CardSwap in Hero section ──────────────────────────────────────────────────
const csRoot = document.getElementById('card-swap-root');
if (csRoot) {
    // Cards data is injected via data-cards attribute as JSON
    let cards = [];
    try { cards = JSON.parse(csRoot.dataset.cards || '[]'); } catch(e) {}

    // Fallback cards if none configured
    if (!cards.length) {
        cards = [
            { title: 'Cybersecurity', subtitle: 'Penetration Testing & SecOps', accent_color: '#00ff88', bg_color: '#0d1117' },
            { title: 'Web Development', subtitle: 'Laravel, React, Full-Stack', accent_color: '#00d4ff', bg_color: '#0d1117' },
            { title: 'AI & Innovation', subtitle: 'Machine Learning & Automation', accent_color: '#b44fff', bg_color: '#0d1117' },
        ];
    }

    createRoot(csRoot).render(
        <div style={{ position:'relative', width:'100%', height:'100%' }}>
            <CardSwap
                width={280} height={200}
                cardDistance={45} verticalDistance={50}
                delay={4000} pauseOnHover easing="elastic"
            >
                {cards.map((c, i) => (
                    <Card key={i} style={{ background: c.bg_color || '#0d1117', border: `1px solid ${c.accent_color}33` }}>
                        <div style={{ padding:'24px', display:'flex', flexDirection:'column', alignItems:'center', justifyContent:'center', height:'100%', textAlign:'center' }}>
                            <div style={{ width:40, height:40, borderRadius:10, marginBottom:12, background:`${c.accent_color}20`, border:`1px solid ${c.accent_color}40`, display:'flex', alignItems:'center', justifyContent:'center' }}>
                                <svg width="18" height="18" fill="none" stroke={c.accent_color} viewBox="0 0 24 24" strokeWidth="1.5">
                                    <path strokeLinecap="round" strokeLinejoin="round" d="M17.25 6.75L22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3l-4.5 16.5"/>
                                </svg>
                            </div>
                            <h3 style={{ fontWeight:700, fontSize:16, color:'#fff', margin:'0 0 6px' }}>{c.title}</h3>
                            <p style={{ fontSize:11, color:'#64748b', margin:0, fontFamily:'monospace' }}>{c.subtitle}</p>
                        </div>
                    </Card>
                ))}
    </CardSwap>
        </div>
    );
}

// ── ContactBento in Contact section ──────────────────────────────────────────
const contactBentoRoot = document.getElementById('contact-bento-root');
if (contactBentoRoot) {
    let socials = [];
    try { socials = JSON.parse(contactBentoRoot.dataset.socials || '[]'); } catch(e) {}
    createRoot(contactBentoRoot).render(
        <ContactBento socials={socials} />
    );
}
