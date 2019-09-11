<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title> Lending Bee </title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <link rel="stylesheet" href="/css/bootstrap2.css">
    <link rel="stylesheet" href="/css/myext.css">

    <script type="text/javascript" src="/js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="/js/layer.js"></script>

    <!-- 谷歌验证码 -->
    {!! htmlScriptTagJsApi() !!}
</head>
<body>

<div class="grap"></div>

<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 login-box-shadow">
            <h2 class="text-center"><img alt="Brand" src="/img/logo.png" height="40"></h2>
            <p class="white-color"> Now, please sign in to your account </p>
            <form action="/login/act" method="post">
                <input type="hidden" name="next" value="{{ $next }}"/>
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Enter a email">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Enter your password">
                </div>

                <div class="form-group">
                    {!! htmlFormSnippet() !!}
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-primary" style="background-color: #444">LOGIN
                    </button>
                </div>

                <div class="form-group text-center">
                    <p><a href="/register" class="grey-color small-text">
                            New to Lending Bee? Sign up for an account </a>
                    </p>
                    <a href="/" class="grey-color small-text"> Go to the home. </a>
                </div>
            </form>
        </div>
    </div>

    <script type="text/javascript">
        var error = "{{count($errors)>0?$errors->first():''}}";

        if (error) {
            layer.confirm(error, {
                btn: ['ok']
            });
        }
    </script>
</div>

