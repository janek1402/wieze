<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Tower Entity
 *
 * @property int $id
 * @property string $nr_stacji
 * @property string $miejscowosc
 * @property string $adres_masztu
 * @property string $decyzja_pnb
 * @property string $nazwa_budowy
 * @property string $wyskosc
 * @property string|null $odstepstwa_od_projektu
 * @property int $investor_id
 * @property int $manager_id
 * @property int $inspector_id
 * @property int $representative_id
 *
 * @property \App\Model\Entity\Investor $investor
 * @property \App\Model\Entity\Manager $manager
 * @property \App\Model\Entity\Inspector $inspector
 * @property \App\Model\Entity\Representative $representative
 * @property \App\Model\Entity\Document[] $documents
 */
class Tower extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'nr_stacji' => true,
        'miejscowosc' => true,
        'adres_masztu' => true,
        'decyzja_pnb' => true,
        'nazwa_budowy' => true,
        'wyskosc' => true,
        'odstepstwa_od_projektu' => true,
        'investor_id' => true,
        'manager_id' => true,
        'inspector_id' => true,
        'representative_id' => true,
        'investor' => true,
        'manager' => true,
        'inspector' => true,
        'representative' => true,
        'documents' => true,
    ];
}
