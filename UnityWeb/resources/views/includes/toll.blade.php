@if (Settings::general()->donate_type == 'CREDITS')
    Current {{ Settings::general()->credit_name }}: {{ Auth::user()->donate_points }}
@else
    Current I-Coin(s): {{ Auth::user()->toll }}
@endif