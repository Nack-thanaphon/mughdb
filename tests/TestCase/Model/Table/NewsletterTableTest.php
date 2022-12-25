<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\NewsletterTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\NewsletterTable Test Case
 */
class NewsletterTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\NewsletterTable
     */
    protected $Newsletter;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Newsletter',
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
        $config = $this->getTableLocator()->exists('Newsletter') ? [] : ['className' => NewsletterTable::class];
        $this->Newsletter = $this->getTableLocator()->get('Newsletter', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Newsletter);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\NewsletterTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\NewsletterTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
