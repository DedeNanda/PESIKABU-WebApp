<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="PESIBU" />
        <title>{{ $title }}</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('image/image-home/favicon.ico') }}" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
        <link href="{{ asset('css/home.css') }}" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#page-top">Home Bullying</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link" href="#about">Tentang</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route ('login') }}">Login</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container px-4 px-lg-5 h-100">
                <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-8 align-self-end">
                        <h1 class="text-white font-weight-bold">Welcome To Website Kasus Bullying</h1>
                        <hr class="divider" />
                    </div>
                    <div class="col-lg-8 align-self-baseline">
                        <p class="text-white-75 mb-5">Selamat datang di situs web PESIKABU. Jika Anda atau seseorang yang Anda kenal mengalami bullying di sekolah, silakan gunakan fitur pelaporan untuk mendapatkan bantuan segera.</p>
                        <a class="btn btn-primary btn-xl" href="#about">Tentang</a>
                    </div>
                </div>
            </div>
        </header>
        <!-- About-->
        <section class="page-section bg-primary" id="about">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="text-white mt-0">Tentang</h2>
                        <hr class="divider divider-light" />
                        <p class="text-white-75 mb-4">PESIKABU merupakan sebuah situs web yang didedikasikan untuk membantu siswa melawan dan mencegah bullying di sekolah. Kami memahami bahwa bullying dapat berdampak negatif pada kesejahteraan fisik, emosional, dan akademik siswa. Oleh karena itu, PESIKABU hadir untuk memberikan solusi dan dukungan yang diperlukan. Untuk melaporkan insiden, harap buat akun terlebih dahulu. Setelah mendaftar dan memiliki akun, Anda dapat membuat laporan setelah login. Jika Anda sudah memiliki akun, Anda bisa langsung login untuk melaporkan insiden.</p>
                        <a class="btn btn-light btn-xl" href="{{ route ('login') }}">Login</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="bg-light py-5">
            <div class="small text-center text-muted">Copyright &copy; <span id="currentYear"></span> - MDNP</div>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
        <script src="{{ asset('js/home.js') }}"></script>
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
