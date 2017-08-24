@if ( ! $memberships->isEmpty())
	<table class="table ">
		<thead>
			<tr>
				<td>Title</td>
				<td>Type</td>
				<td>Duration</td>
				<td>Price</td>
				<td>Action</td>
			</tr>
		</thead>

		<tbody>
			@foreach ($memberships as $membership)
				<tr>
					<td>{{ $membership->title }}</td>
					<td>{{ $membership->tname }}</td>
					<td>{{ $membership->duration }}</td>
					<td>{{ $membership->price }}</td>
					<td class="text-center">
						<div class="btn-group">
						  <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						    Action <span class="caret"></span>
						  </button>
						  <ul class="dropdown-menu" role="menu">
						    <li><a href="{{ action('Admin\MembershipController@getEdit', $membership->id) }}">Edit</a></li>
						    <li><a href="{{ action('Admin\MembershipController@postDelete', $membership->id) }}" data-method="post" data-remote="true" data-confirm="Are you sure you want to delete privilege {{ $membership->title }}?" class="destroy-btn">Delete</a></li>
						  </ul>
						</div>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	No membership available.
@endif