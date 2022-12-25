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
 * Newsletter Controller
 *
 * @property \App\Model\Table\NewsletterTable $Newsletter
 * @method \App\Model\Entity\Newsletter[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class NewsletterController extends AppController
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
            'order' => ['Newsletter.id' => 'desc']
        ];
        $Newsletter = $this->paginate($this->Newsletter);
        $countNewsDownload = $this->Custom->countNewsDownload();
        $countNewsActive = $this->Custom->countNewsActive();
        $countNewsUnActive = $this->Custom->countNewsUnActive();

        $this->set(compact(
            'Newsletter',
            'countNewsDownload',
            'countNewsActive',
            'countNewsUnActive'
        ));
    }

    /**
     * View method
     *
     * @param string|null $id Newsletter id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {
        $id = $this->request->getData('id');
        $Newsletter = $this->Newsletter->get($id, [
            'contain' => [],
        ]);
        $this->set('Newsletter', $Newsletter);
        $this->set('_serialize', ['Newsletter']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $Newsletter = $this->Newsletter->newEmptyEntity();

        if ($this->request->is('post')) {
            $Newsletter = $this->Newsletter->patchEntity($Newsletter, $this->request->getData());
            $Newsletterfile = $this->request->getData("file");
            $fileName = $Newsletterfile->getClientFilename();
            $fileType = $Newsletterfile->getClientMediaType();

            $NewsletterfileData = '';

            $FilePath = WWW_ROOT . "document/newsletter/" . DS . $fileName;
            $Newsletterfile->moveTo($FilePath);
            $NewsletterfileData = "document/newsletter/" . $fileName;

            $Newsletter->file = $NewsletterfileData;
            $Newsletter->user_id = $this->getUsersId();
            $Newsletter->download = 0;


            if ($this->Newsletter->save($Newsletter)) {
                $this->Flash->success(__('The Newsletter has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The Newsletter could not be saved. Please, try again.'));
        }
        $users = $this->Newsletter->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('Newsletter'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Newsletter id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $Newsletter = $this->Newsletter->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $Newsletter = $this->Newsletter->patchEntity($Newsletter, $this->request->getData());
            $Newsletterfile = $this->request->getData("file");
            $NewsletterfileOld = $this->request->getData("fileOld");
            if ($Newsletterfile->getError() == 0){
                $fileName = $Newsletterfile->getClientFilename();
                $fileType = $Newsletterfile->getClientMediaType();

                $NewsletterfileData = '';

                $FilePath = WWW_ROOT . "document/newsletter/" . DS . $fileName;
                $Newsletterfile->moveTo($FilePath);
                $NewsletterfileData = "document/newsletter/" . $fileName;

                $Newsletter->file = $NewsletterfileData;

                if ($this->Newsletter->save($Newsletter)) {
                    $this->Flash->success(__('The Newsletter has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The Newsletter could not be saved. Please, try again.'));
            } else {

                $Newsletter->file = $NewsletterfileOld;
                if ($this->Newsletter->save($Newsletter)) {
                    $this->Flash->success(__('The Newsletter has been saved.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('The Newsletter could not be saved. Please, try again.'));
                }
            }
        }
        $users = $this->Newsletter->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('Newsletter', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Newsletter id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete()
    {
        $this->request->allowMethod(['post', 'delete']);
        $id = $this->request->getData('id');
        $Newsletter = $this->Newsletter->get($id);
        if ($this->Newsletter->delete($Newsletter)) {
            $this->Flash->success(__('The Newsletter has been deleted.'));
        } else {
            $this->Flash->error(__('The Newsletter could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
