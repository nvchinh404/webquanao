<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NORTHSIDE CREW</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="shortcut icon" href="./LOGI NORTHSIDE CREW.png">
</head>
<body>
    <!-- Include header và truyền thẳng categories vào -->
    @include('user.layouts.partials.header', [
        'categories' => App\Models\Category::all() ,
        'brands' => App\Models\Brand::all()
    ])
    <main>
        @yield('body')
    </main>
    @include('user.layouts.partials.footer') <!-- Footer chung -->
</body>
</html>