<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Webstat Model
 *
 * @method \App\Model\Entity\Webstat newEmptyEntity()
 * @method \App\Model\Entity\Webstat newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Webstat[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Webstat get($primaryKey, $options = [])
 * @method \App\Model\Entity\Webstat findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Webstat patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Webstat[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Webstat|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Webstat saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Webstat[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Webstat[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Webstat[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Webstat[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class WebstatTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('webstat');
        $this->setDisplayField('c_id');
        $this->setPrimaryKey('c_id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('c_ip')
            ->requirePresence('c_ip', 'create')
            ->notEmptyString('c_ip');

        $validator
            ->scalar('c_nation')
            ->maxLength('c_nation', 20)
            ->requirePresence('c_nation', 'create')
            ->notEmptyString('c_nation');

        $validator
            ->date('c_date')
            ->notEmptyDate('c_date');

        return $validator;
    }
}
