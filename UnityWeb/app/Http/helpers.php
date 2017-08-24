<?php

use Carbon\Carbon;

if ( ! function_exists('min_diff'))
{
	function min_diff($date, $min)
	{
		$created = new Carbon($date);
		$now = Carbon::now();

		return $created->diffInMinutes($now) > $min ? true : false;
	}
}

if ( ! function_exists('random_string'))
{
	function random_string($length = 42)
	{
		// We'll check if the user has OpenSSL installed with PHP. If they do
		// we'll use a better method of getting a random string. Otherwise, we'll
		// fallback to a reasonably reliable method.
		if (function_exists('openssl_random_pseudo_bytes'))
		{
			// We generate twice as many bytes here because we want to ensure we have
			// enough after we base64 encode it to get the length we need because we
			// take out the "/", "+", and "=" characters.
			$bytes = openssl_random_pseudo_bytes($length * 2);
			// We want to stop execution if the key fails because, well, that is bad.
			if ($bytes === false)
			{
				throw new \RuntimeException('Unable to generate random string.');
			}
			return substr(str_replace(array('/', '+', '='), '', base64_encode($bytes)), 0, $length);
		}
		$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
	}
}

if ( ! function_exists('to_readable_date'))
{
	function to_readable_date($date)
	{
		return Carbon::createFromFormat('Y-m-d', $date)->toDateString();
	}
}

if ( ! function_exists('to_human_date'))
{
	function to_human_date($date)
	{
		return Carbon::parse($date)->toFormattedDateString();
	}
}

if ( ! function_exists('remove_trailing_zeros'))
{
	function remove_trailing_zeros($number)
	{
    	return strpos($number, '.') !== false ? rtrim(rtrim($number, '0'), '.') : $number;
	}
}

if ( ! function_exists('parse_item'))
{
	function parse_item($id)
	{
		$xml = 'http://www.aiondatabase.com/xml/en_US/items/xmls/'.$id.'.xml'; // EXAMPLE: http://www.aiondatabase.com/xml/en_US/items/xmls/182207845.xml
		$xmlstr = @file_get_contents($xml);
		if ($xmlstr === FALSE) return false; //die('Error connect to xml: '.$xml);
		$xml = new SimpleXMLElement($xmlstr);
		if ($xml === FALSE) return false; //die('Error parse xml: '.$xml);

		foreach ($xml->xpath('//aionitem') as $item ) {
			$info['name'] = $item->name;
			$info['level'] = $item->level;
		}

		return $info;
	}
}

if ( ! function_exists('data_status'))
{
	function data_status($activate)
	{
		return $activate == 0 ? '<font color="red">Deactivated</font>' : '<font color="green">Activated</font>';
	}
}

if ( ! function_exists('be_selected'))
{
	function be_selected($name, $same)
	{
		return $name === $same ? 'selected="selected"' : '';
	}
}

if ( ! function_exists('account_access'))
{
	function account_access($access)
	{
		if ($access == 0)
		{
			$access_level = '<font>Player</font>';
		}
		elseif ($access == 1)
		{
			$access_level = '<font color="orange">Trainee-GM</font>';
		}
		elseif ($access == 2)
		{
			$access_level = '<font color="blue">Junior-GM</font>';
		}
		elseif ($access == 3)
		{
			$access_level = '<font color="blue">Senior-GM</font>';
		}
		elseif ($access == 4)
		{
			$access_level = '<font color="red">Head-GM</font>';
		}
		elseif ($access == 5)
		{
			$access_level = '<font color="red">Admin</font>';
		}
		else
		{
			$access_level = '<font color="red">Super Administrator</font>';
		}

		return $access_level;
	}
}

if ( ! function_exists('account_activated'))
{
	function account_activated($activate)
	{
		return $activate == 0 ? '<font color="red">Deactivated</font>' : '<font color="green">Activated</font>';
	}
}

if ( ! function_exists('account_privileges_no_expiry'))
{
	function account_privileges_no_expiry($status)
	{
		if ($status == 1)
		{
			$membership = 'Premium';
		}
		elseif ($status == 2)
		{
			$membership = 'VIP';
		}
		else
		{
			$membership = 'Normal';
		}

		return $membership;
	}
}

if ( ! function_exists('account_privileges'))
{
	function account_privileges($status, $expiry)
	{
		if ($status == 1 && $expiry > Carbon::now()->toDateString() || $status == 1 && is_null($expiry))
		{
			$membership = 'Premium';
		}
		elseif ($status == 2 && $expiry > Carbon::now()->toDateString() || $status == 2 && is_null($expiry))
		{
			$membership = 'VIP';
		}
		else
		{
			$membership = 'Normal';
		}

		return $membership;
	}
}

if ( ! function_exists('char_online'))
{
	function char_online($status)
	{
		return $status == 0 ? '<img src="' . asset("img_icons/off.png") . '" title="Offline">' : '<img src="' . asset("img_icons/on.png") . '" title="Online">';
	}
}

