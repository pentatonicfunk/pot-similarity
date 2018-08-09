<?php

namespace PotSimilarity\Tests;

class TestFindSimilarity extends AbstractCommandTest
{
    public function testFileExist()
    {
        $output = self::runCommand('find:similar /this/file/not/exist.pot');
        $this->assertEquals(
            <<<EOT
Pot file is unreadable.\n
EOT
            ,
            $output
        );
    }

}
