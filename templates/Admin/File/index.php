<?php $this->assign('title', 'ระบบจัดการเอกสารภายใน'); ?>

<div class="container-fluid">
    <div class="row m-2 my-2 h-100 ">
        <div class="col-sm-12  col-12">
            <div class="d-flex justify-content-between py-2 my-auto">
                <div>
                    <small class="text-muted">File Management Systems </small>
                    <h3 class="m-0 p-0">ระบบจัดการเอกสารภายใน</h3>
                </div>
                <a href="/" class="m-0 p-0  text-reset my-auto">
                    <h3 class="fas fa-arrow-alt-circle-left my-auto"></h3>
                </a>
            </div>
            <div class="row  my-3">
                <div class="col-12 col-sm-4 m-0 p-0">
                    <div class="m-1 py-4 p-2 card bg-success">
                        <h5 class="m-0 p-0 ">เอกสารทั้งหมด</h5>
                        <h6 class="text-right m-0 p-0 font-weight-bold">
                            <?= ($countFile) ? $countFile : 0; ?>
                            <span><small>/ รายการ</small></span>
                        </h6>
                    </div>
                </div>
                <div class="col-12 col-sm-4 m-0 p-0">
                    <div class="m-1 py-4 p-2 card bg-primary">
                        <h5 class="m-0 p-0 ">ยอดดาวน์โหลดทั้งหมด</h5>
                        <h6 class="text-right m-0 p-0 font-weight-bold">
                            <?= (number_format($countFileDownload[0]['views'])) ? number_format($countFileDownload[0]['views']) : 0; ?>
                            <span><small>/ ครั้ง</small></span>
                        </h6>
                    </div>
                </div>
                <div class="col-12 col-sm-4 m-0 p-0">
                    <div class="m-1 py-4 p-2 card shadow-sm ">
                        <h5 class="m-0 p-0 ">กำลังใช้งาน</h5>
                        <h6 class="text-right m-0 p-0 font-weight-bold">
                            <?= ($countFileActive) ? $countFileActive : 0; ?>
                            <span><small>/ รายการ</small></span>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12  col-12 ">
            <div class="card  p-2 table-responsive-lg">
                <div class="col-12  d-sm-flex justify-content-end mb-2 m-0 p-0">

                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" data-toggle="modal" data-target="#SubData" class="btn btn-secondary">ระดับการศึกษา</button>
                        <a type="button" href="<?= $this->Url->build(['controller' => 'File', 'action' => 'add']) ?>" class="btn btn-primary"><i class="fas fa-plus-circle"></i> เพิ่มเอกสารภายใน</a>
                    </div>

                </div>
                <table id="example" class="display responsive nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th>รายละเอียดเอกสาร</th>
                            <th>ยอดดาวน์โหลด</th>
                            <th>สถานะ</th>
                            <th>จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($file as $key => $data) : ?>
                            <tr class="shadow-sm">
                                <td width="10"><?= $key + 1 ?></td>
                                <td width="100">
                                    <h5 class="m-0 p-0 "><?= $data->name ?></a></h5> <small class="m-0 p-0 text-muted">ชนิดเอกสาร : <?= $data->filetype ?></small><br>
                                    <small class="m-0 p-0 text-muted"><?= $data->createdat ?></small><br>
                                    <small class="m-0 p-0 text-muted"> <?= $data->user['name'] ?></small>
                                </td>
                                <td width="10">
                                    <?= number_format($data->download) ?> / ครั้ง
                                </td>

                                <td width="10">
                                    <?= ($data->status == 1 ? '<small class="badge badge-primary">เผยแพร่</small>' : '<small class="badge badge-danger">ไม่เผยแพร่</small>') ?>
                                </td>
                                <td width="10">
                                    <a href="<?= $this->Url->build(['controller' => 'File', 'action' => 'edit', $data->id]) ?>" type="button" class=" p-1 text-muted"><i class="fa-solid fa-pen-to-square"></i> </a>
                                    <a type="button" class="p-1 text-primary" onclick="viewsFile(<?= $data->id ?>)"><i class="fas fa-circle-info"></i> </a>
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
                    <p class="m-0 p-0">ข้อมูลเอกสารภายใน</p>
                    <small class="text-muted">File Detail</small>
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
    $(document).ready(function() {
        var t = $('#example').DataTable({
            responsive: true,
        });

    });

    function viewsFile(id) {
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
                let data = resp.File
     
                html = ''
                html += `
                    <p class="m-0 p-0 text-primary">ชื่อเอกสาร :</p>
                    <p class="text-dark">${data['name']}</p>
                    <p class="m-0 p-0 text-primary">ประเภทเอกสาร :</p>
                    <p class="text-dark">${data['type']}</p>
                    <p class="m-0 p-0 text-primary">รายละเอียด <br>
                        <span class="text-dark">${data['detail']}</span>
                    </p>
                    <br>
                    <p class="m-0 p-0 text-muted">เว็บไซต์ : <a  href="${data['website']?data['website']:'ไม่มีข้อมูล'}">เยี่ยมชมเว็บไซต์</a></p>
                    <p class="m-0 p-0 text-muted">ลิงค์เอกสาร : <a href="<?php echo $this->Url->build('/'); ?>${data['file']}">ดาวน์โหลด</a></p>
                    <hr>
                    <p class="m-0 p-0 text-primary">ผู้อัพโหลด : <span class="text-dark">${data['user']}</span></p>
                    <p class="m-0 p-0 text-primary">วันเดือนปีที่ อัพโหลด : <span class="text-dark">${data['date']}</span></p>
                    
                    `

                $('#PreviewsData').html(html)
                $('#viewsData').modal('show')
            }
        })
    }
</script>