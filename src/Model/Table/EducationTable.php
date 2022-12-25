<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Education Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Education newEmptyEntity()
 * @method \App\Model\Entity\Education newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Education[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Education get($primaryKey, $options = [])
 * @method \App\Model\Entity\Education findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Education patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Education[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Education|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Education saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Education[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Education[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Education[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Education[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EducationTable extends Table
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

        $this->setTable('education');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
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
            ->scalar('code')
            ->maxLength('code', 255)
            ->requirePresence('code', 'create')
            ->notEmptyString('code');

        $validator
            ->scalar('title')
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('detail')
            ->requirePresence('detail', 'create')
            ->notEmptyString('detail');

        $validator
            ->scalar('credit')
            ->requirePresence('credit', 'create')
            ->notEmptyString('credit');

        $validator
            ->scalar('level')
            ->requirePresence('level', 'create')
            ->notEmptyString('level');

        $validator
            ->requirePresence('score', 'create')
            ->notEmptyString('score');

        $validator
            ->scalar('type')
            ->requirePresence('type', 'create')
            ->notEmptyString('type');

        $validator
            ->scalar('goal')
            ->requirePresence('goal', 'create')
            ->notEmptyString('goal');

        $validator
            ->scalar('objective')
            ->requirePresence('objective', 'create')
            ->notEmptyString('objective');

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator
            ->scalar('website')
            ->requirePresence('website', 'create')
            ->notEmptyString('website');

        $validator
            ->notEmptyString('user_id');


        $validator
            ->isArray('file')
            ->allowEmptyArray('file');
            // ->allowEmptyFile('file');

        $validator
            ->integer('download')
            ->requirePresence('download', 'create')
            ->notEmptyString('download');

        $validator
            ->requirePresence('status', 'create')
            ->notEmptyString('status');

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
