<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Repositories\MembershipRepositoryInterface;

class Membership extends Request {

	protected $membership;

	public function __construct(MembershipRepositoryInterface $membership)
	{
		$this->membership = $membership;
	}

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$ids = [];

		$memberships = $this->membership->get();

		foreach ($memberships as $membership)
		{
			$ids[] = $membership->id;
		}

		$resultIds = implode(',', $ids);

		return [
			'membership.id'	=>	['required', 'numeric', 'in:'.$resultIds]
		];
	}

	public function messages()
	{
		return [
			'membership.id.required'	=>	'Please select membership.',
			'membership.id.in'			=>	'The selected membership is invalid.',
			'membership.id.numeric'		=>	'The selected membership is invalid.',
		];
	}

}
