<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;
require_once('functions.php');
final class ProcessTest extends TestCase
{
    public function testProcess()
    {
        $this->assertEquals([['name'=>'ASTRID','salary'=>85]], process(['ASTRID=MO10:00-12:00,TH12:00-14:00,SU20:00-21:00']),'Syntax error');
        $this->assertEquals([['error'=>'Syntax error on line JHONMO10:00-12:00']], process(['JHONMO10:00-12:00']),'Syntax error');
    }
}
?>