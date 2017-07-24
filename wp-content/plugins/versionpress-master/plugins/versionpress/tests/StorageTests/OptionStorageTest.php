<?php

namespace VersionPress\Tests\StorageTests;

use VersionPress\Database\EntityInfo;
use VersionPress\Storages\OptionStorage;
use VersionPress\Tests\Utils\ArrayAsserter;
use VersionPress\Utils\FileSystem;

class OptionStorageTest extends \PHPUnit_Framework_TestCase
{
    /** @var OptionStorage */
    private $storage;

    private $testingOption = [
        "option_name" => "blogdescription",
        "option_value" => "Just another WordPress site",
        "autoload" => "yes",
    ];

    private $sampleTaxonomy = 'some_taxonomy';

    /**
     * @test
     */
    public function savedOptionEqualsLoadedOption()
    {
        $this->storage->save($this->testingOption);
        $loadedOption = $this->storage->loadEntity($this->testingOption['option_name']);
        ArrayAsserter::assertSimilar($this->testingOption, $loadedOption);
    }

    /**
     * @test
     */
    public function nullValueOptionMatchesWithEmptyStringValueOption()
    {
        $testingOption = [
            "option_name" => "some option",
            "option_value" => null,
            "autoload" => "yes",
        ];
        $this->storage->save($testingOption);
        $changeInfo = $this->storage->save($testingOption);
        $this->assertNull($changeInfo);
    }

    /**
     * @test
     */
    public function loadAllReturnsOnlyOriginalEntities()
    {
        $this->storage->save($this->testingOption);
        $loadedOptions = $this->storage->loadAll();
        $this->assertTrue(count($loadedOptions) === 1);
        ArrayAsserter::assertSimilar($this->testingOption, reset($loadedOptions));
    }

    /**
     * @test
     */
    public function savedOptionDoesNotContainOptionNameKey()
    {
        $this->storage->save($this->testingOption);
        $fileName = $this->storage->getEntityFilename($this->testingOption['option_name']);
        $content = file_get_contents($fileName);
        $this->assertFalse(strpos($content, 'option_name'), 'Option contains an option_name key');
    }

    /**
     * @test
     */
    public function savedOptionDoesNotContainOptionId()
    {
        $optionWithId = array_merge(['option_id' => 1], $this->testingOption);
        $this->storage->save($optionWithId);
        $fileName = $this->storage->getEntityFilename($this->testingOption['option_name']);
        $content = file_get_contents($fileName);
        $this->assertFalse(strpos($content, 'option_id'), 'Option contains option_id');
    }

    /**
     * @test
     */
    public function storageSupportsOptionsWithDotsInName()
    {
        $testingOption = [
            "option_name" => "some option with . in name",
            "option_value" => "some value",
            "autoload" => "yes",
        ];

        $this->storage->save($testingOption);
        $loadedOption = $this->storage->loadEntity($testingOption['option_name']);
        ArrayAsserter::assertSimilar($testingOption, $loadedOption);
    }

    /**
     * @test
     */
    public function taxonomyChildrenAreNotSaved()
    {
        $option = [
            "option_name" => $this->sampleTaxonomy . "_children",
            "option_value" => "some value",
            "autoload" => "yes",
        ];

        $this->storage->save($option);
        $loadedOptions = $this->storage->loadAll();
        $this->assertEquals(0, count($loadedOptions));
    }

    /**
     * @test
     * @dataProvider specialNamesProvider
     */
    public function optionNameCanContainSpecialChars($optionName)
    {
        $option = [
            'option_name' => $optionName,
            'option_value' => 'foo',
            'autoload' => 'yes',
        ];

        $this->storage->save($option);
        $loadedOption = $this->storage->loadEntity($optionName);
        ArrayAsserter::assertSimilar($option, $loadedOption);
    }

    public function specialNamesProvider()
    {
        return [
            ['name_with_<'],
            ['name_with_>'],
            ['name_with_:'],
            ['name_with_?'],
            ['name_with_*'],
            ['name_with_|'],
            ['name_with_"'],
            ['name_with_/'],
            ['name_with_\\'],
            ['.'],
            ['..'],
            [' '],
            ['+'],
            ['%2B'],
        ];
    }

    /**
     * @test
     * @dataProvider ignoredOptionNamesProvider
     */
    public function ignoredOptionAreNotSaved($optionName)
    {
        $option = [
            'option_name' => $optionName,
            'option_value' => 'foo',
            'autoload' => 'yes',
        ];

        $this->assertFalse($this->storage->shouldBeSaved($option));
    }

    /**
     * See $entityInfo in $this->setUp for rules for ignored options
     */
    public function ignoredOptionNamesProvider()
    {
        return [
            ['ignored_option'],
        ];
    }

    /**
     * Test covers part of for WP-428
     *
     * @test
     */
    public function vpidShouldBeReplaceableWithZero()
    {
        $testingOption = [
            'option_name' => 'some_option',
            'option_value' => 'FE00B4B4D5FE4FD4ACAFF9D11A78F44E',
            'autoload' => 'yes'
        ];

        $updatedOption = [
            'option_name' => 'some_option',
            'option_value' => 0
        ];

        $expectedOption = array_merge($testingOption, $updatedOption);

        $this->storage->save($testingOption);
        $this->storage->save($updatedOption);

        $loadedOption = $this->storage->loadEntity($testingOption['option_name']);
        ArrayAsserter::assertSimilar($expectedOption, $loadedOption);
    }

    protected function setUp()
    {
        parent::setUp();
        $entityInfo = new EntityInfo([
            'option' => [
                'table' => 'options',
                'vpid' => 'option_name',
                'ignored-entities' => [
                    'option_name: ignored_option',
                ],
            ]
        ]);

        $this->storage = new OptionStorage(__DIR__ . '/options', $entityInfo, 'prefix_', [$this->sampleTaxonomy]);
    }

    protected function tearDown()
    {
        parent::tearDown();
        FileSystem::remove(__DIR__ . '/options');
    }
}
