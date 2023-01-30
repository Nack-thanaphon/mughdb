<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;


class EducationController extends AppController
{

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions(['controller' => 'dashboard', 'action' => 'index']);
    }
    public function index()
    {

        $education = $this->Education->find('all')->toArray();
        $countEducationDownload = $this->Custom->countEducationDownload();
        $countEducationActive = $this->Custom->countEducationActive();
        $countEducationUnActive = $this->Custom->countEducationUnActive();

        $this->set(compact(
            'education',
            'countEducationDownload',
            'countEducationActive',
            'countEducationUnActive'
        ));
    }


    public function view()
    {
        $id = $this->request->getData('id');
        $Education = $this->Education->get($id, [
            'contain' => [],
        ]);
        $this->set('Education', $Education);
        $this->set('_serialize', ['Education']);
    }


    public function add()
    {
        $education = $this->Education->newEmptyEntity();
        if ($this->request->is('post')) {

            $fileData = $this->request->getData('file');

            $education = $this->Education->patchEntity($education, $this->request->getData());
            $fileName = $fileData->getClientFilename();

            $fileDataSave = '';
            if ($fileData->getError() == 0) {
                $FilePath = WWW_ROOT . "document/education/" . DS . $fileName;
                $fileData->moveTo($FilePath);
                $fileDataSave = "document/education/" . $fileName;
            }
            $education->file = $fileDataSave;
            $education->download = 0;
            $education->user_id = $this->getUsersId();
            if ($this->Education->save($education)) {
                $this->Flash->success(__('บันทึกข้อมูลสำเร็จ'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('บันทึกข้อมูลไม่สำเร็จ'));
        }
        $users = $this->Education->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('education', 'users'));
    }


    public function edit($id = null)
    {
        $education = $this->Education->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['post', 'put'])) {
            $Education = $this->Education->patchEntity($education, $this->request->getData());
            $Educationfile = $this->request->getData("fileNews");
            $EducationfileOld = $this->request->getData("fileOld");

            $EducationfileData = '';
            if (!empty($Educationfile)) {
                $fileName = $Educationfile->getClientFilename();
                if (!$Educationfile->getError()) {
                    $FilePath = WWW_ROOT . "document/education/" . DS . $fileName;
                    $Educationfile->moveTo($FilePath);
                    $EducationfileData = "document/education/" . $fileName;
                }
            }
            if (($EducationfileData) == '') {
                $EducationfileData = $EducationfileOld;
            }


            $Education->file = $EducationfileData;

            if ($this->Education->save($Education)) {
                $this->Flash->success(__('บันทึกข้อมูลสำเร็จ'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('บันทึกข้อมูลไม่สำเร็จ'));
            }
        }
        $users = $this->Education->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('education', 'users'));
    }

    public function delete()
    {
        $this->request->allowMethod(['post', 'delete']);
        $id = $this->request->getData('id');
        $education = $this->Education->get($id);
        if ($this->Education->delete($education)) {
            $this->Flash->success(__('ลบข้อมูลสำเร็จ'));
        } else {
            $this->Flash->error(__('ลบข้อมูลไม่สำเร็จ'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
