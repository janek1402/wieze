<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InspectorsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InspectorsTable Test Case
 */
class InspectorsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\InspectorsTable
     */
    protected $Inspectors;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Inspectors',
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
        $config = $this->getTableLocator()->exists('Inspectors') ? [] : ['className' => InspectorsTable::class];
        $this->Inspectors = $this->getTableLocator()->get('Inspectors', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Inspectors);

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
