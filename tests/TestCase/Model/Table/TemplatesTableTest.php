<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TemplatesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TemplatesTable Test Case
 */
class TemplatesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TemplatesTable
     */
    protected $Templates;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Templates',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Templates') ? [] : ['className' => TemplatesTable::class];
        $this->Templates = $this->getTableLocator()->get('Templates', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Templates);

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
