@extends('admin')

@section('content')

	<div class="col-sm-12 col-md-12">
		<div class="page-header">
			<h3>Membership</h3>
		</div>

		<div class="row">
			<div class="col-sm-8">
				@include('admin.includes.memberships')
			</div>

			<div class="col-sm-4 well">

				@include('includes.form-messages')

				<form action="{{ action('Admin\MembershipController@postEdit', $membership->id) }}" method="POST">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">

					<div class="form-group">
						<label>Title</label>
						<input type="text" name="title" class="form-control" value="{{ $membership->title }}">
					</div>

					<div class="form-group">
						<label>Type</label>
						<select name="type" class="form-control">
							<option value="-1">-- Select Type --</option>
							@foreach ($categories as $category)
								<option value="{{ $category->id }}" {{ $category->id == $membership->type ? 'selected="selected"': '' }}>{{ $category->type }}</option>
							@endforeach
						</select>
					</div>

					<div class="form-group">
						<label>Duration (Days)</label>
						<input type="text" name="duration" class="form-control" value="{{ $membership->duration }}">
					</div>

					<div class="form-group">
						<label>Price</label>
						<input type="text" name="price" class="form-control" value="{{ $membership->price }}">
					</div>

					<div class="form-group">
						<input type="submit" name="submit" value="Update Privileges" class="btn btn-primary">
					</div>
				</form>
			</div>
		</div>

	</div>

@endsection