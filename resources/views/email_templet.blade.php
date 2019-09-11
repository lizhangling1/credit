<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title> Lending Bee </title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <style type="text/css">
        * {
            font-family: "Microsoft Yahei";
            font-weight: normal;
        }

        .box {
            width: 60%;
            margin: 0 auto;
            background-color: #ed1c24;
            margin-top: 40px;
            border-radius: 6px;
            padding: 10px 30px;
            color: #ffffff;
        }

        .title {
            color: #fff;
            text-align: center;
            padding: 10px 0;
            font-size: 30px;
        }
    </style>

</head>
<body>

<div class="box">
    <h2 class="title"> Lending Bee </h2>
    <hr>
    <h3>Hi {{ $name }},</h3>
    <h4> To activate your account,please use the verification code below for email authentication:</h4>

    <div class="text-center" style="font-size: 60px; color: #ffd249;text-align: center">{{ $msg }}</div>

    <h4>Yours Sincerely,<br>The Lending Bee Team</h4>

    <div style="padding:20px 0;margin: 10px 0;color: #f5f5f5">
        <h5>Terms & Conditions:</h5>
        <h6>Terms & Conditions apply:Click <a target="_blank" href="https://www.lendingbee.com.sg">here</a> for
            details.</h6>

        <h5>To Contact US:</h5>
        <h6>Please do not reply to this email. You can reach us at
            <a href="mailto:support@lendingbee.com.sg">support@lendingbee.com.sg</a></h6>
    </div>
</div>
</body>

