<?php
require_once '../vendor/autoload.php';
require_once('../functions.php');
use PHPUnit\Framework\TestCase;
class Test extends TestCase
{
    public function testGetFileContent()
    {
        $this->assertEquals('test', get_file_content('test.txt'));
    }
}
?>