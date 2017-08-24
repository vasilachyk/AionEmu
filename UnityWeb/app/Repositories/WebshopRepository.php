<?php

namespace App\Repositories;

use App\Models\Webshop;

class WebshopRepository implements WebshopRepositoryInterface {

	protected $webshop;

	public function __construct(Webshop $webshop)
	{
		$this->webshop = $webshop;
	}

	public function getByCategory($id, $paginate = 9)
	{
		return $this->webshop
			->leftJoin('cms_webshop_category', 'cms_webshop.category_id', '=', 'cms_webshop_category.id')
			->where('cms_webshop.category_id', $id)
			->select([
				'cms_webshop.id',
				'cms_webshop.item_id',
				'cms_webshop.level',
				'cms_webshop.name',
                'cms_webshop.type',
				'cms_webshop.amount',
				'cms_webshop.price',
				'cms_webshop.enchant',
				'cms_webshop.temperance',
				'cms_webshop_category.name as cat_name',
                'cms_webshop.image_id'
			])
			->paginate($paginate);
	}

	public function getAll($paginate = 9)
	{
		return $this->webshop
			->leftJoin('cms_webshop_category', 'cms_webshop.category_id', '=', 'cms_webshop_category.id')
			->select([
				'cms_webshop.id',
				'cms_webshop.item_id',
				'cms_webshop.level',
				'cms_webshop.name',
                'cms_webshop.type',
				'cms_webshop.amount',
				'cms_webshop.price',
				'cms_webshop.enchant',
				'cms_webshop.temperance',
				'cms_webshop_category.name as cat_name',
                'cms_webshop.image_id'
			])
			->where('cms_webshop_category.status', 1)
			->paginate($paginate);
	}

	public function filterByItemName($name, $paginate = 9)
	{
		return $this->webshop
			->leftJoin('cms_webshop_category', 'cms_webshop.category_id', '=', 'cms_webshop_category.id')
			->select([
				'cms_webshop.id',
				'cms_webshop.item_id',
				'cms_webshop.level',
				'cms_webshop.name',
                'cms_webshop.image_id',
                'cms_webshop.type',
				'cms_webshop.amount',
				'cms_webshop.price',
				'cms_webshop.enchant',
				'cms_webshop.temperance',
				'cms_webshop_category.name as cat_name'
			])
			->where('cms_webshop_category.status', 1)
			->where('cms_webshop.name', 'like', '%'.$name.'%')
			->paginate($paginate);
	}

	public function filterByItemNameAdmin($name, $paginate = 10)
	{
		return $this->webshop
			->leftJoin('cms_webshop_category', 'cms_webshop.category_id', '=', 'cms_webshop_category.id')
			->select([
				'cms_webshop.id',
				'cms_webshop.item_id',
				'cms_webshop.level',
				'cms_webshop.name',
                'cms_webshop.image_id',
                'cms_webshop.type',
				'cms_webshop.amount',
				'cms_webshop.price',
				'cms_webshop.enchant',
				'cms_webshop.temperance',
				'cms_webshop_category.name as cat_name'
			])
			->where('cms_webshop.name', 'like', '%'.$name.'%')
			->paginate($paginate);
	}

	public function all($paginate = 50)
	{
		return $this->webshop
			->leftJoin('cms_webshop_category', 'cms_webshop.category_id', '=', 'cms_webshop_category.id')
			->select([
				'cms_webshop.id',
				'cms_webshop.item_id',
				'cms_webshop.level',
				'cms_webshop.name',
                'cms_webshop.image_id',
                'cms_webshop.type',
				'cms_webshop.amount',
				'cms_webshop.price',
				'cms_webshop.enchant',
				'cms_webshop.temperance',
				'cms_webshop_category.name as cat_name'
			])
			->paginate($paginate);
	}

	public function create($request)
	{
		return $this->webshop
			->create([
				'item_id'		=>	$request['itemid'],
				'level'			=>	$request['level'],
				'name'			=>	$request['name'],
                'type'          =>  $request['type'],
                'image_id'      =>  $request['image_id'],
				'category_id'	=>	$request['category'],
				'enchant'		=>	$request['enchant'],
				'temperance'	=>	$request['temperance'],
				'amount'		=>	$request['amount'],
				'price'			=>	$request['price'],
			]);
	}

	public function update($id, $request)
	{
		return $this->webshop
			->where('id', $id)
			->update([
				'item_id'		=>	$request['itemid'],
				'level'			=>	$request['level'],
				'name'			=>	$request['name'],
                'type'          =>  $request['type'],
                'image_id'      =>  $request['image_id'],
				'category_id'	=>	$request['category'],
				'enchant'		=>	$request['enchant'],
				'temperance'	=>	$request['temperance'],
				'amount'		=>	$request['amount'],
				'price'			=>	$request['price'],
			]);
	}

	public function delete($id)
	{
		return $this->webshop
			->where('id', $id)
			->delete();
	}

	public function find($id)
	{
		return $this->webshop
			->leftJoin('cms_webshop_category', 'cms_webshop.category_id', '=', 'cms_webshop_category.id')
			->select([
				'cms_webshop.id',
				'cms_webshop.item_id',
				'cms_webshop.level',
				'cms_webshop.category_id',
				'cms_webshop.name',
                'cms_webshop.image_id',
                'cms_webshop.type',
				'cms_webshop.amount',
				'cms_webshop.price',
				'cms_webshop.enchant',
				'cms_webshop.temperance',
				'cms_webshop_category.name as cat_name'
			])
			->where('cms_webshop_category.status', 1)
			->where('cms_webshop.id', $id)
			->first();
	}

	public function findAdmin($id)
	{
		return $this->webshop
			->leftJoin('cms_webshop_category', 'cms_webshop.category_id', '=', 'cms_webshop_category.id')
			->select([
				'cms_webshop.id',
				'cms_webshop.item_id',
				'cms_webshop.level',
				'cms_webshop.category_id',
				'cms_webshop.name',
                'cms_webshop.image_id',
                'cms_webshop.type',
				'cms_webshop.amount',
				'cms_webshop.price',
				'cms_webshop.enchant',
				'cms_webshop.temperance',
				'cms_webshop_category.name as cat_name'
			])
			->where('cms_webshop.id', $id)
			->first();
	}

}