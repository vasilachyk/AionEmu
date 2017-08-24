
<span>
	Game:
	@if ($game)
		<span class="label label-success">Online</span>
	@else
		<span class="label label-danger">Offline</span>
	@endif

	Login:
	@if ($login)
		<span class="label label-success">Online</span>
	@else
		<span class="label label-danger">Offline</span>
	@endif
</span>

