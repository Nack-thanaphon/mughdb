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

    <div class="col-12 col-md-12 col-lg-12 card">
        <div class="row m-0 p-3">

            <div class="form-group col-12 col-sm-12 my-auto ">
                <?= $this->Flash->render() ?>
                <?= $this->Form->create($education, ["enctype" => "multipart/form-data"]); ?>

                <div class="row m-0 p-0">
                    <div class="col-12 col-sm-6 m-0 ">
                        <div class="col-12 form-floating mb-3 m-0 p-0">
                            <label for="floatingemail">รหัสและชื่อรายวิชา</label>
                            <?= $this->Form->input('code', ['class' => 'form-control ', 'placeholder' => 'รหัสและชื่อรายวิชา']); ?>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 m-0 ">
                        <div class="row m-0 p-0">
                            <div class="col-12 col-sm-6 m-0 p-0 p-sm-1">
                                <div class="form-floating mb-3 m-0 p-0">
                                    <label for="floatingemail">ประเภทของรายวิชา </label>
                                    <select class="form-control" name="type">
                                        <option value="รายวิชาเฉพาะ" selected>รายวิชาเฉพาะ</option>
                                        <option value="รายวิชาเลือกเสรี">รายวิชาเลือกเสรี</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 m-0 p-0 p-sm-1">
                                <div class="form-floating mb-3">
                                    <label for="floatingemail">ระดับ </label>
                                    <select class="form-control" name="level">
                                        <option value="ปริญญาตรี" selected>ปริญญาตรี</option>
                                        <option value="ปริญญาโท">ปริญญาโท</option>
                                        <option value="ปริญญาเอก">ปริญญาเอก</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 m-0 p-0">
                                <label for="floatingemail" class="mr-2 my-auto mb-2">จำนวนหน่วยกิต</label>
                              
                                <div class="form-floating row m-0 p-0 my-auto pt-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="score" id="inlineRadio1" value="1" checked>
                                        <label class="form-check-label text-start text-sm-end" for="inlineRadio1">1</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="score" id="inlineRadio2" value="2">
                                        <label class="form-check-label text-start text-sm-end" for="inlineRadio2">2</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="score" id="inlineRadio3" value="3">
                                        <label class="form-check-label text-start text-sm-end" for="inlineRadio3">3</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="score" id="inlineRadio3" value="4">
                                        <label class="form-check-label text-start text-sm-end" for="inlineRadio3">4</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="score" id="inlineRadio3" value="5">
                                        <label class="form-check-label text-start text-sm-end" for="inlineRadio3">5</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 form-floating my-3">
                    <label for="floatingemail">หัวข้อหลักสูตร</label>
                    <?= $this->Form->input('title', ['class' => 'form-control ', 'placeholder' => 'หัวข้อหลักสูตร']); ?>
                </div>
                <div class="row m-0 p-0 mb-2">
                    <div class="col-sm-6 col-12 m-0 ">
                        <div class="form-floating mb-3">
                            <label for="floatingemail">รายละเอียด</label>
                            <textarea class="form-control" rows="4" name="detail" placeholder="รายละเอียด"></textarea>
                        </div>
                    </div>
                    <div class="col-sm-6 col-12 m-0 ">
                        <div class="form-floating mb-1">
                            <label for="floatingemail">จุดมุ่งหมาย </label>
                            <?= $this->Form->input('objective', ['class' => 'form-control ', 'placeholder' => 'จุดมุ่งหมาย']); ?>
                        </div>
                        <div class="form-floating mb-1">
                            <div class="form-floating mb-1">
                                <label>วันที่แก้ไขหลักสูตร</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar"></i></span>
                                    </div>
                                    <input type="text" name="updated" class="form-control addnew" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row m-0 p-0">
                    <div class="col-sm-6 col-12 m-0 ">
                        <div class="form-floating mb-3">
                            <label for="floatingemail">ผู้จัดทำ </label>
                            <textarea class="form-control" rows="4" name="credit" placeholder="รายละเอียด"></textarea>
                        </div>
                    </div>
                    <div class="col-sm-6 col-12 m-0 ">
                        <div class="form-floating mb-1">
                            <label for="floatingemail">วัตถุประสงค์ </label>
                            <?= $this->Form->input('goal', ['class' => 'form-control ', 'placeholder' => 'วัตถุประสงค์']); ?>
                        </div>
                        <div class="form-floating mb-1">
                            <label for="floatingemail">เว็บไซต์ </label>
                            <?= $this->Form->input('website', ['class' => 'form-control ', 'placeholder' => 'เว็บไซต์']); ?>
                        </div>
                    </div>
                </div>
                <div class="row m-0 p-0">
                    <div class="col-sm-6 col-12 m-0 ">
                        <div class="form-floating mb-1">
                            <label for="floatingemail">รายละเอียดแบบย่อ </label>
                            <textarea class="form-control" rows="4" name="description" placeholder="รายละเอียด"></textarea>
                        </div>
                    </div>
                    <div class="col-sm-6 col-12 m-0 ">
                        <div class="form-floating mb-1">
                            <label for="floatingemail">เอกสารประกอบ </label>
                            <input type="file" name="file" class="form-control">
                        </div>
                        <div class="form-floating mb-1">
                            <label for="floatingemail">ลิงค์ </label>
                            <?= $this->Form->input('link', ['class' => 'form-control ', 'placeholder' => 'ลิงค์อื่นๆ']); ?>
                        </div>
                    </div>
                </div>


                <!--                 
                <div class="row m-0 p-0">
                    <div class="col-12 col-sm-6">
                        <div class="form-floating mb-1">
                            <label>วันเริ่มต้น</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar"></i></span>
                                </div>
                                <input type="text" name="startdate" class="form-control addnew" value="">
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
                                <input type="text" name="enddate" class="form-control addnew" value="">
                            </div>
                        </div>
                    </div>
                </div> -->

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