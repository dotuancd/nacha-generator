<?php

namespace Nacha\Field;

class StringTest extends \PHPUnit_Framework_TestCase
{

    public function testPadding()
    {
        // given
        $str = new Str('Hello World', 32);

        // then
        $this->assertEquals('HELLO WORLD                     ', (string)$str);
    }

	public function testOptional() {
		// given
		$str = new Str('', 10);

		// then
		$this->assertEquals('          ', (string)$str);
	}

	public function testValidCharacters() {
		// given
		$allValidAsciiChars = '';
		
		foreach (range(32, 127) as $ascii) {
			$allValidAsciiChars .= chr($ascii);
		}

		// when
		$str = new Str($allValidAsciiChars, strlen($allValidAsciiChars));

		// then
		$this->assertEquals(strtoupper($allValidAsciiChars), (string)$str);
	}

	/**
	 * @expectedException \Nacha\Field\InvalidFieldException
	 */
	public function testNotString() {
		new Str(12, 32);
	}

	public function testInvalidCharacter() {
		$asciiValues = array_merge(range(0, 31), range(128, 255));
		foreach ($asciiValues as $ascii) {
			$invalid = 'validtext'.chr($ascii);

			try {
				new Str($invalid, strlen($invalid));

				$this->assertTrue(false, 'Should throw an exception for invalid ASCII:'.$ascii);

			} catch (InvalidFieldException $e) {
				$this->assertTrue(true);
			}
		}
	}
}