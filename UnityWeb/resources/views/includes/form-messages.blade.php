@if (Session::has('success'))
	<p class="alert alert-success" style="color : #000">{{ Session::get('success') }}</p>
	{{ Session::forget('success') }}
@endif

@if (Session::has('failure'))
	<p class="alert alert-danger" style="color : #000">{{ Session::get('failure') }}</p>
	{{ Session::forget('failure') }}
@endif

@if ( ! $errors->isEmpty())
	<ul class="alert alert-danger" style="color : #000">
	@foreach($errors->all() as $error)
	    <li>{{$error}}</li>
	@endforeach
	</ul>
@endif