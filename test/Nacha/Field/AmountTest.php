<?php

namespace Nacha\Field;

class AmountTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Nacha\Field\InvalidFieldException
     */
    public function testInvalidLengthFloat()
    {
        new Amount(100000000.00); // only accepts $99M
    }

    /**
     * @expectedException \Nacha\Field\InvalidFieldException
     */
    public function testInvalidLengthString()
    {
        new Amount('100000000.00'); // only accepts $99M
    }

    public function testFloatOperations()
    {
        // given
        $sec = new Amount(100.99);

        // then
        $this->assertEquals('10099', (string)$sec);
    }

    public function testFloatStringOperations()
    {
        // given
        $sec = new Amount('100.99');

        // then
        $this->assertEquals('10099', (string)$sec);
    }

    public function testFloatOperationsPreservesZeroDecimals()
    {
        // given
        $sec = new Amount(100.00);

        // then
        $this->assertEquals('10000', (string)$sec);
    }

    public function testFloatStringOperationsPreservesZeroDecimals()
    {
        // given
        $sec = new Amount('100.00');

        // then
        $this->assertEquals('10000', (string)$sec);
    }

}