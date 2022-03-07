<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Managers Model
 *
 * @property \App\Model\Table\TowersTable&\Cake\ORM\Association\HasMany $Towers
 *
 * @method \App\Model\Entity\Manager newEmptyEntity()
 * @method \App\Model\Entity\Manager newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Manager[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Manager get($primaryKey, $options = [])
 * @method \App\Model\Entity\Manager findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Manager patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Manager[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Manager|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Manager saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Manager[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Manager[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Manager[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Manager[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ManagersTable extends Table
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

        $this->setTable('managers');
        $this->setDisplayField('nazwa');
        $this->setPrimaryKey('id');

        $this->hasMany('Towers', [
            'foreignKey' => 'manager_id',
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

        $validator
            ->scalar('nr_uprawnien')
            ->maxLength('nr_uprawnien', 512)
            ->requirePresence('nr_uprawnien', 'create')
            ->notEmptyString('nr_uprawnien');

        return $validator;
    }
}
