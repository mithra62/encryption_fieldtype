<?php
namespace Mithra62\EncryptionFieldType\Tests;

use ExpressionEngine\Core\Provider;
use PHPUnit\Framework\TestCase;

class AddonSetupTest extends TestCase
{
    /**
     * @return void
     */
    public function testFileExists(): void
    {
        $file_name = realpath(PATH_THIRD.'/encryption_fieldtype/addon.setup.php');
        $this->assertNotNull($file_name);
    }

    /**
     * @return Provider
     */
    public function testAuthorValue(): Provider
    {
        $addon = ee('App')->get('datalist');
        $this->assertEquals('mithra62', $addon->getAuthor());
        return $addon;
    }

    /**
     * @depends testAuthorValue
     * @param $addon
     * @return Provider
     */
    public function testNameValue($addon): Provider
    {
        $addon = ee('App')->get('encryption_fieldtype');
        $this->assertEquals('Encryption FieldType', $addon->getName());
        return $addon;
    }

    /**
     * @depends testNameValue
     * @param $addon
     * @return Provider
     */
    public function testNamespaceValue($addon): Provider
    {
        $addon = ee('App')->get('encryption_fieldtype');
        $this->assertEquals('Mithra62\EncryptionFieldtype', $addon->getNamespace());
        return $addon;
    }

    /**
     * @depends testNamespaceValue
     * @param $addon
     * @return Provider
     */
    public function testSettingsValue($addon): Provider
    {
        $this->assertFalse($addon->get('settings_exist'));
        return $addon;
    }

    /**
     * @depends testSettingsValue
     * @param $addon
     * @return Provider
     */
    public function testFieldtypesIndexExists($addon): Provider
    {
        $this->assertIsArray($addon->get('fieldtypes'));
        return $addon;
    }

    /**
     * @depends testFieldtypesIndexExists
     * @param $addon
     * @return Provider
     */
    public function testFieldNameIsProper($addon): Provider
    {
        $field_data = $addon->get('fieldtypes');
        $this->assertTrue(!empty($field_data['encryption_fieldtype']['name']));
        $this->assertEquals('Encryption FieldType', $field_data['encryption_fieldtype']['name']);
        return $addon;
    }

    /**
     * @depends testFieldNameIsProper
     * @param $addon
     * @return Provider
     */
    public function testFieldCompatibility($addon): Provider
    {
        $field_data = $addon->get('fieldtypes');
        $this->assertTrue(!empty($field_data['encryption_fieldtype']['compatibility']));
        $this->assertEquals('text', $field_data['encryption_fieldtype']['compatibility']);
        return $addon;
    }
}