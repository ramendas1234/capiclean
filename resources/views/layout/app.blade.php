<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500&family=Inter:wght@400;500&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link href="/css/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link href="css/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="css/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="css/aos/aos.css" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ mix('css/blog-style.css') }}">
    
    <title>@yield('title')</title>
    
</head>
<body>

    <!-- Page Preloder -->
    {{-- <div id="preloder">
        <div class="loader"></div>
    </div> --}}

    @include('layout.header')

    

    <main id="main">
      
          @if(session('status'))
              <div class="alert alert-success">{{ session('status') }}</div>
          @endif
          @yield('content')
      
    </main>
    


    @include('layout.footer')
  <script src="{{ mix('js/app.js') }}" defer></script>
  <!-- Vendor JS Files -->
  <script src="css/swiper/swiper-bundle.min.js"></script>
  <script src="css/glightbox/js/glightbox.min.js"></script>
  <script src="css/aos/aos.js"></script>
  <script src="css/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="js/main.js"></script>
</body>
</html>