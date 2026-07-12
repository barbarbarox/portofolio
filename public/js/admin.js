/**
 * Admin Panel JS
 * Handles sidebar toggle, delete confirmations, skill reorder, etc.
 */

const $ = id => document.getElementById(id);
const $$ = sel => document.querySelectorAll(sel);

// ─── Sidebar Toggle (Mobile) ──────────────────────────────
(function initSidebar() {
  const toggle  = document.querySelector('.adm-menu-toggle');
  const sidebar = document.querySelector('.adm-sidebar');
  const overlay = document.querySelector('.adm-overlay');
  if (!toggle) return;

  const open = () => { sidebar?.classList.add('open'); overlay?.classList.add('open'); };
  const close = () => { sidebar?.classList.remove('open'); overlay?.classList.remove('open'); };

  toggle.addEventListener('click', () => sidebar?.classList.contains('open') ? close() : open());
  overlay?.addEventListener('click', close);
})();

// ─── Delete Confirmations ─────────────────────────────────
document.querySelectorAll('[data-confirm]').forEach(el => {
  el.addEventListener('click', e => {
    const msg = el.dataset.confirm || 'Yakin ingin menghapus?';
    if (!confirm(msg)) e.preventDefault();
  });
});

// ─── Toggle Featured (AJAX) ───────────────────────────────
document.querySelectorAll('.toggle-featured').forEach(btn => {
  btn.addEventListener('click', async () => {
    const id    = btn.dataset.id;
    const token = document.querySelector('meta[name="csrf-token"]')?.content;
    const base  = document.querySelector('meta[name="base-path"]')?.content || '/portfolio';

    const res = await fetch(`${base}/admin/projects/toggle-featured`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: `id=${id}&_csrf_token=${encodeURIComponent(token)}`,
    });
    const data = await res.json();
    if (data.success) {
      const icon  = btn.querySelector('i');
      const label = btn.querySelector('.feat-label');
      const isFeatured = btn.dataset.featured === '1';
      btn.dataset.featured = isFeatured ? '0' : '1';
      if (icon) { icon.className = isFeatured ? 'fas fa-star' : 'fas fa-star'; }
      btn.style.opacity = isFeatured ? '0.4' : '1';
      if (label) label.textContent = isFeatured ? 'Featured: Off' : 'Featured: On';
    }
  });
});

// ─── Mark Read (AJAX) ─────────────────────────────────────
document.querySelectorAll('.mark-read-btn').forEach(btn => {
  btn.addEventListener('click', async () => {
    const id    = btn.dataset.id;
    const token = document.querySelector('meta[name="csrf-token"]')?.content;
    const base  = document.querySelector('meta[name="base-path"]')?.content || '/portfolio';

    await fetch(`${base}/admin/messages/read`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: `id=${id}&_csrf_token=${encodeURIComponent(token)}`,
    });
    const row = btn.closest('tr');
    if (row) row.classList.remove('msg-unread');
    btn.remove();
  });
});

// ─── Image Preview ────────────────────────────────────────
const imageInput = document.querySelector('input[type="file"][name="image"]');
if (imageInput) {
  imageInput.addEventListener('change', e => {
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = ev => {
      let preview = document.querySelector('.img-preview');
      if (!preview) {
        preview = document.createElement('img');
        preview.className = 'img-preview';
        preview.style.cssText = 'width:100%;max-height:200px;object-fit:cover;border-radius:8px;margin-top:0.5rem;';
        imageInput.parentNode.appendChild(preview);
      }
      preview.src = ev.target.result;
    };
    reader.readAsDataURL(file);
  });
}

// ─── Skill Reorder (Drag & Drop) ─────────────────────────
(function initReorder() {
  const table = document.querySelector('.sortable-table tbody');
  if (!table) return;

  let dragging = null;

  table.querySelectorAll('tr').forEach(row => {
    row.setAttribute('draggable', 'true');
    row.style.cursor = 'grab';

    row.addEventListener('dragstart', () => {
      dragging = row;
      setTimeout(() => row.classList.add('dragging'), 0);
    });
    row.addEventListener('dragend', () => {
      row.classList.remove('dragging');
      dragging = null;
      _saveOrder(table);
    });
    row.addEventListener('dragover', e => {
      e.preventDefault();
      if (!dragging || dragging === row) return;
      const bounding = row.getBoundingClientRect();
      const offset   = bounding.y + bounding.height / 2;
      if (e.clientY - offset > 0) { row.after(dragging); } else { row.before(dragging); }
    });
  });

  async function _saveOrder(tbody) {
    const ids   = Array.from(tbody.querySelectorAll('tr')).map(r => r.dataset.id);
    const token = document.querySelector('meta[name="csrf-token"]')?.content;
    const base  = document.querySelector('meta[name="base-path"]')?.content || '/portfolio';
    const body  = ids.map((id, i) => `order[${i}]=${id}`).join('&') + `&_csrf_token=${encodeURIComponent(token)}`;
    await fetch(`${base}/admin/skills/reorder`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body,
    });
  }
})();

// ─── Percentage Range Input ───────────────────────────────
const rangeInput = document.querySelector('input[type="range"][name="percentage"]');
const rangeDisplay = document.querySelector('.range-display');
if (rangeInput && rangeDisplay) {
  rangeDisplay.textContent = rangeInput.value + '%';
  rangeInput.addEventListener('input', () => { rangeDisplay.textContent = rangeInput.value + '%'; });
}

// ─── Auto-dismiss alerts ──────────────────────────────────
document.querySelectorAll('.adm-alert').forEach(alert => {
  setTimeout(() => {
    alert.style.transition = 'opacity 0.5s';
    alert.style.opacity = '0';
    setTimeout(() => alert.remove(), 500);
  }, 4000);
});

// ─── reCAPTCHA on Login ───────────────────────────────────
(function initAdminRecaptcha() {
  const form = document.querySelector('form[data-recaptcha]');
  if (!form) return;
  form.addEventListener('submit', function(e) {
    e.preventDefault();
    const action  = form.dataset.recaptcha;
    const sitekey = form.dataset.sitekey;
    if (typeof grecaptcha === 'undefined') { form.submit(); return; }
    grecaptcha.ready(() => {
      grecaptcha.execute(sitekey, { action }).then(token => {
        let inp = form.querySelector('input[name="recaptcha_token"]');
        if (!inp) { inp = document.createElement('input'); inp.type='hidden'; inp.name='recaptcha_token'; form.appendChild(inp); }
        inp.value = token;
        form.submit();
      });
    });
  });
})();
