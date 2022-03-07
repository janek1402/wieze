<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Towers Model
 *
 * @property \App\Model\Table\InvestorsTable&\Cake\ORM\Association\BelongsTo $Investors
 * @property \App\Model\Table\ManagersTable&\Cake\ORM\Association\BelongsTo $Managers
 * @property \App\Model\Table\InspectorsTable&\Cake\ORM\Association\BelongsTo $Inspectors
 * @property \App\Model\Table\RepresentativesTable&\Cake\ORM\Association\BelongsTo $Representatives
 * @property \App\Model\Table\DocumentsTable&\Cake\ORM\Association\HasMany $Documents
 *
 * @method \App\Model\Entity\Tower newEmptyEntity()
 * @method \App\Model\Entity\Tower newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Tower[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Tower get($primaryKey, $options = [])
 * @method \App\Model\Entity\Tower findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Tower patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Tower[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Tower|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Tower saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Tower[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Tower[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Tower[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Tower[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class TowersTable extends Table
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

        $this->setTable('towers');
        $this->setDisplayField('nr_stacji');
        $this->setPrimaryKey('id');

        $this->belongsTo('Investors', [
            'foreignKey' => 'investor_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Managers', [
            'foreignKey' => 'manager_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Inspectors', [
            'foreignKey' => 'inspector_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Representatives', [
            'foreignKey' => 'representative_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Documents', [
            'foreignKey' => 'tower_id',
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
            ->scalar('nr_stacji')
            ->maxLength('nr_stacji', 256)
            ->requirePresence('nr_stacji', 'create')
            ->notEmptyString('nr_stacji');

        $validator
            ->scalar('miejscowosc')
            ->maxLength('miejscowosc', 256)
            ->requirePresence('miejscowosc', 'create')
            ->notEmptyString('miejscowosc');

        $validator
            ->scalar('adres_masztu')
            ->requirePresence('adres_masztu', 'create')
            ->notEmptyString('adres_masztu');

        $validator
            ->scalar('decyzja_pnb')
            ->requirePresence('decyzja_pnb', 'create')
            ->notEmptyString('decyzja_pnb');

        $validator
            ->scalar('nazwa_budowy')
            ->requirePresence('nazwa_budowy', 'create')
            ->notEmptyString('nazwa_budowy');

        $validator
            ->decimal('wyskosc')
            ->requirePresence('wyskosc', 'create')
            ->notEmptyString('wyskosc');

        $validator
            ->scalar('odstepstwa_od_projektu')
            ->allowEmptyString('odstepstwa_od_projektu');

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
        $rules->add($rules->existsIn(['investor_id'], 'Investors'), ['errorField' => 'investor_id']);
        $rules->add($rules->existsIn(['manager_id'], 'Managers'), ['errorField' => 'manager_id']);
        $rules->add($rules->existsIn(['inspector_id'], 'Inspectors'), ['errorField' => 'inspector_id']);
        $rules->add($rules->existsIn(['representative_id'], 'Representatives'), ['errorField' => 'representative_id']);

        return $rules;
    }
}
