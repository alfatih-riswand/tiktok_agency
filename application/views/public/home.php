<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TikTok Agency</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: Inter, Arial, sans-serif;
      background: radial-gradient(circle at top left, rgba(236,72,153,0.25), transparent 32%),
                  linear-gradient(135deg, #070b13 0%, #0b1020 38%, #190b2a 100%);
      color: #edf2ff;
      min-height: 100vh;
    }
    .landing-shell {
      max-width: 1200px;
      margin: 60px auto;
      padding: 28px;
    }
    .landing-hero {
      display: grid;
      grid-template-columns: 1.2fr 0.8fr;
      gap: 28px;
      background: rgba(13, 20, 31, 0.82);
      border: 1px solid rgba(148, 163, 184, 0.2);
      border-radius: 28px;
      overflow: hidden;
      box-shadow: 0 30px 80px rgba(0,0,0,0.35);
      backdrop-filter: blur(8px);
    }
    .landing-copy {
      padding: 56px 42px;
    }
    .eyebrow {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 8px 14px;
      border-radius: 999px;
      background: rgba(34, 211, 238, 0.1);
      color: #7dd3fc;
      border: 1px solid rgba(125, 211, 252, 0.2);
      font-size: 12px;
      letter-spacing: 1.2px;
      text-transform: uppercase;
      font-weight: 700;
    }
    h1 {
      font-size: clamp(2.5rem, 3vw, 4.3rem);
      line-height: 1.05;
      margin: 22px 0 18px;
      font-weight: 900;
      letter-spacing: -0.06em;
    }
    h1 .gradient {
      background: linear-gradient(90deg, #22d3ee 0%, #f472b6 55%, #f8b4d9 100%);
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
    }
    .landing-copy p {
      color: rgba(226, 232, 240, 0.8);
      line-height: 1.8;
      font-size: 1.05rem;
      max-width: 650px;
    }
    .cta-row {
      display: flex;
      flex-wrap: wrap;
      gap: 14px;
      margin-top: 32px;
    }
    .btn-primary, .btn-secondary {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 14px 22px;
      border-radius: 12px;
      text-decoration: none;
      font-weight: 700;
      transition: 0.25s ease;
    }
    .btn-primary {
      background: linear-gradient(135deg, #f72585 0%, #ff4d9d 35%, #7c3aed 100%);
      color: #fff;
      box-shadow: 0 15px 35px rgba(247,37,133,0.35);
    }
    .btn-secondary {
      background: rgba(148, 163, 184, 0.08);
      color: #e2e8f0;
      border: 1px solid rgba(148, 163, 184, 0.18);
    }
    .landing-visual {
      position: relative;
      min-height: 500px;
      background: linear-gradient(180deg, rgba(15, 118, 110, 0.28), rgba(59, 130, 246, 0.08));
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }
    .orb {
      position: absolute;
      border-radius: 50%;
      filter: blur(12px);
      opacity: 0.75;
    }
    .orb.one { width: 220px; height: 220px; background: rgba(34,211,238,0.26); right: 14%; top: 14%; }
    .orb.two { width: 180px; height: 180px; background: rgba(249,115,22,0.26); left: 18%; bottom: 14%; }
    .device-card {
      position: relative;
      width: min(100%, 400px);
      background: linear-gradient(180deg, rgba(17,24,39,0.9), rgba(15,23,42,0.85));
      border: 1px solid rgba(148, 163, 184, 0.18);
      border-radius: 28px;
      padding: 18px;
      box-shadow: 0 30px 60px rgba(15,23,42,0.6);
      z-index: 1;
    }
    .mini-widget {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: rgba(15, 23, 42, 0.8);
      border: 1px solid rgba(148, 163, 184, 0.15);
      border-radius: 16px;
      padding: 12px 14px;
      margin-bottom: 12px;
      font-size: 12px;
      color: rgba(226, 232, 240, 0.8);
    }
    .mini-widget strong { display: block; font-size: 20px; color: #fff; margin-top: 4px; }
    .mini-widget .icon {
      width: 42px; height: 42px;
      display: grid; place-items: center;
      border-radius: 12px;
      background: linear-gradient(135deg, rgba(34,211,238,0.18), rgba(247,37,133,0.18));
      color: #fff;
    }
    .stat-strip {
      margin-top: 18px;
      display: grid;
      grid-template-columns: repeat(3, minmax(0,1fr));
      gap: 12px;
    }
    .stat-box {
      background: rgba(15,23,42,0.8);
      border: 1px solid rgba(148,163,184,0.12);
      border-radius: 16px;
      padding: 16px 12px;
      text-align: center;
    }
    .stat-box strong { font-size: 1.3rem; display: block; }
    .stat-box span { color: rgba(226,232,240,0.7); font-size: 12px; }
    .feature-row {
      display: grid;
      grid-template-columns: repeat(3, minmax(0,1fr));
      gap: 18px;
      margin-top: 30px;
    }
    .feature-card {
      background: rgba(15, 23, 42, 0.75);
      border: 1px solid rgba(148,163,184,0.12);
      border-radius: 18px;
      padding: 22px 18px;
    }
    .feature-card .ic {
      width: 42px; height: 42px; border-radius: 12px;
      display: grid; place-items: center;
      background: linear-gradient(135deg, rgba(34,211,238,0.18), rgba(247,37,133,0.18));
      color: #fff;
      margin-bottom: 12px;
    }
    .feature-card h3 { font-size: 1.05rem; margin: 0 0 8px; }
    .feature-card p { margin: 0; color: rgba(226,232,240,0.72); font-size: .92rem; }
    @media (max-width: 960px) {
      .landing-hero { grid-template-columns: 1fr; }
      .feature-row { grid-template-columns: 1fr; }
    }
  </style>
</head>
<body>
  <div class="landing-shell">
    <section class="landing-hero">
      <div class="landing-copy">
        <div class="eyebrow"><i class="fas fa-bolt"></i> TikTok growth studio</div>
        <h1>Turn content into <span class="gradient">performance</span> that scales.</h1>
        <p>Monitor campaigns, creators, engagement, and revenue in one streamlined dashboard. Built for agencies that want smarter TikTok growth, clearer insights, and faster action.</p>
        <div class="cta-row">
          <a href="<?php echo site_url('login'); ?>" class="btn-primary">Get Started</a>
          <a href="<?php echo site_url('terms'); ?>" class="btn-secondary">Read Terms</a>
        </div>
      </div>
      <div class="landing-visual">
        <div class="orb one"></div>
        <div class="orb two"></div>
        <div class="device-card">
          <div class="mini-widget">
            <div>
              Total Views
              <strong>2.847M</strong>
            </div>
            <div class="icon"><i class="fas fa-eye"></i></div>
          </div>
          <div class="mini-widget">
            <div>
              Total Likes
              <strong>186.5K</strong>
            </div>
            <div class="icon"><i class="fas fa-heart"></i></div>
          </div>
          <div class="stat-strip">
            <div class="stat-box">
              <strong>12.8K</strong>
              <span>Comments</span>
            </div>
            <div class="stat-box">
              <strong>8.4K</strong>
              <span>Shares</span>
            </div>
            <div class="stat-box">
              <strong>Rp 428M</strong>
              <span>GMV</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <div class="feature-row">
      <div class="feature-card">
        <div class="ic"><i class="fas fa-chart-line"></i></div>
        <h3>Live Insights</h3>
        <p>Track views, engagement, and campaign momentum in real time.</p>
      </div>
      <div class="feature-card">
        <div class="ic"><i class="fas fa-bullhorn"></i></div>
        <h3>Campaign Control</h3>
        <p>Manage creator activity, content quality, and product performance from one place.</p>
      </div>
      <div class="feature-card">
        <div class="ic"><i class="fas fa-wallet"></i></div>
        <h3>Revenue Focus</h3>
        <p>Connect TikTok performance to sales impact and optimize for conversion.</p>
      </div>
    </div>
  </div>
</body>
</html>
