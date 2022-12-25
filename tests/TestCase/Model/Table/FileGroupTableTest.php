<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FileGroupTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FileGroupTable Test Case
 */
class FileGroupTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FileGroupTable
     */
    protected $FileGroup;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.FileGroup',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('FileGroup') ? [] : ['className' => FileGroupTable::class];
        $this->FileGroup = $this->getTableLocator()->get('FileGroup', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->FileGroup);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\FileGroupTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
