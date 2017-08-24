<?php

namespace App\Repositories;

use Auth;
use App\Models\MembershipCategory;
use App\Models\Membership;

class MembershipRepository implements MembershipRepositoryInterface {

	protected $category;

	protected $membership;

	public function __construct(MembershipCategory $category, Membership $membership)
	{
		$this->category = $category;

		$this->membership = $membership;
	}

	public function getCategories()
	{
		return $this->category->get();
	}

	public function get()
	{
		return $this->membership
			->leftJoin('cms_membership_type', 'cms_membership_type.id', '=', 'cms_membership.type')
			->orderBy('type', 'desc')
			->orderBy('duration', 'desc')
			->select([
				'cms_membership.id',
				'cms_membership.title',
				'cms_membership.type',
				'cms_membership.duration',
				'cms_membership.price',
				'cms_membership_type.type as tname'
			])
			->get();
	}

	public function find($id)
	{
		return $this->membership->find($id);
	}

	public function create($request)
	{
        return $this->membership->create([
            'title'         =>  $request['title'],
            'type'          =>  $request['type'],
            'duration'      =>  $request['duration'],
            'price'         =>  $request['price'],
            'created_by'    =>  Auth::user()->id
        ]);
	}

	public function update($id, $request)
	{
		return $this->membership
			->where('id', $id)
			->update([
	            'title'         =>  $request['title'],
	            'type'          =>  $request['type'],
	            'duration'      =>  $request['duration'],
	            'price'         =>  $request['price'],
	            'updated_by'    =>  Auth::user()->id
			]);
	}

	public function delete($id)
	{
		return $this->membership
			->where('id', $id)
			->delete();
	}
}