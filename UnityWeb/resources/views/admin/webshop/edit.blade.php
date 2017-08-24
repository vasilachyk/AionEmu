@extends('admin')

@section('content')

	<div class="col-sm-12 col-md-12">
		<div class="page-header">
			<h3>Webshop Edit Item</h3>

			@include('includes.form-messages')
		</div>

		<form action="{{ action('Admin\WebshopController@update', $item->id) }}" method="POST">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="_method" value="PUT">

			<div class="row">
				<div class="col-sm-12 col-md-3">
					<div class="form-group">
						<label>Item ID</label>
						<input type="text" name="itemid" id="wsitemid" value="{{ $item->item_id }}" class="form-control">
					</div>
				</div>

				<div class="col-sm-12 col-md-3">
					<div class="form-group">
						<label>Name</label>
						<input type="text" name="name" value="{{ $item->name }}" class="form-control">
					</div>
				</div>
				
				<div class="col-sm-12 col-md-3">
				    <div class="form-group">
				        <label>Type</label>
				        <input type="text" name="type" value="{{ $item->type }}" class="form-control">
				    </div>
				</div>

				<div class="col-sm-12 col-md-3">
					<div class="form-group">
						<label>Level</label>
						<input type="text" name="level" value="{{ $item->level }}" class="form-control">
					</div>
				</div>

				<div class="col-sm-12 col-md-3">
					<div class="form-group">
						<label>Amount / Quantity</label>
						<input type="text" name="amount" value="{{ $item->amount }}" class="form-control">
					</div>
				</div>

				<div class="col-sm-12 col-md-3">
					<div class="form-group">
						<label>Enchant</label>
						<input type="text" name="enchant" value="{{ $item->enchant }}" class="form-control">
					</div>
				</div>

				<div class="col-sm-12 col-md-3">
					<div class="form-group">
						<label>Temperance</label>
						<input type="text" name="temperance" value="{{ $item->temperance }}" class="form-control">
					</div>
				</div>

				<div class="col-sm-12 col-md-3">
					<div class="form-group">
						<label>Price / Credit Points / Toll</label>
						<input type="text" name="price" value="{{ $item->price }}" class="form-control">
					</div>
				</div>

				<div class="col-sm-12 col-md-3">
					<div class="form-group">
						<label>Category</label>
						<select class="form-control" name="category">
							<option value="-1">-- Select Category --</option>
							@foreach ($shopCategory as $category)
								<option value="{{ $category->id }}" {{ be_selected($item->category_id, $category->id) }}>{{ $category->name }}</option>
							@endforeach
						</select>
					</div>
				</div>
				
				<div class="col-sm-12 col-md-3">
				    <div class="form-group">
				        <label>Image ID</label>
				        <input type="text" class="form-control" name="image_id" value="{{ $item->image_id }}">
				    </div>
				</div>

				<div class="col-sm-12 col-md-12">
					<input type="submit" value="Update Item" class="btn btn-primary pull-right">
				</div>
			</div>
		</form>
	</div>

@endsection