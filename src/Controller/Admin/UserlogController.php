<?php
declare(strict_types=1);

namespace App\Controller\Admin;
use App\Controller\Admin\AppController;



/**
 * Userlog Controller
 *
 * @property \App\Model\Table\UserlogTable $Userlog
 * @method \App\Model\Entity\Userlog[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UserlogController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users'],
        ];
        $userlog = $this->paginate($this->Userlog);

        $this->set(compact('userlog'));
    }

    /**
     * View method
     *
     * @param string|null $id Userlog id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $userlog = $this->Userlog->get($id, [
            'contain' => ['Users'],
        ]);

        $this->set(compact('userlog'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userlog = $this->Userlog->newEmptyEntity();
        if ($this->request->is('post')) {
            $userlog = $this->Userlog->patchEntity($userlog, $this->request->getData());
            if ($this->Userlog->save($userlog)) {
                $this->Flash->success(__('The userlog has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The userlog could not be saved. Please, try again.'));
        }
        $users = $this->Userlog->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('userlog', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Userlog id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userlog = $this->Userlog->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userlog = $this->Userlog->patchEntity($userlog, $this->request->getData());
            if ($this->Userlog->save($userlog)) {
                $this->Flash->success(__('The userlog has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The userlog could not be saved. Please, try again.'));
        }
        $users = $this->Userlog->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('userlog', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Userlog id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userlog = $this->Userlog->get($id);
        if ($this->Userlog->delete($userlog)) {
            $this->Flash->success(__('The userlog has been deleted.'));
        } else {
            $this->Flash->error(__('The userlog could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
