<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('letter-a-block.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Dashboard — AgoraTrade</title>
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

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: #fff;
            border-radius: 15px 0 15px 0;
            padding: 20px;
            border: 1px solid #eee;
        }

        .stat-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: #ffe0a9;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
            font-size: 18px;
        }

        .stat-label {
            font-size: 12px;
            color: #999;
            margin-bottom: 4px;
        }

        .stat-value {
            font-size: 26px;
            font-weight: bold;
            color: #333;
        }

        .stat-change {
            font-size: 12px;
            margin-top: 6px;
        }

        .up {
            color: #3B6D11;
        }

        .down {
            color: #A32D2D;
        }

        .mid-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 16px;
            margin-bottom: 24px;
        }

        .card {
            background: #fff;
            border-radius: 15px 0 15px 0;
            padding: 20px;
            border: 1px solid #eee;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }

        .card-title {
            font-size: 15px;
            font-weight: bold;
            color: #333;
        }

        .chart-outer {
            display: flex;
            flex-direction: column;
        }

        .chart-wrap {
            display: flex;
            align-items: flex-end;
            gap: 5px;
            height: 140px;
        }

        .chart-col {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-end;
            height: 100%;
        }

        .chart-bar {
            width: 100%;
            border-radius: 4px 4px 0 0;
            min-height: 4px;
        }

        .chart-bar.gold {
            background: #ffe0a9;
        }

        .chart-bar.dark {
            background: #1a1a1a;
        }

        .chart-labels {
            display: flex;
            gap: 5px;
            margin-top: 6px;
        }

        .chart-month {
            flex: 1;
            font-size: 9px;
            color: #bbb;
            text-align: center;
        }

        .bar-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 14px;
        }

        .bar-row:last-child {
            margin-bottom: 0;
        }

        .bar-label {
            font-size: 12px;
            color: #777;
            width: 90px;
            flex-shrink: 0;
        }

        .bar-track {
            flex: 1;
            background: #f0f0f0;
            border-radius: 4px;
            height: 8px;
            overflow: hidden;
        }

        .bar-fill {
            height: 100%;
            background: #ffe0a9;
            border-radius: 4px;
        }

        .bar-val {
            font-size: 12px;
            color: #999;
            width: 32px;
            text-align: right;
        }

        .bottom-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .orders-table {
            width: 100%;
            border-collapse: collapse;
        }

        .orders-table th {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #999;
            padding: 8px 10px;
            text-align: left;
            border-bottom: 1px solid #f0f0f0;
        }

        .orders-table td {
            padding: 11px 10px;
            font-size: 13px;
            color: #333;
            border-bottom: 1px solid #f5f5f5;
        }

        .orders-table tr:last-child td {
            border-bottom: none;
        }

        .orders-table tr:hover td {
            background: #fafafa;
        }

        .avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #ffe0a9;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: bold;
            color: #555;
            margin-right: 6px;
            vertical-align: middle;
        }

        .badge {
            font-size: 10px;
            padding: 3px 10px;
            border-radius: 4px;
            font-weight: bold;
        }

        .badge-success {
            background: #EAF3DE;
            color: #3B6D11;
        }

        .badge-warn {
            background: #FAEEDA;
            color: #854F0B;
        }

        .badge-info {
            background: #E6F1FB;
            color: #185FA5;
        }

        .quick-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            border-radius: 15px 0 15px 0;
            border: 1px solid #eee;
            text-decoration: none;
            margin-bottom: 10px;
            transition: background 0.2s;
        }

        .quick-link:last-child {
            margin-bottom: 0;
        }

        .quick-link:hover {
            background: #f8f9fa;
        }

        .ql-icon {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 16px;
        }

        .ql-gold {
            background: #ffe0a9;
        }

        .ql-dark {
            background: #1a1a1a;
        }

        .ql-gray {
            background: #f0f0f0;
        }

        .ql-text {
            font-size: 13px;
            font-weight: bold;
            color: #333;
        }

        .ql-sub {
            font-size: 11px;
            color: #999;
        }

        .empty-state {
            text-align: center;
            padding: 30px;
            color: #bbb;
            font-size: 13px;
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
            <a href="{{ url('/') }}"><img src="{{ asset('letter-a-block.png') }}" alt="Logo"></a>
            <div class="sidebar-brand-text"><span>Agora</span>Trade</div>
        </div>
        <a href="{{ url('/profile') }}" class="sidebar-user" style="text-decoration:none;">
            @if(Auth::user()->profile_picture)
                <img src="{{ Storage::url(Auth::user()->profile_picture) }}" class="sidebar-avatar">
            @else
                <img src="{{ asset('user.png') }}" class="sidebar-avatar">
            @endif
            <div>
                <div class="sidebar-username">{{ Auth::user()->username }}</div>
                <div class="sidebar-role">Seller</div>
            </div>
        </a>
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
                <div class="topbar-title">Welcome back, {{ Auth::user()->username }} 👋</div>
                <div class="topbar-sub">{{ now()->format('l, F j Y') }}</div>
            </div>
            <a href="{{ url('/listings/create') }}" class="gold-btn">+ Add Listing</a>
        </div>

        <div class="content">

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">💰</div>
                    <div class="stat-label">Total Revenue</div>
                    <div class="stat-value">KES {{ number_format($totalRevenue, 2) }}</div>
                    <div class="stat-change up">↑ All time</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">🛍</div>
                    <div class="stat-label">Total Orders</div>
                    <div class="stat-value">{{ $totalOrders }}</div>
                    <div class="stat-change up">↑ {{ $newOrdersToday }} new today</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">🏷</div>
                    <div class="stat-label">Active Listings</div>
                    <div class="stat-value">{{ $activeListings }}</div>
                    <div class="stat-change {{ $expiredListings > 0 ? 'down' : 'up' }}">
                        {{ $expiredListings > 0 ? '↓ ' . $expiredListings . ' expired' : '✓ All active' }}
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">📦</div>
                    <div class="stat-label">Items Sold</div>
                    <div class="stat-value">{{ $itemsSold }}</div>
                    <div class="stat-change up">↑ All time</div>
                </div>
            </div>

            <div class="mid-grid">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Revenue Over Time</div>
                    </div>
                    @php
                        $monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                        $maxSale = max($monthlySales) > 0 ? max($monthlySales) : 1;
                    @endphp
                    <div class="chart-outer">
                        <div class="chart-wrap">
                            @foreach($monthlySales as $i => $sale)
                                <div class="chart-col">
                                    <div class="chart-bar {{ $i % 2 === 0 ? 'gold' : 'dark' }}"
                                        style="height: {{ max(4, round(($sale / $maxSale) * 130)) }}px"
                                        title="KES {{ number_format($sale, 2) }}">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="chart-labels">
                            @foreach($monthNames as $m)
                                <div class="chart-month">{{ $m }}</div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Top Categories</div>
                    </div>
                    @foreach($topCategories as $cat)
                        <div class="bar-row">
                            <div class="bar-label">{{ $cat['name'] }}</div>
                            <div class="bar-track">
                                <div class="bar-fill" style="width: {{ $cat['pct'] }}%"></div>
                            </div>
                            <div class="bar-val">{{ $cat['pct'] }}%</div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="bottom-grid">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Recent Orders</div>
                        <a href="{{ url('/orders') }}" style="font-size:12px;color:#999;text-decoration:none;">View all
                            →</a>
                    </div>
                    @if($recentOrders->isEmpty())
                        <div class="empty-state">🛍 No orders yet — post a listing to get started!</div>
                    @else
                        <table class="orders-table">
                            <thead>
                                <tr>
                                    <th>Buyer</th>
                                    <th>Item</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentOrders as $order)
                                    <tr>
                                        <td><span
                                                class="avatar">{{ strtoupper(substr($order->buyer_name, 0, 1)) }}</span>{{ $order->buyer_name }}
                                        </td>
                                        <td>{{ $order->item_name }}</td>
                                        <td>KES {{ number_format($order->price, 2) }}</td>
                                        <td><span
                                                class="badge {{ $order->status === 'Delivered' ? 'badge-success' : ($order->status === 'Pending' ? 'badge-warn' : 'badge-info') }}">{{ $order->status }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Quick Actions</div>
                    </div>
                    <a href="{{ url('/listings/create') }}" class="quick-link">
                        <div class="ql-icon ql-gold">➕</div>
                        <div>
                            <div class="ql-text">Add New Listing</div>
                            <div class="ql-sub">Post an item for sale</div>
                        </div>
                    </a>
                    <a href="{{ url('/listings') }}" class="quick-link">
                        <div class="ql-icon ql-gray">📋</div>
                        <div>
                            <div class="ql-text">My Listings</div>
                            <div class="ql-sub">{{ $activeListings }} active items</div>
                        </div>
                    </a>
                    <a href="{{ url('/orders') }}" class="quick-link">
                        <div class="ql-icon ql-dark">🚚</div>
                        <div>
                            <div class="ql-text">View Orders</div>
                            <div class="ql-sub">{{ $pendingOrders }} pending dispatch</div>
                        </div>
                    </a>
                    <a href="{{ url('/purchases') }}" class="quick-link">
                        <div class="ql-icon ql-gold">🛒</div>
                        <div>
                            <div class="ql-text">My Purchases</div>
                            <div class="ql-sub">Items you've bought</div>
                        </div>
                    </a>
                </div>
            </div>

        </div>
        <footer>© {{ now()->format('Y') }} AgoraTrade Limited. All Rights Reserved.</footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>