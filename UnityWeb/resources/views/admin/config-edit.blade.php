@extends('admin')

@section('content')

	<div class="col-sm-12 col-md-12">
		<div class="page-header"><h3>EDIT CONFIG SETTINGS</h3></div>
	</div>


	<div class="row">
		<div class="col-sm-12 col-md-12">
			<form class="form-inline" action="{{ action('Admin\DashboardController@postConfig') }}" method="POST">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">

					@include('includes.form-messages')

					<div class="col-sm-12 col-md-4">
						<div><strong>PORT CONFIGURATION</strong></div>
						<table class="table table-remove-stripe">
							<tbody>
								<tr>
									<td>
										Game Port
									</td>
									<td>
										<div class="form-group">
											<input type="text" name="game_port" value="{{ $config->game_port }}" class="form-control">
										</div>
									</td>
								</tr>

								<tr>
									<td>Login Port</td>
									<td>
										<div class="form-group">
											<input type="text" name="login_port" value="{{ $config->login_port }}" class="form-control">
										</div>
									</td>
								</tr>

								<tr>
									<td>Timeout</td>
									<td>
										<div class="form-group">
											<input type="text" name="timeout" value="{{ $config->timeout }}" class="form-control">
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>

					<div class="col-sm-12 col-md-4">
						<div><strong>MEMBERSHIP PRICES</strong></div>
						<table class="table table-remove-stripe">
							<tbody>
								<tr>
									<td>Premium Membership (1 Day)</td>
									<td>
										<div class="form-group">
											<input type="text" name="premium" value="{{ $config->membership_premium }}" class="form-control">
										</div>
									</td>
								</tr>

								<tr>
									<td>Vip Membership (1 Day)</td>
									<td>
										<div class="form-group">
											<input type="text" name="vip" value="{{ $config->membership_vip }}" class="form-control">
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>

					<div class="col-sm-12 col-md-4">
						<div><strong>RATES</strong></div>
						<table class="table table-remove-stripe">
							<tbody>
								<tr>
									<td>Exp</td>
									<td>
										<div class="form-group">
											<input type="text" name="exp" value="{{ $config->rate_exp }}" class="form-control">
										</div>
									</td>
								</tr>

								<tr>
									<td>Kinah</td>
									<td>
										<div class="form-group">
											<input type="text" name="kinah" value="{{ $config->rate_kinah }}" class="form-control">
										</div>
									</td>
								</tr>

								<tr>
									<td>Drop</td>
									<td>
										<div class="form-group">
											<input type="text" name="drop" value="{{ $config->rate_drop }}" class="form-control">
										</div>
									</td>
								</tr>

								<tr>
									<td>Quest</td>
									<td>
										<div class="form-group">
											<input type="text" name="quest" value="{{ $config->rate_quest }}" class="form-control">
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>

					<div class="col-sm-12 col-md-4">
						<div><strong>Donate</strong></div>
						<table class="table table-remove-stripe">
							<tbody>
								<tr>
									@if (config('aion.donate_type') == 'CREDITS')
										<td>Donate Points per USD $1</td>
										<td>
											<div class="form-group">
												<input type="text" name="donate_toll" value="{{ $config->donate_points }}" class="form-control">
											</div>
										</td>
									@else
										<td>Toll per USD $1</td>
										<td>
											<div class="form-group">
												<input type="text" name="donate_toll" value="{{ $config->donate_toll }}" class="form-control">
											</div>
										</td>
									@endif
								</tr>

								<tr>
									<td>Donate Rates</td>
									<td>
										<div class="form-group">
											<input type="text" name="donate_times" value="{{ $config->donate_times }}" class="form-control">
										</div>
									</td>
								</tr>

							</tbody>
						</table>
					</div>

				<div class="col-sm-12 col-md-12">
					<input type="submit" value="Update Settings" class="btn btn-primary">
				</div>
			</form>
		</div>
	</div>
@endsection