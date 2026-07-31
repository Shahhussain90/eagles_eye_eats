const BASE_URL = "https://yaafta.com/";

window.restaurants = [];
let restaurantsReady = false;

fetch(`${BASE_URL}files/data/restaurants.json`)
  .then(r => {
    if (!r.ok) throw new Error('Failed to fetch restaurants.json');
    return r.json();
  })
  .then(data => {
    window.restaurants = data;
    restaurantsReady = true;
  })
  .catch(err => {
    console.error('Could not load restaurant data:', err);
  });

function escapeHtml(str) {
  return String(str)
    .replace(/&/g, "&amp;")
    .replace(/</g, "&lt;")
    .replace(/>/g, "&gt;")
    .replace(/"/g, "&quot;")
    .replace(/'/g, "&#039;");
}
// =========================
// Review Slider
// =========================
(function () {
  var track  = document.getElementById('rs-track');
  var dotsEl = document.getElementById('rs-dots');
  if (!track || !dotsEl) return;

  var slides = track.querySelectorAll('.rs-review');
  var n = slides.length;
  if (n === 0) return;

  var cur = 0, timer;
  var avatarColors = ['#1d4ed8','#0891b2','#0d9488','#7c3aed','#db2777'];

  track.style.width = (n * 100) + '%';

  slides.forEach(function (slide, i) {
    slide.style.width = (100 / n) + '%';

    var avatar = slide.querySelector('.rs-avatar');
    if (avatar) avatar.style.background = avatarColors[i % avatarColors.length];

    var dot = document.createElement('button');
    dot.className = 'rs-dot' + (i === 0 ? ' active' : '');
    dot.setAttribute('role', 'tab');
    dot.setAttribute('aria-label', 'Review ' + (i + 1));
    dot.onclick = function () { goTo(i); reset(); };
    dotsEl.appendChild(dot);
  });

  function goTo(idx) {
    cur = ((idx % n) + n) % n;
    track.style.transform = 'translateX(-' + ((cur / n) * 100) + '%)';
    Array.prototype.forEach.call(dotsEl.children, function (d, i) {
      d.className = 'rs-dot' + (i === cur ? ' active' : '');
    });
  }

  function reset() {
    clearInterval(timer);
    timer = setInterval(function () { goTo(cur + 1); }, 4500);
  }

  var prevBtn = document.getElementById('rs-prev');
  var nextBtn = document.getElementById('rs-next');
  if (prevBtn) prevBtn.onclick = function () { goTo(cur - 1); reset(); };
  if (nextBtn) nextBtn.onclick = function () { goTo(cur + 1); reset(); };

  reset();
})();

// =========================
// Hamburger Toggle
// =========================
const toggle = document.querySelector('.nav-toggle');
const mobileMenu = document.getElementById('mobile-menu');

toggle?.addEventListener('click', () => {
  const isOpen = toggle.classList.toggle('open');
  mobileMenu.classList.toggle('open', isOpen);
  toggle.setAttribute('aria-expanded', isOpen);
  mobileMenu.setAttribute('aria-hidden', !isOpen);
});

mobileMenu?.querySelectorAll('a').forEach(link => {
  link.addEventListener('click', () => {
    toggle.classList.remove('open');
    mobileMenu.classList.remove('open');
    toggle.setAttribute('aria-expanded', 'false');
    mobileMenu.setAttribute('aria-hidden', 'true');
  });
});

// =========================
// Header Search (desktop + mobile)
// =========================
const searchInputDesktop   = document.getElementById('searchInput');
const searchInputMobile    = document.getElementById('searchInputMobile');
const searchResultsDesktop = document.getElementById('searchResults');
const searchResultsMobile  = document.getElementById('searchResultsMobile');

const searchInputs = [searchInputDesktop, searchInputMobile].filter(Boolean);

let headerDebounce;

searchInputs.forEach(input => {
  input.addEventListener('input', () => {
    const query = input.value.trim();
    searchInputs.forEach(other => {
      if (other !== input) other.value = input.value;
    });

    clearTimeout(headerDebounce);
    headerDebounce = setTimeout(() => {
      const targetResults = input === searchInputMobile ? searchResultsMobile : searchResultsDesktop;
      handleSearch(query, targetResults);
    }, 150);
  });

  input.addEventListener('blur', () => {
    setTimeout(() => {
      if (searchResultsDesktop) searchResultsDesktop.style.display = 'none';
      if (searchResultsMobile) searchResultsMobile.style.display = 'none';
    }, 200);
  });

  input.addEventListener('focus', () => {
    const query = input.value.trim();
    const targetResults = input === searchInputMobile ? searchResultsMobile : searchResultsDesktop;
    if (query) handleSearch(query, targetResults);
  });
});

function handleSearch(query, resultsEl) {
  if (!resultsEl) return;

  if (!query) {
    resultsEl.style.display = 'none';
    resultsEl.innerHTML = '';
    return;
  }


const data = window.restaurants || [];

const words = query.toLowerCase().split(/\s+/).filter(Boolean);

const matches = data.filter(r => {
  const haystack = `${r.name} ${r.cuisine || ''} ${r.area || ''}`.toLowerCase();
  return words.every(w => haystack.includes(w));
});

  if (!matches.length) {
    resultsEl.innerHTML = `
      <div class="search-item">
        <span>No results found for "<strong>${escapeHtml(query)}</strong>"</span>
      </div>`;
    resultsEl.style.display = 'block';
    return;
  }

  resultsEl.innerHTML = matches.map(r => `
    <div class="search-item" onclick="window.location='${r.page_url}'">
      <strong>${escapeHtml(r.name)}</strong>
      <span>${escapeHtml(r.cuisine || '')} ${r.area ? '· ' + escapeHtml(r.area) : ''}</span>
    </div>
  `).join('');

  resultsEl.style.display = 'block';
}

// Hide results when clicking outside either search widget
document.addEventListener('click', (e) => {
  const clickedDesktop = searchInputDesktop?.contains(e.target) || searchResultsDesktop?.contains(e.target);
  const clickedMobile  = searchInputMobile?.contains(e.target)  || searchResultsMobile?.contains(e.target);

  if (!clickedDesktop && searchResultsDesktop) searchResultsDesktop.style.display = 'none';
  if (!clickedMobile && searchResultsMobile) searchResultsMobile.style.display = 'none';
});

// =========================
// Search page specific (/files/search or similar)
// =========================
const searchInput  = document.getElementById('restaurantSearch');
const clearBtn      = document.getElementById('searchClear');
const emptyMsg      = document.getElementById('searchEmpty');
const spinner       = document.getElementById('searchSpinner');
const searchBox     = document.querySelector('.search-box');
const cards         = document.querySelectorAll('.featured-grid .card');

let debounceTimer;

function applyFilter() {
  if (!searchInput) return;
  const query = searchInput.value.toLowerCase().trim();
  let visibleCount = 0;

  cards.forEach(card => card.classList.add('fade-out'));

  setTimeout(() => {
    cards.forEach(card => {
      const text = card.textContent.toLowerCase();
      const matches = text.includes(query);
      card.style.display = matches ? '' : 'none';
      if (matches) visibleCount++;
    });

    cards.forEach(card => {
      card.classList.remove('fade-out');
      card.classList.add('fade-in');
    });

    emptyMsg?.classList.toggle('visible', query.length > 0 && visibleCount === 0);

    spinner?.classList.remove('visible');
    searchBox?.classList.remove('loading');
  }, 180);
}

searchInput?.addEventListener('input', () => {
  const query = searchInput.value;
  clearBtn?.classList.toggle('visible', query.length > 0);

  spinner?.classList.add('visible');
  searchBox?.classList.add('loading');
  emptyMsg?.classList.remove('visible');

  clearTimeout(debounceTimer);
  debounceTimer = setTimeout(applyFilter, 280);
});

clearBtn?.addEventListener('click', () => {
  searchInput.value = '';
  clearBtn.classList.remove('visible');
  spinner?.classList.add('visible');
  searchBox?.classList.add('loading');
  clearTimeout(debounceTimer);
  debounceTimer = setTimeout(applyFilter, 180);
  searchInput.focus();
});







(function () {
  const nav = document.getElementById('quicknav');
  if (!nav) return;

  const links = nav.querySelectorAll('.quicknav-link');
  const sections = Array.from(links)
    .map(link => document.getElementById(link.dataset.target))
    .filter(Boolean);

  // Highlight active link on scroll
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach(entry => {
        const link = nav.querySelector(`.quicknav-link[data-target="${entry.target.id}"]`);
        if (entry.isIntersecting) {
          links.forEach(l => l.classList.remove('active'));
          link.classList.add('active');
        }
      });
    },
    { rootMargin: '-30% 0px -60% 0px', threshold: 0 }
  );

  sections.forEach(sec => observer.observe(sec));
})();



