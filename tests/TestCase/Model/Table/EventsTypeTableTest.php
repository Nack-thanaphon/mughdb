<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EventsTypeTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EventsTypeTable Test Case
 */
class EventsTypeTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\EventsTypeTable
     */
    protected $EventsType;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.EventsType',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('EventsType') ? [] : ['className' => EventsTypeTable::class];
        $this->EventsType = $this->getTableLocator()->get('EventsType', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->EventsType);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\EventsTypeTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
