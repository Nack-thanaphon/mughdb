<?php $this->assign('title', 'ระบบจัดการคลังรูปภาพ'); ?>

<style>
    .fc-toolbar,
    .fc-header-toolbar {
        margin: 0px !important;
        padding: 0px !important;
        text-transform: center !important;
    }

    .fc-day-number {
        color: #000000 !important;
    }

    .fc-event,
    .fc-event-dot {
        background-color: #007bff !important;
        border: none !important;
    }

    .fc-center h2 {
        margin: 20px 0px !important;
        font-size: 1.5rem !important;
    }
</style>
<div class="container-fluid">
    <div class="row m-2 my-2 h-100 ">
        <div class="col-sm-12  col-12 p-0 p-sm-1 m-0">
            <div class="d-flex justify-content-between py-2 my-auto">
                <div>
                    <small class="text-muted">Gallery Management Systems </small>
                    <h3 class="m-0 p-0">ระบบจัดการคลังรูปภาพ</h3>
                </div>
                <a href="/" class="m-0 p-0  text-reset my-auto">
                    <h3 class="fas fa-arrow-alt-circle-left my-auto"></h3>
                </a>
            </div>
        </div>
        <div class="col-sm-8  col-12 my-3 h-100">
            <div class="row m-0 p-0 h-100">
                <div class="col-12 mb-3 h-100">
                    <form>
                        <div class="row mb-4">
                            <div class="form-group col-md-9">
                                <input id="exampleFormControlInput5" name="g_name" type="text" placeholder="ค้นหาอัลบั้มที่คุณต้องการ ?" class="form-control form-control-underlined">
                            </div>
                            <div class="form-group col-md-3">
                                <button type="submit" class="btn btn-primary rounded-pill btn-block shadow-sm">ค้นหา</button>
                            </div>
                        </div>
                    </form>
                </div>

                <?php if ($Gallery) { ?>
                    <?php foreach ($Gallery as $key => $data) : ?>
                        <?php if ($data->img != NULL) { ?>
                            <div class="col-6 col-sm-4 mb-2 ">
                                <a type="button" onclick="viewsImg(<?= $data->id ?>)">
                                    <img style="object-fit:cover; width:100%; height: 100%; " src="<?php echo $this->Url->build($data->img, ['fullBase' => true]); ?>">
                                </a>
                            </div>
                        <?php } else { ?>
                            <div class="col-6 col-sm-4 mb-2 ">
                                <a type="button" onclick="viewsImg(<?= $data->id ?>)">
                                    <img style="object-fit:cover; width:100%; height: 100%;" src="https://archive.org/download/no-photo-available/no-photo-available.png">
                                </a>
                            </div>
                        <?php } ?>
                    <?php endforeach ?>
                <?php } else { ?>
                    <p>ไม่พบข้อมูล</p>
                <?php } ?>
            </div>

            <div id="bigPagination" class="row m-0 p-0 my-3 <?= $Gallery ? '' : 'd-none' ?>">
                <div class="col-12 col-sm-6 mb-2"><?= $this->Paginator->counter(__('แสดง {{page}} - {{pages}} | แสดง {{current}} ข้อมูลทั้งหมด {{count}} ')) ?></div>
                <div class="col-12 col-sm-6 mb-2 d-sm-flex justify-content-end">
                    <ul class='pagination'>
                        <?= $this->Paginator->prev("ก่อนหน้า") ?>
                        <?= $this->Paginator->numbers() ?>
                        <?= $this->Paginator->next("ถัดไป") ?>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-sm-4 d-none d-sm-block col-12 ">
            <div class="row m-0 p-0 my-3">
                <div class="col-6 col-sm-6 m-0 p-0">
                    <div class="m-1 py-4 p-2 card bg-success">
                        <h5 class="m-0 p-0 ">อัลบั้มทั้งหมด</h5>
                        <h6 class="text-right m-0 p-0 font-weight-bold">
                            <?= ($countImg) ? $countImg : 0; ?>
                            <span><small>/ รายการ</small></span>
                        </h6>
                    </div>
                </div>
                <div class="col-6 col-sm-6 m-0 p-0">
                    <div class="m-1 py-4 p-2 card bg-primary">
                        <h5 class="m-0 p-0 ">กำลังใช้งาน</h5>

                        <h6 class="text-right m-0 p-0 font-weight-bold">
                            <?= ($countImgActive) ? $countImgActive : 0; ?>
                            <span><small>/ ครั้ง</small></span>
                        </h6>
                    </div>
                </div>
                <div class="col-12 col-sm-12 m-0 p-0">
                    <div class="m-1 py-4 p-2 card shadow-sm ">
                        <h5 class="m-0 p-0 ">ไม่ใช้งาน</h5>
                        <h6 class="text-right m-0 p-0 font-weight-bold">
                            <?= ($countImgUnActive) ? $countImgUnActive : 0; ?>
                            <span><small>/ รายการ</small></span>
                        </h6>
                    </div>
                </div>
            </div>
            <div class="row m-0 p-0 my-3 m-0 p-0">
                <div class="col-12 m-0 p-0 ">
                    <div class="card  p-2 table-responsive-lg">
                        <div class="col-12  d-sm-flex justify-content-end mb-2 m-0 p-0">
                            <div class="">
                                <a href="<?= $this->Url->build(['controller' => 'Gallery', 'action' => 'add']) ?>" class="btn btn-primary m-1"><i class="fas fa-plus-circle"></i> เพิ่มคลังรูปภาพ</a>
                            </div>
                        </div>
                        <table id="example1" class="table table-responsive-lg display-nowrap" style="width:100%">
                            <thead>
                                <tr>

                                    <th>รายละเอียด</th>
                                    <th>จัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($Gallery as $key => $data) : ?>
                                    <tr class="shadow-sm border-none ">

                                        <td width="100">
                                            <h6 class="text-wrap"><?= $data->name ?></h6>
                                            <small class="m-0 p-0 text-muted"><?= $data->user ?></small> <br>
                                            <small class="m-0 p-0 text-muted"><?= $data->created ?></small>
                                        </td>
                                        <td width="10">
                                            <a href="<?= $this->Url->build(['controller' => 'Gallery', 'action' => 'edit', $data->id]) ?>" type="button" class=" p-1 text-muted"><i class="fa-solid fa-pen-to-square"></i> </a>
                                            <a type="button" class="p-1 text-primary" onclick="viewsImg(<?= $data->id ?>)"><i class="fas fa-circle-info"></i> </a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
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
                    <p class="m-0 p-0 text-primary">ข้อมูลคลังรูปภาพ</p>
                    <small class="text-muted">Gallery Detail</small>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-12 m-0 p-0">

                    </div>
                    <div class="col-12 my-2 m-0 p-0">
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner" id="imgData">

                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-12" id="PreviewsData">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function viewsImg(id) {
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
                let data = resp.DataGallery
                let imageData = resp.imgData


                html = ''
                Imgall = ''

                for (let i = 0; i < imageData.length; i++) {
                    let imgdata2 = imageData[i]['all']
                    for (let x = 0; x < imgdata2.length; x++) {
                        Imgall +=
                            `<div class="carousel-item ${(x == 0) ?'active':''}">
                                <img class="w-100" src="<?php echo $this->Url->build('/', ['fullBase' => true]); ?>${imgdata2[x]['name']}" alt="">
                            </div>
                            `
                    }
                }
                $('#imgData').html(Imgall)

                html += `
                    <div class="col-12 my-2 m-0 p-0">
                        <p class="m-0 p-0 text-primary">หัวข้อคลังรูปภาพ :</p>
                        <h5 class="text-dark text-wrap m-0 pt-2">${data['name']}</h5>
                    </div>
                    <div class="col-12 m-0 p-0">
                        <p class="m-0 p-0 text-primary">รายละเอียด :</p>
                        <p class="text-dark">${data['detail']?data['detail']:'ไม่มีข้อมูล'}</p>
                    </div>
                    <div class="col-12 m-0 p-0">
                        <div class="mt-2 m-0 p-0">
                            <p class="m-0 p-0 text-primary">ผู้ลงข้อมูล :</p>
                            <p class="text-dark ">${data['user']}</p>
                            <p class="m-0 p-0 text-primary">วันที่ลงข้อมูล :</p>
                            <p class="text-dark ">${data['created']}</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                            <a type="button" href="<?php echo $this->Url->build(['controller' => 'gallery', 'action' => 'edit',]); ?>/${data['id']}" target="blank" class="text-reset"><i class="fa-solid fa-circle-arrow-up"></i> อัพเดตข้อมูล</a>
                    </div> 
                    `
                $.LoadingOverlay("hide");
                $('#PreviewsData').html(html)
                $('#viewsData').modal('show')
            }
        })
    }
    $(document).ready(function() {
        var t = $('#example1').DataTable({
            reponsive: true,
            searching: false,
            info: false,
            pageLength: 5,
            lengthMenu: [
                [5, 10, 20, -1],
                [5, 10, 20, ]
            ]
        })
    });
</script>