<?php $this->assign('title', 'อัพเดตกิจกรรม'); ?>


<div class="row my-3 m-2">
    <div class="col-12 d-flex justify-content-between mb-3">
        <div>
            <small class="text-muted">Update event Systems </small>
            <h3 class="m-0 p-0">อัพเดตกิจกรรม</h3>
        </div>
        <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="m-0 p-0  text-reset my-auto">
            <h3 class="fas fa-arrow-alt-circle-left my-auto"></h3>
        </a>

    </div>

    <div class="col-12 col-md-12 col-lg-12 ">

        <div class="row p-3 card">
            <div class="col-12 d-flex justify-content-end mb-3">
                <h5 class="fas fa-trash-alt my-auto" type="button" onclick="deletePosts(<?= $event->id ?>)"></h5>
            </div>
            <div class="form-group col-12 col-sm-12 my-auto ">
                
                <?= $this->Form->create($event, ["enctype" => "multipart/form-data"]); ?>
                <div class="row m-0 p-0 mb-2">
                    <div class="col-12 col-sm-12 mb-2">
                        <?php if (!empty($event->imgcover)) { ?>
                            <img style="object-fit:cover; height: 400px;width: 100%;" id="EventsImgPreviews"  class="py-2" src="<?= $this->Url->build($event->imgcover) ?>">
                        <?php } else { ?>
                            <img style="object-fit:cover; height: 400px;width: 100%;" id="EventsImgPreviews" class="py-2" hidden>
                        <?php } ?>
                    </div>
                    <div class="col-12 col-sm-6 ">
                        <div class="form-floating mb-3 m-0 p-0">
                            <label for="floatingemail">หัวข้อกิจกรรม</label>
                            <?= $this->Form->input('title', ['class' => 'form-control ', 'placeholder' => 'หัวข้อกิจกรรม']); ?>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 ">
                        <div class="form-floating mb-3 ">
                            <label for="floatingemail">ประเภทของกิจกรรม </label>
                            <select class="form-control" name="typeid">
                                <?php foreach ($getEventGroup as $data) : ?>
                                    <option value="<?= $data->id ?>" <?= ($event->typeid == $data->id) ? 'selected' : '' ?>><?= $data->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row m-0 p-0 mb-2">
                    <div class="col-sm-6 col-12 ">
                        <div class="form-floating mb-3">
                            <label for="floatingemail">รายละเอียด</label>
                            <textarea class="form-control" rows="4" name="detail" placeholder="รายละเอียด"><?= $event->detail ?></textarea>
                        </div>
                    </div>
                    <div class="col-sm-6 col-12 m-0 p-0 ">
                        <div class="row m-0 p-0">
                            <div class="col-12 col-sm-6">
                                <div class="form-floating mb-1">
                                    <label>วันเริ่มต้น</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar"></i></span>
                                        </div>
                                        <input type="text" name="start" class="form-control editstartdate" value="<?= $event->start ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-floating mb-1">
                                    <label>วันสิ้นสุด</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar"></i></span>
                                        </div>
                                        <input type="text" name="end" class="form-control editenddate" value="<?= $event->end ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row m-0 p-0">
                            <div class="col-12 col-sm-6">
                                <div class="form-floating mb-1">
                                    <label>เวลาเริ่ม</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-clock"></i></span>
                                        </div>
                                        <input type="time" name="time_start" value="<?= $event->time_start ?>" class="form-control " value="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-floating mb-1">
                                    <label>เวลาสิ้นสุด</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-clock"></i></span>
                                        </div>
                                        <input type="time" name="time_end" value="<?= $event->time_end ?>" class="form-control" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row m-0 p-0 mb-2">
                    <div class="col-sm-6 col-12 ">
                        <div class="form-floating mb-3 m-0 p-0">
                            <label for="floatingemail">ลิงค์</label>
                            <?= $this->Form->input('link', ['class' => 'form-control ', 'placeholder' => 'ลิงค์อื่นๆ']); ?>
                        </div>
                        <div class="form-floating mb-3 m-0 p-0">
                            <label for="floatingemail">สถานที่</label>
                            <?= $this->Form->input('address', ['class' => 'form-control ', 'placeholder' => 'ลิงค์อื่นๆ']); ?>
                        </div>
                    </div>
                    <div class="col-sm-6 col-12 ">
                        <div class="form-floating mb-3 m-0 p-0">
                            <label for="floatingemail">เอกสารเพิ่มเติม</label>
                            <input type="file" name="docfile" class="form-control">
                            <input type="hidden" name="docfileOld" value="<?= $event->docfile ?>">
                            <small class="text-muted mt-2">ไฟล์ปัจจุบัน : <?= ($event->docfile) ? '<a href="' . $this->Url->build($event->docfile) . '">ดาวน์โหลด</a>' : 'ไม่มีข้อมูล' ?></small>

                        </div>
                        <div class="form-floating mb-3 m-0 p-0">
                            <label for="floatingemail">ภาพหน้าปกกิจกรรม</label>
                            <input type="file" name="imgcover" id="imgcover" class="form-control">
                            <input type="hidden" name="imgcoverOld" value="<?= $event->imgcover ?>">
                        </div>
                    </div>
                </div>




                <div class="col-12 form-floating  mb-3">
                    <label for="floatingemail">สถานะการใช้งาน</label>
                    <div class="form-check">
                        <input class="form-check-input " type="radio" name="status" value='1' checked>
                        <label class="form-check-label text-success" for="flexRadioDefault1">
                            เปิดการใช้งาน
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" value='0'>
                        <label class="form-check-label " for="flexRadioDefault2">
                            ปิดการใช้งาน
                        </label>
                    </div>
                </div>
                <?= $this->Form->button(__('บันทึกข้อมูล'), ['class' => 'btn btn-primary w-100 mt-2 m-0']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function() {
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#EventsImgPreviews').attr('src', e.target.result);
                    $('#EventsImgPreviews').attr('hidden', false);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imgcover").change(function() {
            readURL(this);
        });

        $(".editstartdate").datepicker({
            todayHighlight: true, // to highlight the today's date
            format: 'dd-m-yyyy',
            autoclose: true,
        });

        $(".editenddate").datepicker({
            todayHighlight: true, // to highlight the today's date
            format: 'dd-m-yyyy',
            autoclose: true,

        });


    })
    function deletePosts(id) {
        Swal.fire({
            title: 'คุณแน่ใจใช่ไหม?',
            text: "คุณต้องการลบข้อมูล " + id + " ใช่ไหม !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ใช่, ลบเลย!',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= $this->Url->build(['action' => 'delete']) ?>",
                    type: "post",
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    headers: {
                        'X-CSRF-token': $('meta[name="csrfToken"]').attr('content')
                    },
                })
                Swal.fire(
                    'ลบเรียบร้อย!',
                    'ดำเนินการเรียบร้อย.',
                    'success'
                )
                window.location = ('<?= $this->Url->build(['action' => 'index']) ?>')
            }
        })
    }
</script>