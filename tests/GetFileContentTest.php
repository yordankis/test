<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;
require_once('functions.php');

final class GetFileContentTest extends TestCase
{
    public function testGetFileContent()
    {
        $this->assertEquals(['1'], get_file_content('tests/test.txt'),'Invalid File');
        $this->assertEquals(false, get_file_content('tests/test1.txt'),'Missing File');
    }

    /**
     */
}
?>