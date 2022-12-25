<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FileTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FileTable Test Case
 */
class FileTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FileTable
     */
    protected $File;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.File',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('File') ? [] : ['className' => FileTable::class];
        $this->File = $this->getTableLocator()->get('File', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->File);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\FileTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\FileTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
