<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('letter-a-block.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Store • AgoraTrade</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }

        body {
            background: #f8f9fa;
        }

        nav {
            display: flex;
            flex-direction: row;
            align-items: center;
            background-color: #fff;
            padding: 15px 40px;
        }

        nav img {
            height: 70px;
            width: 70px;
            margin-right: -20px;
            margin-left: -10px;
        }

        nav form {
            display: flex;
            flex-grow: 1;
            max-width: 950px;
            align-items: center;
            margin-left: 55px;
        }

        nav input[type="text"] {
            margin-left: 20px;
            padding: 30px 30px 30px 20px;
            width: 600px;
            height: 45px;
            border: 1px solid #ccc;
            border-radius: 15px 0 0 0;
            outline: none;
            font-size: 15px;
        }

        nav select {
            padding: 8px;
            border: 1px solid #ccc;
            border-left: none;
            outline: none;
            font-size: 15px;
            border-radius: 0 0 15px 0;
            height: 61.5px;
            width: 80px;
            color: #777;
        }

        nav button {
            padding: 8px 15px;
            border: 1px #ccc solid;
            background-color: #ffe0a9;
            color: #777;
            cursor: pointer;
            font-size: 15px;
            margin-top: -0.5px;
            margin-left: 5px;
            border-radius: 15px 0 15px 0;
            height: 60px;
            width: 180px;
        }

        nav button:hover {
            background-color: #f7d9a3;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-left: auto;
            flex-shrink: 0;
        }

        /* Logged in — profile dropdown */
        .nav-profile {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 16px 12px;
            border-radius: 15px 0 15px 0;
            border: 1px solid #eee;
            cursor: pointer;
            transition: background 0.2s;
            position: relative;
            text-decoration: none;
        }

        .nav-profile:hover {
            background: #f8f9fa;
        }

        .nav-avatar {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: #ffe0a9;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
            color: #555;
            overflow: hidden;
            flex-shrink: 0;
        }

        .nav-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .nav-username {
            font-size: 13px;
            font-weight: bold;
            color: #333;
        }

        .nav-chevron {
            font-size: 11px;
            color: #999;
        }

        .nav-dropdown {
            display: none;
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            background: #fff;
            border: 1px solid #eee;
            border-radius: 12px 0 12px 0;
            padding: 6px;
            min-width: 180px;
            z-index: 200;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        }

        .nav-profile:hover .nav-dropdown {
            display: block;
        }

        .nav-dropdown a {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 9px 12px;
            border-radius: 8px;
            font-size: 13px;
            color: #333;
            text-decoration: none;
            transition: background 0.15s;
        }

        .nav-dropdown a:hover {
            background: #f8f9fa;
        }

        .nav-dropdown-divider {
            height: 1px;
            background: #f0f0f0;
            margin: 4px 0;
        }

        .nav-dropdown form {
            margin-left: 0px;
        }

        .nav-dropdown .logout {
            color: #e74c3c;
        }

        .nav-dropdown .logout:hover {
            background: #FCEBEB;
        }

        /* Logged out — auth buttons */
        .nav-auth {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .nav-auth a {
            padding: 8px 18px;
            font-size: 13px;
            font-weight: bold;
            border-radius: 12px 0 12px 0;
            text-decoration: none;
            transition: background 0.2s;
        }

        .nav-login {
            border: 1px solid #ddd;
            color: #555;
        }

        .nav-login:hover {
            background: #f8f9fa;
        }

        .nav-signup {
            background: #ffe0a9;
            color: #555;
            border: none;
        }

        .nav-signup:hover {
            background: #f7d9a3;
        }

        .UP {
            display: flex;
            gap: 15px;
            margin-left: auto;
            padding-left: 30px;
            align-items: center;
        }

        .UP svg {
            cursor: pointer;
            fill: #777;
            margin-right: 5px;
            transition: fill 0.3s ease;
            position: relative;
            /* Add relative positioning here */
        }

        .UP svg:hover {
            fill: #ffe0a9;
        }

        #login::after {
            content: "Log In";
            /* Tooltip text */
            position: absolute;
            left: 100%;
            /* Position it to the right of the element */
            top: 50%;
            transform: translate(5px, -50%);
            background-color: #333;
            color: #fff;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 12px;
            white-space: nowrap;
            opacity: 0;
            transition: opacity 0.3s;
            pointer-events: none;
        }

        /* Show the tooltip on hover */
        #login:hover::after {
            opacity: 1;
        }

        #signup::after {
            content: "Sign Up";
            /* Tooltip text */
            position: absolute;
            left: 100%;
            /* Position it to the right of the element */
            top: 50%;
            transform: translate(5px, -50%);
            background-color: #333;
            color: #fff;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 12px;
            white-space: nowrap;
            opacity: 0;
            transition: opacity 0.3s;
            pointer-events: none;
        }

        /* Show the tooltip on hover */
        #signup:hover::after {
            opacity: 1;
        }


        /* ── Store layout ── */
        .store-wrap {
            max-width: 1300px;
            margin: 0 auto;
            padding: 30px 20px;
        }

        /* ── Hero ── */
        .store-hero {
            background: #1a1a1a;
            border-radius: 15px 0 15px 0;
            padding: 32px 40px;
            margin-bottom: 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .store-hero h1 {
            font-size: 28px;
            font-weight: bold;
            color: #fff;
        }

        .store-hero p {
            font-size: 14px;
            color: #888;
            margin-top: 6px;
        }

        .store-hero-stat {
            text-align: center;
        }

        .store-hero-stat-value {
            font-size: 28px;
            font-weight: bold;
            color: #ffe0a9;
        }

        .store-hero-stat-label {
            font-size: 12px;
            color: #888;
            margin-top: 2px;
        }

        .hero-stats {
            display: flex;
            gap: 40px;
        }

        /* ── Filter bar ── */
        .filter-bar {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }

        .filter-label {
            font-size: 13px;
            color: #999;
            margin-right: 4px;
        }

        .filter-btn {
            padding: 7px 16px;
            border: 1px solid #ddd;
            border-radius: 15px 0 15px 0;
            font-size: 12px;
            font-weight: bold;
            background: #fff;
            color: #777;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-block;
        }

        .filter-btn:hover {
            background: #1a1a1a;
            color: #fff;
            border-color: #1a1a1a;
        }

        .filter-btn.active {
            background: #ffe0a9;
            color: #555;
            border-color: #ffe0a9;
        }

        /* ── Sort & results bar ── */
        .results-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .results-count {
            font-size: 13px;
            color: #999;
        }

        .sort-select {
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 15px 0 15px 0;
            font-size: 13px;
            outline: none;
            background: #fff;
            color: #555;
            cursor: pointer;
        }

        .sort-select:focus {
            border-color: #ffe0a9;
        }

        /* ── Product grid ── */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 20px;
        }

        .product-card {
            background: #fff;
            border-radius: 15px 0 15px 0;
            overflow: hidden;
            border: 1px solid #eee;
            transition: box-shadow 0.2s, transform 0.2s;
            position: relative;
        }

        .product-card:hover {
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            transform: translateY(-3px);
        }

        .product-image {
            width: 100%;
            height: 220px;
            object-fit: cover;
            display: block;
            background: #f5f5f5;
        }

        .product-image-placeholder {
            width: 100%;
            height: 220px;
            background: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            color: #ddd;
        }

        .condition-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background: #1a1a1a;
            color: #fff;
            font-size: 10px;
            font-weight: bold;
            padding: 3px 8px;
            border-radius: 4px;
        }

        .product-info {
            padding: 14px 16px;
        }

        .product-name {
            font-size: 14px;
            font-weight: 500;
            color: #333;
            margin-bottom: 6px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .product-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 8px;
        }

        .product-price {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }

        .product-category {
            font-size: 11px;
            color: #999;
        }

        .product-seller {
            font-size: 11px;
            color: #999;
            margin-bottom: 12px;
        }

        .product-seller span {
            color: #555;
            font-weight: 500;
        }

        .buy-btn {
            width: 100%;
            padding: 10px;
            background: #1a1a1a;
            color: #fff;
            border: none;
            border-radius: 15px 0 15px 0;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s;
        }

        .buy-btn:hover {
            background: #333;
        }

        .buy-btn.sold {
            background: #ddd;
            color: #999;
            cursor: not-allowed;
        }

        /* ── Empty state ── */
        .empty-state {
            text-align: center;
            padding: 80px 20px;
            grid-column: 1 / -1;
        }

        .empty-state .empty-icon {
            font-size: 52px;
            margin-bottom: 16px;
        }

        .empty-state h3 {
            font-size: 20px;
            color: #555;
            margin-bottom: 8px;
        }

        .empty-state p {
            font-size: 14px;
            color: #999;
        }

        /* ── Buy modal ── */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            align-items: center;
            justify-content: center;
        }

        .modal-overlay.open {
            display: flex;
        }

        .buy-modal {
            background: #fff;
            padding: 28px;
            width: 460px;
            max-width: 95vw;
            position: relative;
            z-index: 10000;
            margin: auto;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.18);
            max-height: 90vh;
            overflow-y: auto;
        }

        .buy-modal-close {
            position: absolute;
            top: 16px;
            right: 16px;
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            color: #999;
        }

        .buy-modal-close:hover {
            color: #333;
        }

        .buy-modal-title {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            margin-bottom: 6px;
        }

        .buy-modal-sub {
            font-size: 13px;
            color: #999;
            margin-bottom: 20px;
        }

        .buy-modal-item {
            display: flex;
            gap: 14px;
            padding: 14px;
            background: #f8f9fa;
            border-radius: 15px 0 15px 0;
            margin-bottom: 20px;
            border: 1px solid #eee;
        }

        .buy-modal-item-img {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 8px;
            background: #eee;
            flex-shrink: 0;
        }

        .buy-modal-item-name {
            font-size: 14px;
            font-weight: bold;
            color: #333;
        }

        .buy-modal-item-price {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            margin-top: 4px;
        }

        .buy-modal-item-seller {
            font-size: 12px;
            color: #999;
            margin-top: 4px;
        }

        .buy-modal-form label {
            display: block;
            font-size: 13px;
            font-weight: bold;
            color: #555;
            margin-bottom: 6px;
        }

        .buy-modal-form input,
        .buy-modal-form textarea {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #ddd !important;
            border-radius: 15px 0 15px 0 !important;
            font-size: 13px;
            outline: none;
            margin-bottom: 8px;
            transition: border-color 0.2s;
            background: #fff !important;
            box-shadow: none !important;
        }

        .buy-modal-form input:focus,
        .buy-modal-form textarea:focus {
            border-color: #ffe0a9 !important;
            box-shadow: none !important;
        }

        .buy-modal-form textarea {
            resize: vertical;
            min-height: 80px;
        }

        .buy-modal-confirm-btn {
            width: 100%;
            padding: 13px;
            background: #ffe0a9;
            border: none;
            border-radius: 15px 0 15px 0;
            font-size: 14px;
            font-weight: bold;
            color: #555;
            cursor: pointer;
            transition: background 0.2s;
            margin-top: 0px;
        }

        .buy-modal-confirm-btn:hover {
            background: #f7d9a3;
        }

        footer {
            background: #fff;
            border-top: 1px solid #eee;
            text-align: center;
            color: #999;
            font-size: 12px;
            padding: 20px;
            margin-top: 40px;
        }

        #footerpara {
            margin: 0;
            padding: 10px;
        }

        .Pic-ImgTwo {
            margin-top: 60px;
            margin-left: 100px;
        }

        .UP img {
            height: 50px;
            width: 50px;
        }

        .UP span {
            padding-left: 20px;
        }

        .UP a {
            text-decoration: none;
            color: #555;
        }

        .profile-container {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0px 0px;
            border-radius: 50px;
            transition: all 0.3s ease;
        }

        .profile-container:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .profile-pic {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .profile-username {
            font-weight: 600;
            color: #333;
            font-size: 14px;
        }

        .dark .profile-username {
            color: #000;
        }

        .profile-pic {
            transition: transform 0.3s ease;
        }

        .profile-container:hover .profile-pic {
            transform: scale(1.1);
        }

        .inline-logout {
            display: inline-flex;
            margin-left: 8px;
        }

        .inline-logout button:hover {
            opacity: 1;
            transform: translateX(2px);
        }
    </style>
</head>

<body>

    <nav>
        <a href="{{ url('/') }}"><img src="{{ asset('letter-a-block.png') }}" alt="Logo"></a>
        <form class="nav-search" action="{{ url('/store') }}" method="GET">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search listings...">
            <select name="category">
                <option value="">All</option>
                <option value="Antiques" {{ request('category') === 'Antiques' ? 'selected' : '' }}>Antiques</option>
                <option value="Art" {{ request('category') === 'Art' ? 'selected' : '' }}>Art</option>
                <option value="Books" {{ request('category') === 'Books' ? 'selected' : '' }}>Books</option>
                <option value="CellPhones & Accessories" {{ request('category') === 'CellPhones & Accessories' ? 'selected' : '' }}>Cell Phones</option>
                <option value="Clothing" {{ request('category') === 'Clothing' ? 'selected' : '' }}>Clothing</option>
                <option value="Computers/Tablets & Networking" {{ request('category') === 'Computers/Tablets & Networking' ? 'selected' : '' }}>Computers</option>
                <option value="Health & Beauty" {{ request('category') === 'Health & Beauty' ? 'selected' : '' }}>Health &
                    Beauty</option>
                <option value="Jewelry & Watches" {{ request('category') === 'Jewelry & Watches' ? 'selected' : '' }}>
                    Jewelry</option>
                <option value="Music" {{ request('category') === 'Music' ? 'selected' : '' }}>Music</option>
                <option value="Pottery & Glass" {{ request('category') === 'Pottery & Glass' ? 'selected' : '' }}>Pottery
                    & Glass</option>
                <option value="Sporting Goods" {{ request('category') === 'Sporting Goods' ? 'selected' : '' }}>Sporting
                    Goods</option>
                <option value="Video Games & Consoles" {{ request('category') === 'Video Games & Consoles' ? 'selected' : '' }}>Video Games</option>
                <option value="Everything Else" {{ request('category') === 'Everything Else' ? 'selected' : '' }}>
                    Everything Else</option>
            </select>
            <button type="submit">Search</button>
        </form>
        <div class="UP">
            <div class="nav-right">
                @if(Auth::check())
                    <div class="nav-profile">
                        <div class="nav-avatar">
                            @if(Auth::user()->profile_picture)
                                <img src="{{ Storage::url(Auth::user()->profile_picture) }}" alt="avatar">
                            @else
                                {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                            @endif
                        </div>
                        <span class="nav-username">{{ Auth::user()->username }}</span>
                        <span class="nav-chevron">▾</span>
                        <div class="nav-dropdown">
                            <a href="{{ url('/profile') }}">👤 My Profile</a>
                            <a href="{{ url('/dashboard') }}">📊 Dashboard</a>
                            <a href="{{ url('/listings') }}">🏷 My Listings</a>
                            <a href="{{ url('/purchases') }}">🛒 Purchases</a>
                            <div class="nav-dropdown-divider"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="logout"
                                    style="width:100%; background:none; border:none; padding:0; cursor:pointer;">
                                    <a href="#" class="logout" onclick="this.closest('form').submit(); return false;">🚪 Log
                                        Out</a>
                                </button>
                            </form>
                        </div>
                    </div>
                @else

                    <div class="nav-auth">
                        <a href="{{ url('/login') }}" class="nav-login">Log In</a>
                        <a href="{{ url('/signup') }}" class="nav-signup">Sign Up</a>
                    </div>
                @endif
            </div>
    </nav>



    <div class="store-wrap">

        {{-- Hero --}}
        <div class="store-hero">
            <div>
                <h1>AgoraTrade Store</h1>
                <p>Browse items listed by sellers in your community.</p>
            </div>
            <div class="hero-stats">
                <div class="store-hero-stat">
                    <div class="store-hero-stat-value">{{ $totalListings }}</div>
                    <div class="store-hero-stat-label">Listings</div>
                </div>
                <div class="store-hero-stat">
                    <div class="store-hero-stat-value">{{ $totalSellers }}</div>
                    <div class="store-hero-stat-label">Sellers</div>
                </div>
            </div>
        </div>

        {{-- Category filters --}}
        <div class="filter-bar">
            <span class="filter-label">Category:</span>
            <a href="{{ url('/store') }}" class="filter-btn {{ !request('category') ? 'active' : '' }}">All</a>
            @foreach($categories as $cat)
                <a href="{{ url('/store') }}?category={{ urlencode($cat) }}{{ request('search') ? '&search=' . urlencode(request('search')) : '' }}"
                    class="filter-btn {{ request('category') === $cat ? 'active' : '' }}">
                    {{ $cat }}
                </a>
            @endforeach
        </div>

        {{-- Results bar --}}
        <div class="results-bar">
            <div class="results-count">
                {{ $listings->count() }} result{{ $listings->count() !== 1 ? 's' : '' }}
                @if(request('search')) for "<strong>{{ request('search') }}</strong>" @endif
                @if(request('category')) in <strong>{{ request('category') }}</strong> @endif
            </div>
            <form action="{{ url('/store') }}" method="GET" style="display:inline;">
                @if(request('search'))<input type="hidden" name="search" value="{{ request('search') }}">@endif
                @if(request('category'))<input type="hidden" name="category" value="{{ request('category') }}">@endif
                <select name="sort" class="sort-select" onchange="this.form.submit()">
                    <option value="latest" {{ request('sort') === 'latest' ? 'selected' : '' }}>Newest first</option>
                    <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>Price: Low to High
                    </option>
                    <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Price: High to Low
                    </option>
                </select>
            </form>
        </div>

        {{-- Product grid --}}
        <div class="product-grid">
            @forelse($listings as $listing)
                <div class="product-card">
                    @if($listing->image)
                        <img src="{{ Storage::url($listing->image) }}" class="product-image" alt="{{ $listing->title }}">
                    @else
                        <div class="product-image-placeholder">📦</div>
                    @endif
                    <span class="condition-badge">{{ $listing->condition }}</span>
                    <div class="product-info">
                        <div class="product-name" title="{{ $listing->title }}">{{ $listing->title }}</div>
                        <div class="product-meta">
                            <div class="product-price">KES {{ number_format($listing->price, 2) }}</div>
                            <div class="product-category">{{ $listing->category }}</div>
                        </div>
                        <div class="product-seller">
                            Sold by <span>{{ $listing->user->username }}</span>
                            @if($listing->location) · {{ $listing->location }} @endif
                        </div>
                        @if(Auth::check() && Auth::id() !== $listing->user_id)
                            <button class="buy-btn" onclick="openBuyModal(
                                        {{ $listing->id }},
                                        '{{ addslashes($listing->title) }}',
                                        '{{ number_format($listing->price, 2) }}',
                                        '{{ $listing->user->username }}',
                                        '{{ $listing->image ? Storage::url($listing->image) : '' }}'
                                    )">Buy Now</button>
                        @elseif(Auth::check() && Auth::id() === $listing->user_id)
                            <button class="buy-btn sold" disabled>Your Listing</button>
                        @else
                            <a href="{{ url('/login') }}" class="buy-btn"
                                style="display:block; text-align:center; text-decoration:none;">Login to Buy</a>
                        @endif
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <div class="empty-icon">🔍</div>
                    <h3>No listings found</h3>
                    <p>Try a different search term or category.</p>
                </div>
            @endforelse
        </div>

    </div>

    <footer>
        <p id="footerpara">© {{ now()->format('Y') }} AgoraTrade Limited. All Rights Reserved.</p>
    </footer>


    {{-- Buy modal --}}
    <div class="modal-overlay" id="buyModal" onclick="closeModalOutside(event)">
        <div class="buy-modal">
            <button class="buy-modal-close" onclick="closeBuyModal()">✕</button>
            <div class="buy-modal-title">Confirm Purchase</div>
            <div class="buy-modal-sub">Fill in your shipping details to complete the order.</div>

            <div class="buy-modal-item">
                <img id="modal-img" src="" alt="" class="buy-modal-item-img" onerror="this.style.display='none'">
                <div>
                    <div class="buy-modal-item-name" id="modal-title"></div>
                    <div class="buy-modal-item-price" id="modal-price"></div>
                    <div class="buy-modal-item-seller" id="modal-seller"></div>
                </div>
            </div>

            <form method="POST" action="{{ url('/orders') }}" class="buy-modal-form" id="mpesaForm">
                @csrf
                <input type="hidden" name="listing_id" id="modal-listing-id">
                <label>Full Name</label>
                <input type="text" name="buyer_name" id="modal-buyer-name" value="{{ Auth::user()->fullname ?? '' }}"
                    required>

                <label>Email</label>
                <input type="email" name="buyer_email" id="modal-buyer-email" value="{{ Auth::user()->email ?? '' }}"
                    required>

                <label>M-Pesa Phone Number</label>
                <input type="text" name="phone" id="modal-phone" placeholder="e.g. 0712345678" required>

                <label>Shipping Address</label>
                <textarea name="buyer_address" id="modal-buyer-address" placeholder="Street, City, Country"
                    required></textarea>

                <div id="mpesa-message"
                    style="display:none; padding:10px; border-radius:15px 0 15px 0; margin-bottom:14px; font-size:13px; text-align:center;">
                </div>

                <button type="submit" class="buy-modal-confirm-btn" id="mpesa-btn">📱 Pay with
                    M-Pesa</button><br /><br />
                <button type="submit" class="buy-modal-confirm-btn">✓ Place Order</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function openBuyModal(id, title, price, seller, img) {
            document.getElementById('modal-listing-id').value = id;
            document.getElementById('modal-title').textContent = title;
            document.getElementById('modal-price').textContent = 'KES ' + price;
            document.getElementById('modal-seller').textContent = 'Sold by ' + seller;
            document.getElementById('modal-img').src = img;
            document.getElementById('mpesa-message').style.display = 'none';
            document.getElementById('mpesa-btn').textContent = '📱 Pay with M-Pesa';
            document.getElementById('mpesa-btn').disabled = false;
            document.getElementById('buyModal').classList.add('open');
        }

        function closeBuyModal() {
            document.getElementById('buyModal').classList.remove('open');
        }

        function closeModalOutside(e) {
            if (e.target === document.getElementById('buyModal')) closeBuyModal();
        }

        document.getElementById('mpesaForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const btn = document.getElementById('mpesa-btn');
            const msg = document.getElementById('mpesa-message');

            btn.textContent = 'Sending STK Push...';
            btn.disabled = true;

            const formData = {
                listing_id: document.getElementById('modal-listing-id').value,
                buyer_name: document.getElementById('modal-buyer-name').value,
                buyer_email: document.getElementById('modal-buyer-email').value,
                phone: document.getElementById('modal-phone').value,
                buyer_address: document.getElementById('modal-buyer-address').value,
                _token: document.querySelector('input[name="_token"]').value,
            };

            fetch('{{ url("/mpesa/stk-push") }}', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(formData),
            })
                .then(res => res.json())
                .then(data => {
                    msg.style.display = 'block';
                    if (data.success) {
                        msg.style.background = '#EAF3DE';
                        msg.style.color = '#3B6D11';
                        msg.textContent = data.message;
                        btn.textContent = '⏳ Waiting for payment...';
                    } else {
                        msg.style.background = '#FCEBEB';
                        msg.style.color = '#A32D2D';
                        msg.textContent = data.message;
                        btn.textContent = '📱 Pay with M-Pesa';
                        btn.disabled = false;
                    }
                })
                .catch(() => {
                    msg.style.display = 'block';
                    msg.style.background = '#FCEBEB';
                    msg.style.color = '#A32D2D';
                    msg.textContent = 'Something went wrong. Please try again.';
                    btn.textContent = '📱 Pay with M-Pesa';
                    btn.disabled = false;
                });
        });
    </script>
</body>

</html>