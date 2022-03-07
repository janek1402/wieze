<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TowersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TowersTable Test Case
 */
class TowersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TowersTable
     */
    protected $Towers;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Towers',
        'app.Investors',
        'app.Managers',
        'app.Inspectors',
        'app.Representatives',
        'app.Documents',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Towers') ? [] : ['className' => TowersTable::class];
        $this->Towers = $this->getTableLocator()->get('Towers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Towers);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\TowersTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\TowersTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
