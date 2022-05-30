<?php
declare(strict_types = 1);

namespace Spaze\PHPStan\Rules\Disallowed\Usages;

use PHPStan\File\FileHelper;
use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;
use Spaze\PHPStan\Rules\Disallowed\DisallowedSuperglobalFactory;
use Spaze\PHPStan\Rules\Disallowed\DisallowedVariableHelper;
use Spaze\PHPStan\Rules\Disallowed\IsAllowedFileHelper;

class SuperglobalUsagesTest extends RuleTestCase
{

	protected function getRule(): Rule
	{
		return new VariableUsages(
			new DisallowedVariableHelper(new IsAllowedFileHelper(new FileHelper(__DIR__))),
			(new DisallowedSuperglobalFactory())->getDisallowedVariables([
				[
					'superglobal' => '$GLOBALS',
					'message' => 'the cake is a lie',
					'allowIn' => [
						'../src/disallowed-allowed/*.php',
						'../src/*-allow/*.*',
					],
				],
				[
					'superglobal' => '$_GET',
					'message' => 'the cake is a lie',
					'allowIn' => [
						'../src/disallowed-allowed/*.php',
						'../src/*-allow/*.*',
					],
				],
			])
		);
	}


	public function testRule(): void
	{
		// Based on the configuration above, in this file:
		$this->analyse([__DIR__ . '/../src/disallowed/superglobalUsages.php'], [
			[
				// expect this error message:
				'Using $GLOBALS is forbidden, the cake is a lie',
				// on this line:
				8,
			],
			[
				'Using $_GET is forbidden, the cake is a lie',
				9,
			],
			[
				'Using $_GET is forbidden, the cake is a lie',
				12,
			],
		]);
		$this->analyse([__DIR__ . '/../src/disallowed-allow/superglobalUsages.php'], []);
	}

}