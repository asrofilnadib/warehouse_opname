<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OPNAME</title>
    <!-- ================= Favicon ================== -->
    <!-- Standard -->
    <link rel="shortcut icon" href="http://placehold.it/64.png/000/fff">
    <!-- Retina iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="144x144" href="http://placehold.it/144.png/000/fff">
    <!-- Retina iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="114x114" href="http://placehold.it/114.png/000/fff">
    <!-- Standard iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="72x72" href="http://placehold.it/72.png/000/fff">
    <!-- Standard iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="57x57" href="http://placehold.it/57.png/000/fff">
    <!-- Styles -->
    <link href="{{ URL::asset('assets/css/lib/calendar2/pignose.calendar.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/lib/chartist/chartist.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/lib/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/lib/themify-icons.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/lib/owl.carousel.min.css')}}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/css/lib/owl.theme.default.min.css')}}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/css/lib/weather-icons.css')}}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/css/lib/menubar/sidebar.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/lib/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/lib/helper.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/style.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts/dist/apexcharts.css">

    @if(isset($periode))
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.css">
    @else
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    @endif

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
</head>

<body>
