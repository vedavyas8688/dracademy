<style>
  .dra-recent-wrap{
    border-top:1px solid #e7eef6;
    background:#f8fbff;
    padding:30px 34px 34px;
  }

  .dra-recent-head{
    display:flex;
    align-items:flex-end;
    justify-content:space-between;
    gap:18px;
    margin-bottom:18px;
  }

  .dra-recent-head h2{
    margin:0;
    color:#123d7a;
    font-size:28px;
    font-weight:800;
  }

  .dra-recent-head a{
    color:#123d7a;
    font-weight:800;
    text-decoration:none;
  }

  .dra-recent-grid{
    display:grid;
    grid-template-columns:repeat(3, minmax(0, 1fr));
    gap:18px;
  }

  .dra-recent-card{
    display:flex;
    flex-direction:column;
    min-height:100%;
    border:1px solid #dfe8f2;
    border-radius:12px;
    background:#ffffff;
    overflow:hidden;
    text-decoration:none;
    box-shadow:0 10px 24px rgba(18,61,122,.07);
    transition:transform .2s ease, box-shadow .2s ease;
  }

  .dra-recent-card:hover{
    transform:translateY(-3px);
    box-shadow:0 16px 32px rgba(18,61,122,.12);
  }

  .dra-recent-thumb{
    width:100%;
    aspect-ratio:16 / 9;
    object-fit:cover;
    background:#eaf1f8;
    display:block;
  }

  .dra-recent-body{
    padding:14px;
  }

  .dra-recent-date{
    display:inline-flex;
    width:max-content;
    margin-bottom:10px;
    border-radius:999px;
    background:#eef6ff;
    color:#1262b3;
    padding:6px 10px;
    font-size:12px;
    font-weight:800;
  }

  .dra-recent-title{
    margin:0 0 9px;
    color:#102c4c;
    font-size:17px;
    line-height:1.35;
    font-weight:800;
  }

  .dra-recent-desc{
    margin:0;
    color:#617489;
    font-size:14px;
    line-height:1.55;
  }

  .dra-recent-empty{
    grid-column:1 / -1;
    border:1px solid #dfe8f2;
    border-radius:12px;
    background:#ffffff;
    padding:18px;
    color:#617489;
  }

  @media(max-width:991px){
    .dra-recent-grid{ grid-template-columns:repeat(2, minmax(0, 1fr)); }
  }

  @media(max-width:767px){
    .dra-recent-wrap{ padding:24px 20px 28px; }
    .dra-recent-head{ align-items:flex-start; flex-direction:column; }
    .dra-recent-grid{ grid-template-columns:1fr; }
  }
</style>

<section class="dra-recent-wrap" aria-labelledby="draRecentBlogsTitle">
  <div class="dra-recent-head">
    <h2 id="draRecentBlogsTitle">Recent Blogs</h2>
    <a href="../blog.php">View All Blogs</a>
  </div>

  <div class="dra-recent-grid" id="draRecentBlogsGrid">
    <div class="dra-recent-empty">Loading recent blogs...</div>
  </div>
</section>

<script>
  (function () {
    const grid = document.getElementById('draRecentBlogsGrid');
    if (!grid) return;

    function escapeHtml(text) {
      const div = document.createElement('div');
      div.textContent = text || '';
      return div.innerHTML;
    }

    function normalizeDate(dateString) {
      return /^\d{4}-\d{2}-\d{2}$/.test(String(dateString || '')) ? dateString : '1970-01-01';
    }

    function formatDate(dateString) {
      const safeDate = normalizeDate(dateString);
      const parts = safeDate.split('-');
      const date = new Date(Number(parts[0]), Number(parts[1]) - 1, Number(parts[2]));

      return date.toLocaleDateString('en-IN', {
        day: '2-digit',
        month: 'short',
        year: 'numeric'
      });
    }

    function sortRecentBlogs(blogs) {
      return blogs.sort((a, b) => {
        const dateA = new Date(normalizeDate(a.date)).getTime();
        const dateB = new Date(normalizeDate(b.date)).getTime();

        if (dateA !== dateB) {
          return dateB - dateA;
        }

        return String(a.title || '').localeCompare(String(b.title || ''));
      });
    }

    function renderRecentBlogs(blogs) {
      if (!blogs.length) {
        grid.innerHTML = '<div class="dra-recent-empty">No recent blogs found.</div>';
        return;
      }

      grid.innerHTML = blogs.map(blog => `
        <a class="dra-recent-card" href="../${encodeURI(blog.url || '#')}">
          <img class="dra-recent-thumb" src="../${encodeURI(blog.thumbnail || 'blogs/images/tmbnl/tmbnl-003.png')}" alt="${escapeHtml(blog.title || 'Blog image')}" loading="lazy">
          <div class="dra-recent-body">
            <span class="dra-recent-date">${escapeHtml(formatDate(blog.date))}</span>
            <h3 class="dra-recent-title">${escapeHtml(blog.title || 'Untitled Blog')}</h3>
            <p class="dra-recent-desc">${escapeHtml(blog.description || '')}</p>
          </div>
        </a>
      `).join('');
    }

    fetch('../fetch.php', { cache: 'no-store' })
      .then(response => response.json())
      .then(data => {
        if (!Array.isArray(data)) {
          throw new Error('Invalid blog feed');
        }

        const recentBlogs = sortRecentBlogs(data).slice(0, 5);

        renderRecentBlogs(recentBlogs);
      })
      .catch(() => {
        grid.innerHTML = '<div class="dra-recent-empty">Unable to load recent blogs.</div>';
      });
  })();
</script>
