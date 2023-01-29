<div class="row my-3 m-2">
    <div class="col-12 d-flex justify-content-between mb-2">
        <div>
            <small class="text-muted">Update Education Systems </small>
            <h3 class="m-0 p-0">อัพเดตหลักสูตร</h3>
        </div>
        <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="m-0 p-0  text-reset my-auto">
            <h3 class="fas fa-arrow-alt-circle-left my-auto"></h3>
        </a>

    </div>

    <div class="col-12 col-md-12 col-lg-12 card p-2">
        <?= $this->Form->create($education, ["enctype" => "multipart/form-data"]); ?>
        <div class="row p-2 ">
            <div class="col-12 d-flex justify-content-end mb-2">
                <h5 class="fas fa-trash-alt my-auto" type="button" onclick="deletePosts(<?= $education->id ?>)"></h5>
            </div>
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
                        <option value="ปริญญาตรี" <?= ($education->level == 'ปริญญาตรี') ? 'selected' : '' ?>>ปริญญาตรี</option>
                        <option value="ปริญญาโท" <?= ($education->level == 'ปริญญาโท') ? 'selected' : '' ?>>ปริญญาโท</option>
                        <option value="ปริญญาเอก" <?= ($education->level == 'ปริญญาเอก') ? 'selected' : '' ?>>ปริญญาเอก</option>
                    </select>
                </div>
            </div>
            <div class="col-12 col-sm-4 m-0 mb-3">
                <div class="form-floating mb-2 m-0 p-0">
                    <label for="floatingemail" class="text-muted">ประเภทของรายวิชา </label>
                    <select class="form-control" name="type">
                        <option value="รายวิชาเฉพาะ" <?= ($education->type == 'รายวิชาเฉพาะ') ? 'selected' : '' ?>>รายวิชาเฉพาะ</option>
                        <option value="รายวิชาเลือกเสรี" <?= ($education->type == 'รายวิชาเลือกเสรี') ? 'selected' : '' ?>>รายวิชาเลือกเสรี</option>
                    </select>
                </div>
            </div>
            <div class="col-12 col-sm-2 m-0 mb-3">
                <div class="form-floating mb-2 m-0 p-0">
                    <label for="floatingemail" class="text-muted">จำนวนหน่วยกิต </label>
                    <select class="form-control" name="score">
                        <option value="1" <?= ($education->score == '1') ? 'selected' : '' ?>>1</option>
                        <option value="2" <?= ($education->score == '2') ? 'selected' : '' ?>>2</option>
                        <option value="3" <?= ($education->score == '3') ? 'selected' : '' ?>>3</option>
                        <option value="4" <?= ($education->score == '4') ? 'selected' : '' ?>>4</option>
                        <option value="5" <?= ($education->score == '5') ? 'selected' : '' ?>>5</option>
                    </select>
                </div>
            </div>
            <div class="col-12 m-0 ">
                <div class="form-floating mb-2">
                    <label for="floatingemail" class="text-muted">รายละเอียดแบบย่อ </label>
                    <textarea class="form-control" rows="9" name="description" placeholder="รายละเอียด"><?= $education->description ?></textarea>
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
                    <textarea class="form-control" rows="15" name="detail" placeholder="รายละเอียด"><?= $education->detail ?></textarea>
                </div>
            </div>
            <div class="col-sm-6 col-12 m-0 ">
                <div class="form-floating mb-2">
                    <label for="floatingemail" class="text-muted">ผู้จัดทำ </label>
                    <textarea class="form-control" rows="12" name="credit" placeholder="รายละเอียด"><?= $education->credit ?></textarea>
                </div>
            </div>
            <div class="col-sm-6 col-12 m-0 ">
                <div class="form-floating mb-2">
                    <label for="floatingemail" class="text-muted">เอกสารประกอบ </label>
                    <input type="file" name="file" class="form-control">
                    <input type="hidden" name="fileOld" class="form-control" value="<?= $education->file ?>">
                    <small class="text-muted mt-2">ไฟล์ปัจจุบัน : <?= ($education->file) ? '<a href="' . $this->Url->build($education->file) . '">ดาวน์โหลด</a>' : 'ไม่มีข้อมูล' ?></small>

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
                    <input class="form-check-input " type="radio" name="status" value='1' <?= ($education->status == 1 ? 'checked' : '') ?>>
                    <label class="form-check-label " for="flexRadioDefault1">
                        เปิดการใช้งาน
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" value='0' <?= ($education->status == 0 ? 'checked' : '') ?>>
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

<script>
    $(document).ready(function() {
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#bannerImgPreviews').attr('src', e.target.result);
                    $('#bannerImgPreviews').attr('hidden', false);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#bannerImg").change(function() {
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
                    url: "<?= $this->Url->build(['controller' => 'education', 'action' => 'delete']) ?>",
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