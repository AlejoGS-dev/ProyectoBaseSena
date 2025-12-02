// ===== Utilidades =====
const $ = (sel, root=document) => root.querySelector(sel);
const $$ = (sel, root=document) => Array.from(root.querySelectorAll(sel));
const initials = (name='') => name.trim().split(/\s+/).map(s=>s[0]).slice(0,2).join('').toUpperCase();

// ===== Toast =====
(function(){
  const el = document.createElement('div');
  el.id='toast';
  el.style.cssText='position:fixed;left:50%;bottom:24px;transform:translateX(-50%);background:var(--card);color:var(--ink);border:1px solid var(--stroke);padding:10px 14px;border-radius:12px;box-shadow:var(--shadow);opacity:0;pointer-events:none;transition:opacity .2s;z-index:90';
  document.body.appendChild(el);
  window.toast=(msg)=>{
    el.textContent=msg;
    el.style.opacity=1;
    clearTimeout(el._t);
    el._t=setTimeout(()=> el.style.opacity=0,1800);
  };
})();

// ===== Año =====
document.addEventListener('DOMContentLoaded', () => {
  const yearEl = $('#year');
  if (yearEl) yearEl.textContent = new Date().getFullYear();
});

// ===== Tema =====
(function(){
  const root=document.documentElement, btn=$('#themeToggle'), key='freeland-theme';
  const saved=localStorage.getItem(key)||root.getAttribute('data-theme')||'light';
  root.setAttribute('data-theme', saved);
  if (btn) btn.innerHTML = saved==='dark'
    ?'<i class="ri-moon-line"></i>'
    :'<i class="ri-sun-line"></i>';

  btn?.addEventListener('click',()=>{
    const now=root.getAttribute('data-theme')==='dark'?'light':'dark';
    root.setAttribute('data-theme',now);
    localStorage.setItem(key,now);
    btn.innerHTML= now==='dark'
      ?'<i class="ri-moon-line"></i>'
      :'<i class="ri-sun-line"></i>';
    root.style.transition='background .25s,color .25s';
  });
})();

// ===== Router mínimo (Home/Foro) =====
(function(){
  const home=$('#homeView'), forum=$('#forumView');
  if (!home || !forum) return;
  function showHome(){
    home.classList.remove('hidden');
    forum.classList.add('hidden');
    location.hash = '#/home';
  }
  function showForum(){
    forum.classList.remove('hidden');
    home.classList.add('hidden');
    location.hash = '#/foro';
    if (typeof window.renderThreads === 'function') {
      window.renderThreads();
    }
  }
  $('#forumBtn')?.addEventListener('click', showForum);
  $('#backHomeBtn')?.addEventListener('click', showHome);
  if (location.hash === '#/foro') showForum();
})();

// ===== Perfil (persistente y refleja en UI) =====
;(function(){
  const btn=$('#profileMenuBtn'),
        menu=$('#profileMenu'),
        modal=$('#profileModal');
  const close=$('#closeProfile'),
        form=$('#profileForm');
  const nameI=$('#pf_name'),
        titleI=$('#pf_title'),
        bioI=$('#pf_bio');
  const leftName=$('#leftName'),
        leftTitle=$('#leftTitle'),
        leftAvatar=$('#leftAvatar'),
        compAvatar=$('#composerAvatar');
  const KEY='freeland-profile';

  if (!btn || !menu || !modal || !form || !leftName || !leftAvatar) return;

  const read=()=>{ try{return JSON.parse(localStorage.getItem(KEY)||'{}')}catch{return{}} };
  const write=(d)=> localStorage.setItem(KEY, JSON.stringify(d));

  const paint=()=>{
    const d=read();
    if(d.name){
      leftName.textContent=d.name;
      leftAvatar.textContent=initials(d.name);
      if (compAvatar) compAvatar.textContent=initials(d.name);
    }
    if(d.title && leftTitle){
      leftTitle.textContent=d.title;
    }
  };

  const openModal=()=>{
    const d=read();
    nameI.value=d.name||leftName.textContent||'';
    titleI.value=d.title||leftTitle?.textContent||'';
    bioI.value=d.bio||'';
    modal.classList.remove('hidden');
  };

  const closeModal=()=> modal.classList.add('hidden');

  btn.addEventListener('click',()=>{
    const open=!menu.classList.contains('show');
    menu.classList.toggle('show', open);
    btn.setAttribute('aria-expanded', String(open));
  });

  document.addEventListener('click',(e)=>{
    if(!menu.contains(e.target) && !btn.contains(e.target)){
      menu.classList.remove('show');
      btn.setAttribute('aria-expanded','false');
    }
  });

  $('#menuProfile')?.addEventListener('click', (e)=>{ e.preventDefault(); openModal(); });
  $('#menuSettings')?.addEventListener('click', (e)=>{ e.preventDefault(); openModal(); });
  $('#menuLogout')?.addEventListener('click', (e)=>{ e.preventDefault(); toast('Cerrando sesión… (demo)'); });

  close?.addEventListener('click', closeModal);
  $('#pf_cancel')?.addEventListener('click', closeModal);

  form.addEventListener('submit', (e)=>{
    e.preventDefault();
    const d={
      name:nameI.value.trim(),
      title:titleI.value.trim(),
      bio:bioI.value.trim()
    };
    write(d);
    paint();
    toast('Perfil guardado');
    closeModal();
  });

  paint();
})();

