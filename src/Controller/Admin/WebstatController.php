<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
// import the PhpSpreadsheet Class
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


/**
 * Webstat Controller
 *
 * @property \App\Model\Table\WebstatTable $Webstat
 * @method \App\Model\Entity\Webstat[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class WebstatController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $webstat = $this->paginate($this->Webstat);

        $this->set(compact('webstat'));
    }

    /**
     * View method
     *
     * @param string|null $id Webstat id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $webstat = $this->Webstat->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('webstat'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $webstat = $this->Webstat->newEmptyEntity();
        if ($this->request->is('post')) {
            $webstat = $this->Webstat->patchEntity($webstat, $this->request->getData());
            if ($this->Webstat->save($webstat)) {
                $this->Flash->success(__('The webstat has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The webstat could not be saved. Please, try again.'));
        }
        $this->set(compact('webstat'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Webstat id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $webstat = $this->Webstat->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $webstat = $this->Webstat->patchEntity($webstat, $this->request->getData());
            if ($this->Webstat->save($webstat)) {
                $this->Flash->success(__('The webstat has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The webstat could not be saved. Please, try again.'));
        }
        $this->set(compact('webstat'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Webstat id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $webstat = $this->Webstat->get($id);
        if ($this->Webstat->delete($webstat)) {
            $this->Flash->success(__('The webstat has been deleted.'));
        } else {
            $this->Flash->error(__('The webstat could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
