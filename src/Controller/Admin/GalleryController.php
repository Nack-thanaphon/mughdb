<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
// import the PhpSpreadsheet Class
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PHPUnit\TextUI\XmlConfiguration\Group;

/**
 * Gallery Controller
 *
 * @property \App\Model\Table\GalleryTable $Gallery
 * @method \App\Model\Entity\Gallery[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class GalleryController extends AppController
{

    public function index()
    {
        $countImgActive = $this->Custom->countImgActive();
        $countImgUnActive = $this->Custom->countImgUnActive();
        $countImg = $this->Custom->countImg();

        if (empty($this->passedArgs)) {
            $this->passedArgs = $this->request->getQuery();
        }
        if (empty($data)) {
            $data = $this->passedArgs;
        }


        $conditions = [];

        if (!empty($data)) {
            if (!empty($data['g_name'])) {
                $gname = $data['g_name'];
                $conditions[] = [
                    'and' => [
                        "Gallery.name LIKE" => "%" . $gname . "%",
                    ],
                ];
            }
        }



        $Gallery = $this->paginate(
            $this->Gallery->find()
                ->select([
                    'id' => 'Gallery.id',
                    'name' => 'Gallery.name',
                    'detail' => 'Gallery.detail',
                    'user' => 'U.name',
                    'img' => 'Img.name',
                    'status' => 'Gallery.status',
                    'created' => 'Gallery.created'
                ])
                ->join([
                    'Img' => ([
                        'table' => 'image',
                        'type' => 'LEFT',
                        'conditions' => 'Img.gallery_id = Gallery.id'
                    ]),
                    'U' => ([
                        'table' => 'users',
                        'type' => 'LEFT',
                        'conditions' => 'U.id = Gallery.user_id'
                    ])
                ])->where([
                    $conditions
                ])
                ->group([
                    'Gallery.id'
                ]),
            // $this->Consumables->find()
            // ->where([
            //     $conditions,
            // ])->offset($offset)
            // ->limit(10),
            ['limit' => 10, 'maxLimit' => 10]
        );
        // $Gallery = $this->Gallery->find()
        //     ->select([
        //         'id' => 'Gallery.id',
        //         'name' => 'Gallery.name',
        //         'detail' => 'Gallery.detail',
        //         'user' => 'U.name',
        //         'img' => 'Img.name',
        //         'status' => 'Gallery.status',
        //         'created' => 'Gallery.created'
        //     ])
        //     ->join([
        //         'Img' => ([
        //             'table' => 'image',
        //             'type' => 'LEFT',
        //             'conditions' => 'Img.gallery_id = Gallery.id'
        //         ]),
        //         'U' => ([
        //             'table' => 'users',
        //             'type' => 'LEFT',
        //             'conditions' => 'U.id = Gallery.user_id'
        //         ])
        //     ])
        //     ->group([
        //         'Gallery.id'
        //     ])
        //     ->toArray();


        // pr($Gallery);die;

        $this->set(compact('Gallery', 'countImgActive', 'countImgUnActive', 'countImg'));
    }

    public function view()
    {
        $id = $this->request->getData('id');
        $DataGallery = $this->Gallery->find()
            ->select([
                'id' => 'Gallery.id',
                'name' => 'Gallery.name',
                'detail' => 'Gallery.detail',
                'user' => 'U.name',
                'status' => 'Gallery.status',
                'created' => 'Gallery.created'
            ])
            ->join([
                'U' => ([
                    'table' => 'users',
                    'type' => 'LEFT',
                    'conditions' => 'U.id = Gallery.user_id'
                ])
            ])
            ->where([
                'Gallery.id' => $id
            ])->first();

        $imgData = $this->getDataImg('gallery_id', $DataGallery->id);

        $this->set(compact('DataGallery', 'imgData'));
        $this->set('_serialize', ['DataGallery', 'imgData']);
    }

    public function getGallerydata()
    {

        $DataGallery = $this->Gallery->find('all')->toArray();

        $this->set('DataGallery', $DataGallery);
        $this->set('_serialize', ['DataGallery']);
    }



    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $ImageTable = TableRegistry::getTableLocator()->get('Image');
        $GalleryTable = TableRegistry::getTableLocator()->get('Gallery');

        $GalleryData =  $GalleryTable->newEmptyEntity();

        if ($this->request->is("post")) {
            $GalleryData = $GalleryTable->patchEntity($GalleryData, array(
                "name" => $this->request->getData('name'),
                "detail" => $this->request->getData('detail'),
                "date" => $this->request->getData('date'),
                "user_id" => $this->getUsersId(),
                "status" => $this->request->getData('status'),
            ));
            if ($GalleryTable->save($GalleryData)) {
                $Galleryid = $GalleryData->id;
                $GalleryDataImage = $this->request->getData("images");

                if (!empty($GalleryDataImage)) {
                    if (count($GalleryDataImage)) {
                        foreach ($GalleryDataImage as $key => $imageFile) {
                            $fileName = $GalleryDataImage[$key]->getClientFilename();
                            $fileType = $GalleryDataImage[$key]->getClientMediaType();
                            if ($fileType == "image/webp" || $fileType == "image/png" || $fileType == "image/jpeg" || $fileType == "image/jpg") {
                                $imagePath = WWW_ROOT . "img/gallery/" . DS . $fileName;
                                $GalleryDataImage[$key]->moveTo($imagePath);
                                $data["name"] = "img/gallery/" . $fileName;
                                $imageData = $ImageTable->newEmptyEntity();
                                $imageData = $ImageTable->patchEntity($imageData, array(
                                    "gallery_id" => $Galleryid,
                                    "name" => $data["name"],
                                    "cover" => 0,
                                    "status" => 1,
                                ));
                                $ImageTable->save($imageData);
                            }
                        }
                    }
                }
            }
            if (!empty($this->request->getData("imagecover"))) {
                $this->CoverImage($Galleryid, $this->request->getData("imagecover"));
            } else {
                $this->Flash->error(__('ไม่สามารถบันทึกได้'));
            };
        }

        $this->set(compact("GalleryData"));
    }

    public function CoverImage($id = null, $filename = null)
    {
        $ImageTable = TableRegistry::getTableLocator()->get('Image');
        $imageData = $ImageTable->newEmptyEntity();
        $imagecover = $filename;
        $fileName = $imagecover->getClientFilename();
        $fileType = $imagecover->getClientMediaType();
        if ($fileType == "image/webp" || $fileType == "image/png" || $fileType == "image/jpeg" || $fileType == "image/jpg") {
            $imagePath = WWW_ROOT . "img/gallery/" . DS . $fileName;
            $imagecover->moveTo($imagePath);
            $coverimage = "img/gallery/" . $fileName;
            $imageData = $ImageTable->newEmptyEntity();
            $imageData = $ImageTable->patchEntity($imageData, array(
                "gallery_id" => $id,
                "name" => $coverimage,
                "cover" => 1,
                "status" => 1,
            ));
            $ImageTable->save($imageData);
        }

        $this->Flash->success(__('บันทึกเรียบร้อย'));
        return $this->redirect(['controller' => 'Gallery', 'action' => 'index']);
    }


    public function getGalleryImg()
    {

        $this->request->allowMethod(['post', 'delete']);
        $id = $this->request->getData('id');

        $imgData =   $this->Gallery->find()
            ->select([
                'id' => 'd.id',
                'name' => 'd.name',
                'cover' => 'd.cover',
            ])
            ->join([
                'd' => [
                    'table' => 'image',
                    'type' => 'INNER',
                    'conditions' => 'd.gallery_id = Gallery.id',
                ]
            ])
            ->where([
                'd.gallery_id' => $id
            ])
            ->toArray();

        $imgID = [];
        $img = [];
        $coverImg = [];
        $postsEdit = [];
        foreach ($imgData as  $data) {
            if ($data['cover'] == 1) {
                $coverImg[] =  [
                    'id' => $data['id'],
                    'name' => $data['name']
                ];
            }
            if ($data['cover'] == 0) {
                $img[] = [
                    'id' => $data['id'],
                    'name' => $data['name']
                ];
            }
        }
        $postsEdit = [
            'id' => $imgID,
            'img' => $img,
            'cover' =>  $coverImg,
        ];
        echo json_encode($postsEdit);
        die;
    }



    public function edit($id = null)
    {

        $gallery = $this->Gallery->get($id, array([
            'contain' => []
        ]));

        $coverimage = [];
        $images = [];

        $imgData =   $this->Gallery->find()
            ->select([
                'id' => 'd.id',
                'name' => 'd.name',
                'cover' => 'd.cover',
            ])
            ->join([
                'd' => [
                    'table' => 'image',
                    'type' => 'INNER',
                    'conditions' => 'd.gallery_id = Gallery.id',
                ]
            ])
            ->where([
                'd.gallery_id' => $id
            ])
            ->toArray();



        $imgID = [];
        $img = [];
        $coverImg = [];
        $galleryData = [];

        foreach ($imgData as  $data) {

            if ($data['cover'] == 1) {
                $coverImg[] =  [
                    'id' => $data['id'],
                    'name' => $data['name']
                ];
            }
            if ($data['cover'] == 0) {
                $img[] = [
                    'id' => $data['id'],
                    'name' => $data['name']
                ];
            }
        }
        $galleryData = [
            'id' => $imgID,
            'img' => $img,
            'cover' =>  $coverImg,
        ];
        if ($this->request->is(['patch', 'post', 'put'])) {
            $gallery = $this->Gallery->patchEntity($gallery, $this->request->getData());

            if ($this->Gallery->save($gallery)) {
                $this->Flash->success(__('The post has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The post could not be saved. Please, try again.'));
        }


        $this->set(compact('gallery', 'galleryData', 'coverimage', 'images'));
    }


    public function delete()
    {
        $this->request->allowMethod(['post', 'delete']);

        $id = $this->request->getData('id');
        $event = $this->Events->get($id);
        if ($this->Events->delete($event)) {
            $this->Flash->success(__('The event has been deleted.'));
        } else {
            $this->Flash->error(__('The event could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
