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
 * Gallery Controller
 *
 * @property \App\Model\Table\GalleryTable $Gallery
 * @method \App\Model\Entity\Gallery[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class GalleryController extends AppController
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
        $gallery = $this->paginate($this->Gallery);

        $this->set(compact('gallery'));
    }

    /**
     * View method
     *
     * @param string|null $id Gallery id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $gallery = $this->Gallery->get($id, [
            'contain' => ['Users'],
        ]);

        $this->set(compact('gallery'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $gallery = $this->Gallery->newEmptyEntity();
        if ($this->request->is('post')) {
            $gallery = $this->Gallery->patchEntity($gallery, $this->request->getData());
            if ($this->Gallery->save($gallery)) {
                $this->Flash->success(__('The gallery has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The gallery could not be saved. Please, try again.'));
        }
        $users = $this->Gallery->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('gallery', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Gallery id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $gallery = $this->Gallery->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $gallery = $this->Gallery->patchEntity($gallery, $this->request->getData());
            if ($this->Gallery->save($gallery)) {
                $this->Flash->success(__('The gallery has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The gallery could not be saved. Please, try again.'));
        }
        $users = $this->Gallery->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('gallery', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Gallery id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $gallery = $this->Gallery->get($id);
        if ($this->Gallery->delete($gallery)) {
            $this->Flash->success(__('The gallery has been deleted.'));
        } else {
            $this->Flash->error(__('The gallery could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
