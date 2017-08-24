@extends('admin')

@section('content')

	<div class="col-sm-12 col-md-12">
		<div class="page-header">
			<h3>Webshop
				<small><a class="btn btn-primary btn-sm pull-right" href="{{ action('Admin\WebshopController@create') }}">Add Item</a></small>
			</h3>

			@include('includes.form-messages')
		</div>

	<div class="col-sm-12 col-md-12 mbt">

		@include('includes.form-messages')

		<div class="col-sm-12 mbt">
			<form action="{{ action('Admin\WebshopController@index') }}" method="GET" class="pull-right">
				<div class="form-inline">
					<input type="text" name="itemname" value="{{ Input::get('itemname') }}" placeholder="Search by itemname" class="form-control">
					<input type="submit" value="Search" class="btn btn-primary">
				</div>
			</form>
		</div>

	</div>

		<table class="table">
			<thead>
				<tr>
					<th>ITEMID</th>
					<th>Level</th>
					<th>Name</th>
					<th>Type</th>
					<th>Enchant</th>
					<th>Temperance</th>
					<th>Category</th>
					<th>Quantity</th>
					<th>Price</th>
					<th>Image ID</th>
					<th class="text-center">Action</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($items as $item)
					<tr>
						<td><a href="http://aiondatabase.net/us/item/{{ $item->item_id }}" target="_blank">{{ $item->item_id }}</a></td>
						<td>{{ $item->level }}</td>
						<td><a href="http://aiondatabase.net/us/item/{{ $item->item_id }}" target="_blank">{{ $item->name }}</a></td>
                        <td>{{ $item->type }}</td>
						<td>{{ $item->enchant }}</td>
						<td>{{ $item->temperance }}</td>
						<td>{{ $item->cat_name }}</td>
						<td>{{ $item->amount }}</td>
						<td>{{ $item->price }}</td>
				        <td><img src="/images/webshop/{{ $item->image_id }}.png" class="item-icon" alt=""></td>
						<td class="text-center">
							<div class="btn-group">
							  <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
							    Action <span class="caret"></span>
							  </button>
							  <ul class="dropdown-menu" role="menu">
							    <li><a href="{{ action('Admin\WebshopController@edit', $item->id) }}">Edit</a></li>
							    <li><a href="{{ action('Admin\WebshopController@destroy', $item->id) }}" data-method="delete" data-remote="true" data-confirm="Are you sure you want to delete item {{ $item->name }}?" class="destroy-btn">Delete</a></li>
							  </ul>
							</div>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		<div class="pull-right">
			@if (! empty(Input::get('itemname')))
				{!! $items->appends(['itemname' => Input::get('itemname')])->render() !!}
			@else
				{!! $items->render() !!}
			@endif
		</div>

	</div>

@endsection