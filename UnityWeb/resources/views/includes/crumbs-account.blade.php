
<div role="tabpanel">
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="{{ action('AccountController@getIndex') }}" aria-controls="account">Account</a></li>
        <li role="presentation" class="active"><a href="{{ action('AccountController@getPassword') }}" aria-controls="password">Change Password</a></li>
        <li role="presentation" class="active"><a href="{{ action('AccountController@getWebshopPurchase') }}" aria-controls="webshop-purchase">Webshop Purchases</a></li>
        <li role="presentation" class="active"><a href="{{ action('AccountController@getUnstuck') }}" aria-controls="webshop-purchase">Unstuck</a></li>
        <li role="presentation" class="active"><a href="{{ action('AccountController@getBan') }}" aria-controls="webshop-purchase">Char Ban</a></li>
    </ul>
</div>
    