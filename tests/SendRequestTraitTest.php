<?php

class SendRequestTraitTest extends \PHPUnit\Framework\TestCase
{
    public function testCheckMimeTypeByKey() {
        $testClass = new Class {
            use \Obs\Internal\SendRequestTrait {
                checkMimeType as public;
            }
        };

        $param1 = ['Key' => 'image.jpg'];
        $testClass->checkMimeType('putObject', $param1);
        $this->assertArrayHasKey('ContentType', $param1);
        $this->assertEquals('image/jpeg', $param1['ContentType']);


        $param2 = ['Key' => 'image.png'];
        $testClass->checkMimeType('putObject', $param2);
        $this->assertArrayHasKey('ContentType', $param2);
        $this->assertEquals('image/png', $param2['ContentType']);


        $param3 = ['Key' => 'image.gif'];
        $testClass->checkMimeType('putObject', $param3);
        $this->assertArrayHasKey('ContentType', $param3);
        $this->assertEquals('image/gif', $param3['ContentType']);


        $param = ['Key' => 'image.gif', 'SourceFile' => 'source.png'];
        $testClass->checkMimeType('putObject', $param);
        $this->assertArrayHasKey('ContentType', $param);
        $this->assertEquals('image/gif', $param['ContentType']);
    }

    public function testCheckMimeTypeBySourceFile() {
        $testClass = new Class {
            use \Obs\Internal\SendRequestTrait {
                checkMimeType as public;
            }
        };

        $param1 = ['SourceFile' => 'image.jpg'];
        $testClass->checkMimeType('putObject', $param1);
        $this->assertArrayHasKey('ContentType', $param1);
        $this->assertEquals('image/jpeg', $param1['ContentType']);


        $param2 = ['SourceFile' => 'image.png'];
        $testClass->checkMimeType('putObject', $param2);
        $this->assertArrayHasKey('ContentType', $param2);
        $this->assertEquals('image/png', $param2['ContentType']);


        $param3 = ['SourceFile' => 'image.gif'];
        $testClass->checkMimeType('putObject', $param3);
        $this->assertArrayHasKey('ContentType', $param3);
        $this->assertEquals('image/gif', $param3['ContentType']);


        $param = ['Key' => 'image.gif', 'SourceFile' => 'source.png'];
        $testClass->checkMimeType('putObject', $param);
        $this->assertArrayHasKey('ContentType', $param);
        $this->assertEquals('image/gif', $param['ContentType']);
    }

    public function testCheckMimeTypeDefaultContentType() {
        $testClass = new Class {
            use \Obs\Internal\SendRequestTrait {
                checkMimeType as public;
            }
        };

        $param1 = [];
        $testClass->checkMimeType('putObject', $param1);
        $this->assertArrayHasKey('ContentType', $param1);
        $this->assertEquals('binary/octet-stream', $param1['ContentType']);

        $param1 = ['Key' => ''];
        $testClass->checkMimeType('putObject', $param1);
        $this->assertArrayHasKey('ContentType', $param1);
        $this->assertEquals('binary/octet-stream', $param1['ContentType']);

        $param1 = ['ContextType' => ''];
        $testClass->checkMimeType('putObject', $param1);
        $this->assertArrayHasKey('ContentType', $param1);
        $this->assertEquals('binary/octet-stream', $param1['ContentType']);
    }
}