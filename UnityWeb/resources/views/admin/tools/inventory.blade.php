@extends('admin')

@section('content')

	<div class="col-sm-12 col-md-12">
		<div class="page-header">
			<h3>Tools / Search Player Inventory: {{ $player->name }}</h3>
		</div>

		<div class="row">

			<div class="col-sm-12">

				@include('includes.form-messages')

				@if ( ! $inventory->isEmpty())
					<a class="btn btn-danger" href="{{ action('Admin\ToolsController@postPlayerInventoryDeleteAll', $player->name) }}" data-method="post" data-confirm="Are you sure you want to delete all items of this player?" class="destroy-btn">Delete All Items</a>

					<form action="{{ action('Admin\ToolsController@postPlayerInventory') }}" method="POST" class="form-inline pull-right">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="player" value="{{ $player->name }}">

						<div class="form-group">
							<input type="text" name="itemid" class="form-control" placeholder="Search by itemid" value="{{ !empty(Input::get('itemid')) ? Input::get('itemid') : '' }}">
							<input type="submit" value="Filter" class="btn btn-primary">
						</div>
					</form>
				@endif

			</div>

			<div class="col-sm-12">

				@if ( ! $inventory->isEmpty())
					<table class="table">
						<thead>
							<tr>
								<td>Item</td>
								<td>Item Quantity</td>
								<td>Action</td>
							</tr>
						</thead>

						<tbody>
							@foreach ($inventory as $item)
							<tr>
								<td><a href="http://aiondatabase.net/us/item/{{ $item->item_id }}" target="_blank">{{ $item->item_id }}</a></td>
								<td>{{ $item->item_count }}</td>
								<td>
									<a class="btn btn-danger btn-xs" href="{{ action('Admin\ToolsController@postPlayerInventoryDelete', [$item->item_unique_id, $player->name]) }}" data-method="post" data-confirm="Are you sure you want to delete item {{ $item->item_id }}?" class="destroy-btn">Delete</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				@else
					This player has no items.
				@endif
			</div>
		</div>


	</div>

@endsection