// ===== Buscador (demo, ya no lo usamos en Blade para backend) =====
(function(){
  const form=document.querySelector('form.search');
  if(!form || !form.q) return;
  form.addEventListener('submit',(e)=>{
    // En tu Blade esto ya hace submit real; si quieres mantener el toast, quita el preventDefault
    // e.preventDefault();
    const q=form.q.value.trim();
    if(!q) return form.q.focus();
    // toast('Buscar: '+q);
  });
})();

// ===== Notificaciones CRUD =====
;(function(){
  const KEY='freeland-notifs';
  const btn=$('#notifBtn'),
        panel=$('#notifPanel'),
        badge=$('#notifBadge'),
        list=$('#notifList');
  const readAll=$('#notifReadAll'),
        clearBtn=$('#notifClear'),
        seedBtn=$('#notifSeed');

  if (!btn || !panel || !badge || !list) return;

  const read=()=>{ try{return JSON.parse(localStorage.getItem(KEY)||'[]')}catch{return[]} };
  const write=(arr)=> localStorage.setItem(KEY, JSON.stringify(arr));
  const unread=()=> read().filter(n=>!n.read).length;

  const paintBadge=()=>{
    const n=unread();
    badge.textContent=n;
    badge.style.display = n>0? 'inline-block':'none';
  };

  const add=(text)=>{
    const arr=read();
    arr.push({id:Date.now()+Math.random(), text, read:false, ts:new Date().toISOString()});
    write(arr);
    paintList();
    paintBadge();
  };

  const seed=()=>['Bienvenido a Freeland','Nueva respuesta en tu hilo','Actualiza tu perfil'].forEach(t=>add(t));

  const paintList=()=>{
    const arr=read().sort((a,b)=> new Date(b.ts)-new Date(a.ts));
    list.innerHTML='';
    if(!arr.length){
      const d=document.createElement('div');
      d.className='muted';
      d.style.padding='10px';
      d.textContent='Sin notificaciones';
      list.appendChild(d);
      return;
    }
    for(const it of arr){
      const row=document.createElement('div');
      row.className='notif-item'+(it.read?'':' unread');
      row.innerHTML =
        `<i class="ri-notification-3-line" aria-hidden="true"></i>
        <div style="flex:1">
          <div>${it.text}</div>
          <small>${new Date(it.ts).toLocaleString()}</small>
        </div>
        <div class="notif-actions">
          <button class="btn" data-act="toggle">${it.read?'Marcar no leído':'Marcar leído'}</button>
          <button class="btn" data-act="del"><i class="ri-delete-bin-line"></i></button>
        </div>`;

      row.querySelector('[data-act="toggle"]').addEventListener('click',()=>{
        it.read=!it.read;
        write(arr);
        paintList();
        paintBadge();
      });

      row.querySelector('[data-act="del"]').addEventListener('click',()=>{
        const idx=arr.findIndex(n=>n.id===it.id);
        if(idx>-1){
          arr.splice(idx,1);
          write(arr);
          paintList();
          paintBadge();
        }
      });

      list.appendChild(row);
    }
  };

  const position=()=>{
    const rect=btn.getBoundingClientRect();
    panel.style.right=(window.innerWidth-rect.right)+'px';
    panel.style.top=(rect.bottom+8)+'px';
  };

  btn.addEventListener('click',()=>{
    const open=panel.classList.toggle('show');
    if(open){
      position();
      paintList();
    }
  });

  readAll?.addEventListener('click',()=>{
    const arr=read().map(n=>({...n, read:true}));
    write(arr);
    paintList();
    paintBadge();
  });

  clearBtn?.addEventListener('click',()=>{
    write([]);
    paintList();
    paintBadge();
  });

  seedBtn?.addEventListener('click',()=> seed());

  document.addEventListener('click',(e)=>{
    if(!panel.contains(e.target)&&!btn.contains(e.target))
      panel.classList.remove('show');
  });

  window.addEventListener('resize',()=>{
    if(panel.classList.contains('show')) position();
  });

  window.pushNotif = add;
  paintBadge();
})();

