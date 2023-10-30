<?php
namespace Mithra62\EncryptionFieldtype\Tests;

use PHPUnit\Framework\TestCase;
use \Encryption_fieldtype_ft AS FieldType;

class EncryptionFieldTest extends TestCase
{
    public function testFileExists()
    {
        $file_name = realpath(__DIR__ . '/../ft.encryption_fieldtype.php');
        $this->assertNotNull($file_name);
        require_once $file_name;
    }

    public function tefdsstFtObjetExists()
    {
        //$this->assertTrue(class_exists('\Encryption_fieldtype_ft'));
    }

    public function testObjectIsInstanceOfOptions(): FieldType
    {
        $ft = new FieldType();
        $this->assertInstanceOf('\EE_Fieldtype', $ft);
        return $ft;
    }

    /**
     * @depends testObjectIsInstanceOfOptions
     * @param FieldType $ft
     * @return FieldType
     */
    public function testInfoPropertyExists(FieldType $ft): FieldType
    {
        $this->assertClassHasAttribute('info', '\Encryption_fieldtype_ft');
        return $ft;
    }

    /**
     * @depends testInfoPropertyExists
     * @param FieldType $ft
     * @return FieldType
     */
    public function testInfoPropertyChildKeysExist(FieldType $ft): FieldType
    {
        $this->assertArrayHasKey('name', $ft->info);
        $this->assertArrayHasKey('version', $ft->info);
        return $ft;
    }
}