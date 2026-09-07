<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('letter-a-block.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>AgoraTrade. Its Cheap. Its Maybe Broken. But Its Yours Now.</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
            box-sizing: border-box;
        }

        nav {
            display: flex;
            flex-direction: row;
            align-items: center;
            background-color: #fff;
            padding: 15px 40px;
            max-width: 1300px;
            width: 100%;
            margin: 0 auto;
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
            align-items: center;
            margin-left: 55px;
        }

        nav input[type="text"] {
            margin-left: 20px;
            padding: 30px 30px 30px 20px;
            width: 100%;
            flex-grow: 1;
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

        .carousel {
            max-width: 1300px;
            width: 100%;
            margin: 0 auto;
            border-top: 1px #ccc solid;
            border-bottom: 1px #ccc solid;
        }

        /* Carousel CSS Stuff*/
        .carousel-caption {
            bottom: 40%;
        }

        .carousel-inner {
            min-height: 200px;
        }

        #carouselExampleControls {
            max-height: 400px;
            /* Set your desired height */
            overflow: hidden;
            /* Ensures no overflow from images */
        }

        #carouselExampleControls .carousel-inner img {
            height: 100%;
            /* Ensures the images adjust to the carousel height */
            object-fit: cover;
            /* Maintains a good aspect ratio for images */
        }

        /* General carousel styles */
        .carousel-caption {
            color: #fff;
            /* White text for contrast */
            text-shadow: 1px 1px 10px rgba(0, 0, 0, 0.7);
            /* Adds depth to text */
            padding: 20px;
        }

        /* Cool caption at the top on all the slides*/
        .cool-top-caption-two {
            top: 18%;
            /* Position near the top */
            transform: translateY(-50%);
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
        }

        .cool-top-caption-three {
            top: 16%;
            /* Position near the top */
            transform: translateY(-50%);
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
            width: 700px;
        }

        .cool-top-caption {
            top: 15%;
            /* Position near the top */
            transform: translateY(-50%);
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
        }

        /* Additional styling for h3 and p in captions */
        .carousel-caption h3 {
            font-size: 65px;
            font-weight: bold;
        }

        .carousel-caption p {
            font-size: 20px;
        }

        .Track {
            background-image: url("{{ asset('coke.jpg') }}");
            background-size: cover;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            margin: 20px auto;
            padding: 28px;
            max-width: 1260px;
            width: calc(100% - 40px);
            height: 140px;
            border-radius: 20px 0 20px 0;
            border: 1px #ccc solid;
        }

        .Track a {
            padding: 15px 35px;
            background-color: #fff;
            text-decoration: none;
            color: #333;
            cursor: pointer;
            font-size: 15px;
            font-weight: bold;
            margin-top: -0.5px;
            margin-left: 5px;
            height: 60px;
            width: 180px;
            border-radius: 15px 0 15px 0;
        }

        .Text {
            color: #fff;
            margin: 10px;
        }

        .Text h3 {
            font-weight: bold;
        }

        .Btn {
            margin: 28px;
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

        .product-section {
            max-width: 1260px;
            width: 100%;
            margin: 0 auto;
            padding: 20px;
        }

        .product-section h2 {
            font-size: 24px;
            font-weight: bold;
        }

        .product-section p {
            color: #555;
        }

        .product-text {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            margin-top: 20px;
        }

        .product-text a {
            padding: 15px 35px;
            background-color: #333;
            text-decoration: none;
            color: #fff;
            cursor: pointer;
            font-size: 15px;
            font-weight: bold;
            margin-top: -0.5px;
            margin-left: 5px;
            height: 60px;
            width: 180px;
            border-radius: 15px 0 15px 0;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
            margin-bottom: 40px;
        }

        .product-backgroundOne {
            background-image: url("{{ asset('Whitey.jpg') }}");
            background-size: cover;
            height: 350px;
            max-width: 100%;
        }

        .product-backgroundTwo {
            background-image: url("{{ asset('XBox One.jpg') }}");
            background-size: cover;
            height: 350px;
            max-width: 100%;
        }

        .product-backgroundThree {
            background-image: url("{{ asset('Blacky.jpg') }}");
            background-size: cover;
            height: 350px;
            max-width: 100%;
        }

        .product-backgroundFour {
            background-image: url("{{ asset('PS2 NOT.jpg') }}");
            background-size: cover;
            height: 350px;
            max-width: 100%;
        }

        .product-card {
            background: #fff;
            border-radius: 8px;
            display: flex;
            flex-direction: column;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: auto;
            text-align: center;
        }

        .product-card img {
            max-width: 100%;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        .product-card h3 {
            font-size: 16px;
            font-weight: 500;
            margin: 20px 0;
        }

        .product-card .price {
            color: #333;
            font-weight: bold;
            font-size: 18px;
        }

        .product-image-dynamic {
            height: 350px;
            max-width: 100%;
            background-size: cover;
            background-position: center;
            background-color: #f1f1f1;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
        }

        .no-listings {
            grid-column: 1 / -1;
            text-align: center;
            color: #999;
            padding: 40px 0;
        }

        .other-products {
            display: flex;
            flex-direction: row;
            background-color: #000;
            color: #fff;
            max-width: 1300px;
            width: 100%;
            margin: 0 auto 20px auto;
            justify-content: space-between;
        }

        @media (max-width: 900px) {
            nav {
                flex-wrap: wrap;
                padding: 15px 20px;
            }

            nav form {
                margin-left: 0;
                margin-top: 12px;
                flex-basis: 100%;
            }

            .UP {
                padding-left: 0;
            }

            .Track {
                flex-direction: column;
                height: auto;
                gap: 15px;
                text-align: center;
            }

            .other-products {
                flex-direction: column;
                text-align: center;
            }

            .other-products img {
                width: 100% !important;
                height: auto !important;
                max-width: 320px;
            }

            .Pic-ImgTwo {
                margin: 20px auto 0 auto;
            }
        }

        .other-text {
            margin: 60px 40px 40px 40px;
        }

        .other-text p {
            margin-bottom: 60px;
        }

        .other-products a {
            padding: 15px 35px;
            background-color: #fff;
            text-decoration: none;
            color: #000;
            cursor: pointer;
            font-size: 15px;
            font-weight: bold;
            margin-top: 20px;
            margin-left: 5px;
            height: 60px;
            border-radius: 15px 0 15px 0;
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

    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <a href="{{ Auth::check() ? '/store' : route('auth.redirect') }}">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ asset('PC Accessories.jpg') }}" alt="First slide">
                    <div class="carousel-caption cool-top-caption">
                        <h3>Tech Savvy</h3>
                        <p>Explore our premium PC accessories for every need.</p>
                    </div>
                </div>
            </a>
            <a href="{{ Auth::check() ? '/store' : route('auth.redirect') }}">
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('Jeans Mono.webp') }}" alt="Second slide">
                    <div class="carousel-caption cool-top-caption-two">
                        <h3>Classic Jeans</h3>
                        <p>Comfort meets style—shop the look now, and More.</p>
                    </div>
                </div>
            </a>
            <a href="{{ Auth::check() ? '/store' : route('auth.redirect') }}">
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('Watch.webp') }}" alt="Third slide">
                    <div class="carousel-caption cool-top-caption-three">
                        <h3>Timeless Elegance</h3>
                        <p>Accessorize with luxury and precision.</p>
                    </div>
                </div>
            </a>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="Track">
        <div class="Text">
            <h3>Check Out What's In Stock Before it's too late</h3>
            <p>Click the button on the right to explore more.</p>
        </div>
        <div class="Btn">
            @auth
                <a href="/store">Shop</a>
            @else
                <a href="{{ route('auth.redirect') }}">Shop</a>
            @endauth
        </div>
    </div>

    <div class="product-section">
        <div class="product-text">
            <div>
                <h2>New Listings</h2>
                <p>Fresh items just added by our sellers</p>
            </div>
            <div>
                @auth
                    <a href="/store">See More</a>
                @else
                    <a href="{{ route('auth.redirect') }}">See More</a>
                @endauth
            </div>
        </div>

        <div class="product-grid">
            @forelse($listings ?? [] as $listing)
            <div class="product-card">
                <div class="product-image-dynamic" @if($listing->image) style="background-image: url('{{ Storage::url($listing->image) }}');" @endif>
                    @unless($listing->image) 📦 @endunless
                </div>
                <div class="product-backtext">
                    <h3>{{ $listing->title }}</h3>
                    <p class="price">KES {{ number_format($listing->price, 2) }}</p>
                </div>
            </div>
            @empty
            <p class="no-listings">No listings yet — be the first to <a href="{{ Auth::check() ? '/listings/create' : route('auth.redirect') }}">list an item</a>.</p>
            @endforelse
        </div>
    </div>

    <div class="other-products">
        <div class="other-text">
            <h2>Sport Equipment</h2>
            <p>Gear up with sporting goods and elevate the fun! Click here to check out what's in stock.</p>
            @auth
                <a href="/store">Shop</a>
            @else
                <a href="{{ route('auth.redirect') }}">Shop</a>
            @endauth
        </div>
        <div class="Pic-Img">
            <img src="{{ asset('Equip.jpg') }}" width="500px" height="400px" />
        </div>
    </div>

    <div class="other-products">
        <div class="Pic-ImgTwo">
            <img src="{{ asset('VaseBlack.png') }}" width="320px" height="320px" />
        </div>
        <div class="other-text">
            <h2>Pottery & Glassware</h2>
            <p>Beautify your home with pottery and glassware! Click to explore our collection.</p>
            @auth
                <a href="/store">Shop</a>
            @else
                <a href="{{ route('auth.redirect') }}">Shop</a>
            @endauth
        </div>
    </div>

    <footer>
        <p id="footerpara">© {{ now()->format('Y') }} AgoraTrade Limited. All Rights Reserved.</p>
    </footer>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">

        </script>

    @if(!Auth::check())
        <script>
            document.getElementById('searchForm').addEventListener('submit', function (e) {
                e.preventDefault();

                // Get form values
                const search = this.elements.search.value;
                const category = this.elements.category.value;

                // Store in session storage
                sessionStorage.setItem('pendingSearch', JSON.stringify({
                    search: search,
                    category: category
                }));

                // Redirect to login with intended URL
                window.location.href = "{{ route('login') }}?redirect={{ urlencode('/store') }}";
            });
        </script>
    @endif

</body>

</html>