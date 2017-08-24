@extends('app')

@section('content')

	<div class="page-header"><h4>INFORMATION</h4></div>

	<div class="rb">

		<b>Game Server:</b> {{ Status::gameServer('188.40.141.199', Settings::general()->port_game) }} <br>
		<b>Login Server:</b> {{ Status::loginServer('188.40.141.199', Settings::general()->port_login) }} <br>
		<b>Online Players:</b> {{ Status::onlineCount() }} <br>
		<b>Most Online Ever:</b> {{ Status::onlinePeakCount() }} <br>
		<b>Most Online Last 24 Hours:</b>  {{ Status::onlinePeakCount24Hrs() }}<br>
		<b>Online Asmodians:</b> {{ Status::onlineAsmo() }} <br>
		<b>Online Elyos:</b> {{ Status::onlineEly() }} <br>
		<b>Total Accounts:</b> {{ Status::totalAccounts() }} <br>
		<b>Total Players:</b> {{ Status::totalPlayers() }} <br>
		<b>Total Legions:</b> {{ Status::totalLegions() }} <br>
		<b>Asmodian Legions:</b> {{ Status::totalLegionsPerRace('ASMODIANS') }} <br>
		<b>Elyos Legions:</b> {{ Status::totalLegionsPerRace('ELYOS') }} <br>
		<b>GMs Online Now:</b> {{ Status::totalGmsOnline() }} <br>
		<b>Total GMs:</b> {{ Status::totalGms() }} <br>
		<b>Total Asmodians:</b> {{ Status::totalAsmo() }} <br>
		<b>Total Elyos:</b> {{ Status::totalEly() }}
		<br><br>

		<div class="page-header"><h4>Total Players Per Class</h4></div>

		<div class="row">
			@foreach (Status::playerClass() as $class)
				<div class="col-sm-3">
				<b>{{ $class == 'SPIRIT_MASTER' ? ucfirst(strtolower(str_replace('_', '', $class))) : ucfirst(strtolower($class)) }}</b> : {{ Status::totalPlayerCountPerClass($class) }}
				</div>
			@endforeach
		</div>
		<br>

		<div class="page-header"><h4>Server Rates</h4></div>

		<div class="row">
			<div class="col-sm-4">
				<b>Normal Rates:</b> <br>
				Quest GP: x20 <br>
				Gathering XP: x500 <br>
				Gathering Count: x500  <br>
				Crafting XP: x500 <br>
				Pet Feeding: x150 <br>
				Quest Kinah: x100 <br>
				Quest AP: x100 <br>
				Drop: x150  <br>
				PvP AP: x10 <br>
				PvE AP: x10 <br>
				PvE GP: x10 <br>
				PvE DP: x50 <br>
				PvP Discipline Arena Reward: x15 <br>
				PvP Chaos Arena Reward: x15 <br>
				PvP Harmony Arena Reward: x15 <br> 
				PvP Glory Arena Reward: x15 <br>
				Sell Limits: x24 <br>
			</div>

			<div class="col-sm-4">
				<b>Premium Rates:</b> <br>
				Quest GP: x30 <br>
				Gathering XP: x1000 <br>
				Gathering Count: x1000  <br>
				Crafting XP: x1000 <br>
				Pet Feeding: x200 <br>
				Quest Kinah: x200 <br>
				Quest AP: x200 <br>
				Drop: x175  <br>
				PvP AP: x15 <br>
				PvE AP: x15 <br>
				PvE GP: x15 <br>
				PvE DP: x75 <br>
				PvP Discipline Arena Reward: x25 <br>
				PvP Chaos Arena Reward: x25 <br>
				PvP Harmony Arena Reward: x25 <br> 
				PvP Glory Arena Reward: x25 <br>
				Sell Limits: x34 <br>
			</div>

			<div class="col-sm-4">
				<b>Vip Rates:</b> <br>
				Quest GP: x40 <br>
				Gathering XP: x1500 <br>
				Gathering Count: x1500  <br>
				Crafting XP: x1500 <br>
				Pet Feeding: x250 <br>
				Quest Kinah: x300 <br>
				Quest AP: x300 <br>
				Drop: x200  <br>
				PvP AP: x25 <br>
				PvE AP: x25 <br>
				PvE GP: x25 <br>
				PvE DP: x100 <br>
				PvP Discipline Arena Reward: x35 <br>
				PvP Chaos Arena Reward: x35 <br>
				PvP Harmony Arena Reward: x35 <br> 
				PvP Glory Arena Reward: x35 <br>
				Sell Limits: x44 <br>
			</div>
		</div>
	</div>
@endsection
