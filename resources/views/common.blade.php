<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title> Lending Bee </title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <link rel="stylesheet" href="/css/bootstrap2.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/myext.css">

    @yield('css','')

    <script type="text/javascript" src="/js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/layer.js"></script>
    @yield('js','')
</head>
<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <a class="navbar-brand" href="/">
                    <img alt="Brand" src="/img/logo.png" height="20">
                </a>
            </div>
            <div class="col-md-9">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="#">My Loan</a></li>
                    <li><a href="#">My Info</a></li>
                    <li><a href="#">Service Request</a></li>
                    <li><a href="#">Downloads</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </div>
            <div class="col-md-1">
                <div class="dropdown">
                    @if(empty($user))
                        <a href="/login?q=/" class="auxiliary-color"> login </a>
                    @else
                        <span class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                              aria-expanded="false">{{ $user->name }} <span class="caret"></span></span>
                        <ul class="dropdown-menu">
                            <li><a href="#">My Info</a></li>
                            <li><a href="/logout">Sign Out</a></li>
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</nav>

@yield('myext')
<div class="container">
    @yield('content')
</div>

<div class="footer" id="footer">
    <h6> Copyright © 2019 Lending Bee Pte Ltd. All rights reserved. </h6>
</div>

<script type="text/javascript">
    $(function () {
            $("#footer").removeClass("fixed-bottom");
            var contentHeight = document.body.scrollHeight,
                winHeight = window.innerHeight;
            if (contentHeight < winHeight) {
                $("#footer").addClass("fixed-bottom");
            }
        }
    );
</script>

</body>
</html>
