<?php
declare(strict_types = 1);

namespace Spaze\PHPStan\Rules\Disallowed;

interface Disallowed
{

	/**
	 * @return string[]
	 */
	public function getAllowIn(): array;


	/**
	 * @return string[]
	 */
	public function getAllowExceptIn(): array;


	/**
	 * @return string[]
	 */
	public function getAllowInCalls(): array;


	/**
	 * @return string[]
	 */
	public function getAllowExceptInCalls(): array;

}
