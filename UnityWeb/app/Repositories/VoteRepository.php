<?php namespace App\Repositories;

use Carbon;
use Auth;
use App\Models\VoteSites;
use App\Models\LogVote;
use Request;

class VoteRepository implements VoteRepositoryInterface {

	protected $voteSite;

	protected $voteLog;

	public function __construct(VoteSites $voteSite, LogVote $voteLog)
	{
		$this->voteSite = $voteSite;

		$this->voteLog = $voteLog;
	}

	public function all()
	{
		return $this->voteSite->get();
	}

	public function getAll($paginate = 25)
	{
		return $this->voteSite
			->orderBy('created_at', 'desc')
			->paginate($paginate);
	}

	public function create($request)
	{
		return $this->voteSite
			->create([
				'name'			=>	$request['name'],
				'address'		=>	$request['site_address'],
				'points'		=>	$request['points'],
				'banner_url'	=>	$request['banner_url'],
				'blocking_time'	=>	$request['blocking_time']
			]);
	}

	public function update($id, $request)
	{
		return $this->voteSite
			->where('id', $id)
			->update([
				'name'			=>	$request['name'],
				'address'		=>	$request['site_address'],
				'points'		=>	$request['points'],
				'banner_url'	=>	$request['banner_url'],
				'blocking_time'	=>	$request['blocking_time']
			]);
	}

	public function delete($id)
	{
		return $this->voteSite
			->where('id', $id)
			->delete();
	}

	public function find($id)
	{
		return $this->voteSite->find($id);
	}

	public function findByAddress($address)
	{
		return $this->voteSite
			->where('address', 'like', '%'.$address.'%')
			->first();
	}

	public function findLog($id, $userId)
	{
		return $this->voteLog
			->where('id', $id)
			->where('account_id', $userId)
			->first();
	}

	public function findLogWithIp($id, $ipAddress)
	{
		return $this->voteLog
			->where('id', $id)
			->where('ip_address', $ipAddress)
			->where('account_id', Auth::user()->id)
			->first();
	}

	public function findVoteLogIpBlocking($id, $ipAddress)
	{
		return $this->voteLog
			->where('id', $id)
			->where('unblock_time', '>', Carbon::now())
			->where('ip_address', $ipAddress)
			->orderBy('unblock_time', 'desc')
			->select([
				'id',
				'unblock_time',
				'ip_address'
			])
			->first();
	}

	public function voteCreate($siteData)
	{
		return $this->voteLog->create([
			'id'		=>	$siteData['id'],
			'unblock_time'	=>	Carbon::now()->addHours($siteData['blocking_time']),
			'account_id'	=>	Auth::user()->id,
			'ip_address'	=>	Request::ip()
		]);
	}

	public function voteUpdate($siteData)
	{
		return $this->voteLog
			->where('id', $siteData['id'])
			->where('account_id', Auth::user()->id)
			->update([
				'unblock_time'	=>	Carbon::now()->addHours($siteData['blocking_time']),
				'account_id'	=>	Auth::user()->id,
				'ip_address'	=>	Request::ip()
		]);
	}
}