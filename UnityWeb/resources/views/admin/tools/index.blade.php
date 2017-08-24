@extends('admin')

@section('content')

	<div class="col-sm-12 col-md-12">
		<div class="page-header">
			<h3>Tools</h3>

			@include('includes.form-messages')
		</div>

		<div class="row">
			<div class="col-sm-3">
				<a class="btn btn-primary" href="{{ action('Admin\ToolsController@getSendItem') }}">Send Item</a>
			</div>

			<div class="col-sm-3">
				<a class="btn btn-primary" href="{{ action('Admin\ToolsController@getInventory') }}">Search Player Inventory</a>
			</div>
		</div>

	</div>

@endsection