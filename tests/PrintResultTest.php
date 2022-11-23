<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;
require_once('functions.php');
final class PrintResultTest extends TestCase
{
    public function testPrintResultData()
    {
        $this->expectOutputString("The amount to pay MARY is: 100 USD\n");
        print_result([['name'=>'MARY','salary'=>100]]);
    }
    public function testPrintResultError()
    {
        $this->expectOutputString("Syntax error on 10\n");
        print_result([['error'=>'Syntax error on 10']]);
    }
}
?>