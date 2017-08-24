@extends('admin')

@section('content')

	<div class="col-sm-12 col-md-12">
		<div class="page-header">
			<h3>Webshop Add Item</h3>

			@include('includes.form-messages')
		</div>

		<form action="{{ action('Admin\WebshopController@store') }}" method="POST">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">

			<div class="row">
				<div class="col-sm-12 col-md-3">
					<div class="form-group">
						<label>Item ID</label>
						<input type="text" name="itemid" id="wsitemid" value="{{ old('itemid') }}" class="form-control">
					</div>
				</div>

				<div class="col-sm-12 col-md-3">
					<div class="form-group">
						<label>Name</label>
						<input type="text" name="name" value="{{ old('name') }}" class="form-control">
					</div>
				</div>
				
				<div class="col-sm-12 col-md-3">
				    <div class="form-group">
				        <label>Type</label>
				        <input type="text" name="type" value="{{ old('type') }}" class="form-control">
				    </div>
				</div>

				<div class="col-sm-12 col-md-3">
					<div class="form-group">
						<label>Level</label>
						<input type="text" name="level" value="{{ old('level') }}" class="form-control">
					</div>
				</div>

				<div class="col-sm-12 col-md-3">
					<div class="form-group">
						<label>Amount / Quantity</label>
						<input type="text" name="amount" value="{{ old('amount') }}" class="form-control">
					</div>
				</div>

				<div class="col-sm-12 col-md-3">
					<div class="form-group">
						<label>Enchant</label>
						<input type="text" name="enchant" value="{{ old('enchant') }}" class="form-control">
					</div>
				</div>

				<div class="col-sm-12 col-md-3">
					<div class="form-group">
						<label>Temperance</label>
						<input type="text" name="temperance" value="{{ old('temperance') }}" class="form-control">
					</div>
				</div>

				<div class="col-sm-12 col-md-3">
					<div class="form-group">
						<label>Price / Credit Points / Toll</label>
						<input type="text" name="price" value="{{ old('price') }}" class="form-control">
					</div>
				</div>

				<div class="col-sm-12 col-md-3">
					<div class="form-group">
						<label>Category</label>
						<select class="form-control" name="category">
							<option value="-1">-- Select Category --</option>
							@foreach ($shopCategory as $category)
								<option value="{{ $category->id }}" {{ be_selected(old('category'), $category->id) }}>{{ $category->name }}</option>
							@endforeach
						</select>
					</div>
				</div>
				
				<div class="col-sm-12 col-md-3">
				    <div class="form-group">
				        <label>Image ID</label>
				        <input type="text" class="form-control" name="image_id" value="{{ old ('image_id') }}">
				    </div>
				</div>

				<div class="col-sm-12 col-md-12">
					<input type="submit" value="Add Item" class="btn btn-primary pull-right">
				</div>
			</div>
		</form>
	</div>

@endsection