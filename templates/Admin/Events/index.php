<?php $this->assign('title', 'ระบบจัดการกิจกรรม'); ?>

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
                    <small class="text-muted">Events Management Systems </small>
                    <h3 class="m-0 p-0">ระบบจัดการกิจกรรม</h3>
                </div>
                <a href="/" class="m-0 p-0  text-reset my-auto">
                    <h3 class="fas fa-arrow-alt-circle-left my-auto"></h3>
                </a>
            </div>
        </div>
        <div class="col-sm-4  col-12 my-3 m-0 p-0">
            <div class="mr-sm-3">
                <div class="card p-1 w-100 nowarp m-1" id='calendar'></div>
            </div>
        </div>
        <div class="col-sm-8  col-12 -0 p-0 ">
            <div class="row m-0 p-0 my-3">
                <div class="col-12 col-sm-4 m-0 p-0">
                    <div class="m-1 py-4 p-2 card bg-success">
                        <h5 class="m-0 p-0 ">กิจกรรมทั้งหมด</h5>
                        <h6 class="text-right m-0 p-0 font-weight-bold">
                            <?= ($CountEvents) ? $CountEvents : 0; ?>
                            <span><small>/ รายการ</small></span>
                        </h6>
                    </div>
                </div>
                <div class="col-12 col-sm-4 m-0 p-0">
                    <div class="m-1 py-4 p-2 card bg-primary">
                        <h5 class="m-0 p-0 ">กำลังมาถึง</h5>

                        <h6 class="text-right m-0 p-0 font-weight-bold">
                            <?= ($CountActiveEvents) ? $CountActiveEvents : 0; ?>
                            <span><small>/ ครั้ง</small></span>
                        </h6>
                    </div>
                </div>
                <div class="col-12 col-sm-4 m-0 p-0">
                    <div class="m-1 py-4 p-2 card shadow-sm ">
                        <h5 class="m-0 p-0 ">ดำเนินการเสร็จสิ้น</h5>
                        <h6 class="text-right m-0 p-0 font-weight-bold">
                            <?= ($CountUnActiveEvents) ? $CountUnActiveEvents : 0; ?>
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
                                <a href="<?= $this->Url->build(['controller' => 'Events', 'action' => 'add']) ?>" class="btn btn-primary m-1"><i class="fas fa-plus-circle"></i> เพิ่มกิจกรรม</a>
                            </div>
                        </div>
                        <table id="example" class="table table-responsive-lg display-nowrap" style="width:100%">

                            <thead>
                                <tr>
                                    <th>ลำดับ</th>
                                    <th>รายละเอียด</th>
                                    <th>สถานะ</th>
                                    <th>จัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($events as $key => $data) : ?>
                                    <tr class="shadow-sm ">
                                        <td width="10"><?= $key + 1 ?></td>
                                        <td>
                                            <?= ($this->Custom->getDateEndInt($data->end) > 0 ? '<small class="text-primary">กำลังมาถึงอีก ' . $this->Custom->getDateEndInt($data->end) . ' วัน </small>' : '<small class="text-danger">หมดอายุ</small>') ?>
                                            <h6 class="text-wrap"><?= $data->title ?></h6>
                                            <small class="m-0 p-0 text-muted">วันเริ่มต้น : <?= $data->start ?></small><br>
                                            <small class="m-0 p-0 text-muted">วันสิ้นสุด : <?= $data->end ?></small><br>
                                            <small class="m-0 p-0 text-muted"><?= $data->user['name'] ?></small>
                                        </td>
                                        <td>
                                            <?= ($this->Custom->getDateEndStr($data->end) == 'กำลังใช้งาน' ? '<small class="badge badge-primary">กำลังใช้งาน</small>' : '<small class="badge badge-danger">หมดอายุ</small>') ?>
                                        </td>
                                        <td>
                                            <a href="<?= $this->Url->build(['controller' => 'Events', 'action' => 'edit', $data->id]) ?>" type="button" class=" p-1 text-muted"><i class="fa-solid fa-pen-to-square"></i> </a>
                                            <a type="button" class="p-1 text-primary" onclick="viewsEvents(<?= $data->id ?>)"><i class="fas fa-circle-info"></i> </a>
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
                    <p class="m-0 p-0 text-primary">ข้อมูลกิจกรรม</p>
                    <small class="text-muted">Events Detail</small>
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
    function viewsEvents(id) {
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
                let data = resp.Events


                let date = moment(data['created']).format("Do MMMM YYYY, h:mm:ss a");

                html = ''

                html += `
                 <div class="row mb-3">
                        <div class="col-12 my-2 m-0 p-0">
                        <img class="w-100 mb-2" src="<?php echo $this->Url->build('/', ['fullBase' => true]); ?>${data['img']}" alt="">
                            <p class="m-0 p-0 text-primary">ชนิดกิจกรรม :</p>
                            <small class="text-dark text-wrap m-0 p-0">${data['type']}</small>
                        </div>
                        <div class="col-12 my-2 m-0 p-0">
                            <p class="m-0 p-0 text-primary">หัวข้อกิจกรรม  ${resp.ContDateleft > 0 ? '<span class="text-muted">(กำลังมาถึงอีก '+resp.ContDateleft+' วัน)</span>':'<span class="text-danger">(หมดอายุ)</span>'}  :</p>
                            <h5 class="text-dark text-wrap m-0 pt-2">${data['title']}</h5>
                        </div>
                        <div class="col-12 m-0 p-0">
                            <p class="m-0 p-0 text-primary">รายละเอียด :</p>
                            <p class="text-dark">${data['detail']?data['detail']:'ไม่มีข้อมูล'}</p>
                        </div>
                        <div class="col-6 m-0 p-0">
                            <p class="m-0 p-0 text-primary">วันเริ่มต้น :</p>
                            <p class="text-dark">${data['start']?data['start']:'ไม่มีข้อมูล'}</p>
                        </div>
                        <div class="col-6 m-0 p-0">
                            <p class="m-0 p-0 text-primary">วันสิ้นสุด :</p>
                            <p class="text-dark">${data['end']?data['end']:'ไม่มีข้อมูล'}</p>
                        </div>
                        <div class="col-6 m-0 p-0">
                            <p class="m-0 p-0 text-primary">เวลาเริ่มต้น :</p>
                            <p class="text-dark">${data['time_start']?'<i class="fa-solid fa-clock"></i> '+data['time_start']+'':'ไม่มีข้อมูล'}</p>
                        </div>
                        <div class="col-6 m-0 p-0">
                            <p class="m-0 p-0 text-primary">เวลาสิ้นสุด :</p>
                            <p class="text-dark">${data['time_end']?'<i class="fa-solid fa-clock"></i> '+data['time_end']+'':'ไม่มีข้อมูล'}</p>
                        </div>
                   
                    <div class="col-12 m-0 p-0">
                        <hr>
                            <p class="m-0  text-muted">ลิงค์เพิ่มเติม : <a href="${data['link']}">เยี่ยมชมเว็บไซต์</a></p>
                            <p class="m-0  text-muted">ลิงค์เอกสาร : <a href="<?php echo $this->Url->build('/'); ?>${data['file']}">ดาวน์โหลด</a></p>
                        <hr>
                        <div class="mt-2 m-0 p-0">
                            <p class="m-0 p-0 text-primary">ผู้ลงข้อมูล :</p>
                            <p class="text-dark ">${data['user']}</p>
                            <p class="m-0 p-0 text-primary">วันที่ลงข้อมูล :</p>
                            <p class="text-dark ">${date}</p>
                        </div>
                    </div> 
                   </div>
                   `
                $.LoadingOverlay("hide");
                $('#PreviewsData').html(html)
                $('#viewsData').modal('show')
            }
        })
    }
    $(document).ready(function() {

        $.ajax({
            url: "<?= $this->Url->build(['action' => 'geteventsdata']) ?>",
            method: "post",
            dataType: "json",
            contentType: "application/json",
            headers: {
                'X-CSRF-token': $('meta[name="csrfToken"]').attr('content')
            },
            success: function(response) {
                var calendar = $('#calendar').fullCalendar({
                    header: {
                        left: 'prev,next',
                        center: 'title',
                        right: 'month,agendaWeek,list'
                    },
                    events: response.EventData,
                    nowIndicator: true,
                    scrollTime: '08:00:00',
                    navLinks: true,
                    selectable: true,
                    dateClick: false,
                    eventClick: function(event) {
                        viewsEvents(event.id)
                    },
                });
            }
        });
    });
</script>