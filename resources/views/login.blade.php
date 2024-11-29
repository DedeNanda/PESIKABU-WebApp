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
                                    <h2 class="fw-bold mb-2 text-uppercase">PESIKABU LOGIN</h2>
                                    <p class="text-white-50 mb-5">Silakan Masukkan Email dan Password Anda!</p>
                                    @if(session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    @endif
                                    
                                    @if($errors->has('login_gagal'))
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <span class="alert-inner--text"><strong>Warning!</strong> {{ $errors->first('login_gagal') }}</span>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    @endif
                                    <form action="{{url('proses_login')}}" method="POST" id="logForm">
                                        {{ csrf_field() }}
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
    
                                        <div class="d-grid gap-2 mb-4">
                                            <button class="btn btn-outline-light btn-lg px-5 mb-4" type="submit">Login</button>
                                            <a class="btn btn-outline-light btn-lg px-5 mb-3" href="{{ route('index') }}" role="button">Home</a>
                                            <p class="mb-0">Tidak memiliki akun? 
                                                <a href="{{ route('register') }}" class="text-blue-50 fw-bold">Buat Akun</a>
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