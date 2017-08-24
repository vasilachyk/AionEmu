@if ( ! $news->isEmpty())
	@foreach ($news as $content)
		<div class="row">
			<div class="col-sm-12 col-md-8">
				<div>
					<span class="label label-info">{{ $content->catTitle }}</span> <a href="{{ action('NewsController@getNews', [$content->id, $content->slug])}}">{{ $content->title }}</a>
				</div>
				<div><i>Created By: {{ $content->createdby_name }}</i></div>
			</div>

			<div class="col-sm-12 col-md-4">
				<div class="text-center">
					{{ to_human_date($content->updated_at) }}
				</div>
			</div>
		</div>
	@endforeach
@else
	No News
@endif