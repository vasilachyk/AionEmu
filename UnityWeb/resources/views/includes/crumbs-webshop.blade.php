@if ( ! $shopCategory->isEmpty())
    <ul class="dropdown-menu">
        <li><a href="{{ action('WebshopController@getIndex') }}">&rArr; &nbsp;All Category</a></li>
        @foreach ($shopCategory as $category)
            <li><a href="{{ action('WebshopController@getCategory', $category->slug) }}">&rArr; &nbsp;{{ ucfirst($category->name) }}</a></li>
        @endforeach
    </ul>
@endif