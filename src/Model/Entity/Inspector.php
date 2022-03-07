<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Inspector Entity
 *
 * @property int $id
 * @property string $nazwa
 * @property string $adres_ulica
 * @property string $adres_miasto
 * @property string|null $telefon
 * @property string $uprawnienia
 *
 * @property \App\Model\Entity\Tower[] $towers
 */
class Inspector extends Entity
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
        'nazwa' => true,
        'adres_ulica' => true,
        'adres_miasto' => true,
        'telefon' => true,
        'uprawnienia' => true,
        'towers' => true,
    ];
}
