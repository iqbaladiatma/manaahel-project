<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('auth.emails.verify.subject') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #4F46E5;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f9fafb;
            padding: 30px;
            border: 1px solid #e5e7eb;
        }
        .button {
            display: inline-block;
            background-color: #4F46E5;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            padding: 20px;
            color: #6b7280;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ config('app.name') }}</h1>
    </div>
    <div class="content">
        <h2>{{ __('auth.emails.verify.greeting', ['name' => $user->name]) }}</h2>
        <p>{{ __('auth.emails.verify.line1') }}</p>
        <p>{{ __('auth.emails.verify.line2') }}</p>
        <div style="text-align: center;">
            <a href="{{ $verificationUrl }}" class="button">
                {{ __('auth.emails.verify.action') }}
            </a>
        </div>
        <p>{{ __('auth.emails.verify.line3') }}</p>
        <p style="word-break: break-all; color: #6b7280; font-size: 14px;">
            {{ $verificationUrl }}
        </p>
        <p>{{ __('auth.emails.verify.line4') }}</p>
    </div>
    <div class="footer">
        <p>{{ __('auth.emails.verify.footer') }}</p>
    </div>
</body>
</html>
