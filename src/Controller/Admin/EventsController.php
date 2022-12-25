<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Events Controller
 *
 * @property \App\Model\Table\EventsTable $Events
 * @method \App\Model\Entity\Event[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EventsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $CountEvents = $this->Custom->CountEvents();
        $CountActiveEvents = $this->Custom->CountActiveEvents();
        $CountUnActiveEvents = $this->Custom->CountUnActiveEvents();
        $this->paginate = [
            'contain' => ['Users'],
        ];
        $events = $this->paginate($this->Events);

        // pr($CountActiveEvents);die;
        $this->set(compact('events', 'CountEvents', 'CountActiveEvents', 'CountUnActiveEvents'));
    }

    /**
     * View method
     *
     * @param string|null $id Event id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {
        $id = $this->request->getData('id');
        $Events = $this->Events->find()
            ->select([
                'title' => 'Events.title',
                'detail' => 'Events.detail',
                'address' => 'Events.address',
                'user' => 'U.name',
                'type' => 'T.name',
                'img' => 'NUll',
                'link' => 'NUll',
                'file' => 'NUll',
                'start' => 'Events.start',
                'end' => 'Events.end',
                'status' => 'Events.status',
                'time_start' => 'Events.time_start',
                'time_end' => 'Events.time_end',
                'created' => 'Events.created_at'
            ])
            ->join([
                'T' => ([
                    'table' => 'events_type',
                    'type' => 'INNER',
                    'conditions' => 'T.id = Events.typeid'
                ]),
                'U' => ([
                    'table' => 'users',
                    'type' => 'INNER',
                    'conditions' => 'U.id = Events.user_id'
                ])
            ])
            ->where([
                'Events.id' => $id
            ])->first();


        $ContDateleft = $this->getDateEndInt($Events['end']);

        $this->set(compact('Events','ContDateleft'));
        $this->set('_serialize', ['Events','ContDateleft']);
    }

    public function geteventsdata()
    {

        $DataEvents = $this->Events->find('all')->toArray();

        $this->set('DataEvents', $DataEvents);
        $this->set('_serialize', ['DataEvents']);
    }



    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $event = $this->Events->newEmptyEntity();
        if ($this->request->is('post')) {
            $event = $this->Events->patchEntity($event, $this->request->getData());
            if ($this->Events->save($event)) {
                $this->Flash->success(__('The event has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The event could not be saved. Please, try again.'));
        }
        $users = $this->Events->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('event', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Event id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {

        $event = $this->Events->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $event = $this->Events->patchEntity($event, $this->request->getData());
            if ($this->Events->save($event)) {
                $this->Flash->success(__('The event has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The event could not be saved. Please, try again.'));
        }
        $users = $this->Events->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('event', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Event id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $event = $this->Events->get($id);
        if ($this->Events->delete($event)) {
            $this->Flash->success(__('The event has been deleted.'));
        } else {
            $this->Flash->error(__('The event could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
