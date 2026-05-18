@extends('layouts.app')

@section('title') Blog @endsection

@section('css')
<style>
    .blog-page { display:flex; flex-direction:column; gap:22px; width:100%; }

    /* Flash messages */
    .adm-flash { padding:12px 18px; border-radius:10px; font-size:14px; margin-bottom:4px; }
    .adm-flash.success { background:#f0fdf4; border:1px solid #bbf7d0; color:#15803d; }
    .adm-flash.error   { background:#fef2f2; border:1px solid #fecaca; color:#dc2626; }

    /* Toolbar */
    .blog-toolbar { display:flex; align-items:center; justify-content:space-between; gap:14px; flex-wrap:wrap; }

    /* Table */
    .blog-table-wrap { background:#fff; border-radius:16px; box-shadow:0 2px 16px rgba(13,31,53,.06); overflow:hidden; }
    .blog-table { width:100%; border-collapse:collapse; }
    .blog-table thead tr { background:#f8f9fb; }
    .blog-table th { padding:14px 18px; font-size:12px; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:.6px; border-bottom:1px solid #e8ecf2; white-space:nowrap; }
    .blog-table td { padding:14px 18px; font-size:14px; color:#374151; border-bottom:1px solid #f0f2f7; vertical-align:middle; }
    .blog-table tr:last-child td { border-bottom:none; }
    .blog-table tr:hover td { background:#fafbfc; }

    .blog-cover { width:64px; height:48px; object-fit:cover; border-radius:8px; background:#f0f2f7; display:block; }
    .blog-no-img { width:64px; height:48px; border-radius:8px; background:#f0f2f7; display:flex; align-items:center; justify-content:center; color:#bbb; font-size:18px; }

    .blog-title-cell { font-weight:600; color:#182b39; max-width:260px; }
    .blog-excerpt-cell { color:#666; font-size:13px; max-width:200px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }

    .cat-badge { display:inline-block; padding:3px 10px; border-radius:50px; font-size:12px; font-weight:600; }
    .cat-news     { background:#e0f2fe; color:#0369a1; }
    .cat-event    { background:#ede9fe; color:#7c3aed; }
    .cat-tour     { background:#fff0e8; color:#C85A2A; }
    .cat-upcoming { background:#dcfce7; color:#16a34a; }

    .pub-badge { display:inline-flex; align-items:center; gap:5px; font-size:12px; font-weight:600; }
    .pub-badge.yes { color:#16a34a; }
    .pub-badge.no  { color:#9ca3af; }

    .tbl-actions { display:flex; gap:8px; }
    .btn-tbl-edit { background:#0f5f86; color:#fff; border:none; border-radius:7px; padding:6px 14px; font-size:12px; font-weight:600; cursor:pointer; transition:background .2s; }
    .btn-tbl-edit:hover { background:#0c4d6d; }
    .btn-tbl-del { background:#fff; color:#e74c3c; border:1px solid #e74c3c; border-radius:7px; padding:6px 14px; font-size:12px; font-weight:600; cursor:pointer; transition:all .2s; }
    .btn-tbl-del:hover { background:#e74c3c; color:#fff; }

    .no-posts { text-align:center; padding:60px 20px; color:#bbb; }
    .no-posts i { font-size:36px; display:block; margin-bottom:12px; }

    /* ── Modal ── */
    .adm-modal-overlay { position:fixed; top:0; left:0; right:0; bottom:0; background:rgba(0,0,0,.48); display:flex; align-items:center; justify-content:center; z-index:2000; padding:16px; }
    .adm-modal { background:#fff; border-radius:16px; padding:28px 32px; max-width:720px; width:100%; max-height:92vh; overflow-y:auto; }
    .adm-modal-head { display:flex; justify-content:space-between; align-items:center; margin-bottom:22px; }
    .adm-modal-head h3 { font-size:18px; font-weight:700; color:#1a1a2e; margin:0; }
    .adm-modal-close { background:none; border:none; font-size:22px; cursor:pointer; color:#aaa; }
    .adm-modal-close:hover { color:#333; }

    .adm-form-row { display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:16px; }
    .adm-form-row.single { grid-template-columns:1fr; }
    .adm-form-group { display:flex; flex-direction:column; }
    .adm-form-group label { font-size:13px; font-weight:600; color:#444; margin-bottom:6px; }
    .adm-form-group input,
    .adm-form-group textarea,
    .adm-form-group select { padding:10px 14px; border:1.5px solid #e0e0e0; border-radius:8px; font-size:14px; outline:none; font-family:inherit; background:#fff; color:#1a1a2e; }
    .adm-form-group input:focus,
    .adm-form-group textarea:focus,
    .adm-form-group select:focus { border-color:#0D1F35; }
    .adm-form-group textarea { resize:vertical; min-height:120px; }

    .adm-check-row { display:flex; align-items:center; gap:8px; font-size:14px; color:#444; margin-bottom:16px; }
    .adm-check-row input[type=checkbox] { width:16px; height:16px; accent-color:#0D1F35; cursor:pointer; }

    /* Image preview */
    .img-preview-box { margin-top:8px; }
    .img-preview-box img { width:100%; max-height:160px; object-fit:cover; border-radius:8px; display:block; }

    .adm-modal-foot { display:flex; justify-content:flex-end; border-top:1px solid #f0f0f0; padding-top:18px; margin-top:8px; }
    .btn-save { background:#0D1F35; color:#fff; border:none; padding:11px 28px; border-radius:8px; font-size:14px; font-weight:600; cursor:pointer; }
    .btn-save:hover { background:#1e3a5f; }

    /* ── Responsive ── */
    @media (max-width: 991px) {
        .blog-table-wrap { overflow-x: auto; -webkit-overflow-scrolling: touch; }
        .blog-table { min-width: 700px; }
    }

    @media (max-width: 767px) {
        .blog-page { gap: 16px; }

        /* Toolbar stacks on mobile */
        .blog-toolbar { flex-direction: column; align-items: flex-start; gap: 10px; }
        .blog-toolbar .admin-primary-btn { width: 100%; justify-content: center; }

        /* Table horizontally scrollable */
        .blog-table-wrap { overflow-x: auto; -webkit-overflow-scrolling: touch; border-radius: 12px; }
        .blog-table { min-width: 600px; }
        .blog-table th,
        .blog-table td { padding: 10px 12px; }

        /* Hide excerpt on small screens to save space */
        .blog-excerpt-cell { display: none; }
        .blog-title-cell { max-width: none; font-size: 13px; }

        /* Modal takes full screen width */
        .adm-modal-overlay { padding: 0; align-items: flex-end; }
        .adm-modal {
            border-radius: 18px 18px 0 0;
            padding: 22px 18px 28px;
            max-height: 92vh;
            width: 100%;
            max-width: 100%;
        }
        .adm-modal-head h3 { font-size: 16px; }

        /* Collapse 2-col form rows to 1 col */
        .adm-form-row { grid-template-columns: 1fr !important; }
        .adm-form-group[style*="grid-column"] { grid-column: auto !important; }

        /* Full-width save button */
        .adm-modal-foot { justify-content: stretch; }
        .btn-save { width: 100%; text-align: center; padding: 13px 20px; }
    }

    @media (max-width: 480px) {
        /* Hide cover column, rely on title info */
        .blog-table { min-width: 420px; }
        .blog-table .cover-col { display: none; }
        .btn-tbl-edit,
        .btn-tbl-del { padding: 5px 10px; font-size: 11px; }
        .tbl-actions { gap: 6px; }
    }
</style>
@endsection

@section('content')
<div class="blog-page">

    @include('layouts.partials.admin_topbar', ['title' => 'Blog', 'searchInputId' => 'blogSearch', 'searchAriaLabel' => 'Search posts'])

    @if(session('success'))
        <div class="adm-flash success"><i class="fas fa-check-circle" style="margin-right:6px"></i>{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="adm-flash error"><i class="fas fa-exclamation-circle" style="margin-right:6px"></i>{{ session('error') }}</div>
    @endif

    <div class="blog-toolbar">
        <span style="font-size:14px;color:#666;">{{ $posts->count() }} post{{ $posts->count() !== 1 ? 's' : '' }}</span>
        <button class="admin-primary-btn" type="button" onclick="openAddModal()">
            <i class="fas fa-plus"></i> New Post
        </button>
    </div>

    <div class="blog-table-wrap">
        @if($posts->count())
        <table class="blog-table">
            <thead>
                <tr>
                    <th class="cover-col">Cover</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="blogTableBody">
                @foreach($posts as $post)
                <tr class="blog-row">
                    <td class="cover-col">
                        @if($post->image)
                            <img src="{{ $post->image }}" alt="{{ $post->title }}" class="blog-cover">
                        @else
                            <div class="blog-no-img"><i class="fas fa-image"></i></div>
                        @endif
                    </td>
                    <td>
                        <div class="blog-title-cell">{{ $post->title }}</div>
                        @if($post->excerpt)
                            <div class="blog-excerpt-cell">{{ Str::limit($post->excerpt, 80) }}</div>
                        @endif
                    </td>
                    <td><span class="cat-badge cat-{{ $post->category }}">{{ $post->category_label }}</span></td>
                    <td>
                        @if($post->published)
                            <span class="pub-badge yes"><i class="fas fa-circle" style="font-size:7px"></i> Published</span>
                        @else
                            <span class="pub-badge no"><i class="fas fa-circle" style="font-size:7px"></i> Draft</span>
                        @endif
                    </td>
                    <td style="white-space:nowrap;font-size:13px;color:#666;">
                        {{ $post->published_at ? $post->published_at->format('M j, Y') : $post->created_at->format('M j, Y') }}
                    </td>
                    <td>
                        <div class="tbl-actions">
                            <button class="btn-tbl-edit" onclick="openEditModal({{ $post->id }})">Edit</button>
                            <button class="btn-tbl-del"  onclick="deletePost({{ $post->id }})">Delete</button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="no-posts">
            <i class="fas fa-newspaper"></i>
            No blog posts yet. Create your first post!
        </div>
        @endif
    </div>
</div>

{{-- ── Add Modal ── --}}
<div class="adm-modal-overlay" id="addModal" style="display:none;">
    <div class="adm-modal">
        <div class="adm-modal-head">
            <h3>New Post</h3>
            <button class="adm-modal-close" onclick="document.getElementById('addModal').style.display='none'">&times;</button>
        </div>
        <form action="{{ route('blog.admin.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="adm-form-row">
                <div class="adm-form-group" style="grid-column:1/-1">
                    <label>Title <span style="color:#e74c3c">*</span></label>
                    <input type="text" name="title" placeholder="Post title" required>
                </div>
            </div>
            <div class="adm-form-row">
                <div class="adm-form-group">
                    <label>Category</label>
                    <select name="category">
                        <option value="news">News</option>
                        <option value="event">Event</option>
                        <option value="tour">Tour</option>
                        <option value="upcoming">Upcoming</option>
                    </select>
                </div>
                <div class="adm-form-group">
                    <label>Cover Image</label>
                    <input type="file" name="image" accept="image/*" onchange="previewImg(this,'addPreview')">
                    <div class="img-preview-box" id="addPreview"></div>
                </div>
            </div>
            <div class="adm-form-row single">
                <div class="adm-form-group">
                    <label>Excerpt <span style="font-weight:400;color:#999">(short summary shown on the blog list)</span></label>
                    <textarea name="excerpt" rows="2" placeholder="Brief summary of this post..."></textarea>
                </div>
            </div>
            <div class="adm-form-row single">
                <div class="adm-form-group">
                    <label>Content <span style="font-weight:400;color:#999">(full article)</span></label>
                    <textarea name="content" rows="8" placeholder="Write your full post content here..."></textarea>
                </div>
            </div>
            <div class="adm-check-row">
                <input type="checkbox" name="published" id="addPublished">
                <label for="addPublished">Publish immediately</label>
            </div>
            <div class="adm-modal-foot">
                <button type="submit" class="btn-save">Create Post</button>
            </div>
        </form>
    </div>
</div>

{{-- ── Edit Modal ── --}}
<div class="adm-modal-overlay" id="editModal" style="display:none;">
    <div class="adm-modal">
        <div class="adm-modal-head">
            <h3>Edit Post</h3>
            <button class="adm-modal-close" onclick="document.getElementById('editModal').style.display='none'">&times;</button>
        </div>
        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="adm-form-row">
                <div class="adm-form-group" style="grid-column:1/-1">
                    <label>Title <span style="color:#e74c3c">*</span></label>
                    <input type="text" name="title" id="editTitle" required>
                </div>
            </div>
            <div class="adm-form-row">
                <div class="adm-form-group">
                    <label>Category</label>
                    <select name="category" id="editCategory">
                        <option value="news">News</option>
                        <option value="event">Event</option>
                        <option value="tour">Tour</option>
                        <option value="upcoming">Upcoming</option>
                    </select>
                </div>
                <div class="adm-form-group">
                    <label>Cover Image <span style="font-weight:400;color:#999">(leave blank to keep current)</span></label>
                    <input type="file" name="image" accept="image/*" onchange="previewImg(this,'editPreview')">
                    <div class="img-preview-box" id="editPreview"></div>
                </div>
            </div>
            <div class="adm-form-row single">
                <div class="adm-form-group">
                    <label>Excerpt</label>
                    <textarea name="excerpt" id="editExcerpt" rows="2"></textarea>
                </div>
            </div>
            <div class="adm-form-row single">
                <div class="adm-form-group">
                    <label>Content</label>
                    <textarea name="content" id="editContent" rows="8"></textarea>
                </div>
            </div>
            <div class="adm-check-row">
                <input type="checkbox" name="published" id="editPublished">
                <label for="editPublished">Published</label>
            </div>
            <div class="adm-modal-foot">
                <button type="submit" class="btn-save">Save Changes</button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
function openAddModal() {
    document.getElementById('addModal').style.display = 'flex';
}

function openEditModal(id) {
    fetch('/admin/blog/' + id + '/data')
        .then(r => r.json())
        .then(data => {
            document.getElementById('editForm').action = '/admin/blog/' + id;
            document.getElementById('editTitle').value    = data.title    || '';
            document.getElementById('editCategory').value = data.category || 'news';
            document.getElementById('editExcerpt').value  = data.excerpt  || '';
            document.getElementById('editContent').value  = data.content  || '';
            document.getElementById('editPublished').checked = data.published;

            var prev = document.getElementById('editPreview');
            prev.innerHTML = data.image
                ? '<img src="' + data.image + '" alt="cover">'
                : '';

            document.getElementById('editModal').style.display = 'flex';
        });
}

function deletePost(id) {
    if (!confirm('Delete this post permanently?')) return;
    var csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var form = document.createElement('form');
    form.method = 'POST';
    form.action = '/admin/blog/' + id;
    [['_token', csrf], ['_method', 'DELETE']].forEach(function(p) {
        var inp = document.createElement('input');
        inp.type = 'hidden'; inp.name = p[0]; inp.value = p[1];
        form.appendChild(inp);
    });
    document.body.appendChild(form);
    form.submit();
}

function previewImg(input, previewId) {
    if (!input.files || !input.files[0]) return;
    var reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById(previewId).innerHTML = '<img src="' + e.target.result + '">';
    };
    reader.readAsDataURL(input.files[0]);
}

// Search
document.addEventListener('DOMContentLoaded', function() {
    var si = document.getElementById('blogSearch');
    if (si) si.addEventListener('input', function() {
        var val = si.value.toLowerCase();
        document.querySelectorAll('.blog-row').forEach(function(row) {
            row.style.display = row.textContent.toLowerCase().includes(val) ? '' : 'none';
        });
    });
});
</script>
@endsection
