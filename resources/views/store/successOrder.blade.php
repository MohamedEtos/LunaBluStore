<!doctype html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>تم الطلب بنجاح 🎉</title>

  <!-- Bootstrap 4 -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>

  <style>
    :root{
      --bg1:#F0287D;
      --bg2:#ac1a57;
      --card:#F0287D;
      --text:#e5e7eb;
      --muted:#9ca3af;
      --accent:#22c55e;
    }

    body{
      min-height:100vh;
      margin:0;
      background:
        radial-gradient(1200px 600px at 20% 10%, rgba(238, 34, 146, 0.16), transparent 60%),
        radial-gradient(900px 500px at 80% 20%, rgba(255, 14, 126, 0.2), transparent 55%),
        radial-gradient(900px 700px at 50% 90%, rgba(255, 4, 192, 0.14), transparent 60%),
        linear-gradient(135deg, var(--bg1), var(--bg2));
      color:var(--text);
      overflow:hidden;
      font-family: "Tajawal", "Cairo", system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
    }

    /* FX layers */
    #fx, #glowFx{
      position:fixed;
      inset:0;
      pointer-events:none;
    }
    #glowFx{ z-index: 0; opacity:.9; }
    #fx{ z-index: 1; }

    .wrap{
      min-height:100vh;
      display:flex;
      align-items:center;
      justify-content:center;
      padding:24px;
      position:relative;
      z-index:2;
    }

    .cardx{
      width:100%;
      max-width:760px;
      /* background:var(--card); */
      /* border:1px solid rgba(255,255,255,.08); */
      border-radius:20px;
      /* box-shadow: 0 18px 60px rgba(0,0,0,.45); */
      padding:24px;
      /* backdrop-filter: blur(1px); */
    }

    .title{ font-weight:900; font-size:28px; margin:0 0 6px; }
    .subtitle{ color:var(--muted); margin:0 0 18px; }

    .scene{
      position:relative;
      height:340px;
      display:flex;
      align-items:center;
      justify-content:center;
      margin: 6px 0 18px;
    }

    /* Gift */
    .gift{
      position:relative;
      width:190px;
      height:170px;
      transform: translateY(12px);
      filter: drop-shadow(0 18px 22px rgba(255, 29, 105, 0.42));
      cursor:pointer;
      user-select:none;
      -webkit-tap-highlight-color: transparent;
    }

    .gift.idle{ animation: idle 1.4s ease-in-out infinite; }
    @keyframes idle{
      0%,100%{ transform: translateY(12px) rotate(-1deg); }
      50%{ transform: translateY(2px) rotate(1deg); }
    }

    .gift.shake{ animation: shake .42s ease-out 1; }
    @keyframes shake{
      0%{ transform: translateY(12px) rotate(0); }
      20%{ transform: translateY(8px) rotate(-2deg); }
      45%{ transform: translateY(10px) rotate(2deg); }
      70%{ transform: translateY(6px) rotate(-1deg); }
      100%{ transform: translateY(8px) rotate(0); }
    }

    .box{
      position:absolute;
      bottom:0; left:0; right:0;
      height:125px;
      border-radius:18px;
      background: linear-gradient(135deg, rgba(255, 255, 255, 0.14), rgba(255,255,255,.05));
      border: 1px solid rgba(255,255,255,.14);
      overflow:hidden;
    }
    .stripe-v{
      position:absolute;
      left:50%;
      top:0; bottom:0;
      width:24px;
      transform:translateX(-50%);
      background: linear-gradient(180deg, rgba(34,197,94,.18), rgba(34,197,94,.75), rgba(34,197,94,.18));
      opacity:.92;
    }
    .stripe-h{
      position:absolute;
      left:0; right:0;
      top:52%;
      height:18px;
      background: linear-gradient(90deg, rgba(34,197,94,.25), rgba(34,197,94,.70), rgba(34,197,94,.25));
      opacity:.88;
    }

    .lid{
      position:absolute;
      top:0; left:-7px; right:-7px;
      height:60px;
      border-radius:18px;
      background: linear-gradient(135deg, rgba(255,255,255,.18), rgba(255,255,255,.06));
      border: 1px solid rgba(255,255,255,.16);
      transform-origin: 50% 100%;
      transition: transform 850ms cubic-bezier(.2,.95,.2,1), top 850ms cubic-bezier(.2,.95,.2,1);
    }

    .bowWrap{
      position:absolute;
      top:14px; left:50%;
      transform: translateX(-50%);
      width:80px; height:42px;
      pointer-events:none;
    }
    .bow{
      position:absolute;
      top:0; width:38px; height:28px;
      border-radius: 999px;
      background: radial-gradient(circle at 30% 30%, rgba(255,255,255,.5), rgba(34,197,94,.80));
      box-shadow: inset 0 0 0 1px rgba(255,255,255,.16);
    }
    .bow.left{ left:0; transform: rotate(-18deg); }
    .bow.right{ right:0; transform: rotate(18deg); }
    .knot{
      position:absolute;
      left:50%; top:11px;
      transform: translateX(-50%);
      width:18px; height:18px;
      border-radius:6px;
      background: rgba(34,197,94,.92);
      box-shadow: inset 0 0 0 1px rgba(255,255,255,.18);
    }

    /* Open state */
    .gift.open .lid{
      top:-34px;
      transform: rotateX(78deg) rotateZ(-10deg);
    }

    /* Glow ring behind gift */
    .halo{
      position:absolute;
      width:340px; height:340px;
      border-radius:50%;
      background: radial-gradient(circle, rgba(34,197,94,.22), rgba(34,211,238,.12), rgba(167,139,250,.10), transparent 62%);
      filter: blur(10px);
      opacity:.85;
      animation: halo 2.8s ease-in-out infinite;
      z-index:-1;
    }
    @keyframes halo{
      0%,100%{ transform: scale(0.98); opacity:.75; }
      50%{ transform: scale(1.05); opacity:1; }
    }

    /* Message */
    .msg{
      position:absolute;
      bottom:18px;
      left:50%;
      transform: translateX(-50%);
      width: calc(100% - 48px);
      max-width: 560px;
      text-align:center;
      opacity:0;
      transition: opacity 520ms ease, transform 520ms ease;
    }
    .msg.show{
      opacity:1;
      transform: translateX(-50%) translateY(-8px);
    }
    .badge-successx{
      display:inline-flex;
      align-items:center;
      justify-content:center;
      gap:10px;
      padding:10px 14px;
      border-radius:999px;
      background: rgba(34,197,94,.16);
      border: 1px solid rgba(34,197,94,.36);
      color: #bbf7d0;
      font-weight:800;
      margin-bottom:10px;
    }
    .msg h3{ font-weight:900; margin:0; font-size:22px; }
    .msg p{ margin:8px 0 0; }

    .footer-actions{
      display:flex;
      gap:10px;
      flex-wrap:wrap;
      justify-content:center;
      margin-top:14px;
    }
    .btnx{ border-radius: 12px; font-weight:800; padding:10px 14px; }
    .hint{ font-size:14px; color:rgba(229,231,235,.75); text-align:center; margin-top:10px; }
    .small-note{ font-size:12px; color:rgba(229,231,235,.55); text-align:center; margin-top:10px; }
  </style>
