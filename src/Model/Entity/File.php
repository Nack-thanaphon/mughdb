<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * File Entity
 *
 * @property int $id
 * @property string $name
 * @property int $filegroup
 * @property string|null $filetype
 * @property int $user_id
 * @property string $detail
 * @property string $file
 * @property string $link
 * @property int $download
 * @property string $status
 * @property \Cake\I18n\FrozenTime $createdat
 * @property \Cake\I18n\FrozenTime $updatedat
 *
 * @property \App\Model\Entity\User $user
 */
class File extends Entity
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
        'name' => true,
        'filegroup' => true,
        'filetype' => true,
        'user_id' => true,
        'detail' => true,
        'file' => true,
        'link' => true,
        'download' => true,
        'status' => true,
        'createdat' => true,
        'updatedat' => true,
        'user' => true,
    ];
}
