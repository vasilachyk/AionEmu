<?php

namespace App;

use Illuminate\Contracts\Hashing\Hasher as HasherContract;

class ShaHasher implements HasherContract
{
	public function make($value, array $options = array())
	{
		return trim(base64_encode(sha1($value, true)));
	}

	public function check($value, $hashedValue, array $options = array())
	{
		return $this->make($value) === $hashedValue;
	}

	public function needsRehash($hashedValue, array $options = array())
	{
		return false;
	}
}
