<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * File Controller
 *
 * @property \App\Model\Table\FileTable $File
 * @method \App\Model\Entity\File[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FileController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {

        $file = $this->File->find('all')->contain('Users')->toArray();

        $countFile = $this->Custom->countFile();
        $countFileDownload = $this->Custom->countFileDownload();
        $countFileActive = $this->Custom->countFileActive();

        $this->set(compact(
            'file',
            'countFile',
            'countFileDownload',
            'countFileActive'
        ));
    }

    /**
     * View method
     *
     * @param string|null $id File id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {
        $id = $this->request->getData('id');
        
        $File = $this->File->find()
        ->select([
            'name' => 'File.name',
            'detail' => 'File.detail',
            'type' => 'FT.g_name',
            'website' => 'File.link',
            'file' => 'File.file',
            'user' => 'US.name',
            'date' => 'File.createdat'
        ])
        ->join([
            'FT' => ([
                'table' => 'file_group',
                'type' => 'INNER',
                'conditions' => 'FT.g_id = File.filegroup'
            ]),
            'US' => ([
                'table' => 'users',
                'type' => 'INNER',
                'conditions' => 'US.id = File.user_id'
            ])
        ])
        ->where([
            'File.id' => $id
        ])->first();


        $this->set('File', $File);
        $this->set('_serialize', ['File']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $getFileGroup = $this->Custom->getFileGroup();
        $file = $this->File->newEmptyEntity();
        if ($this->request->is('post')) {

            $fileData = $this->request->getData('file');
            $fileDataSave = '';
            if ($fileData->getError() == 0) {

                $file = $this->File->patchEntity($file, $this->request->getData());
                $fileName = $fileData->getClientFilename();
                $fileType = $fileData->getClientMediaType();

                pr($fileType);die;
                $FilePath = WWW_ROOT . "document/file/" . DS . $fileName;
                $fileData->moveTo($FilePath);
                $fileDataSave = "document/file/" . $fileName;
                $file->file = $fileDataSave;
                $file->filetype = $fileType;
                $file->download = 0;
                $file->user_id = $this->getUsersId();


                if ($this->File->save($file)) {
                    $this->Flash->success(__('บันทึกข้อมูลสำเร็จ'));

                    return $this->redirect(['action' => 'index']);
                }
            } else {
                $file = $this->File->patchEntity($file, $this->request->getData());
                $file->file = $fileDataSave;
                $file->download = 0;
                $file->user_id = $this->getUsersId();
                if ($this->File->save($file)) {
                    $this->Flash->success(__('บันทึกข้อมูลสำเร็จ'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('บันทึกข้อมูลไม่สำเร็จ'));
            }
        }
        $users = $this->File->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('file', 'users', 'getFileGroup'));
    }

    /**
     * Edit method
     *
     * @param string|null $id File id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {


        $getFileGroup = $this->Custom->getFileGroup();
        $file = $this->File->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $File = $this->File->patchEntity($file, $this->request->getData());
            $fileData = $this->request->getData("file");
            $fileDataOld = $this->request->getData("fileOld");

            if ($fileData->getError() == 0) {
                $fileName = $fileData->getClientFilename();
                $fileType = $fileData->getClientMediaType();

                $fileDataData = '';

                $FilePath = WWW_ROOT . "document/file/" . DS . $fileName;
                $fileData->moveTo($FilePath);
                $fileDataData = "document/file/" . $fileName;

                $File->file = $fileDataData;
                $File->filetype = $fileType;

                if ($this->File->save($File)) {
                    $this->Flash->success(__('บันทึกข้อมูลสำเร็จ'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('บันทึกข้อมูลไม่สำเร็จ'));
            } else {

                $File->file = $fileDataOld;
                if ($this->File->save($File)) {
                    $this->Flash->success(__('บันทึกข้อมูลสำเร็จ'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('บันทึกข้อมูลไม่สำเร็จ'));
                }
            }
        }
        $users = $this->File->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('file', 'users', 'getFileGroup'));
    }

    /**
     * Delete method
     *
     * @param string|null $id File id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete()
    {
        $this->request->allowMethod(['post', 'delete']);
        $id = $this->request->getData('id');
        $file = $this->File->get($id);
        if ($this->File->delete($file)) {
            $this->Flash->success(__('ลบข้อมูลสำเร็จ'));
        } else {
            $this->Flash->error(__('ลบข้อมูลไม่สำเร็จ'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
