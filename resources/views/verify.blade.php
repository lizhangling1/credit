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
</head>
<body>

<div class="grap"></div>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <h2 class="">Email authentication</h2>
            <p class="">
                Enter your verification code sent to your email. If not received, you can click
                <a href="/send/mail"> here </a> to resend.
            </p>
            <form action="/email/verify" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="text" name="code" class="form-control" placeholder="Enter confirmation code">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-primary">CERTIFICATION</button>
                </div>
            </form>
            <div class="form-group">
                <p>* If it does not exist, please check the trash can.</p>
            </div>
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

