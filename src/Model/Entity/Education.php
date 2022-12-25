<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Education Entity
 *
 * @property int $id
 * @property string $code
 * @property string $title
 * @property string $detail
 * @property string $credit
 * @property string $level
 * @property int $score
 * @property string $type
 * @property string $goal
 * @property string $objective
 * @property string $description
 * @property string $website
 * @property int $user_id
 * @property string|null $file
 * @property int $download
 * @property int $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $updated
 *
 * @property \App\Model\Entity\User $user
 */
class Education extends Entity
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
        'code' => true,
        'title' => true,
        'detail' => true,
        'credit' => true,
        'level' => true,
        'score' => true,
        'type' => true,
        'goal' => true,
        'objective' => true,
        'description' => true,
        'website' => true,
        'user_id' => true,
        'file' => true,
        'download' => true,
        'status' => true,
        'created' => true,
        'updated' => true,
        'user' => true,
    ];
}
