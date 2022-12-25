<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FileGroup Model
 *
 * @method \App\Model\Entity\FileGroup newEmptyEntity()
 * @method \App\Model\Entity\FileGroup newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\FileGroup[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FileGroup get($primaryKey, $options = [])
 * @method \App\Model\Entity\FileGroup findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\FileGroup patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\FileGroup[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\FileGroup|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FileGroup saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FileGroup[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\FileGroup[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\FileGroup[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\FileGroup[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class FileGroupTable extends Table
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

        $this->setTable('file_group');
        $this->setDisplayField('g_id');
        $this->setPrimaryKey('g_id');
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
            ->scalar('g_name')
            ->requirePresence('g_name', 'create')
            ->notEmptyString('g_name');

        $validator
            ->scalar('g_detail')
            ->requirePresence('g_detail', 'create')
            ->notEmptyString('g_detail');

        $validator
            ->scalar('g_address')
            ->requirePresence('g_address', 'create')
            ->notEmptyString('g_address');

        $validator
            ->scalar('g_status')
            ->requirePresence('g_status', 'create')
            ->notEmptyString('g_status');

        $validator
            ->date('g_date')
            ->allowEmptyDate('g_date');

        $validator
            ->dateTime('g_update')
            ->notEmptyDateTime('g_update');

        return $validator;
    }
}