// ===== Feed DEMO (ya no se usa con tu backend, pero lo dejo por si lo necesitas en otra vista) =====
function createPost(text){
  if(!text) return;
  const feed=$('#feed');
  if (!feed) return;
  const el=document.createElement('article');
  el.className='card post';
  el.innerHTML = `
    <div class="meta">
      <div class="pic" id="postPic">DF</div>
      <div>
        <div class="name">Tú</div>
        <div class="time muted">Ahora mismo · Publicación</div>
      </div>
    </div>
    <div class="body"></div>
    <div class="actions">
      <button class="action" type="button"><i class="ri-thumb-up-line"></i> Recomendar</button>
      <button class="action" type="button"><i class="ri-chat-3-line"></i> Comentar</button>
      <button class="action" type="button"><i class="ri-share-forward-line"></i> Compartir</button>
    </div>`;
  el.querySelector('.body').textContent = text;
  feed.prepend(el);
  $$('.post .action', el).forEach(a =>
    a.addEventListener('click', ()=> toast(a.textContent.trim()+': próximamente'))
  );
  if(window.pushNotif) window.pushNotif('Tu publicación fue creada.');
}

// ===== Chat persistente =====
;(function(){
  const open=$('#openChat'),
        box=$('#chatbox'),
        close=$('#closeChat');
  const users=$$('.chat-user'),
        title=$('#chatTitle');
  const messages=$('.messages'),
        form=$('#chatForm'),
        input=$('#chatText');

  if (!open || !box || !close || !messages || !form || !input) return;

  const KP='freeland-chat-',
        KC='freeland-chat-current';
  let current=localStorage.getItem(KC)||null;

  const key=(u)=> KP+encodeURIComponent(u);
  const read=(u)=>{try{return JSON.parse(localStorage.getItem(key(u))||'[]')}catch{return[]}};
  const write=(u,arr)=> localStorage.setItem(key(u), JSON.stringify(arr));

  const add=(text,type='to')=>{
    const d=document.createElement('div');
    d.className=`msg ${type}`;
    d.textContent=text;
    messages.appendChild(d);
    messages.scrollTop=messages.scrollHeight;
  };

  const paint=()=>{
    messages.innerHTML='';
    for(const m of read(current)) add(m.text,m.type);
  };

  const switchTo=(u)=>{
    current=u;
    localStorage.setItem(KC,u);
    title.textContent=`Chat con ${u}`;
    if(!read(u).length){
      const w=`Has abierto la conversación con ${u}`;
      write(u,[{type:'from',text:w}]);
    }
    paint();
    input.focus();
  };

  open.addEventListener('click',()=> box.classList.toggle('hidden'));
  close.addEventListener('click',()=> box.classList.add('hidden'));

  users.forEach(u=> u.addEventListener('click',()=> switchTo(u.dataset.user)));

  form.addEventListener('submit',(e)=>{
    e.preventDefault();
    if(!current) return;
    const t=input.value.trim();
    if(!t) return;
    const arr=read(current);
    arr.push({type:'to',text:t});
    write(current,arr);
    add(t,'to');
    input.value='';
    pushNotif?.('Nuevo mensaje enviado a '+current);
  });

  if(current){
    const btn=users.find(b=>b.dataset.user===current);
    if(btn) switchTo(current);
  }
})();

