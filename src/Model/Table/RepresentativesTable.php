<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Representatives Model
 *
 * @property \App\Model\Table\TowersTable&\Cake\ORM\Association\HasMany $Towers
 *
 * @method \App\Model\Entity\Representative newEmptyEntity()
 * @method \App\Model\Entity\Representative newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Representative[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Representative get($primaryKey, $options = [])
 * @method \App\Model\Entity\Representative findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Representative patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Representative[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Representative|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Representative saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Representative[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Representative[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Representative[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Representative[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class RepresentativesTable extends Table
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

        $this->setTable('representatives');
        $this->setDisplayField('nazwa');
        $this->setPrimaryKey('id');

        $this->hasMany('Towers', [
            'foreignKey' => 'representative_id',
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
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('nazwa')
            ->maxLength('nazwa', 512)
            ->requirePresence('nazwa', 'create')
            ->notEmptyString('nazwa');

        $validator
            ->scalar('adres_ulica')
            ->maxLength('adres_ulica', 512)
            ->requirePresence('adres_ulica', 'create')
            ->notEmptyString('adres_ulica');

        $validator
            ->scalar('adres_miasto')
            ->maxLength('adres_miasto', 512)
            ->requirePresence('adres_miasto', 'create')
            ->notEmptyString('adres_miasto');

        $validator
            ->scalar('telefon')
            ->maxLength('telefon', 128)
            ->allowEmptyString('telefon');

        return $validator;
    }
}