</head>
<body>

<canvas id="glowFx"></canvas>
<canvas id="fx"></canvas>

<div class="wrap">
  <div class="cardx">
    <div class="d-flex align-items-start justify-content-between flex-wrap">
      <div>
        <h1 class="title">تم تأكيد طلبك 🎉</h1>
        {{-- <p class="subtitle">اضغط على صندوق الهدية… هتشوف شرايط وفرحة محترمة 😄</p> --}}
      </div>
      <div class="text-left">
        <h2 class="badge badge-pill badge-light" id="orderNo">{{$order->order_number}}</h2>
      </div>
    </div>

    <div class="scene">
      <div class="halo"></div>

      <div class="gift idle" id="gift" aria-label="Gift Box">
        <div class="lid">
          <div class="bowWrap">
            <div class="bow left"></div>
            <div class="bow right"></div>
            <div class="knot"></div>
          </div>
        </div>

        <div class="box">
          <div class="stripe-v"></div>
          <div class="stripe-h"></div>
        </div>
      </div>

      <div class="msg" id="msg">
        <div class="badge-successx">✅ <span>نجاح</span> • <span>Order Placed</span></div>
        <h3>الطلب اتسجل بنجاح!</h3>
        <p class="h4 mt-2">هنبدأ تجهيز الأوردر فورًا — شكراً ليك 💚</p>

        <p class="text-muted mt-3">
             سيتم تحويلك للصفحة الرئيسية خلال
        <span id="counter">5</span>
        ثواني
        </p>

      </div>
    </div>

    <div class="footer-actions">
      {{-- <button class="btn btn-success btnx" id="btnReplay">إعادة الأنيميشن</button> --}}
      <button class="btn btn-outline-light w-75 btnx" id="btnGo">تابع التسوق</button>
      {{-- <button class="btn btn-outline-warning btnx" id="btnTrack">تتبع الطلب</button> --}}
    </div>

    {{-- <div class="hint">ملاحظة: الأنيميشن شغال Canvas بالكامل — سريع وخفيف</div> --}}
    {{-- <div class="small-note">Bootstrap 4 + Confetti + Streamers + Spark Trails (Vanilla JS)</div> --}}
  </div>
