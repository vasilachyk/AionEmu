@extends('admin')

@section('content')

	<div class="col-sm-12 col-md-12">
		<div class="page-header">
			<h3>Tools / Search Player Inventory</h3>
		</div>


		<div class="row">
			<div class="col-sm-6">
				@include('includes.form-messages')

				<form action="{{ action('Admin\ToolsController@postPlayerInventory') }}" method="POST">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-group">
						<label>Player Name</label>
						<input type="text" name="player" class="form-control" value="{{ old('player') }}">
					</div>

					<div class="form-group">
						<input type="submit" value="Search" class="btn btn-primary">
					</div>
				</form>
			</div>
		</div>


	</div>

@endsection