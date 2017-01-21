<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Vetting Model
 *
 * @method \App\Model\Entity\Vetting get($primaryKey, $options = [])
 * @method \App\Model\Entity\Vetting newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Vetting[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Vetting|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Vetting patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Vetting[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Vetting findOrCreate($search, callable $callback = null)
 */
class VettingTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('vetting');
        $this->displayField('id_Vetting');
        $this->primaryKey('id_Vetting');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id_Vetting')
            ->allowEmpty('id_Vetting', 'create');

        $validator
            ->date('date')
            ->requirePresence('date', 'create')
            ->notEmpty('date');

        $validator
            ->allowEmpty('comments');

        $validator
            ->integer('id_Client')
            ->requirePresence('id_Client', 'create')
            ->notEmpty('id_Client');

        $validator
            ->integer('id_User')
            ->requirePresence('id_User', 'create')
            ->notEmpty('id_User');

        return $validator;
    }
}
