<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;
require_once('functions.php');
final class CalculateSalaryTest extends TestCase
{
    public function testCalculateSalary()
    {
        $this->assertEquals(85, calculate_salary('MO10:00-12:00,TH12:00-14:00,SU20:00-21:00'),'Syntax error');
        $this->assertEquals(false, calculate_salary('PE10:00-12:00'),'Syntax error');
        $this->assertEquals(false, calculate_salary('SU10:00-08:00'),'Syntax error');
        $this->assertEquals(185, calculate_salary('SU10:00-19:00'),'Syntax error');
        $this->assertEquals(75, calculate_salary('MO01:00-04:00'),'Syntax error');
        $this->assertEquals(260, calculate_salary('MO01:00-04:00,SU10:00-19:00'),'Syntax error');
    }
}
?>