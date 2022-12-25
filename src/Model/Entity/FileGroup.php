<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * FileGroup Entity
 *
 * @property int $g_id
 * @property string $g_name
 * @property string $g_detail
 * @property string $g_address
 * @property string $g_status
 * @property \Cake\I18n\FrozenDate|null $g_date
 * @property \Cake\I18n\FrozenTime $g_update
 */
class FileGroup extends Entity
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
        'g_name' => true,
        'g_detail' => true,
        'g_address' => true,
        'g_status' => true,
        'g_date' => true,
        'g_update' => true,
    ];
}
