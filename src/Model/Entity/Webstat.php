<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Webstat Entity
 *
 * @property int $c_id
 * @property string $c_ip
 * @property string $c_nation
 * @property \Cake\I18n\FrozenDate $c_date
 */
class Webstat extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'c_ip' => true,
        'c_nation' => true,
        'c_date' => true,
    ];
}