if ( ! function_exists('char_exptolevel'))
{
	function char_exptolevel($var)
	{
		if ($var <= '400') return '1';
		elseif ($var <= '1433') return '2';
		elseif ($var <= '3820') return '3';
		elseif ($var <= '9054') return '4';
		elseif ($var <= '17655') return '5';
		elseif ($var <= '30978') return '6';
		elseif ($var <= '52010') return '7';
		elseif ($var <= '82982') return '8';
		elseif ($var <= '126069') return '9';
		elseif ($var <= '182252') return '10';
		elseif ($var <= '260622') return '11';
		elseif ($var <= '360825') return '12';
		elseif ($var <= '490331') return '13';
		elseif ($var <= '649169') return '14';
		elseif ($var <= '844378') return '15';
		elseif ($var <= '1083018') return '16';
		elseif ($var <= '1401356') return '17';
		elseif ($var <= '1808613') return '18';
		elseif ($var <= '2314771') return '19';
		elseif ($var <= '2941893') return '20';
		elseif ($var <= '3769257') return '21';
		elseif ($var <= '4811154') return '22';
		elseif ($var <= '6110198') return '23';
		elseif ($var <= '7632340') return '24';
		elseif ($var <= '9377726') return '25';
		elseif ($var <= '11395643') return '26';
		elseif ($var <= '13731725') return '27';
		elseif ($var <= '16339413') return '28';
		elseif ($var <= '19378549') return '29';
		elseif ($var <= '23252749') return '30';
		elseif ($var <= '27675843') return '31';
		elseif ($var <= '32911197') return '32';
		elseif ($var <= '39197217') return '33';
		elseif ($var <= '47420762') return '34';
		elseif ($var <= '57899684') return '35';
		elseif ($var <= '70724362') return '36';
		elseif ($var <= '87641065') return '37';
		elseif ($var <= '107088757') return '38';
		elseif ($var <= '129885732') return '39';
		elseif ($var <= '157281282') return '40';
		elseif ($var <= '189342188') return '41';
		elseif ($var <= '227003751') return '42';
		elseif ($var <= '267317400') return '43';
		elseif ($var <= '310123925') return '44';
		elseif ($var <= '355885203') return '45';
		elseif ($var <= '404893687') return '46';
		elseif ($var <= '456755353') return '47';
		elseif ($var <= '511753757') return '48';
		elseif ($var <= '570232075') return '49';
		elseif ($var <= '632338545') return '50';
		elseif ($var <= '701655822') return '51';
		elseif ($var <= '776901823') return '52';
		elseif ($var <= '857160855') return '53';
		elseif ($var <= '941190930') return '54';
		elseif ($var <= '1037885487') return '55';
		elseif ($var <= '1149277979') return '56';
		elseif ($var <= '1276707285') return '57';
		elseif ($var <= '1420814969') return '58';
		elseif ($var <= '1584752478') return '59';
		elseif ($var <= '1823962406') return '60';
		elseif ($var <= '2072828069') return '61';
		elseif ($var <= '2330507012') return '62';
		elseif ($var <= '2611618633') return '63';
		elseif ($var <= '3120186907') return '64';
		elseif ($var <= '3704748142') return '65';
		else return '60';
	}
}

if ( ! function_exists('char_race'))
{
	function char_race($race)
	{
		if ($race == 'ELYOS') { $raceImg = '<img src="' . asset("img_icons/ely.png") . '" title="Elyos">'; }
		elseif ($race == 'ASMODIANS') { $raceImg = '<img src="' . asset("img_icons/asmo.png") . '" title="Asmodian">'; }
		return $raceImg;
	}
}

if ( ! function_exists('char_class'))
{
	function char_class($class)
	{
		if($class == 'WARRIOR') { $player_class = '<img src="' . asset("img_icons/warrior.png") . '" title="Warrior">'; }
		elseif($class == 'GLADIATOR') { $player_class = '<img src="' . asset("img_icons/gladiator.png") . '" title="Gladiator">'; }
		elseif($class == 'TEMPLAR') { $player_class = '<img src="' . asset("img_icons/templar.png") . '" title="Templar">'; }
		elseif($class == 'SCOUT') { $player_class = '<img src="' . asset("img_icons/scout.png") . '" title="Scout">'; }
		elseif($class == 'ASSASSIN') { $player_class = '<img src="' . asset("img_icons/assassin.png") . '" title="Assassin">'; }
		elseif($class == 'RANGER') { $player_class = '<img src="' . asset("img_icons/ranger.png") . '" title="Ranger">'; }
		elseif($class == 'MAGE') { $player_class = '<img src="' . asset("img_icons/mage.png") . '" title="Мage">'; }
		elseif($class == 'SORCERER') { $player_class = '<img src="' . asset("img_icons/sorcerer.png") . '" title="Sorcerer">'; }
		elseif($class == 'SPIRIT_MASTER') { $player_class = '<img src="' . asset("img_icons/spiritmaster.png") . '" title="Spiritmaster">'; }
		elseif($class == 'PRIEST') { $player_class = '<img src="' . asset("img_icons/priest.png") . '" title="Priest">'; }
		elseif($class == 'CLERIC') { $player_class = '<img src="' . asset("img_icons/cleric.png") . '" title="Cleric">'; }
		elseif($class == 'CHANTER') { $player_class = '<img src="' . asset("img_icons/chanter.png") . '" title="Chanter">'; }
		elseif($class == 'ENGINEER') { $player_class = '<img src="' . asset("img_icons/engineer.png") . '" title="Engineer">'; }
		elseif($class == 'GUNNER') { $player_class = '<img src="' . asset("img_icons/gunner.png") . '" title="Gunner">'; }
		elseif($class == 'RIDER') { $player_class = '<img src="' . asset("img_icons/rider.png") . '" title="Rider">'; }
		elseif($class == 'ARTIST') { $player_class = '<img src="' . asset("img_icons/artist.png") . '" title="Artist">'; }
		elseif($class == 'BARD') { $player_class = '<img src="' . asset("img_icons/bard.png") . '" title="Bard">'; }

		return $player_class;
	}
}

