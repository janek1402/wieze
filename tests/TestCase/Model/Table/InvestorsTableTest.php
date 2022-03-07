<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InvestorsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InvestorsTable Test Case
 */
class InvestorsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\InvestorsTable
     */
    protected $Investors;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Investors',
        'app.Towers',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Investors') ? [] : ['className' => InvestorsTable::class];
        $this->Investors = $this->getTableLocator()->get('Investors', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Investors);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
