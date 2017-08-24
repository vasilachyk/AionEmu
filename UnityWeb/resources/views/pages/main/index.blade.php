@extends('app')
@section('content')
    @include('slider.slider')

    <section class="bg-grey-50 border-bottom-1 border-grey-200 relative">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="title outline">
                        <h4><i class="fa fa-heart"></i>Lastest News</h4>
                        <p>News And Announcements In Game / Out Games. Please read first before login!</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @if ( ! $news->isEmpty())
                    @foreach ($news as $content)
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="news news-hover">
                                <div class="news-img">
                                    <img src="{{ asset('images/news/default.jpg') }}" alt="">
                                    <div class="category"><span class="label label-primary">{{ $content->catTitle }}</span></div>
                                    <div class="meta"></div>
                                </div>
                                <div class="caption">
                                    <h3 class="news-title"><a>{{ $content->title }}</a></h3>
                                    <ul>
                                        <li>{{ to_human_date($content->created_at) }}</li>
                                    </ul>
                                    <p>{!! $content->content !!}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else <div class="text-center">No news available.</div>
                @endif
            </div>
        </div>
    </section>

@endsection