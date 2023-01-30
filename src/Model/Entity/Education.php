<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Education Entity
 *
 * @property int $id
 * @property string|null $code
 * @property string|null $faculty
 * @property string|null $title
 * @property string|null $detail
 * @property string|null $credit
 * @property string|null $level
 * @property int|null $score
 * @property string|null $type
 * @property string|null $goal
 * @property string|null $objective
 * @property string|null $description
 * @property string|null $website
 * @property int|null $user_id
 * @property string|null $file
 * @property int|null $download
 * @property string|null $link
 * @property int|null $status
 * @property \Cake\I18n\FrozenTime $created
 * @property string|null $updated
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
        'faculty' => true,
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
        'link' => true,
        'status' => true,
        'created' => true,
        'updated' => true,
        'user' => true,
    ];
}
