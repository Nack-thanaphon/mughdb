<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\WebstatTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\WebstatTable Test Case
 */
class WebstatTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\WebstatTable
     */
    protected $Webstat;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Webstat',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Webstat') ? [] : ['className' => WebstatTable::class];
        $this->Webstat = $this->getTableLocator()->get('Webstat', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Webstat);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\WebstatTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
