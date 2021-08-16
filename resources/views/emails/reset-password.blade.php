<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ __('Reset Password Notification') }}</title>
</head>

<style>
    h3 {
        text-align: center
    }
</style>

<body dir="rtl">
    <h3>{{ __('Reset Password Notification') }}</h3>
    <h5>{{ __('You are receiving this email because we received a password reset request for your account.') }}</h5>

    <a href="{{ $url }}">
        {{ __('Reset Password') }}
    </a>
</body>

</html>
