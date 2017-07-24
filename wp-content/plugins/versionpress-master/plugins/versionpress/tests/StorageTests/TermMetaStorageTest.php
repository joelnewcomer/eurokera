<?php

namespace VersionPress\Tests\StorageTests;

use VersionPress\Database\EntityInfo;
use VersionPress\Storages\TermMetaStorage;
use VersionPress\Storages\TermStorage;
use VersionPress\Utils\FileSystem;

class TermMetaStorageTest extends \PHPUnit_Framework_TestCase
{
    /** @var TermMetaStorage */
    private $storage;
    /** @var TermStorage */
    private $termStorage;

    private $testingTermMeta = [
        'meta_key' => 'some term meta',
        'meta_value' => 'some meta value',
        'vp_id' => '69696969696969696969696969696969',
        'vp_term_id' => 'E3E3E3E3E3E3E3E3E3E3E3E3E3E3E3E3',
    ];

    private $testingTerm = [
        'name' => 'Some term',
        'slug' => 'some-term',
        'term_group' => 0,
        'vp_id' => 'E3E3E3E3E3E3E3E3E3E3E3E3E3E3E3E3',
    ];

    /**
     * @test
     */
    public function savedTermMetaEqualsLoadedPostMeta()
    {
        $this->termStorage->save($this->testingTerm);
        $this->storage->save($this->testingTermMeta);
        $loadedTermMeta = $this->storage->loadEntity($this->testingTermMeta['vp_id'], $this->testingTerm['vp_id']);
        $this->assertTrue($this->testingTermMeta == $loadedTermMeta);
    }

    /**
     * @test
     */
    public function loadAllReturnsOnlyOriginalEntities()
    {
        $this->termStorage->save($this->testingTerm);
        $this->storage->save($this->testingTermMeta);
        $loadedTermMeta = $this->storage->loadAll();
        $this->assertTrue(count($loadedTermMeta) === 1);
        $this->assertTrue($this->testingTermMeta == reset($loadedTermMeta));
    }

    protected function setUp()
    {
        parent::setUp();
        FileSystem::remove(__DIR__ . '/terms');

        $userInfo = new EntityInfo([
            'term' => [
                'table' => 'terms',
                'id' => 'term_id',
            ]
        ]);

        $termMetaInfo = new EntityInfo([
            'termmeta' => [
                'id' => 'meta_id',
                'parent-reference' => 'term_id',
                'references' => [
                    'term_id' => 'term',
                ]
            ]
        ]);

        mkdir(__DIR__ . '/terms');
        $this->termStorage = new TermStorage(__DIR__ . '/terms', $userInfo);
        $this->storage = new TermMetaStorage($this->termStorage, $termMetaInfo);
    }

    protected function tearDown()
    {
        parent::tearDown();
        FileSystem::remove(__DIR__ . '/terms');
    }
}
