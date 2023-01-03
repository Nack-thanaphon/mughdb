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
                $this->Flash->set('กรุณาเช็คอีเมลล์เพื่อยืนยัน', ['element' => 'success']);
                TransportFactory::setConfig('gmail', [
                    'host' => 'smtp.gmail.com',
                    'port' => 587,
                    'username' => 'e21bvz@gmail.com',
                    'password' => 'jxcsblueiiwjzvxd',
                    'className' => 'Smtp',
                    'tls' => true
                ]);

                $mailer = new Mailer('default');
                $mailer->setFrom(['e21bvz@gmail.com' => 'AUN-HPN'])
                    ->setTo($myemail)
                    ->setEmailFormat('html')
                    ->setSubject('กรุณายืนยันอีเมลล์ของคุณเพื่อเข้าใช้งาน AUN-HPN')
                    ->setTransport('gmail')
                    ->setViewVars([
                        'name' => $myname,
                        'verify' => $mytoken
                    ])
                    ->viewBuilder()
                    ->setTemplate('verify');
                $mailer->deliver();
                $this->Flash->set('ลงทะเบียนสำเร็จ', ['element' => 'success']);
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->set('ลงทะเบียนไม่สำเร็จ', ['element' => 'error']);
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
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user', 'getUserRole', 'getUserType'));
    }


    public function delete()
    {

        $id = $this->request->getData('id');
        $Users = $this->Users->get($id);
        if ($this->Users->delete($Users)) {
            $this->Flash->success(__('The users type has been deleted.'));
        } else {
            $this->Flash->error(__('The users type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
