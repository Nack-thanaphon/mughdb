<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Contact Entity
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $nickname
 * @property string|null $about
 * @property string|null $name_address
 * @property string|null $address
 * @property string|null $fax
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $facebook
 * @property string|null $line
 * @property string|null $linetoken
 * @property string|null $lineoficial
 * @property string|null $logo
 * @property \Cake\I18n\FrozenTime $updated_at
 * @property \Cake\I18n\FrozenTime $created_at
 */
class Contact extends Entity
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
        'nickname' => true,
        'about' => true,
        'name_address' => true,
        'address' => true,
        'fax' => true,
        'phone' => true,
        'email' => true,
        'facebook' => true,
        'line' => true,
        'linetoken' => true,
        'lineoficial' => true,
        'logo' => true,
        'updated_at' => true,
        'created_at' => true,
    ];
}
