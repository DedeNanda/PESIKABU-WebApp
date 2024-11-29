<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('image/image-home/favicon.ico') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet" />
</head>
<body>
    <body class="bg-full">
        <section class="full-height-section gradient-custom d-flex align-items-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-dark text-white">
                            <div class="card-body p-5 text-center">
                                <div class="mb-md-5 mt-md-4 pb-5">
                                    <h2 class="fw-bold mb-2 text-uppercase">PESIKABU BUAT AKUN</h2>
                                    <p class="text-white-50 mb-5">Untuk mengakses sistem ini, anda perlu membuat akun terlebih dahulu</p>
                                    <form action="{{route('proses_register')}}" method="POST" id="regFrom">
                                    {{ csrf_field() }}
                                        <div class="form-outline form-white mb-4">
                                            <label class="form-label" for="name">Nama</label>
                                            <input type="text" name="name" id="name" class="form-control form-control-lg" placeholder="Masukan Nama" required />
                                            @if ($errors->has('name'))
                                            <span class="error"> * {{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-outline form-white mb-4">
                                            <label class="form-label" for="email">Email</label>
                                            <input type="email" name="email" id="email" class="form-control form-control-lg" placeholder="Masukan Email" required />
                                            @if ($errors->has('email'))
                                            <span class="error"> * {{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
    
                                        <div class="form-outline form-white mb-4">
                                            <label class="form-label" for="password">Password</label>
                                            <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="Masukan Password" required />
                                            @if ($errors->has('password'))
                                            <span class="error"> * {{ $errors->first('password') }}</span>
                                            @endif
                                        </div>

                                        <div class="form-outline form-white mb-4">
                                            <label class="form-label" for="password">Ulangi Password</label>
                                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-lg" placeholder="Ulangi Password" required />
                                            @if ($errors->has('password_confirmation'))
                                            <span class="error"> * {{ $errors->first('password_confirmation') }}</span>
                                            @endif
                                        </div>
                                        <div class="d-grid gap-2 mb-4">
                                            <button class="btn btn-outline-light btn-lg px-5 mb-4" type="submit">Daftar Akun</button>
                                            <p class="mb-0">Sudah memiliki akun? 
                                                <a href="{{ route ('login') }}" class="text-blue-50 fw-bold">Login Akun</a>
                                            </p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
</body>
</html>