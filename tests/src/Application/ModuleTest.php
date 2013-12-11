<?php

use CafTest\AbstractTestCase;

class ModulesTest extends AbstractTestCase
{
    public function testSeAClassePdoExiste()
    {
        $this->assertTrue(class_exists("\\PDO"));
    }
}