<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;


class EducationController extends AppController
{

    // public function beforeFilter(\Cake\Event\EventInterface $event)
    // {
    //     parent::beforeFilter($event);
    //     $this->Authentication->addUnauthenticatedActions(['controller' => 'dashboard', 'action' => 'index']);
    // }
    // public function index()
    // {
    //     $this->paginate = [
    //         'contain' => ['Users'],
    //         'order' => ['education.id' => 'desc']
    //     ];
    //     $education = $this->paginate($this->Education);
    //     $countEducationDownload = $this->Custom->countEducationDownload();
    //     $countEducationActive = $this->Custom->countEducationActive();
    //     $countEducationUnActive = $this->Custom->countEducationUnActive();

    //     $this->set(compact(
    //         'education',
    //         'countEducationDownload',
    //         'countEducationActive',
    //         'countEducationUnActive'
    //     ));
    // }


    // public function view()
    // {
    //     $id = $this->request->getData('id');
    //     $Education = $this->Education->get($id, [
    //         'contain' => [],
    //     ]);
    //     $this->set('Education', $Education);
    //     $this->set('_serialize', ['Education']);
    // }


    // public function add()
    // {
    //     $education = $this->Education->newEmptyEntity();
    //     if ($this->request->is('post')) {

    //         $fileData = $this->request->getData('file');


    //         $fileDataSave = '';
    //         if ($fileData->getError() == 0) {
    //             $education = $this->Education->patchEntity($education, $this->request->getData());
    //             $fileName = $fileData->getClientFilename();
    //             $fileType = $fileData->getClientMediaType();
    //             $FilePath = WWW_ROOT . "document/education/" . DS . $fileName;
    //             $fileData->moveTo($FilePath);
    //             $fileDataSave = "document/education/" . $fileName;
    //             $education->file = $fileDataSave;
    //             $education->download = 0;
    //             $education->user_id = $this->getUsersId();

    //             if ($this->Education->save($education)) {
    //                 $this->Flash->success(__('The education has been saved.'));

    //                 return $this->redirect(['action' => 'index']);
    //             }
    //         } else {
    //             $education = $this->Education->patchEntity($education, $this->request->getData());
    //             $education->file = $fileDataSave;
    //             $education->download = 0;
    //             $education->user_id = $this->getUsersId();
    //             if ($this->Education->save($education)) {
    //                 $this->Flash->success(__('The education has been saved.'));

    //                 return $this->redirect(['action' => 'index']);
    //             }
    //             $this->Flash->error(__('The education could not be saved. Please, try again.'));
    //         }
    //     }
    //     $users = $this->Education->Users->find('list', ['limit' => 200])->all();
    //     $this->set(compact('education', 'users'));
    // }


    // public function edit($id = null)
    // {
    //     $education = $this->Education->get($id, [
    //         'contain' => [],
    //     ]);
    //     if ($this->request->is(['patch', 'post', 'put'])) {
    //         $Education = $this->Education->patchEntity($education, $this->request->getData());
    //         $Educationfile = $this->request->getData("file");
    //         $EducationfileOld = $this->request->getData("fileOld");
    //         if ($Educationfile->getError() == 0) {
    //             $fileName = $Educationfile->getClientFilename();
    //             $fileType = $Educationfile->getClientMediaType();

    //             $EducationfileData = '';

    //             $FilePath = WWW_ROOT . "document/education/" . DS . $fileName;
    //             $Educationfile->moveTo($FilePath);
    //             $EducationfileData = "document/education/" . $fileName;

    //             $Education->file = $EducationfileData;

    //             if ($this->Education->save($Education)) {
    //                 $this->Flash->success(__('The Education has been saved.'));
    //                 return $this->redirect(['action' => 'index']);
    //             }
    //             $this->Flash->error(__('The Education could not be saved. Please, try again.'));
    //         } else {

    //             $Education->file = $EducationfileOld;
    //             if ($this->Education->save($Education)) {
    //                 $this->Flash->success(__('The Education has been saved.'));
    //                 return $this->redirect(['action' => 'index']);
    //             } else {
    //                 $this->Flash->error(__('The Education could not be saved. Please, try again.'));
    //             }
    //         }
    //     }
    //     $users = $this->Education->Users->find('list', ['limit' => 200])->all();
    //     $this->set(compact('education', 'users'));
    // }

    // public function delete()
    // {
    //     $this->request->allowMethod(['post', 'delete']);
    //     $id = $this->request->getData('id');
    //     $education = $this->Education->get($id);
    //     if ($this->Education->delete($education)) {
    //         $this->Flash->success(__('The education has been deleted.'));
    //     } else {
    //         $this->Flash->error(__('The education could not be deleted. Please, try again.'));
    //     }

    //     return $this->redirect(['action' => 'index']);
    // }
}
