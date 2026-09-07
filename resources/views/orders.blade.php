<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('letter-a-block.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Orders — AgoraTrade</title>
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

        .content {
            padding: 28px 32px;
            flex: 1;
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

        .card {
            background: #fff;
            border-radius: 15px 0 15px 0;
            border: 1px solid #eee;
            overflow: hidden;
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
            padding: 12px 16px;
            text-align: left;
            border-bottom: 1px solid #f0f0f0;
            background: #fafafa;
        }

        .orders-table td {
            padding: 14px 16px;
            font-size: 13px;
            color: #333;
            border-bottom: 1px solid #f5f5f5;
            vertical-align: middle;
        }

        .orders-table tr:last-child td {
            border-bottom: none;
        }

        .orders-table tr:hover td {
            background: #fafafa;
        }

        .avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #ffe0a9;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: bold;
            color: #555;
            margin-right: 8px;
            vertical-align: middle;
        }

        .badge {
            font-size: 10px;
            padding: 4px 10px;
            border-radius: 4px;
            font-weight: bold;
        }

        .badge-pending {
            background: #FAEEDA;
            color: #854F0B;
        }

        .badge-shipped {
            background: #E6F1FB;
            color: #185FA5;
        }

        .badge-delivered {
            background: #EAF3DE;
            color: #3B6D11;
        }

        .badge-cancelled {
            background: #F5F5F5;
            color: #999;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #bbb;
        }

        .empty-state .empty-icon {
            font-size: 48px;
            margin-bottom: 16px;
        }

        .empty-state h3 {
            font-size: 18px;
            color: #555;
            margin-bottom: 8px;
        }

        .empty-state p {
            font-size: 14px;
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
                <div class="topbar-title">Orders</div>
                <div class="topbar-sub">{{ $orders->count() }} order{{ $orders->count() !== 1 ? 's' : '' }} received
                </div>
            </div>
        </div>

        <div class="content">

            @if(session('success'))
                <div class="alert-success">✓ {{ session('success') }}</div>
            @endif

            <div class="card">
                @if($orders->isEmpty())
                    <div class="empty-state">
                        <div class="empty-icon">📭</div>
                        <h3>No orders yet</h3>
                        <p>When someone buys one of your listings it will appear here.</p>
                    </div>
                @else
                    <table class="orders-table">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Buyer</th>
                                <th>Item</th>
                                <th>Price</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td style="color:#999; font-size:12px;">#{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}
                                    </td>
                                    <td>
                                        <span class="avatar">{{ strtoupper(substr($order->buyer_name, 0, 1)) }}</span>
                                        {{ $order->buyer_name }}
                                    </td>
                                    <td>{{ $order->item_name }}</td>
                                    <td><strong>KES {{ number_format($order->price, 2) }}</strong></td>
                                    <td style="color:#999; font-size:12px;">{{ $order->created_at->format('M j, Y') }}</td>
                                    <td>
                                        <span class="badge badge-{{ strtolower($order->status) }}">{{ $order->status }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

        </div>
        <footer>© 2026 AgoraTrade Limited. All Rights Reserved.</footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>