@extends('app')

@section('content')

	<section class="hero hero-panel" style="background-image: url({{ asset('images/default-backgorund.jpg') }});">
		<div class="hero-bg"></div>
		<div class="container">
			<h3>History Purchase Items</h3>
			<p>Account name : {{ Auth::user()->name }}</p>

			<div class="alert alert-warning alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				* History <strong>Webshop</strong> Purchase Items.
			</div>

	@include('includes.crumbs-account')
    &nbsp;

	@if ( ! $weblogs->isEmpty())

	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th>Item</th>
				<th>Amount</th>
				<th>Price</th>
				<th>Enchant</th>
				<th>Temperance</th>
				<th>Buy Date</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($weblogs as $weblog)
			<tr>
				<td><a href="http://aiondatabase.net/us/item/{{ $weblog->item }}" target="_blank">{{ $weblog->item }}</a></a></td>
				<td>{{ $weblog->amount }}</td>
				<td>{{ $weblog->price }}</td>
				<td>{{ $weblog->enchant > 0 ? '+'. $weblog->enchant : 'N/A' }}</td>
				<td>{{ $weblog->temperance > 0 ? '+'. $weblog->temperance : 'N/A' }}</td>
				<td>{{ Carbon::parse($weblog->created_at)->toDayDateTimeString() }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	@else
		No log available.
	@endif
</div>

@endsection