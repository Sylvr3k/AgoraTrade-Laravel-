<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('letter-a-block.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>My Listings — AgoraTrade</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }

        body {
            display: flex;
            min-height: 100vh;
            background: #f8f9fa;
        }

        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: #1a1a1a;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 24px 24px 20px;
            border-bottom: 1px solid #2e2e2e;
        }

        .sidebar-brand img {
            width: 38px;
            height: 38px;
        }

        .sidebar-brand-text {
            font-size: 20px;
            font-weight: bold;
            color: #fff;
        }

        .sidebar-brand-text span {
            color: #ffe0a9;
        }

        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 16px 24px;
            border-bottom: 1px solid #2e2e2e;
        }

        .sidebar-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #ffe0a9;
        }

        .sidebar-username {
            font-size: 13px;
            font-weight: bold;
            color: #fff;
        }

        .sidebar-role {
            font-size: 11px;
            color: #888;
        }

        .sidebar-nav {
            flex: 1;
            padding: 16px 0;
        }

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

        .nav-item:hover {
            color: #fff;
            background: #252525;
            border-left-color: #ffe0a9;
        }

        .nav-item.active {
            color: #ffe0a9;
            background: #252525;
            border-left-color: #ffe0a9;
            font-weight: bold;
        }

        .nav-item svg {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
        }

        .sidebar-footer {
            padding: 16px 24px;
            border-top: 1px solid #2e2e2e;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .sidebar-footer a {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            color: #888;
            text-decoration: none;
            padding: 8px 0;
            transition: color 0.2s;
        }

        .sidebar-footer a:hover {
            color: #fff;
        }

        .sidebar-footer form button {
            display: flex;
            align-items: center;
            gap: 10px;
            background: none;
            border: none;
            font-size: 13px;
            color: #888;
            cursor: pointer;
            padding: 8px 0;
            transition: color 0.2s;
            width: 100%;
        }

        .sidebar-footer form button:hover {
            color: #e74c3c;
        }

        .main {
            margin-left: 260px;
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .topbar {
            background: #fff;
            border-bottom: 1px solid #eee;
            padding: 16px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .topbar-title {
            font-size: 20px;
            font-weight: bold;
            color: #333;
        }

        .topbar-sub {
            font-size: 13px;
            color: #999;
            margin-top: 2px;
        }

        .gold-btn {
            padding: 10px 22px;
            background: #ffe0a9;
            border: none;
            border-radius: 15px 0 15px 0;
            font-size: 13px;
            font-weight: bold;
            color: #555;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: background 0.2s;
        }

        .gold-btn:hover {
            background: #f7d9a3;
            color: #333;
        }

        .content {
            padding: 28px 32px;
            flex: 1;
        }

        /* Alerts */
        .alert-success {
            background: #EAF3DE;
            border: 1px solid #97C459;
            border-radius: 15px 0 15px 0;
            padding: 12px 16px;
            margin-bottom: 20px;
            font-size: 13px;
            color: #3B6D11;
        }

        /* Filter bar */
        .filter-bar {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .filter-bar input {
            padding: 9px 14px;
            border: 1px solid #ddd;
            border-radius: 15px 0 15px 0;
            font-size: 13px;
            outline: none;
            width: 260px;
            transition: border-color 0.2s;
        }

        .filter-bar input:focus {
            border-color: #ffe0a9;
        }

        .filter-btn {
            padding: 9px 16px;
            border: 1px solid #ddd;
            border-radius: 15px 0 15px 0;
            font-size: 12px;
            font-weight: bold;
            background: #fff;
            color: #777;
            cursor: pointer;
            transition: all 0.2s;
        }

        .filter-btn:hover,
        .filter-btn.active {
            background: #1a1a1a;
            color: #fff;
            border-color: #1a1a1a;
        }

        .filter-btn.gold {
            background: #ffe0a9;
            color: #555;
            border-color: #ffe0a9;
        }

        /* Listings grid */
        .listings-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 20px;
        }

        .listing-card {
            background: #fff;
            border-radius: 15px 0 15px 0;
            border: 1px solid #eee;
            overflow: hidden;
            transition: box-shadow 0.2s;
        }

        .listing-card:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        }

        .listing-img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            background: #f0f0f0;
            display: block;
        }

        .listing-img-placeholder {
            width: 100%;
            height: 180px;
            background: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            color: #ddd;
        }

        .listing-body {
            padding: 14px 16px;
        }

        .listing-title {
            font-size: 14px;
            font-weight: bold;
            color: #333;
            margin-bottom: 6px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .listing-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .listing-price {
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }

        .listing-condition {
            font-size: 11px;
            color: #999;
        }

        .listing-category {
            font-size: 11px;
            color: #999;
            margin-bottom: 10px;
        }

        .listing-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 10px;
            border-top: 1px solid #f0f0f0;
        }

        .badge {
            font-size: 10px;
            padding: 3px 10px;
            border-radius: 4px;
            font-weight: bold;
        }

        .badge-active {
            background: #EAF3DE;
            color: #3B6D11;
        }

        .badge-sold {
            background: #E6F1FB;
            color: #185FA5;
        }

        .badge-expired {
            background: #F5F5F5;
            color: #999;
        }

        .action-btns {
            display: flex;
            gap: 6px;
        }

        .btn-edit {
            padding: 5px 12px;
            font-size: 11px;
            font-weight: bold;
            border: 1px solid #ddd;
            border-radius: 15px 0 15px 0;
            background: #fff;
            color: #555;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-edit:hover {
            border-color: #333;
            color: #333;
        }

        .btn-delete {
            padding: 5px 12px;
            font-size: 11px;
            font-weight: bold;
            border: 1px solid #fcc;
            border-radius: 15px 0 15px 0;
            background: #fff;
            color: #e74c3c;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-delete:hover {
            background: #e74c3c;
            color: #fff;
            border-color: #e74c3c;
        }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 80px 20px;
            color: #bbb;
        }

        .empty-state .empty-icon {
            font-size: 52px;
            margin-bottom: 16px;
        }

        .empty-state h3 {
            font-size: 18px;
            color: #555;
            margin-bottom: 8px;
        }

        .empty-state p {
            font-size: 14px;
            margin-bottom: 24px;
        }

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
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="7" height="7" />
                    <rect x="14" y="3" width="7" height="7" />
                    <rect x="3" y="14" width="7" height="7" />
                    <rect x="14" y="14" width="7" height="7" />
                </svg>
                Dashboard
            </a>
            <a href="{{ url('/listings') }}" class="nav-item {{ request()->is('listings') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2" />
                    <rect x="9" y="3" width="6" height="4" rx="1" />
                    <line x1="9" y1="12" x2="15" y2="12" />
                    <line x1="9" y1="16" x2="13" y2="16" />
                </svg>
                My Listings
            </a>
            <a href="{{ url('/listings/create') }}"
                class="nav-item {{ request()->is('listings/create') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10" />
                    <line x1="12" y1="8" x2="12" y2="16" />
                    <line x1="8" y1="12" x2="16" y2="12" />
                </svg>
                Add Listing
            </a>
            <div class="nav-section-label">Commerce</div>
            <a href="{{ url('/orders') }}" class="nav-item {{ request()->is('orders*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z" />
                    <line x1="3" y1="6" x2="21" y2="6" />
                    <path d="M16 10a4 4 0 0 1-8 0" />
                </svg>
                Orders
            </a>
            <a href="{{ url('/purchases') }}" class="nav-item {{ request()->is('purchases*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="9" cy="21" r="1" />
                    <circle cx="20" cy="21" r="1" />
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6" />
                </svg>
                Purchases
            </a>
        </nav>
        <div class="sidebar-footer">
            <a href="{{ url('/') }}">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                    <polyline points="9 22 9 12 15 12 15 22" />
                </svg>
                Return to Main Site
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                        <polyline points="16 17 21 12 16 7" />
                        <line x1="21" y1="12" x2="9" y2="12" />
                    </svg>
                    Log Out
                </button>
            </form>
        </div>
    </aside>

    <div class="main">
        <div class="topbar">
            <div>
                <div class="topbar-title">My Listings</div>
                <div class="topbar-sub">{{ $listings->count() }} item{{ $listings->count() !== 1 ? 's' : '' }} listed
                </div>
            </div>
            <a href="{{ url('/listings/create') }}" class="gold-btn">+ Add Listing</a>
        </div>

        <div class="content">

            @if(session('success'))
                <div class="alert-success">✓ {{ session('success') }}</div>
            @endif

            @if($listings->isEmpty())
                <div class="empty-state">
                    <div class="empty-icon">🏷</div>
                    <h3>No listings yet</h3>
                    <p>Post your first item and start selling on AgoraTrade!</p>
                    <a href="{{ url('/listings/create') }}" class="gold-btn">+ Add Your First Listing</a>
                </div>
            @else
                <div class="filter-bar">
                    <input type="text" id="searchInput" placeholder="Search your listings..." onkeyup="filterListings()">
                    <button class="filter-btn gold active" onclick="filterByStatus('all', this)">All</button>
                    <button class="filter-btn" onclick="filterByStatus('active', this)">Active</button>
                    <button class="filter-btn" onclick="filterByStatus('sold', this)">Sold</button>
                    <button class="filter-btn" onclick="filterByStatus('expired', this)">Expired</button>
                </div>

                <div class="listings-grid" id="listingsGrid">
                    @foreach($listings as $listing)
                        <div class="listing-card" data-status="{{ $listing->status }}"
                            data-title="{{ strtolower($listing->title) }}">
                            @if($listing->image)
                                <img src="{{ Storage::url($listing->image) }}" class="listing-img" alt="{{ $listing->title }}">
                            @else
                                <div class="listing-img-placeholder">📦</div>
                            @endif

                            <div class="listing-body">
                                <div class="listing-title" title="{{ $listing->title }}">{{ $listing->title }}</div>
                                <div class="listing-meta">
                                    <div class="listing-price">KES {{ number_format($listing->price, 2) }}</div>
                                    <div class="listing-condition">{{ $listing->condition }}</div>
                                </div>
                                <div class="listing-category">📁 {{ $listing->category }}</div>
                                <div class="listing-footer">
                                    <span class="badge badge-{{ $listing->status }}">{{ ucfirst($listing->status) }}</span>
                                    <div class="action-btns">
                                        <form method="POST" action="{{ url('/listings/' . $listing->id) }}"
                                            onsubmit="return confirm('Delete this listing?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
        <footer>© 2026 AgoraTrade Limited. All Rights Reserved.</footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function filterListings() {
            const search = document.getElementById('searchInput').value.toLowerCase();
            document.querySelectorAll('.listing-card').forEach(card => {
                const title = card.dataset.title;
                card.style.display = title.includes(search) ? '' : 'none';
            });
        }

        function filterByStatus(status, btn) {
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active', 'gold'));
            btn.classList.add('active', 'gold');
            document.querySelectorAll('.listing-card').forEach(card => {
                card.style.display = (status === 'all' || card.dataset.status === status) ? '' : 'none';
            });
        }
    </script>
</body>

</html>