if ( ! function_exists('char_gender'))
{
	function char_gender($gender)
	{
		if ($gender == 'MALE') { $genderPlayer = "<img src='" . asset('img_icons/male.png') . "' title='Male' />"; }
		elseif ($gender == 'FEMALE') { $genderPlayer = "<img src='" . asset('img_icons/female.png') . "' title='Female' />"; }

		return $genderPlayer;
	}
}

if ( ! function_exists('world_location'))
{
	function world_location($world)
	{
		if($world == 110010000) { $location = "Sanctum"; }
		else if($world == 110070000) { $location = "Kaisinel Academy"; }
		else if($world == 120010000) { $location = "Pandaemonium"; }
		else if($world == 120020000) { $location = "Marchutan Temple"; }
		else if($world == 120080000) { $location = "Marchutan Priory"; }
		else if($world == 210010000) { $location = "Poeta"; }
		else if($world == 210020000) { $location = "Eltnen"; }
		else if($world == 210030000) { $location = "Verteron"; }
		else if($world == 210040000) { $location = "Heiron"; }
		else if($world == 210050000) { $location = "Inggison"; }
		else if($world == 210060000) { $location = "Theobomos"; }
		else if($world == 220010000) { $location = "Ishalgen"; }
		else if($world == 220020000) { $location = "Morheim"; }
		else if($world == 220030000) { $location = "Altgard"; }
		else if($world == 220040000) { $location = "Beluslan"; }
		else if($world == 220050000) { $location = "Brusthonin"; }
		else if($world == 220070000) { $location = "Gelkmaros"; }
		else if($world == 300030000) { $location = "Nochsana Training Camp"; }
		else if($world == 300040000) { $location = "Dark Poeta"; }
		else if($world == 300050000) { $location = "Asteria Chamber"; }
		else if($world == 300060000) { $location = "Sulfur Tree Nest"; }
		else if($world == 300070000) { $location = "Chamber of Roah"; }
		else if($world == 300080000) { $location = "Left Wing Chamber"; }
		else if($world == 300090000) { $location = "Right Wing Chamber"; }
		else if($world == 300100000) { $location = "Steel Rake"; }
		else if($world == 300110000) { $location = "Dredgion"; }
		else if($world == 300120000) { $location = "Kysis Chamber"; }
		else if($world == 300130000) { $location = "Miren Chamber"; }
		else if($world == 300140000) { $location = "Krotan Chamber"; }
		else if($world == 300150000) { $location = "Udas Temple"; }
		else if($world == 300160000) { $location = "Lower Udas Temple"; }
		else if($world == 300170000) { $location = "Beshmundir Temple"; }
		else if($world == 300190000) { $location = "Taloc's Hollow"; }
		else if($world == 300200000) { $location = "Haramel"; }
		else if($world == 300210000) { $location = "Chantra Dredgion"; }
		else if($world == 300220000) { $location = "Abyssal_Splinter"; }
		else if($world == 300230000) { $location = "Kromede's Trial" ; }
		else if($world == 300240000) { $location = "Aturam Sky Fortress" ; }
		else if($world == 300250000) { $location = "Esoterrace"; }
		else if($world == 300260000) { $location = "Elementis Forest"; }
		else if($world == 300270000) { $location = "Argent Manor"; }
		else if($world == 300280000) { $location = "Rentus Base"; }
		else if($world == 300310000) { $location = "Raksang"; }
		else if($world == 300330000) { $location = "Protector's Realm"; }
		else if($world == 300350000) { $location = "Arena of Chaos"; }
		else if($world == 300360000) { $location = "Arena_of Discipline"; }
		else if($world == 300380000) { $location = "Muada Trencher"; }
		else if($world == 300390000) { $location = "Israphel's Tract"; }
		else if($world == 300400000) { $location = "Tiamaranta's Eye"; }
		else if($world == 300410000) { $location = "Sarpan Sky"; }
		else if($world == 300420000) { $location = "Chaos Training Grounds"; }
		else if($world == 300430000) { $location = "Discipline Training Grounds"; }
		else if($world == 300440000) { $location = "Terath_Dredgion"; }
		else if($world == 300450000) { $location = "Arena of Harmony"; }
		else if($world == 300460000) { $location = "Steel Rake Cabin"; }
		else if($world == 300470000) { $location = "Satra Treasure Hoard"; }
		else if($world == 300480000) { $location = "Danuar Mysticarium Solo"; }
		else if($world == 300490000) { $location = "Tiamat Solo"; }
		else if($world == 300500000) { $location = "Tiamat Israphel"; }
		else if($world == 300510000) { $location = "Tiamat Stronghold"; }
		else if($world == 300520000) { $location = "Dragon Lords Refuge"; }
		else if($world == 300540000) { $location = "The Eternal Bastion"; }
		else if($world == 300550000) { $location = "Arena_Of Glory"; }
		else if($world == 300570000) { $location = "Arena Team"; }
		else if($world == 300580000) { $location = "Void Cube"; }
		else if($world == 300590000) { $location = "Ophidan Bridge"; }
		else if($world == 300600000) { $location = "Unstable Abyssal Splinter"; }
		else if($world == 300700000) { $location = "The Hexway"; }
		else if($world == 300800000) { $location = "Infinity Shard"; }
		else if($world == 300900000) { $location = "Danuar Infinity Shard"; }
		else if($world == 301000000) { $location = "Experimentiergefangnis"; }
		else if($world == 301010000) { $location = "Steel Rose Cargo (Solo)"; }
		else if($world == 301020000) { $location = "Steel Rose Quarters (Solo)"; }
		else if($world == 301030000) { $location = "Steel Rose Cargo (Group)"; }
		else if($world == 301040000) { $location = "Steel Rose Quarters (Group)"; }
		else if($world == 301050000) { $location = "Steel Rose Deck"; }
		else if($world == 301100000) { $location = "Unity Training Grounds"; }
		else if($world == 301110000) { $location = "Danuar Reliquary"; }
		else if($world == 301120000) { $location = "Kamar Battlefield"; }
		else if($world == 301130000) { $location = "Sauro Supply Base"; }
		else if($world == 301140000) { $location = "Danuar Sanctuary"; }
		else if($world == 301160000) { $location = "Rukibuki Circus"; }
		else if($world == 301170000) { $location = "Legion Idgel Research Center"; }
		else if($world == 301180000) { $location = "Legion Void Cube"; }
		else if($world == 301190000) { $location = "Legion Danuar Mysticarium"; }
		else if($world == 301200000) { $location = "Rukibuki Big Tent Extravaganza"; }
		else if($world == 301210000) { $location = "Ophidan Bridge War"; }
		else if($world == 310010000) { $location = "Karamatis"; }
		else if($world == 310020000) { $location = "Karamatis"; }
		else if($world == 310030000) { $location = "Aerdina"; }
		else if($world == 310040000) { $location = "Geranaia"; }
		else if($world == 310050000) { $location = "Aetherogenetics Lab"; }
		else if($world == 310060000) { $location = "Sliver of Darkness"; }
		else if($world == 310070000) { $location = "Sliver of Darkness"; }
		else if($world == 310080000) { $location = "Sanctum Underground Arena"; }
		else if($world == 310090000) { $location = "Indratu Fortress"; }
		else if($world == 310100000) { $location = "Azoturan Fortress"; }
		else if($world == 310110000) { $location = "Theobomos Lab's"; }
		else if($world == 320010000) { $location = "Ataxiar"; }
		else if($world == 320020000) { $location = "Ataxiar"; }
		else if($world == 320030000) { $location = "Bregirun"; }
		else if($world == 320040000) { $location = "Nidalber"; }
		else if($world == 320050000) { $location = "Sky Temple Interior"; }
		else if($world == 320060000) { $location = "Abode of Oblivion"; }
		else if($world == 320070000) { $location = "Space of Destiny"; }
		else if($world == 320080000) { $location = "Draupnir Cave"; }
		else if($world == 320090000) { $location = "Triniel Underground Arena"; }
		else if($world == 320100000) { $location = "Fire Temple" ; }
		else if($world == 320110000) { $location = "Alquimia Research Center"; }
		else if($world == 320120000) { $location = "Shadow Court Dungeon" ; }
		else if($world == 320130000) { $location = "Adma Stronghold"; }
		else if($world == 320140000) { $location = "Ataxiar"; }
		else if($world == 320150000) { $location = "Padmarashka's Cave"; }
		else if($world == 400010000) { $location = "Reshanta"; }
		else if($world == 510010000) { $location = "Jail"; }
		else if($world == 520010000) { $location = "Jail"; }
		else if($world == 600010000) { $location = "Silentera Canyon"; }
		else if($world == 600020000) { $location = "Sarpan"; }
		else if($world == 600030000) { $location = "Tiamaranta"; }
		else if($world == 600040000) { $location = "Tiamaranta's Eye"; }
		else if($world == 600050000) { $location = "Katalam"; }
		else if($world == 600060000) { $location = "Danaria"; }
		else if($world == 600070000) { $location = "Idian Depths"; }
		else if($world == 600080000) { $location = "Live Party Concert Hall"; }
		else if($world == 700010000) { $location = "Oriel"; }
		else if($world == 710010000) { $location = "Pernon"; }
		else if($world == 720010000) { $location = "Studio"; }
		else if($world == 730010000) { $location = "Studio"; }
		else if($world == 210070000) { $location = "Cygnea"; }
		else if($world == 220080000) { $location = "Enshar"; }
		else if($world == 600100000) { $location = "Levinshor"; }

		return $location;
	}
}

