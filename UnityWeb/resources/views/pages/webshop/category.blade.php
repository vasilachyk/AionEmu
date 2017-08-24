@extends('app')
@section('content')

    <section class="hero hero-panel" style="background-image: url({{ asset('images/default-backgorund.jpg') }});">
        <div class="hero-bg"></div>
        <div class="container">
            <div class="padding-top-25 no-padding-bottom border-bottom-1 border-grey-300">
                <div class="headline">
                    <h4 style="color: #fffbfb">Items Shop / {{ strtoupper($category->name) }}</h4>
                    <form action="{{ action('WebshopController@getIndex') }}" method="GET">
                        <div class="form-group">
                            <input type="text" name="itemname" value="{{ Input::get('itemname') }}" class="form-control hidden-xs" placeholder="Search items..." style="margin-right: 200px">
                        </div>
                    </form>
                    <div class="dropdown" style="margin-top: -47px">
                        <a href="#" class="btn btn-default btn-icon-left btn-icon-right dropdown-toggle" data-toggle="dropdown"><i class="ion-ios-pricetags"></i> Items category <i class="ion-android-arrow-dropdown"></i></a>
                        @include('includes.crumbs-webshop')
                    </div>
                </div>
            </div>
            <div class="row margin-top-40">
                @include('includes.form-messages')
                @if ( ! $items->isEmpty())
                    @foreach ($items as $item)
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-bottom-sm-30">
                            <div class="card card-hover">
                                <div class="card-img">
                                    <img src="/images/webshop/{{ $item->image_id }}.png" class="item-icon" alt="">
                                    <div class="category"><span class="label label-primary">{{ $item->price }} Credits</span></div>
                                </div>
                                <div class="caption">
                                    <h3 class="card-title"><a href="http://aiondatabase.net/us/item/{{ $item->item_id }}" target="_blank">{{ $item->name }}</a></h3>
                                    <p> ITEM AMOUNT : {{ $item->amount }} PCS <br>
                                        ITEM LEVEL : {{ $item->level }} <br>
                                        ENCHANT : {{ $item->enchant > 0 ? '+'. $item->enchant : 'N/A' }} <br>
                                        TEMPERANCE : {{ $item->temperance > 0 ? '+'. $item->temperance : 'N/A' }} <br>
                                        ITEM TYPE : {{ $item->type }} <br>
                                    </p>
                                    <a href="{{ action('WebshopController@getPurchase', $item->id) }}" class="btn btn-success btn-outline pos">Purchase<i class="fa fa-shopping-cart margin-left-10"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="pull-bottom text-center">
                        {!! $items->render() !!}
                    </div>
                @else
                    <p class="text-center">No items available.</p>
                @endif
            </div>
        </div>
    </section>

@endsection