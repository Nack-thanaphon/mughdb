<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Event Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $typeid
 * @property string $title
 * @property string $detail
 * @property string $address
 * @property string|null $docfile
 * @property string|null $imgcover
 * @property string $link
 * @property string $start
 * @property string $end
 * @property string $status
 * @property string $time_start
 * @property string $time_end
 * @property \Cake\I18n\FrozenTime $created_at
 *
 * @property \App\Model\Entity\User $user
 */
class Event extends Entity
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
        'user_id' => true,
        'typeid' => true,
        'title' => true,
        'detail' => true,
        'address' => true,
        'docfile' => true,
        'imgcover' => true,
        'link' => true,
        'start' => true,
        'end' => true,
        'status' => true,
        'time_start' => true,
        'time_end' => true,
        'created_at' => true,
        'user' => true,
    ];
}