if ( ! function_exists('char_title'))
{
	function char_title($title_id)
	{
		if($title_id == '-1') { $title = "No Title"; }
		elseif($title_id == '1') { $title = "Poeta's Protector"; }
        elseif($title_id == '2') { $title = "Verteron's Warrior"; }
        elseif($title_id == '3') { $title = "Bottled Lightning"; }
        elseif($title_id == '4') { $title = "Tree Hugger"; }
        elseif($title_id == '5') { $title = "Krall Hunter"; }
        elseif($title_id == '6') { $title = "Straw for Brains"; }
        elseif($title_id == '7') { $title = "Animal Lover"; }
        elseif($title_id == '8') { $title = "Krall Whisperer"; }
        elseif($title_id == '9') { $title = "Patient"; }
        elseif($title_id == '10') { $title = "Mabangtah's Envoy"; }
        elseif($title_id == '11') { $title = "Demolitions Expert"; }
        elseif($title_id == '12') { $title = "Eltnen's Hero"; }
        elseif($title_id == '13') { $title = "Klaw Hunter"; }
        elseif($title_id == '14') { $title = "Aerialist"; }
        elseif($title_id == '15') { $title = "Kobold Chef"; }
        elseif($title_id == '16') { $title = "Isson's Apologist"; }
        elseif($title_id == '17') { $title = "Eulogist"; }
        elseif($title_id == '18') { $title = "Bloodsworn"; }
        elseif($title_id == '19') { $title = "Veritas Agent"; }
        elseif($title_id == '20') { $title = "Savior of Eiron Forest"; }
        elseif($title_id == '21') { $title = "Gestanerk's Avenger"; }
        elseif($title_id == '22') { $title = "Bounty Hunter"; }
        elseif($title_id == '23') { $title = "Arbolu's Anointed"; }
        elseif($title_id == '24') { $title = "Chief Investigator"; }
        elseif($title_id == '25') { $title = "Indratu Bane"; }
        elseif($title_id == '26') { $title = "Big Damn Hero"; }
        elseif($title_id == '27') { $title = "Not-Quite-Master of Disguise"; }
        elseif($title_id == '28') { $title = "Master Angler"; }
        elseif($title_id == '29') { $title = "Spymaster"; }
        elseif($title_id == '30') { $title = "Balaur Whisperer"; }
        elseif($title_id == '31') { $title = "Tough"; }
        elseif($title_id == '32') { $title = "Battle-Hardened"; }
        elseif($title_id == '33') { $title = "Invincible"; }
        elseif($title_id == '34') { $title = "Heroic"; }
        elseif($title_id == '35') { $title = "Dread Pirate"; }
        elseif($title_id == '36') { $title = "Top Expert"; }
        elseif($title_id == '37') { $title = "Miragent Holy Templar"; }
        elseif($title_id == '38') { $title = "Aetheric Master"; }
        elseif($title_id == '39') { $title = "Daeva of Mercy"; }
        elseif($title_id == '40') { $title = "Dragon Sword Master"; }
        elseif($title_id == '41') { $title = "Honorary Black Cloud"; }
        elseif($title_id == '42') { $title = "Krall Stalker"; }
        elseif($title_id == '43') { $title = "Battering Ram"; }
        elseif($title_id == '44') { $title = "Tenacious Pursuer"; }
        elseif($title_id == '45') { $title = "Gullible"; }
        elseif($title_id == '46') { $title = "Traitor's Bane"; }
        elseif($title_id == '47') { $title = "Drakanhammer"; }
        elseif($title_id == '48') { $title = "Knight Errant"; }
        elseif($title_id == '49') { $title = "Seraphic Vindicator"; }
        elseif($title_id == '50') { $title = "Dark Sovereign"; }
        elseif($title_id == '51') { $title = "Raider Hero"; }
        elseif($title_id == '52') { $title = "Treasure Hunter"; }
        elseif($title_id == '53') { $title = "Mosbear Slayer"; }
        elseif($title_id == '54') { $title = "Mau Whisperer"; }
        elseif($title_id == '55') { $title = "Kind"; }
        elseif($title_id == '56') { $title = "Legendary Hunter"; }
        elseif($title_id == '57') { $title = "Protector of Altgard"; }
        elseif($title_id == '58') { $title = "Tayga Slayer"; }
        elseif($title_id == '59') { $title = "Curse Breaker"; }
        elseif($title_id == '60') { $title = "Protector of Morheim"; }
        elseif($title_id == '61') { $title = "Shugo Chef"; }
        elseif($title_id == '62') { $title = "Ginseng-Infused"; }
        elseif($title_id == '63') { $title = "Honorary Kidorun"; }
        elseif($title_id == '64') { $title = "Shedim Altruist"; }
        elseif($title_id == '65') { $title = "Mosbear Nemesis"; }
        elseif($title_id == '66') { $title = "Silver Mane Ally"; }
        elseif($title_id == '67') { $title = "Postal"; }
        elseif($title_id == '68') { $title = "Provocateur"; }
        elseif($title_id == '69') { $title = "Tenacious"; }
        elseif($title_id == '70') { $title = "The Cat's Meow"; }
        elseif($title_id == '71') { $title = "Unyielding Pioneer"; }
        elseif($title_id == '72') { $title = "Protector of Brusthonin"; }
        elseif($title_id == '73') { $title = "Easy Mark"; }
        elseif($title_id == '74') { $title = "Beluslan's Hero"; }
        elseif($title_id == '75') { $title = "Snowfield Predator"; }
        elseif($title_id == '76') { $title = "Besfer's Shield"; }
        elseif($title_id == '77') { $title = "Scourge of Mt. Musphel"; }
        elseif($title_id == '78') { $title = "Loremaster"; }
        elseif($title_id == '79') { $title = "Emissary"; }
        elseif($title_id == '80') { $title = "Balaur Whisperer"; }
        elseif($title_id == '81') { $title = "Tough"; }
        elseif($title_id == '82') { $title = "Battle-Hardened"; }
        elseif($title_id == '83') { $title = "Invincible"; }
        elseif($title_id == '84') { $title = "Heroic"; }
        elseif($title_id == '85') { $title = "Steel Rake Headhunter"; }
        elseif($title_id == '86') { $title = "Top Expert"; }
        elseif($title_id == '87') { $title = "Fenris's Fang"; }
        elseif($title_id == '88') { $title = "Aetheric Master"; }
        elseif($title_id == '89') { $title = "Azphel's Aegis"; }
        elseif($title_id == '90') { $title = "Master of Agrif's Rage"; }
        elseif($title_id == '91') { $title = "Wheeler-Dealer"; }
        elseif($title_id == '92') { $title = "Factotum"; }
        elseif($title_id == '93') { $title = "Valiant"; }
        elseif($title_id == '94') { $title = "Silver Mane Champion"; }
        elseif($title_id == '95') { $title = "Born Merchant"; }
        elseif($title_id == '96') { $title = "Shadow Marked"; }
        elseif($title_id == '97') { $title = "Spiritspeaker"; }
        elseif($title_id == '98') { $title = "Pirate of the Carobian"; }
        elseif($title_id == '99') { $title = "Shedim Conquerer"; }
        elseif($title_id == '100') { $title = "Dark Vindicator"; }
        elseif($title_id == '101') { $title = "Settler of Aion"; }
        elseif($title_id == '102') { $title = "Destiny Ascendant"; }
        elseif($title_id == '103') { $title = "Adept of Aion"; }
        elseif($title_id == '104') { $title = "Shining Intellectual"; }
        elseif($title_id == '105') { $title = "Sage of Aion"; }
		elseif($title_id == '106') { $title = "Munificent"; }
		elseif($title_id == '107') { $title = "Iron Stomached"; }
        elseif($title_id == '108') { $title = "Shulack Friend"; }
        elseif($title_id == '109') { $title = "Guardian Ally"; }
        elseif($title_id == '110') { $title = "Kaisinel's Assassin"; }
        elseif($title_id == '111') { $title = "Guardian Protector"; }
        elseif($title_id == '112') { $title = "Balaur Eradicator"; }
		elseif($title_id == '113') { $title = "Discoverer of the Secret"; }
		elseif($title_id == '114') { $title = "Vanquisher of Mastarius"; }
        elseif($title_id == '115') { $title = "Alabaster Wing"; }
        elseif($title_id == '116') { $title = "Alabaster Eye"; }
		elseif($title_id == '117') { $title = "Alabaster Hand"; }
		elseif($title_id == '118') { $title = "Radiant Fist"; }
        elseif($title_id == '119') { $title = "Radiant Shield"; }
        elseif($title_id == '120') { $title = "Radiant Blade"; }
		elseif($title_id == '121') { $title = "Radiant Shroud"; }
		elseif($title_id == '122') { $title = "Seeker"; }
        elseif($title_id == '123') { $title = "Tracker"; }
        elseif($title_id == '124') { $title = "Hunter"; }
		elseif($title_id == '125') { $title = "Fortuneer"; }
		elseif($title_id == '126') { $title = "Lesson Giver"; }
        elseif($title_id == '127') { $title = "Incarnation of Vengeance"; }
        elseif($title_id == '128') { $title = "Apostle of Justice"; }
		elseif($title_id == '129') { $title = "Veille's Adversary"; }
		elseif($title_id == '130') { $title = "Hand of Support"; }
        elseif($title_id == '131') { $title = "Balaur Voltaire"; }
        elseif($title_id == '132') { $title = "Delver of Mysteries"; }
		elseif($title_id == '133') { $title = "Vanquisher of Veille"; }
		elseif($title_id == '134') { $title = "Field Warden"; }
        elseif($title_id == '135') { $title = "Field Agent"; }
        elseif($title_id == '136') { $title = "Field Director"; }
		elseif($title_id == '137') { $title = "Blood Champion"; }
		elseif($title_id == '138') { $title = "Blood Sentinel"; }
        elseif($title_id == '139') { $title = "Blood Conqueror"; }
        elseif($title_id == '140') { $title = "Blood Phalanx"; }
		elseif($title_id == '141') { $title = "Fixer"; }
		elseif($title_id == '142') { $title = "Operator"; }
        elseif($title_id == '143') { $title = "Handler"; }
        elseif($title_id == '144') { $title = "Daemon"; }
		elseif($title_id == '145') { $title = "Taegeuk Hero"; }
		elseif($title_id == '146') { $title = "Daddy Long Legs"; }
        elseif($title_id == '147') { $title = "Akarios' Friend"; }
        elseif($title_id == '148') { $title = "Arekedil's Hope"; }
		elseif($title_id == '149') { $title = "Tiamat Stalker"; }
		elseif($title_id == '150') { $title = "Obstinate Herdsman"; }
        elseif($title_id == '151') { $title = "Master of Many Pets"; }
        elseif($title_id == '152') { $title = "Charmer"; }
		elseif($title_id == '153') { $title = "Sucker"; }
		elseif($title_id == '154') { $title = "Circumspect Advisor"; }
        elseif($title_id == '155') { $title = "Kind Counsel"; }
        elseif($title_id == '156') { $title = "Key Master"; }
		elseif($title_id == '157') { $title = "Shrewd Advisor"; }
		elseif($title_id == '158') { $title = "Outstanding Advisor"; }
        elseif($title_id == '159') { $title = "The Circle Leader"; }
        elseif($title_id == '160') { $title = "Gufrinerk's Patron"; }
		elseif($title_id == '161') { $title = "Jielinlinerk's Patron"; }
		elseif($title_id == '162') { $title = "Hot Shot"; }
        elseif($title_id == '163') { $title = "Jielinlinerk's Faithful Patron"; }
        elseif($title_id == '164') { $title = "Empyrean Challenger"; }
		elseif($title_id == '165') { $title = "Up-and-Comer"; }
		elseif($title_id == '166') { $title = "Master of Preceptors"; }
        elseif($title_id == '167') { $title = "Mighty Combatant"; }
        elseif($title_id == '168') { $title = "Crucible Champion"; }
		elseif($title_id == '169') { $title = "Empyrean Challenger"; }
		elseif($title_id == '170') { $title = "Up-and-Comer"; }
        elseif($title_id == '171') { $title = "Master of Preceptors"; }
        elseif($title_id == '172') { $title = "Mighty Combatant"; }
		elseif($title_id == '173') { $title = "Crucible Champion"; }
		elseif($title_id == '174') { $title = "Memory Journaler"; }
        elseif($title_id == '175') { $title = "Dream Journaler"; }
        elseif($title_id == '176') { $title = "Festival Crab"; }
		elseif($title_id == '177') { $title = "[Event] Memorialist"; }
		elseif($title_id == '178') { $title = "Indomitable"; }
        elseif($title_id == '179') { $title = "New Year"; }
        elseif($title_id == '180') { $title = "Daevic Defender"; }
		elseif($title_id == '181') { $title = "Self-pitying"; }
		elseif($title_id == '182') { $title = "Legendary"; }
        elseif($title_id == '183') { $title = "Crucible Challenger"; }
        elseif($title_id == '184') { $title = "Crucible Challenger"; }
		elseif($title_id == '185') { $title = "Majordomo of Discipline"; }
		elseif($title_id == '186') { $title = "Brawny"; }
        elseif($title_id == '187') { $title = "Sea-Like"; }
        elseif($title_id == '188') { $title = "Novice"; }
		elseif($title_id == '189') { $title = "Returnee"; }
		elseif($title_id == '190') { $title = "Universally Friendly"; }
        elseif($title_id == '191') { $title = "Universally Earnest"; }
        elseif($title_id == '192') { $title = "Trailblazer"; }
		elseif($title_id == '193') { $title = "Friendly Sponsor"; }
		elseif($title_id == '194') { $title = "Earnest Sponsor"; }
        elseif($title_id == '195') { $title = "Diligent Sponsor"; }
        elseif($title_id == '196') { $title = "Big Hitter"; }
		elseif($title_id == '197') { $title = "Eager Hitter"; }
		elseif($title_id == '198') { $title = "Hard Hitter"; }
        elseif($title_id == '199') { $title = "Heavy Hitter"; }
        elseif($title_id == '200') { $title = "Dreamer"; }
		elseif($title_id == '201') { $title = "Love's Bane"; }
		elseif($title_id == '202') { $title = "Empowered"; }
        elseif($title_id == '203') { $title = "Breaking up the Asmodian Scout Band"; }
        elseif($title_id == '204') { $title = "Tiamaranta's Eye Visitor"; }
		elseif($title_id == '205') { $title = "Shining Spear"; }
		elseif($title_id == '206') { $title = "Proud Homeowner"; }
        elseif($title_id == '207') { $title = "Expert Infiltrator"; }
        elseif($title_id == '208') { $title = "Raksang Sealbreaker"; }
		elseif($title_id == '209') { $title = "Dream Chaser"; }
		elseif($title_id == '210') { $title = "Davlin Rescuer"; }
        elseif($title_id == '211') { $title = "Reian Savior"; }
        elseif($title_id == '212') { $title = "Malodorous"; }
		elseif($title_id == '213') { $title = "Sealing Force"; }
		elseif($title_id == '214') { $title = "Breaking up the Elyos Scout Band"; }
        elseif($title_id == '215') { $title = "Tiamat's Defier"; }
        elseif($title_id == '216') { $title = "Shadow Spear"; }
		elseif($title_id == '217') { $title = "House Owner"; }
		elseif($title_id == '218') { $title = "Expert Undercover"; }
        elseif($title_id == '219') { $title = "Raksha Confronter"; }
        elseif($title_id == '220') { $title = "Friend of True Love"; }
		elseif($title_id == '221') { $title = "Honored Guest"; }
		elseif($title_id == '222') { $title = "Rentus's Savior"; }
        elseif($title_id == '223') { $title = "Free Spirit"; }
        elseif($title_id == '224') { $title = "Prima-Daeva"; }
		elseif($title_id == '225') { $title = "Tasteful Daeva"; }
		elseif($title_id == '226') { $title = "Student Leader"; }
        elseif($title_id == '227') { $title = "Stage Setting No.1"; }
        elseif($title_id == '228') { $title = "Supersonic Daeva"; }
		elseif($title_id == '229') { $title = "Lightspeed Daeva"; }
		elseif($title_id == '230') { $title = "Daeva in a Predicament"; }
        elseif($title_id == '231') { $title = "A Wracked Daeva"; }
        elseif($title_id == '232') { $title = "A Chaotic Daeva"; }
		elseif($title_id == '233') { $title = "A Lone Daeva"; }
		elseif($title_id == '234') { $title = "Birthday Daeva"; }
        elseif($title_id == '235') { $title = "Drunken Master"; }
        elseif($title_id == '236') { $title = "Crafting Association Completion Certificate"; }
		elseif($title_id == '237') { $title = "Siel's Warrior"; }
		elseif($title_id == '238') { $title = "Siel's Fighter"; }
        elseif($title_id == '239') { $title = "Ten-time Champion"; }
        elseif($title_id == '240') { $title = "Twenty-time Champion"; }
		elseif($title_id == '241') { $title = "Thirty-time Champion"; }
		elseif($title_id == '242') { $title = "Forty-time Champion"; }
		elseif($title_id == '243') { $title = "Academy Legend"; }
		elseif($title_id == '244') { $title = "Ten-time Champion"; }
        elseif($title_id == '245') { $title = "Twenty-time Champion"; }
        elseif($title_id == '246') { $title = "Thirty-time Champion"; }
		elseif($title_id == '247') { $title = "Forty-time Champion"; }
		elseif($title_id == '248') { $title = "Priory Legend"; }
        elseif($title_id == '249') { $title = "Tiamat's Challenger"; }
        elseif($title_id == '250') { $title = "Tiamat's Challenger"; }
		elseif($title_id == '251') { $title = "No stats"; }
		elseif($title_id == '252') { $title = "Dragonbane"; }
        elseif($title_id == '253') { $title = "Dragon Slayer"; }
        elseif($title_id == '254') { $title = "The Pinnacle Of Beauty"; }
		elseif($title_id == '255') { $title = "Top Gun"; }
		elseif($title_id == '256') { $title = "Katalam's Hope"; }
        elseif($title_id == '257') { $title = "Katalam's Light"; }
        elseif($title_id == '258') { $title = "Watcher of the Forest"; }
		elseif($title_id == '259') { $title = "Nature's Friend"; }
		elseif($title_id == '260') { $title = "Victor in All Realms"; }
        elseif($title_id == '261') { $title = "Elemental Sage"; }
        elseif($title_id == '262') { $title = "Stalwart"; }
		elseif($title_id == '263') { $title = "Guardian Detachment's Hero"; }
		elseif($title_id == '264') { $title = "Archon Battlegroup's Hero"; }
        elseif($title_id == '265') { $title = "Quick Feet"; }
        elseif($title_id == '266') { $title = "Dexterous Agility"; }
		elseif($title_id == '267') { $title = "Head and Shoulders Above the Rest"; }
		elseif($title_id == '268') { $title = "Aion's Chosen"; }
        elseif($title_id == '269') { $title = "Uncontrollably Happy"; }
        elseif($title_id == '270') { $title = "Lots to Talk About"; }
		elseif($title_id == '271') { $title = "Held-up Words Until The End"; }
		elseif($title_id == '272') { $title = "Dreamstrider"; }
		elseif($title_id == '273') { $title = "Ultimate Duo"; }
		elseif($title_id == '274') { $title = "Glorious Number One"; }
		else { $title = "No Title"; }

		return $title;
	}
}

