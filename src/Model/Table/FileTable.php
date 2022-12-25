<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * File Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\File newEmptyEntity()
 * @method \App\Model\Entity\File newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\File[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\File get($primaryKey, $options = [])
 * @method \App\Model\Entity\File findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\File patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\File[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\File|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\File saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\File[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\File[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\File[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\File[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class FileTable extends Table
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

        $this->setTable('file');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);

        $this->belongsTo('FileGroup', [
            'foreignKey' => 'filegroup',
            'joinType' => 'INNER',
        ]);
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
            ->scalar('name')
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->requirePresence('filegroup', 'create')
            ->notEmptyFile('filegroup');

        $validator
            ->scalar('filetype')
            ->allowEmptyFile('filetype');

        $validator
            ->integer('user_id')
            ->notEmptyString('user_id');

        $validator
            ->scalar('detail')
            ->requirePresence('detail', 'create')
            ->notEmptyString('detail');

        $validator
            ->isArray('file')
            ->allowEmptyArray('file');
        // ->allowEmptyFile('file');


        $validator
            ->scalar('link')
            ->requirePresence('link', 'create')
            ->notEmptyString('link');

        $validator
            ->requirePresence('download', 'create')
            ->notEmptyString('download');

        $validator
            ->scalar('status')
            ->requirePresence('status', 'create')
            ->notEmptyString('status');

        $validator
            ->dateTime('createdat')
            ->notEmptyDateTime('createdat');

        $validator
            ->dateTime('updatedat')
            ->notEmptyDateTime('updatedat');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('user_id', 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}
