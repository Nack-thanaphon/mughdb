<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * WebstatFixture
 */
class WebstatFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'webstat';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'c_id' => 1,
                'c_ip' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'c_nation' => 'Lorem ipsum dolor ',
                'c_date' => '2022-12-19',
            ],
        ];
        parent::init();
    }
}