if ( ! function_exists('char_rank'))
{
	function char_rank($rank)
	{
		if($rank == '1') { $rankName = "Soldier, Rank 9"; }
		elseif($rank == '2') { $rankName = "Soldier, Rank 8"; }
		elseif($rank == '3') { $rankName = "Soldier, Rank 7"; }
		elseif($rank == '4') { $rankName = "Soldier, Rank 6"; }
		elseif($rank == '5') { $rankName = "Soldier, Rank 5"; }
		elseif($rank == '6') { $rankName = "Soldier, Rank 4"; }
		elseif($rank == '7') { $rankName = "Soldier, Rank 3"; }
		elseif($rank == '8') { $rankName = "Soldier, Rank 2"; }
		elseif($rank == '9') { $rankName = "Soldier, Rank 1"; }
		elseif($rank == '10') { $rankName = "Army 1-Star Officer (*)"; }
		elseif($rank == '11') { $rankName = "Army 2-Star Officer (**)"; }
		elseif($rank == '12') { $rankName = "Army 3-Star Officer (***)"; }
		elseif($rank == '13') { $rankName = "Army 4-Star Officer (****)"; }
		elseif($rank == '14') { $rankName = "Army 5-Star Officer (*****)"; }
		elseif($rank == '15') { $rankName = "General"; }
		elseif($rank == '16') { $rankName = "Great General"; }
		elseif($rank == '17') { $rankName = "Commander"; }
		elseif($rank == '18') { $rankName = "Governor"; }

		return $rankName;
	}
}

if ( ! function_exists('legion_rank'))
{
	function legion_rank($rank)
	{
		if ($rank == 'BRIGADE_GENERAL') { $rankName = "Brigadier General"; }
		elseif ($rank == 'CENTURION') { $rankName = "Centurion"; }
		elseif($rank == 'LEGIONARY') { $rankName = "Legionary"; }
		else {$rankName = "Recruit"; }

		return $rankName;
	}
}

if ( ! function_exists('seconds_to_time'))
{
	function seconds_to_time($diff)
	{
		$format = sprintf('%02d:%02d:%02d', ($diff / 3600), ($diff / 60 % 60), $diff % 60);
		return $format;
	}
}