(function () {
  const nav = document.getElementById('quicknav');
  const header = document.querySelector('header');
  if (!nav || !header) return;

  function syncQuicknavTop() {
    nav.style.top = header.offsetHeight + 'px';
  }

  syncQuicknavTop();
  window.addEventListener('resize', syncQuicknavTop);
  window.addEventListener('scroll', syncQuicknavTop, { passive: true });
})();






// Review

(function () {
  const form = document.getElementById('revwForm');
  if (!form) return;

  const stars = document.querySelectorAll('#revwStars .revw-star');
  const ratingInput = document.getElementById('revwRatingInput');
  stars.forEach(s => s.addEventListener('click', () => {
    const val = parseInt(s.dataset.val);
    ratingInput.value = val;
    stars.forEach(st => st.classList.toggle('active', parseInt(st.dataset.val) <= val));
  }));

  const pct = document.getElementById('revwPct');
  const pctLabel = document.getElementById('revwPctLabel');
  pct.addEventListener('input', () => pctLabel.textContent = pct.value);

  form.addEventListener('submit', function (e) {
    e.preventDefault();
    const errEl = document.getElementById('revwError');
    if (ratingInput.value === '0') {
      errEl.textContent = 'Please select a star rating.';
      errEl.style.display = 'block';
      return;
    }
    const fd = new FormData(form);
    fetch('<?php echo BASE_URL; ?>files/api/submit_review.php', { method: 'POST', body: fd })
      .then(r => r.json())
      .then(data => {
        if (data.success) {
          window.location.reload();
        } else {
          errEl.textContent = data.error || 'Something went wrong.';
          errEl.style.display = 'block';
        }
      });
  });
})();

