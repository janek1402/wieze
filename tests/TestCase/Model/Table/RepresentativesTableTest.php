<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RepresentativesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RepresentativesTable Test Case
 */
class RepresentativesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RepresentativesTable
     */
    protected $Representatives;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Representatives',
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
        $config = $this->getTableLocator()->exists('Representatives') ? [] : ['className' => RepresentativesTable::class];
        $this->Representatives = $this->getTableLocator()->get('Representatives', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Representatives);

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
