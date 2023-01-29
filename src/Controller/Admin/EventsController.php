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
                'link' => 'Events.link',
                'img' => 'Events.imgcover',
                'file' => 'Events.docfile',
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

        $this->set(compact('Events', 'ContDateleft'));
        $this->set('_serialize', ['Events', 'ContDateleft']);
    }

    public function geteventsdata()
    {

        $DataEvents = $this->Events->find('all')->toArray();

        $EventData = [];
        foreach ($DataEvents as $value) {
            /// DateChangeFormat
            $start = $this->DateFormat($value['start']);
            $end = $this->DateFormat($value['end']);


            $EventData[] = array(
                'id' => $value['id'],
                'title' => $value['title'],
                'start' =>  $start,
                'end' =>  $end,
                'time_start' => $value['time_start'],
                'time_end' => $value['time_end'],
            );
        }


        $this->set('EventData', $EventData);
        $this->set('_serialize', ['EventData']);
    }



    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $getEventGroup = $this->Custom->getEventGroup();

        $event = $this->Events->newEmptyEntity();
        if ($this->request->is(['patch', 'post', 'put'])) {

            $docfile = $this->request->getData('docfile');
            $imgcover = $this->request->getData('imgcover');


            $docfileName = $docfile->getClientFilename();
            $imgcoverName = $imgcover->getClientFilename();

            $docfileDataSave = '';
            $imgcoverDataSave = '';

            if ($docfile->getError() == 0) {
                $docfileData = WWW_ROOT . "document/file/" . DS . $docfileName;
                $docfile->moveTo($docfileData);
                $docfileDataSave = "document/file/" . $docfileName;
            }
            if ($imgcover->getError() == 0) {
                $imgcoverData = WWW_ROOT . "img/event/" . DS . $imgcoverName;
                $imgcover->moveTo($imgcoverData);
                $imgcoverDataSave = "img/event/" . $imgcoverName;
            }

            $event = $this->Events->patchEntity($event, $this->request->getData());

            $event->docfile = $docfileDataSave;
            $event->imgcover = $imgcoverDataSave;
            $event->user_id = $this->getUsersId();

            if ($this->Events->save($event)) {
                $this->Flash->success(__('บันทึกข้อมูลสำเร็จ'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('บันทึกข้อมูลไม่สำเร็จ'));
        }

        $users = $this->Events->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('event', 'users', 'getEventGroup'));
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
        $getEventGroup = $this->Custom->getEventGroup();
        $event = $this->Events->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $docfile = $this->request->getData('docfile');
            $imgcover = $this->request->getData('imgcover');
            $docfileOld = $this->request->getData('docfileOld');
            $imgcoverOld = $this->request->getData('imgcoverOld');

            $docfileDataSave = '';
            $imgcoverDataSave = '';

            $docfileName = $docfile->getClientFilename();
            $docfileType = $docfile->getClientMediaType();

            $imgcoverName = $imgcover->getClientFilename();
            $imgcoverType = $imgcover->getClientMediaType();

            if ($docfile->getError() == 0) {
                $docfileData = WWW_ROOT . "document/file/" . DS . $docfileName;
                $docfile->moveTo($docfileData);
                $docfileDataSave = "document/file/" . $docfileName;
            }
            if ($imgcover->getError() == 0) {
                $imgcoverData = WWW_ROOT . "img/event/" . DS . $imgcoverName;
                $imgcover->moveTo($imgcoverData);
                $imgcoverDataSave = "img/event/" . $imgcoverName;
            }

            $event = $this->Events->patchEntity($event, $this->request->getData());

            if (($docfileDataSave) == '') {
                $docfileDataSave = $docfileOld;
            }
            if (($imgcoverDataSave == '')) {
                $imgcoverDataSave = $imgcoverOld;
            }

            // pr($docfileDataSave);
            // pr($imgcoverDataSave);

            $event->docfile = $docfileDataSave;
            $event->imgcover = $imgcoverDataSave;
            $event->user_id = $this->getUsersId();

            // pr($event);
            // die;
            if ($this->Events->save($event)) {
                $this->Flash->success(__('บันทึกข้อมูลสำเร็จ'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('บันทึกข้อมูลไม่สำเร็จ'));
        }
        $users = $this->Events->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('event', 'users', 'getEventGroup'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Event id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete()
    {
        $this->request->allowMethod(['post', 'delete']);

        $id = $this->request->getData('id');
        $event = $this->Events->get($id);
        if ($this->Events->delete($event)) {
            $this->Flash->success(__('ลบข้อมูลสำเร็จ'));
        } else {
            $this->Flash->error(__('ลบข้อมูลไม่สำเร็จ'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
