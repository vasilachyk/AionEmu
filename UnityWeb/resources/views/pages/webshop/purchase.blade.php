@extends('app')
@section('content')

    <section class="hero hero-games height-300" style="background-image: url({{ asset('images/costume.jpg') }});">
        <div class="hero-bg"></div>
        <div class="container">
            <div class="page-header">
                <div class="page-title bold"><a href="http://aiondatabase.net/us/item/{{ $item->item_id }}" target="_blank">Purchase Items : {{ $item->name }}</a></div>
                <p style="text-transform: uppercase">Items Count : {{ $item->amount }} pcs * Enchant : {{ $item->enchant > 0 ? '+'. $item->enchant : 'N/A' }} * Temperance : {{ $item->temperance > 0 ? '+'. $item->temperance : 'N/A' }} * Item Type : {{ $item->type }} * Item Level : {{ $item->level }}</p>
                <div class="page-title bold" style="font-size: 18px">{!! Helper::webshop_discount($item->price, Auth::user()->membership, Auth::user()->expire) !!}.</div>
            </div>
        </div>
    </section>

    <section class="bg-primary subtitle-lg">
		 @include('includes.form-messages')
        <div class="container">
            <h2>Are you sure about purchase this items..</h2>
            @if ( ! $players->isEmpty())
            <form class="form-horizontal" action="{{ action('WebshopController@postPurchase') }}" method="POST" data-confirm="Are you sure you want to purchase this item?">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="itemid" value="{{ $item->id }}">
				<p>Select Character First</p>
                <div class="form-group">
                    <div class="col-sm-8 options-style">
                        <select name="player" class="styled-select">
                            <option value="-1">-- N/A --</option>
                            @foreach ($players as $player)
                                <option value="{{ $player->id }}">{{ $player->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
				<button type="submit" class="btn btn-white btn-outline">Purchase Now<i class="fa fa-shopping-cart margin-left-10"></i></button>
            </form>
            @else <p>You have no characters on this account. <br> Create Character First !<br></p>
            @endif
            <p>Current Credits : @include('includes.toll')</p>
        </div>
    </section>

@endsection