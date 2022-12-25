<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * FileGroup Controller
 *
 * @property \App\Model\Table\FileGroupTable $FileGroup
 * @method \App\Model\Entity\FileGroup[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FileGroupController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $fileGroup = $this->paginate($this->FileGroup);
       
        $this->set(compact('fileGroup'));
    }

    /**
     * View method
     *
     * @param string|null $id File Group id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $fileGroup = $this->FileGroup->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('fileGroup'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $fileGroup = $this->FileGroup->newEmptyEntity();
        if ($this->request->is('post')) {
            $fileGroup = $this->FileGroup->patchEntity($fileGroup, $this->request->getData());
            if ($this->FileGroup->save($fileGroup)) {
                $this->Flash->success(__('The file group has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The file group could not be saved. Please, try again.'));
        }
        $this->set(compact('fileGroup'));
    }

    /**
     * Edit method
     *
     * @param string|null $id File Group id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $fileGroup = $this->FileGroup->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $fileGroup = $this->FileGroup->patchEntity($fileGroup, $this->request->getData());
            if ($this->FileGroup->save($fileGroup)) {
                $this->Flash->success(__('The file group has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The file group could not be saved. Please, try again.'));
        }
        $this->set(compact('fileGroup'));
    }

    /**
     * Delete method
     *
     * @param string|null $id File Group id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $fileGroup = $this->FileGroup->get($id);
        if ($this->FileGroup->delete($fileGroup)) {
            $this->Flash->success(__('The file group has been deleted.'));
        } else {
            $this->Flash->error(__('The file group could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
