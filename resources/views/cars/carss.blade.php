<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('head')
    <style>
        .article-entry {
            margin-bottom: 20px;
            /* Adjust as needed */
        }
    </style>
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center header-inner-pages">
        <div class="container d-flex align-items-center justify-content-between">

            <h1 class="logo"><a href="{{ route('home') }}">ALLUC</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href=index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto " href="{{ route('home') }}">Home</a></li>
                    <li><a class="active" href="{{ route('carss') }}">Cars</a></li>
                    <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">

                <ol>
                    <li><a href="{{ route('home') }}">Home</a></li>
                </ol>
                <h2>Cars</h2>

            </div>
        </section><!-- End Breadcrumbs -->

        <!-- ======= Blog Section ======= -->
        <section id="blog" class="blog">
            <div class="container" data-aos="fade-up">

                <div class="row">

                    <div class="col-lg-8 entries">
                        @foreach ($cars as $car)
                            <article class="entry">

                                <div class="entry-img">
                                    <img src="{{ asset('storage/' . $car->image) }}" alt="{{ $car->car_name }}"
                                        class="img-fluid">
                                </div>

                                <h2 class="entry-title">
                                    <a href="#">{{ $car->car_name }}</a>
                                </h2>

                                <div class="entry-meta">
                                    <ul>
                                        <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a
                                                href="#">{{ $car->staff->first_name }}</a></li>
                                        <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a
                                                href="#"><time
                                                    datetime="{{ $car->created_at }}">{{ $car->created_at->format('M d, Y') }}</time></a>
                                        </li>
                                        <li class="d-flex align-items-center"><i class="bi bi-geo"></i> <a
                                                href="#">{{ $car->location }}</a></li>
                                    </ul>
                                </div>

                                <div class="entry-content">
                                    <p>
                                        {{ $car->description }}
                                    </p>
                                    <div class="read-more">
                                        <a href="{{ route('car.show', ['id' => $car->car_id]) }}">Read More</a>
                                    </div>
                                </div>

                            </article><!-- End blog entry -->
                        @endforeach

                        <div class="blog-pagination">
                            <ul class="justify-content-center">
                                <li class="active"><a href="#">1</a></li>
                            </ul>
                        </div>
                    </div><!-- End blog entries list -->

                    <div class="col-lg-4">

                        <div class="sidebar">

                            <h3 class="sidebar-title">Search</h3>
                            <div class="sidebar-item search-form">
                                <form action="{{ route('car.search') }}" method="GET">
                                    <input type="text" name="query">
                                    <button type="submit"><i class="bi bi-search"></i></button>
                                </form>
                            </div><!-- End sidebar search formn-->

                            <h3 class="sidebar-title">Categories</h3>
                            <div class="sidebar-item categories">
                                <ul>
                                    @php
                                        $categories = ['SEDAN', 'SUV', 'PICKUP', 'CITY CAR', 'UTILITY VEHICLE'];
                                    @endphp

                                    @foreach ($categories as $category)
                                        @php
                                            $count = \App\Models\Car::where('category', $category)->count();
                                        @endphp
                                        <li><a href="{{ route('category.cars', ['category' => $category]) }}">{{ $category }}
                                                <span>({{ $count }})</span></a></li>
                                    @endforeach
                                </ul>
                            </div><!-- End sidebar categories-->
                            {{--
                  <h3 class="sidebar-title">Recent Posts</h3>
                  <div class="sidebar-item recent-posts">
                    @foreach ($recentCars as $recentCar)
                    <div class="post-item clearfix">
                        <img src="{{ asset('storage/' . $recentCar->image) }}" alt="">
                        <h4><a href="{{ route('car.show', ['id' => $recentCar->car_id]) }}">{{ $recentCar->car_name }}</a></h4>
                        <time datetime="{{ $recentCar->created_at }}">{{ $recentCar->created_at->format('M d, Y') }}</time>
                    </div>
                @endforeach
                </div><!-- End sidebar recent posts--> --}}
                        </div><!-- End sidebar -->

                    </div><!-- End blog sidebar -->

                </div>

            </div>
        </section><!-- End Blog Section -->

    </main><!-- End #main -->

    <!-- Rest of your page content -->

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>

</body>

</html>
