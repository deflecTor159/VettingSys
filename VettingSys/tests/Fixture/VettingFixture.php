<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * VettingFixture
 *
 */
class VettingFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'vetting';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id_Vetting' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'date' => ['type' => 'date', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'comments' => ['type' => 'string', 'length' => 300, 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'id_Client' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'id_User' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_vsdb_vetting_vsdb_client1_idx' => ['type' => 'index', 'columns' => ['id_Client'], 'length' => []],
            'fk_vsdb_vetting_vsdb_user1_idx' => ['type' => 'index', 'columns' => ['id_User'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id_Vetting'], 'length' => []],
            'fk_vsdb_vetting_vsdb_client1' => ['type' => 'foreign', 'columns' => ['id_Client'], 'references' => ['clients', 'id_Client'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_vsdb_vetting_vsdb_user1' => ['type' => 'foreign', 'columns' => ['id_User'], 'references' => ['users', 'idUser'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'latin1_swedish_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id_Vetting' => 1,
            'date' => '2017-01-06',
            'comments' => 'Lorem ipsum dolor sit amet',
            'id_Client' => 1,
            'id_User' => 1
        ],
    ];
}
