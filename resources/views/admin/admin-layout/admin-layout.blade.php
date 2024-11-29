<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Perancangan Sistem Informasi Kasus Bullying (PESIKABU)">
        <meta name="author" content="M. Dede Nanda Pratama">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title }}</title>

        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


        <link rel="icon" type="image/x-icon" href="{{ asset('image/image-home/favicon.ico') }}" />
        <link href="{{ asset('css/admin1.css') }}" rel="stylesheet">
        <link href="{{ asset('css/admin2.css') }}" rel="stylesheet">
    </head>
    
    @yield('content')
    <body id="page-top">
        

        @include('admin.admin-layout.admin-footer')
        <script src="{{ asset('js/admin1.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>