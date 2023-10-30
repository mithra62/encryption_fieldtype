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

    public function testFtObjetExists()
    {
        $this->assertTrue(class_exists('\Encryption_fieldtype_ft'));
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

    /**
     * @depends testInfoPropertyChildKeysExist
     * @param FieldType $ft
     * @return FieldType
     */
    public function testDisplayGlobalSettingsMethodExists(FieldType $ft): FieldType
    {
        $this->assertTrue(method_exists($ft,'display_global_settings'));
        return $ft;
    }

    /**
     * @depends testDisplayGlobalSettingsMethodExists
     * @param FieldType $ft
     * @return FieldType
     */
    public function testDisplayGlobalSettingsMethodValue(FieldType $ft): FieldType
    {
        $this->assertTrue($ft->display_global_settings() == '');
        return $ft;
    }

    /**
     * @depends testDisplayGlobalSettingsMethodValue
     * @param FieldType $ft
     * @return FieldType
     */
    public function testSaveGlobalSettingsMethodExists(FieldType $ft): FieldType
    {
        $this->assertTrue(method_exists($ft,'save_global_settings'));
        return $ft;
    }

    /**
     * @depends testSaveGlobalSettingsMethodExists
     * @param FieldType $ft
     * @return FieldType
     */
    public function testSaveGlobalSettingsReturnValue(FieldType $ft): FieldType
    {
        $_POST = ['foo' => '1', 'doo' => true];
        $this->assertEquals($_POST, $ft->save_global_settings());
        return $ft;
    }

    /**
     * @depends testSaveGlobalSettingsReturnValue
     * @param FieldType $ft
     * @return FieldType
     */
    public function testDisplayFieldMethodExists(FieldType $ft): FieldType
    {
        $this->assertTrue(method_exists($ft,'display_field'));
        return $ft;
    }

    /**
     * @depends testDisplayFieldMethodExists
     * @param FieldType $ft
     * @return FieldType
     */
    public function __testGridDisplayFieldMethodExists(FieldType $ft): FieldType
    {
        $this->assertTrue(method_exists($ft,'grid_display_field'));
        return $ft;
    }

    /**
     * @depends testDisplayFieldMethodExists
     * @param FieldType $ft
     * @return FieldType
     */
    public function testAcceptsContentTypeMethodExists(FieldType $ft): FieldType
    {
        $this->assertTrue(method_exists($ft,'accepts_content_type'));
        return $ft;
    }

    /**
     * @depends testAcceptsContentTypeMethodExists
     * @param FieldType $ft
     * @return FieldType
     */
    public function testAcceptsContentTypeAlwaysReturnsTrue(FieldType $ft): FieldType
    {
        $this->assertTrue($ft->accepts_content_type(false));
        $this->assertTrue($ft->accepts_content_type('hello'));
        $this->assertTrue($ft->accepts_content_type('this is fine'));
        return $ft;
    }

    /**
     * @depends testAcceptsContentTypeAlwaysReturnsTrue
     * @param FieldType $ft
     * @return FieldType
     */
    public function testUpateMethodExists(FieldType $ft): FieldType
    {
        $this->assertTrue(method_exists($ft,'update'));
        return $ft;
    }
}