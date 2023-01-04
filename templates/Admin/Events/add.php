<?php $this->assign('title', 'เพิ่มกิจกรรม'); ?>

<div class="row my-3 m-2">
    <div class="col-12 d-flex justify-content-between mb-3">
        <div>
            <small class="text-muted">Insert Events Systems </small>
            <h3 class=""> เพิ่มกิจกรรม</h3>
        </div>
        <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="m-0 p-0  text-reset my-auto">
            <h3 class="fas fa-arrow-alt-circle-left my-auto"></h3>
        </a>
    </div>

    <div class="col-12 col-md-12 col-lg-12">
        <div class="row m-0 p-3 card">

            <div class="form-group col-12 col-sm-12 my-auto ">
                
                <?= $this->Form->create($event, ["enctype" => "multipart/form-data"]); ?>
                <div class="row m-0 p-0 mb-2">
                    <div class="col-12 col-sm-12 mb-2">
                        <img style="object-fit:cover;height:400px;width: 100%;" id="EventsImgPreviews" class="py-2" src="" hidden>
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
                                    <option value="<?= $data->id ?>"><?= $data->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row m-0 p-0 mb-2">
                    <div class="col-sm-6 col-12 ">
                        <div class="form-floating mb-3">
                            <label for="floatingemail">รายละเอียด</label>
                            <textarea class="form-control" rows="4" name="detail" placeholder="รายละเอียด"></textarea>
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
                                        <input type="text" name="start" class="form-control addnew" value="">
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
                                        <input type="text" name="end" class="form-control addnew" value="">
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
                                        <input type="time" name="time_start" value="00:00:00" class="form-control " value="">
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
                                        <input type="time" name="time_end" value="00:00:00" class="form-control" value="">
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
                        </div>
                        <div class="form-floating mb-3 m-0 p-0">
                            <label for="floatingemail">ภาพหน้าปกกิจกรรม</label>
                            <input type="file" name="imgcover" id="imgcover" class="form-control">
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

        $(".addnew").datepicker({
            todayHighlight: true, // to highlight the today's date
            format: 'dd-m-yyyy',
            autoclose: true,
        }).datepicker('update', new Date());
    })
</script>