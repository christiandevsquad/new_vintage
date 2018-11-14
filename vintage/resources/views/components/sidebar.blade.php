<div class="sidenav" style="margin-top:10px;">
    <h4 style="text-align:center">MENU</h4>
    <a href="{{ action('ProductController@index') }}">Products</a>
    <a href="#">Orders</a>
    <a href="#">Customers</a>
    <a href="#">Analitycs</a>
    <a href="#">Discounts</a>
    <a href="#">Apps</a>
    {{ $slot }}
</div>    