</div>

<script>
  // ===== Canvas setup (2 layers) =====
  const fx = document.getElementById("fx");
  const gxf = document.getElementById("glowFx");
  const ctx = fx.getContext("2d");
  const gctx = gxf.getContext("2d");

  function resize() {
    const dpr = devicePixelRatio || 1;
    [fx, gxf].forEach(c=>{
      c.width = innerWidth * dpr;
      c.height = innerHeight * dpr;
      c.style.width = innerWidth + "px";
      c.style.height = innerHeight + "px";
    });
    ctx.setTransform(dpr,0,0,dpr,0,0);
    gctx.setTransform(dpr,0,0,dpr,0,0);
  }
  addEventListener("resize", resize);
  resize();

  const rand = (a,b)=>Math.random()*(b-a)+a;

  const palette = ["#22c55e","#fbbf24","#fb7185","#22d3ee","#a78bfa","#ffffff"];

  // ===== Particles =====
  class Confetti {
    constructor(x,y){
      this.x=x; this.y=y;
      this.vx = rand(-7,7);
      this.vy = rand(-12,-5);
      this.g  = rand(0.18,0.32);
      this.w  = rand(6,12);
      this.h  = rand(3,7);
      this.rot = rand(0,Math.PI*2);
      this.vrot = rand(-0.22,0.22);
      this.life = rand(70,120);
      this.alpha = 1;
      this.color = palette[(Math.random()*palette.length)|0];
    }
    step(){
      this.life--;
      this.vy += this.g;
      this.x += this.vx;
      this.y += this.vy;
      this.rot += this.vrot;
      if(this.life < 28) this.alpha = Math.max(0, this.life/28);
    }
    draw(){
      ctx.save();
      ctx.globalAlpha = this.alpha;
      ctx.translate(this.x,this.y);
      ctx.rotate(this.rot);
      ctx.fillStyle = this.color;
      ctx.fillRect(-this.w/2, -this.h/2, this.w, this.h);
      ctx.restore();
    }
  }

  class Star {
    constructor(x,y){
      this.x=x; this.y=y;
      this.vx = rand(-6,6);
      this.vy = rand(-14,-7);
      this.g  = rand(0.12,0.22);
      this.r  = rand(4,8);
      this.rot = rand(0,Math.PI*2);
      this.vrot = rand(-0.18,0.18);
      this.life = rand(65,110);
      this.alpha = 1;
      this.color = palette[(Math.random()*palette.length)|0];
    }
    step(){
      this.life--;
      this.vy += this.g;
      this.x += this.vx;
      this.y += this.vy;
      this.rot += this.vrot;
      if(this.life < 28) this.alpha = Math.max(0, this.life/28);
    }
    draw(){
      ctx.save();
      ctx.globalAlpha = this.alpha;
      ctx.translate(this.x,this.y);
      ctx.rotate(this.rot);
      drawStar(0,0,5,this.r*1.9,this.r*0.9,this.color);
      ctx.restore();
    }
  }

  class Spark {
    constructor(x,y,angle){
      const sp = rand(6,11);
      this.x=x; this.y=y;
      this.vx = Math.cos(angle)*sp + rand(-1.5,1.5);
      this.vy = Math.sin(angle)*sp + rand(-1.5,1.5);
      this.g  = rand(0.10,0.18);
      this.life = rand(28,45);
      this.alpha = 1;
      this.color = "#ffffff";
      this.size = rand(1.2,2.4);
    }
    step(){
      this.life--;
      this.vy += this.g;
      this.x += this.vx;
      this.y += this.vy;
      this.alpha = Math.max(0, this.life/45);
    }
    draw(){
      ctx.save();
      ctx.globalAlpha = this.alpha;
      ctx.beginPath();
      ctx.arc(this.x,this.y,this.size,0,Math.PI*2);
      ctx.fillStyle = this.color;
      ctx.fill();
      ctx.restore();
    }
  }

  // Streamers = long ribbons
  class Streamer{
    constructor(x,y){
      this.x=x; this.y=y;
      this.vx = rand(-4,4);
      this.vy = rand(-18,-10);
      this.g = rand(0.20,0.34);
      this.life = rand(95,150);
      this.alpha = 1;
      this.color = palette[(Math.random()*palette.length)|0];
      this.len = rand(90,160);
      this.th = rand(2.2,4.2);
      this.phase = rand(0,Math.PI*2);
      this.amp = rand(10,18);
      this.freq = rand(0.10,0.16);
      this.drag = rand(0.985,0.993);
    }
    step(){
      this.life--;
      this.vy += this.g;
      this.vx *= this.drag;
      this.x += this.vx;
      this.y += this.vy;

      this.phase += this.freq;
      if(this.life < 35) this.alpha = Math.max(0, this.life/35);
    }
    draw(){
      ctx.save();
      ctx.globalAlpha = this.alpha;
      ctx.lineWidth = this.th;
      ctx.strokeStyle = this.color;
      ctx.lineCap = "round";

      // wavy ribbon path
      ctx.beginPath();
      const segments = 10;
      for(let i=0;i<=segments;i++){
        const t = i/segments;
        const yy = this.y + t*this.len;
        const xx = this.x + Math.sin(this.phase + t*6.0)*this.amp*(1-t);
        if(i===0) ctx.moveTo(xx,yy);
        else ctx.lineTo(xx,yy);
      }
      ctx.stroke();

      // little highlight
      ctx.globalAlpha = this.alpha * 0.35;
      ctx.strokeStyle = "#ffffff";
      ctx.lineWidth = Math.max(1.1, this.th-1.2);
      ctx.stroke();

      ctx.restore();
    }
  }

  function drawStar(cx, cy, spikes, outerRadius, innerRadius, color){
    let rot = Math.PI / 2 * 3;
    let x = cx;
    let y = cy;
    const step = Math.PI / spikes;

    ctx.beginPath();
    ctx.moveTo(cx, cy - outerRadius);
    for (let i = 0; i < spikes; i++) {
      x = cx + Math.cos(rot) * outerRadius;
      y = cy + Math.sin(rot) * outerRadius;
      ctx.lineTo(x, y);
      rot += step;

      x = cx + Math.cos(rot) * innerRadius;
      y = cy + Math.sin(rot) * innerRadius;
      ctx.lineTo(x, y);
      rot += step;
    }
    ctx.closePath();
    ctx.fillStyle = color;
    ctx.fill();
  }

  let parts = [];
  let raf = null;

  // ===== Glow pulse at burst point =====
  function glowPulse(x,y){
    const start = performance.now();
    const dur = 650;
    function gloop(now){
      const t = Math.min(1, (now-start)/dur);
      gctx.clearRect(0,0,innerWidth,innerHeight);

      const r = 20 + t*180;
      const a = (1-t) * 0.75;
      const grad = gctx.createRadialGradient(x,y,0,x,y,r);
      grad.addColorStop(0, `rgba(34,197,94,${a})`);
      grad.addColorStop(0.35, `rgba(34,211,238,${a*0.55})`);
      grad.addColorStop(0.7, `rgba(167,139,250,${a*0.35})`);
      grad.addColorStop(1, `rgba(0,0,0,0)`);

      gctx.fillStyle = grad;
      gctx.beginPath();
      gctx.arc(x,y,r,0,Math.PI*2);
      gctx.fill();

      if(t<1) requestAnimationFrame(gloop);
      else gctx.clearRect(0,0,innerWidth,innerHeight);
    }
    requestAnimationFrame(gloop);
  }

  function burst(x,y){
    // streamers (الشرايط)
    for(let i=0;i<18;i++) parts.push(new Streamer(x + rand(-10,10), y + rand(-6,6)));

    // wave 1
    for(let i=0;i<140;i++) parts.push(new Confetti(x,y));
    for(let i=0;i<26;i++) parts.push(new Star(x,y));

    // spark ring
    for(let i=0;i<60;i++){
      const ang = (Math.PI*2) * (i/60);
      parts.push(new Spark(x,y,ang));
    }

    // wave 2 (delayed bigger pop)
    setTimeout(()=>{
      for(let i=0;i<120;i++){
        const c = new Confetti(x,y);
        c.vx *= 1.15;
        c.vy *= 1.15;
        parts.push(c);
      }
      for(let i=0;i<20;i++) parts.push(new Star(x,y));
      if(!raf) loop();
    }, 120);

    glowPulse(x,y);
  }

  function loop(){
    ctx.clearRect(0,0,innerWidth,innerHeight);

    for(let i=parts.length-1;i>=0;i--){
      const p = parts[i];
      p.step();
      p.draw();
      if(p.life<=0 || p.y > innerHeight + 200) parts.splice(i,1);
    }

    if(parts.length){
      raf = requestAnimationFrame(loop);
    } else {
      cancelAnimationFrame(raf);
      raf = null;
    }
  }

  // ===== UI =====
  const gift = document.getElementById("gift");
  const msg  = document.getElementById("msg");
