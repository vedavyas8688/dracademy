<style>
  .blog-sidebar{
    display:flex;
    flex-direction:column;
    gap:20px;
    position:sticky;
    top:104px;
    align-self:start;
  }

  .sidebar-card{
    background:#ffffff;
    border:1px solid #dfe8f2;
    border-radius:16px;
    box-shadow:0 12px 30px rgba(18,61,122,.08);
    overflow:hidden;
  }

  .sidebar-inner{
    padding:18px;
  }

  .sidebar-title{
    margin:0 0 8px;
    color:#123d7a;
    font-size:22px;
    line-height:1.25;
    font-weight:800;
  }

  .sidebar-text{
    margin:0 0 16px;
    color:#617489;
    font-size:14px;
    line-height:1.6;
  }

  .recent-side-list{
    display:flex;
    flex-direction:column;
    gap:14px;
  }

  .recent-side-item{
    display:block;
    border:1px solid #e3ebf4;
    border-radius:12px;
    background:#f9fbfe;
    text-decoration:none;
    overflow:hidden;
    transition:transform .2s ease, box-shadow .2s ease;
  }

  .recent-side-item:hover{
    transform:translateY(-2px);
    box-shadow:0 12px 24px rgba(18,61,122,.10);
  }

  .recent-side-thumb{
    display:block;
    width:100%;
    aspect-ratio:16 / 9;
    object-fit:cover;
    background:#edf4fb;
  }

  .recent-side-body{
    padding:12px;
  }

  .recent-side-date{
    display:inline-flex;
    margin-bottom:8px;
    border-radius:999px;
    background:#eef6ff;
    color:#1262b3;
    padding:5px 9px;
    font-size:12px;
    font-weight:800;
  }

  .recent-side-title{
    margin:0 0 8px;
    color:#102c4c;
    font-size:16px;
    line-height:1.35;
    font-weight:800;
  }

  .recent-side-desc{
    margin:0;
    color:#617489;
    font-size:13px;
    line-height:1.55;
  }

  .sidebar-link-btn{
    display:flex;
    align-items:center;
    justify-content:center;
    width:100%;
    margin-top:16px;
    border:1px solid #d6e3f2;
    border-radius:10px;
    padding:12px 14px;
    color:#123d7a;
    background:#ffffff;
    text-decoration:none;
    font-weight:800;
  }

  .ad-label{
    border-bottom:1px solid #eed9b5;
    background:#fff4df;
    color:#9a5b00;
    padding:11px 14px;
    font-size:12px;
    font-weight:800;
    letter-spacing:1px;
    text-transform:uppercase;
  }

  .ad-body{
    padding:14px;
  }

  .sidebar-empty{
    border:1px solid #e3ebf4;
    border-radius:12px;
    background:#f9fbfe;
    color:#617489;
    padding:14px;
    font-size:14px;
  }

  @media(max-width:991px){
    .blog-sidebar{
      position:static;
    }
  }
</style>

<aside class="blog-sidebar">
  <div class="sidebar-card">
    <div class="sidebar-inner">
      <h2 class="sidebar-title">Recent Blogs</h2>
      <p class="sidebar-text">Read more useful articles from DR Academy.</p>

      <div class="recent-side-list" id="blogSidebarRecentGrid">
        <div class="sidebar-empty">Loading recent blogs...</div>
      </div>

      <a class="sidebar-link-btn" href="../blog.php">View All Blogs</a>
    </div>
  </div>

  <div class="sidebar-card">
    <div class="ad-label">Advertisement</div>
    <div class="ad-body">
      <?php include __DIR__ . '/../../includes/slider.php'; ?>
    </div>
  </div>
</aside>

<script>
  (function () {
    const grid = document.getElementById('blogSidebarRecentGrid');
    if (!grid) return;

    const currentBlogFile = window.location.pathname.split('/').pop().toLowerCase();

    function escapeHtml(text) {
      const div = document.createElement('div');
      div.textContent = text || '';
      return div.innerHTML;
    }

    function normalizeDate(dateString) {
      return /^\d{4}-\d{2}-\d{2}$/.test(String(dateString || '')) ? dateString : '1970-01-01';
    }

    function formatDate(dateString) {
      const parts = normalizeDate(dateString).split('-');
      const date = new Date(Number(parts[0]), Number(parts[1]) - 1, Number(parts[2]));

      return date.toLocaleDateString('en-IN', {
        day: '2-digit',
        month: 'short',
        year: 'numeric'
      });
    }

    function sortBlogs(blogs) {
      return blogs.sort((a, b) => {
        const dateA = new Date(normalizeDate(a.date)).getTime();
        const dateB = new Date(normalizeDate(b.date)).getTime();

        if (dateA !== dateB) {
          return dateB - dateA;
        }

        return String(a.title || '').localeCompare(String(b.title || ''));
      });
    }

    function renderBlogs(blogs) {
      if (!blogs.length) {
        grid.innerHTML = '<div class="sidebar-empty">No recent blogs found.</div>';
        return;
      }

      grid.innerHTML = blogs.map(blog => `
        <a class="recent-side-item" href="../${encodeURI(blog.url || '#')}">
          <img class="recent-side-thumb" src="../${encodeURI(blog.thumbnail || 'blogs/images/tmbnl/tmbnl-003.png')}" alt="${escapeHtml(blog.title || 'Blog image')}" loading="lazy">
          <div class="recent-side-body">
            <span class="recent-side-date">${escapeHtml(formatDate(blog.date))}</span>
            <h3 class="recent-side-title">${escapeHtml(blog.title || 'Untitled Blog')}</h3>
            <p class="recent-side-desc">${escapeHtml(blog.description || '')}</p>
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

        const recentBlogs = sortBlogs(data)
          .filter(blog => String((blog.url || '').split('/').pop()).toLowerCase() !== currentBlogFile)
          .slice(0, 5);

        renderBlogs(recentBlogs);
      })
      .catch(() => {
        grid.innerHTML = '<div class="sidebar-empty">Unable to load recent blogs.</div>';
      });
  })();
</script>
