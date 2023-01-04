<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
/**
 * EventsType Controller
 *
 * @property \App\Model\Table\EventsTypeTable $EventsType
 * @method \App\Model\Entity\EventsType[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EventsTypeController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $eventsType = $this->paginate($this->EventsType);

        $this->set(compact('eventsType'));
    }

    /**
     * View method
     *
     * @param string|null $id Events Type id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $eventsType = $this->EventsType->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('eventsType'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $eventsType = $this->EventsType->newEmptyEntity();
        if ($this->request->is('post')) {
            $eventsType = $this->EventsType->patchEntity($eventsType, $this->request->getData());
            if ($this->EventsType->save($eventsType)) {
                $this->Flash->success(__('บันทึกข้อมูลสำเร็จ'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('บันทึกข้อมูลไม่สำเร็จ'));
        }
        $this->set(compact('eventsType'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Events Type id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $eventsType = $this->EventsType->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $eventsType = $this->EventsType->patchEntity($eventsType, $this->request->getData());
            if ($this->EventsType->save($eventsType)) {
                $this->Flash->success(__('บันทึกข้อมูลสำเร็จ'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('บันทึกข้อมูลไม่สำเร็จ'));
        }
        $this->set(compact('eventsType'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Events Type id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete()
    {
        $this->request->allowMethod(['post', 'delete']);
        $id = $this->request->getData('id');

        $eventsType = $this->EventsType->get($id);
        if ($this->EventsType->delete($eventsType)) {
            $this->Flash->success(__('ลบข้อมูลสำเร็จ'));
        } else {
            $this->Flash->error(__('ลบข้อมูลไม่สำเร็จ'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