// Yaafta Special Rating — hero card
(function () {
  const card = document.getElementById('ysrCard');
  if (!card) return;

  const restaurantId = card.dataset.restaurantId;
  const sliders = card.querySelectorAll('.ysr-slider');
  const scoreNum = document.getElementById('ysrScoreNum');
  const scoreFill = document.getElementById('ysrScoreFill');
  const submitBtn = document.getElementById('ysrSubmitBtn');
  const hint = document.getElementById('ysrHint');
  const resultsBox = document.getElementById('ysrResults');

  function colorForPct(pct) {
    const mix = Math.round(pct);
    return `color-mix(in srgb, #ff5900 ${100 - mix}%, #00f5d4 ${mix}%)`;
  }

  function updateLive() {
    let total = 0;
    sliders.forEach(s => {
      total += parseInt(s.value);
      const valSpan = card.querySelector(`.ysr-field-val[data-for="${
        s.dataset.metric === 'value_for_money' ? 'value' :
        s.dataset.metric === 'influencer_accuracy' ? 'influencer' : 'recommend'
      }"]`);
      if (valSpan) valSpan.textContent = s.value;
    });
    const avg = Math.round(total / sliders.length);
    scoreNum.innerHTML = avg + '<small>%</small>';
    scoreFill.style.width = avg + '%';
    const col = colorForPct(avg);
    scoreFill.style.background = col;
    scoreNum.style.color = col;
  }

  sliders.forEach(s => s.addEventListener('input', updateLive));
  updateLive();

  submitBtn.addEventListener('click', () => {
    submitBtn.disabled = true;
    submitBtn.textContent = 'Submitting...';

    const fd = new FormData();
    fd.append('restaurant_id', restaurantId);
    sliders.forEach(s => fd.append(s.dataset.metric, s.value));

    fetch('https://yaafta.com/files/api/yaafta_special_rate.php', { method: 'POST', body: fd })
      .then(r => r.json())
      .then(data => {
        if (data.success) {
          resultsBox.innerHTML = `Community average from <strong>${data.vote_count}</strong> rating${data.vote_count == 1 ? '' : 's'}: Value ${data.avg_value}% &middot; Hype ${data.avg_influencer}% &middot; Recommend ${data.avg_recommend}% &middot; Overall <strong>${data.overall_avg}%</strong>`;
          resultsBox.style.display = 'block';
          hint.style.display = 'none';
          submitBtn.textContent = 'Submitted ✓';
          sliders.forEach(s => s.disabled = true);
        } else {
          submitBtn.disabled = false;
          submitBtn.textContent = 'Submit Rating';
          alert('Something went wrong, try again.');
        }
      })
      .catch(() => {
        submitBtn.disabled = false;
        submitBtn.textContent = 'Submit Rating';
        alert('Network error, try again.');
      });
  });
})();