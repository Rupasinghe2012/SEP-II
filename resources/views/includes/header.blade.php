<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Profiler.net</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="/css/skins/_all-skins.min.css">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
    <script type="text/javascript"> var baseUrl = "{{url('/')}}";</script>
    <link rel="stylesheet" type="text/css" href="{{ asset('/dist/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/parsley.css') }}">
    <script src="/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <link href="//cdn.muicss.com/mui-0.9.3/css/mui.min.css" rel="stylesheet" type="text/css" />
    <!-- include the BotDetect layout stylesheet -->
    <link href="{{ captcha_layout_stylesheet_url() }}" type="text/css" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">
    @yield('links')

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->

@if($userData == "client")
    <body class="hold-transition skin-black sidebar-mini">
@elseif($userData == "moderator")
    <body class="hold-transition skin-yellow sidebar-mini">
@elseif($userData == "admin")
    <body class="hold-transition skin-red sidebar-mini">
@else
    <body class="hold-transition skin-blue sidebar-mini">
@endif