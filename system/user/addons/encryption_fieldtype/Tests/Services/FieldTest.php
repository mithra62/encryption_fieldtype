<?php
namespace Mithra62\EncryptionFieldtype\Tests\Services;

use PHPUnit\Framework\TestCase;
use Mithra62\EncryptionFieldtype\Services\Field;
use DOMDocument;
use DOMElement;

class FieldTest extends TestCase
{
    public function testClassExists()
    {
        $this->assertTrue(class_exists('Mithra62\EncryptionFieldtype\Services\Field'));;
    }

    public function __testGetDataListingdHtml()
    {
        $field = new Field();
        $options = ['one' => 'One', 'two' => 'Two'];
        $field->setName('test-name')->setValue('two')->setOptions($options);
        $xml = simplexml_load_string($field->getDataListOptions());
        $this->assertInstanceOf('SimpleXMLElement', $xml);

        $this->assertEquals($xml->option[0], 'One');
        $this->assertEquals($xml->option[1], 'Two');
    }
}