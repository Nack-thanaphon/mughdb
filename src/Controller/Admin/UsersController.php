<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\Mailer\Mailer;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Utility\Security;
use Cake\ORM\TableRegistry;
use Cake\Mailer\TransportFactory;
use Cake\ORM\Locator\TableLocator;
use Cake\Routing\Router;

class UsersController extends AppController
{

    public function index()
    {
        $getUserRole = $this->Custom->getUserRole();
        $getUserType = $this->Custom->getUserType();


        $usersUnVerifiled = $this->Users->find('all', [
            'contain' => ['UsersType', 'UsersRole'],
        ])->order([
            'Users.id' => 'DESC'
        ])->limit(5)->toArray();



        $this->set(compact('usersUnVerifiled',  'getUserRole', 'getUserType'));
    }
    public function forgetpassword()
    {

        $this->viewBuilder()->setlayout('frontend');

        if ($this->request->is('post')) {
            $email = $this->request->getData('email');
            $usertable = TableRegistry::getTableLocator()->get('Users');
            $user = $usertable->find('all')->where(['email' => $email])->first();
            $token = $user->token;
            if ($user != null) {
                $user->password = '';
                if ($usertable->save($user)) {
                    $this->Flash->set('กรุณาเช็คในอีเมลล์ ' . $email . ' เพื่อยืนยันการเปลี่ยนรหัสผ่าน', ['element' => 'success']);
                    $mailer = new Mailer('default');
                    $mailer->setFrom(['e21bvz@gmail.com' => 'MUGH'])
                        ->setTo($email)
                        ->setEmailFormat('html')
                        ->setSubject('เปลี่ยนรหัสผ่านการเข้าใช้งาน MUGH')
                        ->setTransport('gmail')
                        ->setViewVars([
                            'name' => $user->name,
                            'verify' => $token
                        ])
                        ->viewBuilder()
                        ->setTemplate('resetpassword');

                    $mailer->deliver();
                    $htmlStatusCode = 200;
                    $response = [
                        'status' => $htmlStatusCode,
                        'message' => 'OK',
                    ];
                    $this->set(compact('response'));
                    $this->viewBuilder()->setOption('serialize', ['response']);
                    $this->setResponse($this->response->withStatus($htmlStatusCode));
                } else {
                    $this->Flash->set('เปลี่ยนรหัสผ่านไม่สำเร็จ หรือข้อมูลไม่ถูกต้อง', ['element' => 'error']);
                }
            } else {
                $this->Flash->set('ไม่มีข้อมูลในระบบ', ['element' => 'error']);
            }
        }
    }
    public function view($token = null)
    {
        $user = $this->Users->find()
            ->where([
                'token =' => $token
            ])
            ->contain(['UsersType', 'UsersRole'])
            ->first();

        // pr($user);
        // die;
        $this->set(compact('user'));
    }


    public function add()
    {
        $getUserRole = $this->Custom->getUserRole();
        $getUserType = $this->Custom->getUserType();
        $user = $this->Users->newEmptyEntity();

        if ($this->request->is('post')) {
            $usertable = TableRegistry::getTableLocator()->get('Users');
            $user = $usertable->newemptyEntity();
            $hasher = new DefaultPasswordHasher();
            $myname = $this->request->getData('name');
            $myemail = $this->request->getData('email');
            $userrole = $this->request->getData('user_role_id');
            $usertype = $this->request->getData('user_type_id');

            $mypass = $this->request->getData('password');
            $mytoken = Security::hash(Security::randomBytes(32));
            $user->name = $myname;
            $user->email = $myemail;
            $user->user_type_id = $usertype;
            $user->user_role_id = $userrole;
            $user->status = 1;
            $user->verified = 0;
            $user->password = $hasher->hash($mypass);
            $user->token = $mytoken;
            $user->created_at = date('Y-m-d H:i:s');
            $user->updated_at = date('Y-m-d H:i:s');

            if ($usertable->save($user)) {
                $this->Flash->success('กรุณาเช็คอีเมลล์เพื่อยืนยัน');


                $mailer = new Mailer('default');
                $mailer->setFrom(['e21bvz@gmail.com' => 'MUGH'])
                    ->setTo($myemail)
                    ->setEmailFormat('html')
                    ->setSubject('กรุณายืนยันอีเมลล์ของคุณเพื่อเข้าใช้งาน MUGH')
                    ->setTransport('gmail')
                    ->setViewVars([
                        'name' => $myname,
                        'verify' => $mytoken
                    ])
                    ->viewBuilder()
                    ->setTemplate('verify');
                $mailer->deliver();
                $this->Flash->error('ลงทะเบียนสำเร็จ');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('ลงทะเบียนไม่สำเร็จ');
            }
        }
        $this->set(compact('user', 'getUserRole', 'getUserType'));
    }

    public function edit($token = null)
    {
        $getUserRole = $this->Custom->getUserRole();
        $getUserType = $this->Custom->getUserType();
        $user = $this->Users->find()
            ->where([
                'token =' => $token
            ])
            ->contain(['UsersType', 'UsersRole'])
            ->first();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            ///file
            $userimg = $this->request->getData("userimage");
            ///filetext
            $userimgText = $this->request->getData("imgold");
            //userId
            $userid = $this->request->getData('userId');

            $userimgDataSave = '';

            $imgcoverName = $userimg->getClientFilename();

            if ($userimg->getError() == 0) {
                $userimgData = WWW_ROOT . "img/user/" . DS . $imgcoverName;
                $userimg->moveTo($userimgData);
                $userimgDataSave = "img/user/" . $imgcoverName;
            }
            if (($userimgDataSave == '')) {
                $userimgDataSave = $userimgText;
            }

            $user->image = $userimgDataSave;
            $user->id = $userid;

            if ($this->Users->save($user)) {
                $this->Flash->success(__('บันทึกข้อมูลสำเร็จ'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('บันทึกข้อมูลไม่สำเร็จ'));
        }
        $this->set(compact('user', 'getUserRole', 'getUserType'));
    }

    public function profile($token = null)
    {
        $getUserRole = $this->Custom->getUserRole();
        $getUserType = $this->Custom->getUserType();
        $user = $this->Users->find()
            ->where([
                'token =' => $token
            ])
            ->contain(['UsersType', 'UsersRole'])
            ->first();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            ///file
            $userimg = $this->request->getData("userimage");
            ///filetext
            $userimgText = $this->request->getData("imgold");
            //userId
            $userid = $this->request->getData('userId');

            $userimgDataSave = '';

            $imgcoverName = $userimg->getClientFilename();

            if ($userimg->getError() == 0) {
                $userimgData = WWW_ROOT . "img/user/" . DS . $imgcoverName;
                $userimg->moveTo($userimgData);
                $userimgDataSave = "img/user/" . $imgcoverName;
            }
            if (($userimgDataSave == '')) {
                $userimgDataSave = $userimgText;
            }

            $user->image = $userimgDataSave;
            $user->id = $userid;

            if ($this->Users->save($user)) {
                $this->Flash->success(__('บันทึกข้อมูลสำเร็จ'));

                return $this->redirect(['controller' => 'dashboard', 'action' => 'index']);
            }
            $this->Flash->error(__('บันทึกข้อมูลไม่สำเร็จ'));
        }
        $this->set(compact('user', 'getUserRole', 'getUserType'));
    }


    public function delete()
    {

        $id = $this->request->getData('id');
        $Users = $this->Users->get($id);
        if ($this->Users->delete($Users)) {
            $this->Flash->success(__('ลบข้อมูลสำเร็จ'));
        } else {
            $this->Flash->error(__('ลบข้อมูลไม่สำเร็จ'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