//   const btnReplay = document.getElementById("btnReplay");
  const btnGo = document.getElementById("btnGo");
//   const btnTrack = document.getElementById("btnTrack");

  function play(){
    gift.classList.remove("idle");
    gift.classList.add("open");
    gift.classList.add("shake");
    setTimeout(()=>gift.classList.remove("shake"), 450);

    msg.classList.add("show");

    const rect = gift.getBoundingClientRect();
    const x = rect.left + rect.width/2;
    const y = rect.top + 44;

    burst(x,y);
    if(!raf) loop();
  }

  function reset(){
    gift.classList.remove("open","shake");
    msg.classList.remove("show");
    setTimeout(()=>gift.classList.add("idle"), 120);

    parts = [];
    ctx.clearRect(0,0,innerWidth,innerHeight);
    gctx.clearRect(0,0,innerWidth,innerHeight);
    if(raf){ cancelAnimationFrame(raf); raf=null; }
  }

  gift.addEventListener("click", ()=>{
    if(!gift.classList.contains("open")) play();
    else {
      // extra mini-burst when clicking again
      const rect = gift.getBoundingClientRect();
      burst(rect.left + rect.width/2, rect.top + 44);
      if(!raf) loop();
    }
  });

//   btnReplay.addEventListener("click", ()=>{ reset(); setTimeout(play, 220); });

//   btnGo.addEventListener("click", ()=> alert("حط هنا لينك متابعة التسوق ✅"));
//   btnTrack.addEventListener("click", ()=> alert("حط هنا لينك تتبع الطلب ✅"));

  // demo order number
//   document.getElementById("orderNo").textContent = "#ORD-2026-" + Math.floor(1000 + Math.random()*9000);

  // auto play
  setTimeout(play, 650);

    let seconds = 7;
    const counter = document.getElementById('counter');

    const timer = setInterval(() => {
        seconds--;
        counter.textContent = seconds;

        if (seconds <= 0) {
        clearInterval(timer);
        window.location.href = "/";
        }
    }, 1000);




</script>

</body>
</html>
