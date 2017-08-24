<small class="pull-right">
	@if (Settings::general()->vote_type == 'CREDITS')
		Current {{ Settings::general()->credit_name }}: {{ Auth::user()->donate_points }}
	@else
		Current Toll(s): {{ Auth::user()->toll }}
	@endif
</small>