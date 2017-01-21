<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VsUserTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VsUserTable Test Case
 */
class VsUserTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\VsUserTable
     */
    public $VsUser;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.vs_user'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('VsUser') ? [] : ['className' => 'App\Model\Table\VsUserTable'];
        $this->VsUser = TableRegistry::get('VsUser', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->VsUser);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
