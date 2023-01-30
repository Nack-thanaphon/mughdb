<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;


class DashboardController extends AppController
{

    public function index()
    {
        $countVisiter =  $this->Custom->countVisiter();
        $countNews =  $this->Custom->countNews();
        $countUsers =  $this->Custom->countUsers();

        $getUserlogData = $this->Custom->getUserlogData();
        // pr($getUserlogData);die;
        $getPosts = $this->Custom->getPosts();
        
        $thaiyear = (date("Y") + 543);
        $year = (date("Y"));

        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute(
            "select 'มกราคม' as month ,count(ip) as amount from webstat where date like '%" . $year . "-01%' UNION
            select 'กุมภาพันธ์' as month , count(ip) as amount from webstat where date like '%" . $year . "-02%' UNION
            select 'มีนาคม' as month , count(ip) as amount from webstat where date like '%" . $year . "-03%'UNION
            select 'เมษายน' as month ,count(ip) as amount from webstat where date like '%" . $year . "-04%' UNION
            select 'พฤษภาคม' as month , count(ip) as amount from webstat where date like '%" . $year . "-05%' UNION
            select 'มิถุนายน' as month , count(ip) as amount from webstat where date like '%" . $year . "-06%'UNION
            select 'กรกฎาคม' as month ,count(ip) as amount from webstat where date like '%" . $year . "-07%' UNION
            select 'สิงหาคม' as month , count(ip) as amount from webstat where date like '%" . $year . "-08%' UNION
            select 'กันยายน' as month , count(ip) as amount from webstat where date like '%" . $year . "-09%'UNION
            select 'ตุลาคม' as month ,count(ip) as amount from webstat where date like '%" . $year . "-10%' UNION
            select 'พฤศจิกายน' as month , count(ip) as amount from webstat where date like '%" . $year . "-11%' UNION
            select 'ธันวาคม' as month , count(ip) as amount from webstat where date like '%" . $year . "-12%';"
        );
        $rows = $stmt->fetchAll('assoc');
        $Graphdata = [];
        $month = [];
        $amount = [];
        $Graphdata['amount'] = [];
        $Graphdata['month'] = [];

        foreach ($rows as $key => $row) {
            if ($row['amount'] != null) {
                $Graphdata['amount'][$key] = $row['amount'];
            } else {
                $Graphdata['amount'][$key] = 0;
            }
            $Graphdata['month'][$key] = $row['month'];
        }

        $month = json_encode($Graphdata['month']);
        $amount = json_encode($Graphdata['amount']);
        
        // pr($month);
        // pr($amount);
        // die;

        $this->set(compact(
            'getPosts',
            'getUserlogData',
            'countVisiter',
            'countNews',
            'countUsers',
            'thaiyear',
            'Graphdata',
            'month',
            'amount'
        ));
    }
    
    public function userlogview()
    {
        $userlogviewtable = TableRegistry::getTableLocator()->get('Userlog');

        $userlog= $this->Custom->getUserlogDataAll();

        
        $this->set('userlog', $userlog);
        $this->set('_serialize', ['userlog']);
    }


    public function view($id = null)
    {
        $dashboard = $this->Dashboard->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('dashboard'));
    }
}
