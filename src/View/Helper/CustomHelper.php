<?php

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\StringTemplateTrait;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use PharIo\Version\PreReleaseSuffix;

class customHelper extends Helper
{

    public function getOrderStatus($orderId)
    {

        $Orderstable = TableRegistry::getTableLocator()->get('Orders');
        $OdersData = $Orderstable->find()
            ->where([
                'id' => $orderId
            ])->first();

        $status = '';

        if ($OdersData->status == 0) {
            $status = '<span class="text-danger">ยกเลิก</span>';
        }
        if ($OdersData->status == 1) {
            $status = '<span class="text-muted">รอการชำระเงิน</span>';
        }
        if ($OdersData->status == 2) {
            $status = '<span class="text-primary">รอการตรวจสอบ</span>';
        }
        if ($OdersData->status == 3) {
            $status = '<span class="text-primary">ชำระเงินแล้ว</span>';
        }
        if ($OdersData->status == 4) {
            $status = '<span class="text-muted">กำลังดำเนินการ</span>';
        }
        if ($OdersData->status == 5) {
            $status = '<span class="text-success">จัดส่งแล้ว</span>';
        }

        echo $status;
    }
    public function countBalance()
    {
        $table = TableRegistry::getTableLocator()->get('Orders');
        $countBalance = $table->find('all', [
            "contain" => ['Users']
        ])->toArray();
        return $countBalance;
    }

    public function countSuccessOrder()
    {
        $table = TableRegistry::getTableLocator()->get('Orders');
        $countBalance = $table->find()
            ->where([
                'status' => 5
            ])
            ->count();
        return $countBalance;
    }

    public function GetContactData()
    {
        $table = TableRegistry::getTableLocator()->get('Contact');
        $GetContactData = $table->find('all');
        return $GetContactData;
    }

    public function countInCart()
    {
        $table = TableRegistry::getTableLocator()->get('Orders');
        $countBalance = $table->find()
            ->where([
                'status' => 1
            ])
            ->count();
        return $countBalance;
    }
    public function countOrderCancle()
    {
        $table = TableRegistry::getTableLocator()->get('Orders');
        $countBalance = $table->find()
            ->where([
                'status' => 0
            ])
            ->count();
        return $countBalance;
    }



    public function getProductsType()
    {
        $ProductsType = TableRegistry::getTableLocator()->get('ProductsType');
        $getProductsType = $ProductsType->find('all')->toArray();
        return $getProductsType;
    }
    public function countOrders()
    {
        $table = TableRegistry::getTableLocator()->get('Orders');
        $countOrders = $table->find()->limit(3)->toArray();
        return $countOrders;
    }
    public function countPost()
    {
        $table = TableRegistry::getTableLocator()->get('Posts');
        $countPost = $table->find()->count();
        return $countPost;
    }
    public function DateThai($strDate)
    {
        $strYear = date("Y", strtotime($strDate)) + 543;
        $strMonth = date("n", strtotime($strDate));
        $strDay = date("j", strtotime($strDate));
        $strHour = date("H", strtotime($strDate));
        $strMinute = date("i", strtotime($strDate));
        $strSeconds = date("s", strtotime($strDate));
        $strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
        $strMonthThai = $strMonthCut[$strMonth];
        return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
    }


    public function getDateEndInt($getDateEnd)
    {
        $today = strtotime(date("Y-m-d h:i:sa"));
        $str_end = strtotime($getDateEnd); // ทำวันที่ให้อยู่ในรูปแบบ timestamp

        $nseconds = $str_end - $today; // วันที่ระหว่างเริ่มและสิ้นสุดมาลบกัน
        $ndays = round($nseconds / 86400); // หนึ่งวันมี 86400 วินาที
        // $ndays = round($ndays / 3);
        return $ndays;
    }

    public function getDateEndStr($getDateEnd)
    {
        $today = strtotime(date("Y-m-d h:i:sa"));
        $str_end = strtotime($getDateEnd); // ทำวันที่ให้อยู่ในรูปแบบ timestamp
        $nseconds = $str_end - $today; // วันที่ระหว่างเริ่มและสิ้นสุดมาลบกัน
        $ndays = round($nseconds / 86400); // หนึ่งวันมี 86400 วินาที

        $Exprired = '';
        if ($ndays <= 0) {
            $Exprired = 'หมดอายุการใช้งาน';
        } else {
            $Exprired = 'กำลังใช้งาน';
        }
        return $Exprired;
    }



    public function countPostType()
    {
        $table = TableRegistry::getTableLocator()->get('PostsType');
        $countProductType = $table->find()->count();
        return $countProductType;
    }
    public function GetUsertoken($result = null)
    {
        if (!empty($result)) {
            $Usertoken = '';
            if (!empty($result['token'])) {
                $Usertoken = $result['token'];
            }
            return $Usertoken;
        }
    }


    public function GetUserDataById($id)
    {
        if (!empty($id)) {
            $usertable = TableRegistry::getTableLocator()->get('Users');
            $user = $usertable->find()
                ->select([
                    'id' => 'users.id',
                    'token' => 'users.token',
                    'email' => 'users.email',
                    'address' => 'users.address',
                    'phone' => 'users.phone',
                    'name' => 'users.name',
                    'role' => 'ur.ur_name'
                ])
                ->join([
                    'ur' => ([
                        'table' => 'users_role',
                        'type' => 'INNER',
                        'conditions' => 'ur.id = users.user_role_id'
                    ])
                ])
                ->from('users')
                ->where([
                    'users.id' => $id
                ])
                ->toArray();
            return $user;
        }
    }
    public function GetUserData($token)
    {
        if (!empty($token)) {
            $usertable = TableRegistry::getTableLocator()->get('Users');
            $user = $usertable->find()
                ->select([
                    'id' => 'users.id',
                    'token' => 'users.token',
                    'email' => 'users.email',
                    'address' => 'users.address',
                    'phone' => 'users.phone',
                    'name' => 'users.name',
                    'role' => 'ur.ur_name'
                ])
                ->join([
                    'ur' => ([
                        'table' => 'users_role',
                        'type' => 'INNER',
                        'conditions' => 'ur.id = users.user_role_id'
                    ])
                ])
                ->from('users')
                ->where([
                    'users.token' => $token
                ])
                ->toArray();
            return $user;
        }
    }


    public function getPromotion()
    {
        $table = TableRegistry::getTableLocator()->get('Promotions');
        $promotion = $table->find('all');
        return $promotion;
    }
    public function getProductType()
    {
        $table = TableRegistry::getTableLocator()->get('ProductsType');
        $Productstype = $table->find('all');
        return $Productstype;
    }

    public function getPostsType()
    {
        $table = TableRegistry::getTableLocator()->get('PostsType');
        $getPostsType = $table->find('all');
        return $getPostsType;
    }







    public function countVisiter()
    {
        $table = TableRegistry::getTableLocator()->get('webstat');
        $countProduct = $table->find()->count();
        return $countProduct;
    }
    public function countCauses()
    {
        $table = TableRegistry::getTableLocator()->get('education');
        $countProduct = $table->find()->count();
        return $countProduct;
    }
    public function countUsers()
    {
        $table = TableRegistry::getTableLocator()->get('users');
        $countBranch = $table->find()->count();
        return $countBranch;
    }
}
