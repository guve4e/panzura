<?php

use PHPUnit\Framework\TestCase;

require_once dirname(__FILE__) . "/../relative-paths.php";
require_once (CONTROLLERS_PATH . "/TaxCalculator/TaxCalculator.php");

class TaxCalculatorTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testGetController()
    {
        $_HTTP_RAW_POST_DATA = [
            "streetNumber" => "12345",
            "streetName" => "Lakeshore Boulevard",
            "apt" => "",
            "city" => "Bratenahl",
            "state" => "OH",
            "zip" => "44108"
        ];

        $taxCalculator = new TaxCalculator();
        $actual = $taxCalculator->post(1);

        $expected = [
            "city" => "Bratenahl",
            "taxPercentage" => 9.5,
        ];

        $this->assertEqualsCanonicalizing($expected, $actual);
    }
}
