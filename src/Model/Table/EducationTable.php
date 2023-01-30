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
            ->allowEmptyString('code');

        $validator
            ->scalar('faculty')
            ->allowEmptyString('faculty');

        $validator
            ->scalar('title')
            ->allowEmptyString('title');

        $validator
            ->scalar('detail')
            ->allowEmptyString('detail');

        $validator
            ->scalar('credit')
            ->allowEmptyString('credit');

        $validator
            ->scalar('level')
            ->allowEmptyString('level');

        $validator
            ->allowEmptyString('score');

        $validator
            ->scalar('type')
            ->allowEmptyString('type');

        $validator
            ->scalar('goal')
            ->allowEmptyString('goal');

        $validator
            ->scalar('objective')
            ->allowEmptyString('objective');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        $validator
            ->scalar('website')
            ->allowEmptyString('website');

        $validator
            ->allowEmptyString('user_id');

        $validator
            ->scalar('file')
            ->allowEmptyFile('file')
            ->allowEmptyString('file');


        $validator
            ->integer('download')
            ->allowEmptyString('download');

        $validator
            ->scalar('link')
            ->allowEmptyString('link');

        $validator
            ->allowEmptyString('status');

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
