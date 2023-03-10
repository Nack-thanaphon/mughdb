<?php $this->assign('title', 'ข่าวสาร'); ?>

<div class="container-fluid">
    <div class="row m-2  my-2 h-100 ">
        <div class="col-sm-12  col-12 p-0 p-sm-1 m-0">
            <div class="d-flex justify-content-between py-2 my-auto">
                <div>
                    <small class="text-muted">Article & News Management Systems </small>
                    <h3 class="m-0 p-0">ระบบจัดการข่าวสารเว็บไซต์</h3>
                </div>
                <a href="/" class="m-0 p-0  text-reset my-auto">
                    <h3 class="fas fa-arrow-alt-circle-left my-auto"></h3>
                </a>
            </div>
            <div class="row m-0 p-0  my-3">
                <div class="col-12 col-sm-4 m-0 p-0">
                    <div class="m-1 py-4 p-2 card bg-success">
                        <h5 class="m-0 p-0 ">ข่าวสารทั้งหมด</h5>
                        <h6 class="text-right m-0 p-0 font-weight-bold">
                            <?= ($this->Custom->countPost() ? $this->Custom->countPost() : 0); ?>
                            <span><small>/ รายการ</small></span>
                        </h6>
                    </div>
                </div>
                <div class="col-12 col-sm-4 m-0 p-0">
                    <div class="m-1 py-4 p-2 card bg-primary">
                        <h5 class="m-0 p-0 ">ประเภทข่าวสารทั้งหมด</h5>
                        <h6 class="text-right m-0 p-0 font-weight-bold">
                            <?= ($this->Custom->countPostType() ? $this->Custom->countPostType() : 0); ?>
                            <span><small>/ ประเภท</small></span>
                        </h6>
                    </div>
                </div>
                <div class="col-12 col-sm-4 m-0 p-0">
                    <div class="m-1 py-4 p-2 card shadow-sm ">
                        <h5 class="m-0 p-0 ">ยอดเข้าชมทั้งหมด</h5>
                        <h6 class="text-right m-0 p-0 font-weight-bold">
                            <?= $countPostsViews[0]['views'] ?>
                            <span><small>/ ครั้ง</small></span>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12  col-12 p-0 p-sm-1 m-0 ">
            <div class="card  p-2 table-responsive-lg">
                <div class="col-12  d-sm-flex justify-content-end mb-2 m-0 p-0">
                    <div class="">
                        <a href="<?= $this->Url->build(['controller' => 'Posts', 'action' => 'add']) ?>" class="btn btn-primary m-1"><i class="fas fa-plus-circle"></i> เพิ่มข่าวสาร</a>
                    </div>
                </div>

                <table id="example" class="table table-responsive-lg display-nowrap" style="width:100%">


                    <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>รูปภาพปก</th>
                            <th data-priority="1">รายละเอียด</th>
                            <th>สถานะ</th>
                            <th>จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($post as $key => $posts) : ?>

                            <tr class="shadow-sm">
                                <td width="10"><?= $key + 1 ?></td>
                                <td class="w-60" style="width: 250px; overflow: hidden;height:150px ;">
                                    <a data-fslightbox href="<?php echo $this->Url->build($posts->image, ['fullBase' => true]); ?>">
                                        <img class="w-100" style="object-fit:contain;" src="<?php echo $this->Url->build($posts->image, ['fullBase' => true]); ?>">
                                    </a>

                                </td>
                                <td class="w-30">
                                    <h5 class="m-0 p-0 "><?= $posts->title ?></a></p>
                                        <small class="m-0 p-0 text-muted"><?= $posts->date ?></small><br>
                                        <small class="m-0 p-0 text-muted"> <?= $posts->user ?></small>
                                </td>
                                <td class="w-10">
                                    <?= ($posts->status == 1 ? '<small class="badge badge-primary">เผยแพร่</small>' : '<small class="badge badge-danger">ไม่เผยแพร่</small>') ?>
                                </td>
                                <td class="actions w-30">
                                    <a href="<?= $this->Url->build(['controller' => 'posts', 'action' => 'edit', $posts->id]) ?>" type="button" class=" p-1 text-muted"><i class="fa-solid fa-pen-to-square"></i> </a>
                                    <a href="<?= $this->Url->build(['controller' => 'posts', 'action' => 'view', $posts->id]) ?>" class="p-1 text-primary"><i class="fas fa-circle-info"></i> </a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>