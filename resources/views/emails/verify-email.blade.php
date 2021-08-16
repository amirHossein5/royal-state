<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ __('Verify Email Address') }}</title>
</head>
<style>
    h3 {
        text-align: center
    }

</style>

<body dir="rtl">
    <h3>{{ __('Verify Email Address') }}</h3>
    <h5>{{ __('Please click the button below to verify your email address.') }}</h5>

    <a href="{{ $url }}">
        {{ __('Verify Email Address') }}
    </a>
</body>

</html>
