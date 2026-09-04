<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('letter-a-block.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Add Listing — AgoraTrade</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Roboto', sans-serif; }

        body { display: flex; min-height: 100vh; background: #f8f9fa; }

        /* ── Sidebar (same as dashboard) ── */
        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: #1a1a1a;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0;
            z-index: 100;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 24px 24px 20px;
            border-bottom: 1px solid #2e2e2e;
        }

        .sidebar-brand img { width: 38px; height: 38px; }
        .sidebar-brand-text { font-size: 20px; font-weight: bold; color: #fff; }
        .sidebar-brand-text span { color: #ffe0a9; }

        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 16px 24px;
            border-bottom: 1px solid #2e2e2e;
        }

        .sidebar-avatar {
            width: 38px; height: 38px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #ffe0a9;
        }

        .sidebar-username { font-size: 13px; font-weight: bold; color: #fff; }
        .sidebar-role { font-size: 11px; color: #888; }

        .sidebar-nav { flex: 1; padding: 16px 0; }

        .nav-section-label {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #555;
            padding: 12px 24px 6px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 24px;
            color: #aaa;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }

        .nav-item:hover { color: #fff; background: #252525; border-left-color: #ffe0a9; }
        .nav-item.active { color: #ffe0a9; background: #252525; border-left-color: #ffe0a9; font-weight: bold; }
        .nav-item svg { width: 18px; height: 18px; flex-shrink: 0; }

        .sidebar-footer {
            padding: 16px 24px;
            border-top: 1px solid #2e2e2e;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .sidebar-footer a {
            display: flex; align-items: center; gap: 10px;
            font-size: 13px; color: #888; text-decoration: none;
            padding: 8px 0; transition: color 0.2s;
        }

        .sidebar-footer a:hover { color: #fff; }

        .sidebar-footer form button {
            display: flex; align-items: center; gap: 10px;
            background: none; border: none;
            font-size: 13px; color: #888;
            cursor: pointer; padding: 8px 0;
            transition: color 0.2s; width: 100%;
        }

        .sidebar-footer form button:hover { color: #e74c3c; }

        /* ── Main ── */
        .main { margin-left: 260px; flex: 1; display: flex; flex-direction: column; min-height: 100vh; }

        .topbar {
            background: #fff;
            border-bottom: 1px solid #eee;
            padding: 16px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .topbar-title { font-size: 20px; font-weight: bold; color: #333; }
        .topbar-sub { font-size: 13px; color: #999; margin-top: 2px; }

        .content { padding: 28px 32px; flex: 1; }

        /* ── Form layout ── */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 24px;
            align-items: start;
        }

        .card {
            background: #fff;
            border-radius: 15px 0 15px 0;
            padding: 24px;
            border: 1px solid #eee;
            margin-bottom: 20px;
        }

        .card:last-child { margin-bottom: 0; }

        .card-title {
            font-size: 15px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 1px solid #f0f0f0;
        }

        .form-group { margin-bottom: 18px; }
        .form-group:last-child { margin-bottom: 0; }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: bold;
            color: #555;
            margin-bottom: 6px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 11px 14px;
            border: 1px solid #ddd;
            border-radius: 15px 0 15px 0;
            font-size: 14px;
            color: #333;
            outline: none;
            transition: border-color 0.2s;
            background: #fff;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: #ffe0a9;
        }

        .form-group textarea { resize: vertical; min-height: 120px; }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .price-wrap { position: relative; }
        .price-wrap input { padding-left: 28px; }
        .price-symbol {
            position: absolute;
            left: 12px; top: 50%;
            transform: translateY(-50%);
            color: #999; font-size: 14px;
        }

        /* ── Image upload ── */
        .file-upload-label {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            padding: 11px 14px;
            border: 1px dashed #ddd;
            border-radius: 15px 0 15px 0;
            font-size: 14px;
            color: #999;
            cursor: pointer;
            transition: border-color 0.2s, background 0.2s;
        }

        .file-upload-label:hover { border-color: #ffe0a9; background: #fffaf3; }
        .file-upload-wrapper input[type="file"] { display: none; }

        .image-preview {
            display: none;
            position: relative;
            margin-top: 12px;
        }

        .image-preview img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-radius: 15px 0 15px 0;
            border: 1px solid #eee;
        }

        .remove-preview {
            position: absolute;
            top: 8px; right: 8px;
            background: #1a1a1a;
            color: #fff;
            border-radius: 50%;
            width: 24px; height: 24px;
            font-size: 12px;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
        }

        .remove-preview:hover { background: #e74c3c; }

        /* ── Condition selector ── */
        .condition-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
        }

        .condition-option input[type="radio"] { display: none; }

        .condition-option label {
            display: block;
            text-align: center;
            padding: 10px 6px;
            border: 1px solid #ddd;
            border-radius: 15px 0 15px 0;
            font-size: 12px;
            font-weight: bold;
            color: #777;
            cursor: pointer;
            transition: all 0.2s;
        }

        .condition-option input:checked + label {
            border-color: #ffe0a9;
            background: #fffaf3;
            color: #333;
        }

        .condition-option label:hover { border-color: #ffe0a9; }

        /* ── Buttons ── */
        .btn-row {
            display: flex;
            gap: 12px;
            margin-top: 4px;
        }

        .gold-btn {
            flex: 1;
            padding: 13px;
            background: #ffe0a9;
            border: none;
            border-radius: 15px 0 15px 0;
            font-size: 14px;
            font-weight: bold;
            color: #555;
            cursor: pointer;
            text-align: center;
            transition: background 0.2s;
        }

        .gold-btn:hover { background: #f7d9a3; }

        .outline-btn {
            flex: 1;
            padding: 13px;
            background: none;
            border: 1px solid #ddd;
            border-radius: 15px 0 15px 0;
            font-size: 14px;
            font-weight: bold;
            color: #777;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            display: block;
            transition: all 0.2s;
        }

        .outline-btn:hover { border-color: #333; color: #333; }

        /* ── Alerts ── */
        .alert-error {
            background: #FCEBEB;
            border: 1px solid #F09595;
            border-radius: 15px 0 15px 0;
            padding: 12px 16px;
            margin-bottom: 20px;
            font-size: 13px;
            color: #A32D2D;
        }

        .alert-success {
            background: #EAF3DE;
            border: 1px solid #97C459;
            border-radius: 15px 0 15px 0;
            padding: 12px 16px;
            margin-bottom: 20px;
            font-size: 13px;
            color: #3B6D11;
        }

        .hint { font-size: 11px; color: #999; margin-top: 4px; }

        footer {
            background: #fff;
            border-top: 1px solid #eee;
            text-align: center;
            color: #999;
            font-size: 12px;
            padding: 16px;
        }
    </style>
</head>
<body>

{{-- ── SIDEBAR ── --}}
<aside class="sidebar">
    <div class="sidebar-brand">
        <img src="{{ asset('letter-a-block.png') }}" alt="Logo">
        <div class="sidebar-brand-text"><span>Agora</span>Trade</div>
    </div>
    <div class="sidebar-user">
        @if(Auth::user()->profile_picture)
            <img src="{{ Storage::url(Auth::user()->profile_picture) }}" class="sidebar-avatar">
        @else
            <img src="{{ asset('user.png') }}" class="sidebar-avatar">
        @endif
        <div>
            <div class="sidebar-username">{{ Auth::user()->username }}</div>
            <div class="sidebar-role">Seller</div>
        </div>
    </div>
    <nav class="sidebar-nav">
        <div class="nav-section-label">Main</div>
        <a href="{{ url('/dashboard') }}" class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
            Dashboard
        </a>
        <a href="{{ url('/listings') }}" class="nav-item {{ request()->is('listings') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="1"/><line x1="9" y1="12" x2="15" y2="12"/><line x1="9" y1="16" x2="13" y2="16"/></svg>
            My Listings
        </a>
        <a href="{{ url('/listings/create') }}" class="nav-item {{ request()->is('listings/create') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
            Add Listing
        </a>
        <div class="nav-section-label">Commerce</div>
        <a href="{{ url('/orders') }}" class="nav-item {{ request()->is('orders*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
            Orders
        </a>
        <a href="{{ url('/purchases') }}" class="nav-item {{ request()->is('purchases*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
            Purchases
        </a>
    </nav>
    <div class="sidebar-footer">
        <a href="{{ url('/') }}">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            Return to Main Site
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                Log Out
            </button>
        </form>
    </div>
</aside>
{{-- ── MAIN ── --}}
<div class="main">
    <div class="topbar">
        <div>
            <div class="topbar-title">Add Listing</div>
            <div class="topbar-sub">Fill in the details to post your item for sale.</div>
        </div>
    </div>

    <div class="content">

        @if($errors->any())
        <div class="alert-error">
            <strong>Please fix the following:</strong><br>
            @foreach($errors->all() as $error)
                • {{ $error }}<br>
            @endforeach
        </div>
        @endif

        @if(session('success'))
        <div class="alert-success">
            ✓ {{ session('success') }}
        </div>
        @endif

        <form action="{{ route('listings.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-grid">

                {{-- Left column --}}
                <div>
                    <div class="card">
                        <div class="card-title">Item Details</div>

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" id="title" name="title" value="{{ old('title') }}" placeholder="e.g. Sony PlayStation 5 Pro 2TB — Like New" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" placeholder="Describe your item — condition, what's included, any flaws..." required>{{ old('description') }}</textarea>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select id="category" name="category" required>
                                    <option value="" disabled selected>Select a category</option>
                                    <option value="Antiques" {{ old('category') === 'Antiques' ? 'selected' : '' }}>Antiques</option>
                                    <option value="Art" {{ old('category') === 'Art' ? 'selected' : '' }}>Art</option>
                                    <option value="Books" {{ old('category') === 'Books' ? 'selected' : '' }}>Books</option>
                                    <option value="CellPhones & Accessories" {{ old('category') === 'CellPhones & Accessories' ? 'selected' : '' }}>CellPhones & Accessories</option>
                                    <option value="Clothing" {{ old('category') === 'Clothing' ? 'selected' : '' }}>Clothing</option>
                                    <option value="Computers/Tablets & Networking" {{ old('category') === 'Computers/Tablets & Networking' ? 'selected' : '' }}>Computers & Tablets</option>
                                    <option value="Health & Beauty" {{ old('category') === 'Health & Beauty' ? 'selected' : '' }}>Health & Beauty</option>
                                    <option value="Jewelry & Watches" {{ old('category') === 'Jewelry & Watches' ? 'selected' : '' }}>Jewelry & Watches</option>
                                    <option value="Music" {{ old('category') === 'Music' ? 'selected' : '' }}>Music</option>
                                    <option value="Pottery & Glass" {{ old('category') === 'Pottery & Glass' ? 'selected' : '' }}>Pottery & Glass</option>
                                    <option value="Sporting Goods" {{ old('category') === 'Sporting Goods' ? 'selected' : '' }}>Sporting Goods</option>
                                    <option value="Video Games & Consoles" {{ old('category') === 'Video Games & Consoles' ? 'selected' : '' }}>Video Games & Consoles</option>
                                    <option value="Everything Else" {{ old('category') === 'Everything Else' ? 'selected' : '' }}>Everything Else</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="price">Price</label>
                                <div class="price-wrap">
                                    <span class="price-symbol">$</span>
                                    <input type="number" id="price" name="price" value="{{ old('price') }}" placeholder="0.00" step="0.01" min="0" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Condition</label>
                            <div class="condition-grid">
                                @foreach(['Brand New', 'Like New', 'Very Good', 'Good', 'Acceptable', 'For Parts'] as $condition)
                                <div class="condition-option">
                                    <input type="radio" name="condition" id="cond_{{ $loop->index }}" value="{{ $condition }}" {{ old('condition') === $condition ? 'checked' : '' }}>
                                    <label for="cond_{{ $loop->index }}">{{ $condition }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="location">Location</label>
                            <input type="text" id="location" name="location" value="{{ old('location') }}" placeholder="e.g. Dar es Salaam, Tanzania">
                            <div class="hint">Buyers will see this to estimate shipping.</div>
                        </div>
                    </div>
                </div>

                {{-- Right column --}}
                <div>
                    <div class="card">
                        <div class="card-title">Item Photo</div>
                        <div class="form-group">
                            <div class="file-upload-wrapper">
                                <label for="image" class="file-upload-label">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="20px" width="20px" viewBox="0 0 512 512" fill="#aaa">
                                        <path d="M288 109.3V352c0 17.7-14.3 32-32 32s-32-14.3-32-32V109.3l-73.4 73.4c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l128-128c12.5-12.5 32.8-12.5 45.3 0l128 128c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L288 109.3zM64 352H192c0 35.3 28.7 64 64 64s64-28.7 64-64H448c35.3 0 64 28.7 64 64v32c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V416c0-35.3 28.7-64 64-64z"/>
                                    </svg>
                                    <span id="file-upload-text">Choose a photo</span>
                                </label>
                                <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(event)">
                            </div>
                            <div class="image-preview" id="image-preview">
                                <img id="preview-img" src="" alt="Preview">
                                <span class="remove-preview" onclick="removeImage()">✕</span>
                            </div>
                            <div class="hint">JPG, PNG or WEBP. Max 2MB.</div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-title">Publish</div>
                        <div class="btn-row">
                            <a href="{{ url('/listings') }}" class="outline-btn">Cancel</a>
                            <button type="submit" class="gold-btn">Post Listing</button>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <footer>© 2026 AgoraTrade Limited. All Rights Reserved.</footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
function previewImage(event) {
    const file = event.target.files[0];
    if (!file) return;
    const preview = document.getElementById('image-preview');
    const previewImg = document.getElementById('preview-img');
    const fileText = document.getElementById('file-upload-text');
    const reader = new FileReader();
    reader.onload = e => {
        previewImg.src = e.target.result;
        preview.style.display = 'block';
        fileText.textContent = file.name;
    };
    reader.readAsDataURL(file);
}

function removeImage() {
    document.getElementById('image-preview').style.display = 'none';
    document.getElementById('preview-img').src = '';
    document.getElementById('file-upload-text').textContent = 'Choose a photo';
    document.getElementById('image').value = '';
}
</script>
</body>
</html>