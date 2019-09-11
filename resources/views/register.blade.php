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
        <div class="col-md-6 col-md-offset-3 login-box-shadow">
            <h2 class="text-center"><img alt="Brand" src="/img/logo.png" height="40"></h2>
            <p class="white-color"> Now, please sign up for your Lending Bee account. </p>
            <form action="/register/act" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="input" name="name" class="form-control" placeholder="Enter a name">
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Enter a email">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Enter a password">
                </div>
                <div class="form-group">
                    <input type="password" name="repassword" class="form-control"
                           placeholder="Enter the password again">
                </div>

                <div class="form-group">
                    <p class="white-color">
                        To continue,please read agree to <a href="#" class="grey-color"> Lending Bee TERMS OF USE &
                            PRIVACY POLICY. </a>
                    </p>
                    <div class="custom-control custom-checkbox white-color">
                        <input type="checkbox" class="custom-control-input" id="defaultChecked" name="policy" value="1"
                               checked>
                        <label class="custom-control-label" for="defaultChecked">I agree</label>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-primary" style="background-color: #444">REGISTER
                    </button>
                </div>

                <div class="form-group text-center">
                    <a href="/login" class="grey-color small-text"> Have an account,Go to land </a>
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