// ===== Foro (threads y comentarios con localStorage) =====
;(function(){
  const KT='freeland-threads';
  const read=()=>{ try{return JSON.parse(localStorage.getItem(KT)||'[]')}catch{return[]} };
  const write=(arr)=> localStorage.setItem(KT, JSON.stringify(arr));

  const list=$('#threadList'),
        nbtn=$('#newThreadBtn'),
        form=$('#threadForm'),
        titleI=$('#th_title'),
        bodyI=$('#th_body'),
        cancel=$('#th_cancel');

  if (!list || !nbtn || !form || !titleI || !bodyI || !cancel) {
    return;
  }

  function toggleForm(show){
    form.classList.toggle('hidden', !show);
    if(show) titleI.focus();
  }

  function render(){
    const arr=read().sort((a,b)=> b.id-a.id);
    list.innerHTML='';
    if(!arr.length){
      const d=document.createElement('div');
      d.className='muted';
      d.style.padding='10px';
      d.textContent='Sin hilos todavía.';
      list.appendChild(d);
      return;
    }
    for(const th of arr){
      const el=document.createElement('article');
      el.className='thread';
      el.innerHTML=`
        <h4>${th.title}</h4>
        <div class="muted" style="font-size:12px">${new Date(th.id).toLocaleString()}</div>
        <p style="margin:6px 0 8px">${th.body}</p>
        <div class="comments"></div>
        <form class="reply" style="display:flex;gap:6px;margin-top:8px">
          <input class="rtext" placeholder="Agregar comentario" required>
          <button class="btn" type="submit"><i class="ri-send-plane-2-line"></i></button>
        </form>`;
      const box=el.querySelector('.comments');
      (th.comments||[]).forEach(c=>{
        const cd=document.createElement('div');
        cd.className='comment';
        cd.textContent=c.text;
        box.appendChild(cd);
      });
      el.querySelector('.reply').addEventListener('submit',(e)=>{
        e.preventDefault();
        const r=el.querySelector('.rtext');
        const txt=r.value.trim();
        if(!txt) return;
        th.comments = th.comments||[];
        th.comments.push({text:txt, ts:Date.now()});
        write(arr);
        const cd=document.createElement('div');
        cd.className='comment';
        cd.textContent=txt;
        box.appendChild(cd);
        r.value='';
        pushNotif?.('Nuevo comentario en "'+th.title+'"');
      });
      list.appendChild(el);
    }
  }

  nbtn.addEventListener('click', ()=> toggleForm(true));
  cancel.addEventListener('click', ()=> toggleForm(false));

  form.addEventListener('submit',(e)=>{
    e.preventDefault();
    const t=titleI.value.trim(),
          b=bodyI.value.trim();
    if(!t||!b) return;
    const arr=read();
    arr.push({id:Date.now(), title:t, body:b, comments:[]});
    write(arr);
    titleI.value='';
    bodyI.value='';
    toggleForm(false);
    render();
    pushNotif?.('Hilo creado: '+t);
  });

  window.renderThreads = render;
  window.addEventListener('load', render);
})();

// ===== Accesibilidad foco =====
(function(){
  function handleFirstTab(e){
    if(e.key==='Tab'){
      document.body.classList.add('user-tabbing');
      window.removeEventListener('keydown', handleFirstTab);
    }
  }
  window.addEventListener('keydown', handleFirstTab);
})();

// ====== QA ======
;(function runTests(){
  const results = [];
  const ok=(name,cond)=> results.push({name, pass:!!cond});
  try{
    ok('Util $ definida una sola vez', typeof $==='function');
    ok('Tema: botón existe', !!document.getElementById('themeToggle'));
    ok('Perfil: modal existe', !!document.getElementById('profileModal'));
    ok('Notificaciones: badge existe', !!document.getElementById('notifBadge'));
    ok('Foro: vista existe', !!document.getElementById('forumView'));
    if (window.renderThreads) {
      const KT='freeland-threads';
      localStorage.setItem(KT, JSON.stringify([{id:1,title:'Test',body:'Body',comments:[]}]));
      window.renderThreads();
      ok('Foro: renderiza lista', document.querySelectorAll('#threadList .thread').length>=1);
    }
  }catch(e){
    results.push({name:'Excepción en tests', pass:false, error:String(e)});
  }
  const passAll = results.every(r=>r.pass);
  console.group('%cFreeland QA','color:#fff;background:#7b1fa2;padding:2px 6px;border-radius:6px');
  results.forEach(r=> console[r.pass?'log':'error']((r.pass?'✔':'✖')+' '+r.name, r.error||''));
  console.groupEnd();
  if (!passAll) toast('Algunas pruebas fallaron. Revisa la consola.');
})();
