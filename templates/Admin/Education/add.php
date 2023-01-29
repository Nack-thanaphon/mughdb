<div class="row my-3 m-2">
    <div class="col-12 d-flex justify-content-between mb-3">
        <div>
            <small class="text-muted">Insert Education Systems </small>
            <h3 class="m-0 p-0">เพิ่มหลักสูตร</h3>
        </div>
        <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="m-0 p-0  text-reset my-auto">
            <h3 class="fas fa-arrow-alt-circle-left my-auto"></h3>
        </a>
    </div>
    <div class="col-12 col-md-12 col-lg-12 card p-2">
        <?= $this->Form->create($education, ["enctype" => "multipart/form-data"]); ?>
        <div class="row p-2 ">
            <div class="col-12 col-sm-4  mb-2">
                <label for="floatingemail" class="text-muted">รหัสและชื่อรายวิชา </label>
                <?= $this->Form->input('code', ['class' => 'form-control ', 'placeholder' => 'รหัสและชื่อรายวิชา']); ?>
            </div>
            <div class="col-12 col-sm-8  mb-2">
                <label for="floatingemail" class="text-muted">หัวข้อหลักสูตร </label>
                <?= $this->Form->input('title', ['class' => 'form-control ', 'placeholder' => 'หัวข้อหลักสูตร']); ?>
            </div>
            <div class="col-12 col-sm-6 m-0 mb-3">
                <div class="form-floating mb-2">
                    <label for="floatingemail" class="text-muted">ระดับ </label>
                    <select class="form-control" name="level">
                    <option disabled selected>กรุณาเลือกระดับการศึกษา</option>
                        <option value="ปริญญาตรี">ปริญญาตรี</option>
                        <option value="ปริญญาโท">ปริญญาโท</option>
                        <option value="ปริญญาเอก">ปริญญาเอก</option>
                    </select>
                </div>
            </div>
            <div class="col-12 col-sm-4 m-0 mb-3">
                <div class="form-floating mb-2 m-0 p-0">
                    <label for="floatingemail" class="text-muted">ประเภทของรายวิชา </label>
                    <select class="form-control" name="type">
                        <option disabled selected>กรุณาเลือกประเภทของรายวิชา</option>
                        <option value="รายวิชาเฉพาะ">รายวิชาเฉพาะ</option>
                        <option value="รายวิชาเลือกเสรี">รายวิชาเลือกเสรี</option>
                    </select>
                </div>
            </div>
            <div class="col-12 col-sm-2 m-0 mb-3">
                <div class="form-floating mb-2 m-0 p-0">
                    <label for="floatingemail" class="text-muted">จำนวนหน่วยกิต </label>
                    <select class="form-control" name="score">
                        <option disabled selected>กรุณาเลือกหน่วยกิต</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
            </div>
            <div class="col-12 m-0 ">
                <div class="form-floating mb-2">
                    <label for="floatingemail" class="text-muted">รายละเอียดแบบย่อ </label>
                    <textarea class="form-control" rows="9" name="description" placeholder="รายละเอียด"></textarea>
                </div>
            </div>

            <div class="col-sm-6 col-12 m-0 ">
                <div class="form-floating mb-2">
                    <label for="floatingemail" class="text-muted">จุดมุ่งหมาย </label>
                    <?= $this->Form->input('objective', ['class' => 'form-control ', 'placeholder' => 'จุดมุ่งหมาย']); ?>
                </div>
            </div>
            <div class="col-sm-6 col-12 m-0 ">
                <div class="form-floating mb-2">
                    <label for="floatingemail" class="text-muted">วัตถุประสงค์ </label>
                    <?= $this->Form->input('goal', ['class' => 'form-control ', 'placeholder' => 'วัตถุประสงค์']); ?>
                </div>
            </div>

            <div class="col-12 m-0 ">
                <div class="form-floating mb-2">
                    <label for="floatingemail" class="text-muted">รายละเอียด</label>
                    <textarea class="form-control" rows="15" name="detail" placeholder="รายละเอียด"></textarea>
                </div>
            </div>
            <div class="col-sm-6 col-12 m-0 ">
                <div class="form-floating mb-2">
                    <label for="floatingemail" class="text-muted">ผู้จัดทำ </label>
                    <textarea class="form-control" rows="12" name="credit" placeholder="รายละเอียด"></textarea>
                </div>
            </div>
            <div class="col-sm-6 col-12 m-0 ">
                <div class="form-floating mb-2">
                    <label for="floatingemail" class="text-muted">เอกสารประกอบ </label>
                    <input type="file" name="file" class="form-control">
                    <input type="hidden" name="fileOld" class="form-control">
                </div>
                <div class="form-floating mb-2">
                    <label for="floatingemail" class="text-muted">ลิงค์ </label>
                    <?= $this->Form->input('link', ['class' => 'form-control ', 'placeholder' => 'ลิงค์อื่นๆ']); ?>
                </div>
                <div class="form-floating mb-2">
                    <label for="floatingemail" class="text-muted">เว็บไซต์ </label>
                    <?= $this->Form->input('website', ['class' => 'form-control ', 'placeholder' => 'เว็บไซต์']); ?>
                </div>
                <div class="form-floating mb-2">
                    <label>วันที่แก้ไขหลักสูตร</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar"></i></span>
                        </div>
                        <input type="text" name="updated" class="form-control addnew" value="">
                    </div>
                </div>
            </div>

            <div class="col-12 form-floating  mb-2">
                <label for="floatingemail" class="text-muted">สถานะการใช้งาน</label>
                <div class="form-check">
                    <input class="form-check-input " type="radio" name="status" value='1' checked>
                    <label class="form-check-label " for="flexRadioDefault1">
                        เปิดการใช้งาน
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" value='0'>
                    <label class="form-check-label text-muted" for="flexRadioDefault2">
                        ปิดการใช้งาน
                    </label>
                </div>
            </div>
            <?= $this->Form->button(__('บันทึกข้อมูล'), ['class' => 'btn btn-primary w-100 mt-2 m-0']) ?>
            <?= $this->Form->end() ?>
        </div>

    </div>

</div>



<script>
    $(document).ready(function() {
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#EducationImgPreviews').attr('src', e.target.result);
                    $('#EducationImgPreviews').attr('hidden', false);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#EducationImg").change(function() {
            readURL(this);
        });
    })
    $(function() {
        $(".addnew").datepicker({
            todayHighlight: true, // to highlight the today's date
            format: 'dd-MM-yyyy',
            autoclose: true,
            todayHighlight: true
        }).datepicker('update', new Date());
    });
</script>