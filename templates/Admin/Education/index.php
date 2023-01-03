<?php $this->assign('title', 'ระบบจัดการหลักสูตร'); ?>

<div class="container-fluid">
    <div class="row m-2 my-2 h-100 ">
        <div class="col-sm-12  col-12 p-0 p-sm-1 m-0">
            <div class="d-flex justify-content-between py-2 my-auto">
                <div>
                    <small class="text-muted">Education Management Systems </small>
                    <h3 class="m-0 p-0">ระบบจัดการหลักสูตร</h3>
                </div>
                <a href="/" class="m-0 p-0  text-reset my-auto">
                    <h3 class="fas fa-arrow-alt-circle-left my-auto"></h3>
                </a>
            </div>
            <div class="row m-0 p-0 my-3">
                <div class="col-12 col-sm-4 m-0 p-0">
                    <div class="m-1 py-4 p-2 card bg-success">
                        <h5 class="m-0 p-0 ">ยอดดาวน์โหลดทั้งหมด</h5>
                        <h6 class="text-right m-0 p-0 font-weight-bold">
                            <?= ($countEducationDownload[0]['views']) ? $countEducationDownload[0]['views'] : 0; ?>
                            <span><small>/ ครั้ง</small></span>
                        </h6>
                    </div>
                </div>
                <div class="col-12 col-sm-4 m-0 p-0">
                    <div class="m-1 py-4 p-2 card bg-primary">
                        <h5 class="m-0 p-0 ">กำลังใช้งาน</h5>
                        <h6 class="text-right m-0 p-0 font-weight-bold">
                            <?= ($countEducationActive) ? $countEducationActive : 0; ?>
                            <span><small>/ รายการ</small></span>
                        </h6>
                    </div>
                </div>
                <div class="col-12 col-sm-4 m-0 p-0">
                    <div class="m-1 py-4 p-2 card shadow-sm ">
                        <h5 class="m-0 p-0 ">หมดอายุ</h5>
                        <h6 class="text-right m-0 p-0 font-weight-bold">
                            <?= ($countEducationUnActive) ? $countEducationUnActive : 0; ?>
                            <span><small>/ รายการ</small></span>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12  col-12 p-0 p-sm-1 m-0 ">
            <div class="card  p-2 table-responsive-lg">
                <?= $this->Flash->render() ?>
                <div class="col-12  d-sm-flex justify-content-end mb-2 m-0 p-0">

                    <div class="btn-group" role="group" aria-label="Basic example">
                        <!-- <button type="button" class="btn btn-secondary">Left</button> -->
                        <button type="button" data-toggle="modal" data-target="#SubData" class="btn btn-secondary">ระดับการศึกษา</button>
                        <a type="button" href="<?= $this->Url->build(['controller' => 'Education', 'action' => 'add']) ?>" class="btn btn-primary"><i class="fas fa-plus-circle"></i> เพิ่มหลักสูตร</a>
                    </div>

                </div>
                <table id="example" class="table table-hover row-border display dt-responsive nowrap" style="width:100%">

                    <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>รหัสและชื่อรายวิชา</th>
                            <th>หัวข้อ</th>
                            <th>ระดับ</th>
                            <th>สถานะ</th>
                            <th>จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($education as $key => $data) : ?>
                            <tr class="shadow-sm">
                                <td width="10"><?= $key + 1 ?></td>
                                <td width="10">
                                    <h2 class="m-0 p-0 text-center text-primary"><?= $data->code ?></a></h2>
                                </td>
                                <td width="40">
                                    <h5 class="m-0 p-0 "><?= $data->title ?></a></h5>
                                    <small class="m-0 p-0 text-muted"><?= $data->created ?></small><br>
                                    <small class="m-0 p-0 text-muted"> <?= $data->user['name'] ?></small>
                                </td>
                                <td width="10">
                                    <?= $data->level ?>
                                </td>

                                <td width="10">
                                    <?= ($data->status == 1 ? '<small class="badge badge-primary">เผยแพร่</small>' : '<small class="badge badge-danger">ไม่เผยแพร่</small>') ?>
                                </td>
                                <td width="10">
                                    <a href="<?= $this->Url->build(['controller' => 'Education', 'action' => 'edit', $data->id]) ?>" type="button" class=" p-1 text-muted"><i class="fa-solid fa-pen-to-square"></i> </a>
                                    <a type="button" class="p-1 text-primary" onclick="viewsEducation(<?= $data->id ?>)"><i class="fas fa-circle-info"></i> </a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal" id="SubData" tabindex="-1" role="dialog" aria-labelledby="viewsDataLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="my-auto d-flex">
                    <h5 class=" m-1" id="SubDataLabel">จัดการระดับการศึกษา</h5>
                    <h5 class="fas fa-plus-circle m-1"></h5>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="height: 450px; overflow-y: scroll;">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th class="w-90">ระดับการศึกษา</th>
                            <th class="w-10">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>ปริญญาตรี</td>
                            <td>
                                <div class="d-flex">
                                    <a type="button" class="fas fa-file-pen m-1 text-reset"></a>
                                    <a type="button" class="fa-solid fa-trash m-1 text-reset"></a>
                                </div>
                            </td>

                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal" id="viewsData" tabindex="-1" role="dialog" aria-labelledby="viewsDataLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title" id="viewsDataLabel">
                    <p class="m-0 p-0 text-primary">ข้อมูลหลักสูตร</p>
                    <small class="text-muted">Education Detail</small>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-12" id="PreviewsData">
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function viewsEducation(id) {
        $.LoadingOverlay("show");
        $.ajax({
            url: "<?= $this->Url->build(['action' => 'view']) ?>",
            type: "post",
            dataType: 'json',
            data: {
                id: id
            },
            headers: {
                'X-CSRF-token': $('meta[name="csrfToken"]').attr('content')
            },
            success: function(resp) {
                let data = resp.Education
                console.log(data)
                html = ''
                html += `
                 <div class="row mb-3">
                        <div class="col-12 my-2">
                            <p class="m-0 p-0 text-primary">รหัสและชื่อรายวิชา</p>
                            <h4 class="text-dark text-wrap m-0 p-0">${data['code']}</h4>
                        </div>
                        <div class="col-12 my-2">
                            <p class="m-0 p-0 text-primary">หัวข้อหลักสูตร</p>
                            <h4 class="text-dark text-wrap m-0 p-0">${data['title']}</h4>
                        </div>
                        <div class="col-12">
                            <p class="m-0 p-0 text-primary">รายละเอียด</p>
                            <p class="text-dark">${data['detail']}</p>
                        </div>
                        <div class="col-6">
                            <p class="m-0 p-0 text-primary">ประเภทของรายวิชา :</p>
                            <p class="text-dark">${data['type']}</p>
                        </div>
                        <div class="col-6">
                            <p class="m-0 p-0 text-primary">ระดับ :</p>
                            <p class="text-dark">${data['level']}</p>
                        </div>
                        <div class="col-6">
                            <p class="m-0 p-0 text-primary">จำนวนหน่วยกิต :</p>
                            <p class="text-dark">${data['score']}</p>
                        </div>
                        <div class="col-6">
                            <p class="m-0 p-0 text-primary">จุดมุ่งหมาย :</p>
                            <p class="text-dark">${data['objective']}</p>
                        </div>
                        <div class="col-6">
                            <p class="m-0 p-0 text-primary">ผู้จัดทำ :</p>
                            <p class="text-dark">${data['credit']}</p>
                        </div>
                        <div class="col-6">
                            <p class="m-0 p-0 text-primary">วัตถุประสงค์ :</p>
                            <p class="text-dark">${data['goal']}</p>
                        </div>
                    </div>
                    
                    <p class="m-0 p-0 text-muted">เว็บไซต์ : <a  href="${data['website']?data['website']:'ไม่มีข้อมูล'}">เยี่ยมชมเว็บไซต์</a></p>
                    <p class="m-0 p-0 text-muted">ลิงค์เอกสาร : <a href="<?php echo $this->Url->build('/'); ?>${data['file']}">ดาวน์โหลด</a></p>
                   <div class="mt-2">
                        <p class="m-0 p-0 text-primary">วันที่แก้ไขหลักสูตร :</p>
                        <p class="text-dark ">${data['updated']}</p>
                   </div>
                   
                    `
                $.LoadingOverlay("hide");
                $('#PreviewsData').html(html)
                $('#viewsData').modal('show')
            }
        })
    }
</script>