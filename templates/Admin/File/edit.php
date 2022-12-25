<div class="row my-3 m-2">
    <div class="col-12 d-flex justify-content-between">
        <div>
            <small class="text-muted">Update File Systems </small>
            <h3 class="m-0 p-0">อัพเดตเอกสารภายใน</h3>
        </div>
        <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="m-0 p-0  text-reset my-auto">
            <h3 class="fas fa-arrow-alt-circle-left my-auto"></h3>
        </a>

    </div>

    <div class="col-12 col-md-12 col-lg-12 card">
        <div class="row p-3 ">
            <div class="col-12 d-flex justify-content-end mb-3">
                <h5 class="fas fa-trash-alt my-auto" type="button" onclick="deletePosts(<?= $file->id ?>)"></h5>
            </div>
            <div class="form-group col-12 col-sm-12 my-auto ">
                <?= $this->Flash->render() ?>
                <?= $this->Form->create($file, ["enctype" => "multipart/form-data"]); ?>

                <div class="row m-0 p-0">
                    <div class="col-6 m-0 ">
                        <div class="form-floating my-3">
                            <label for="floatingemail">หัวข้อเอกสาร</label>
                            <?= $this->Form->input('name', ['class' => 'form-control ', 'placeholder' => 'หัวข้อเอกสาร']); ?>
                        </div>
                    </div>
                    <div class="col-6 m-0 ">
                        <div class="form-floating my-3 ">
                            <label for="floatingemail">กลุ่มเอกสาร</label>

                            <select class="form-control" name="filegroup">
                                <?php foreach ($getFileGroup as $data) : ?>
                                    <option value="<?= $data->g_id ?>" <?= ($file->filegroup == $data->g_id) ? 'selected' : '' ?>><?= $data->g_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-12 form-group mb-3">
                    <label for="exampleFormControlTextarea1">รายละเอียด</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="detail" placeholder="รายละเอียด"><?= $file->detail ?></textarea>
                </div>

                <div class="row m-0 p-0">
                    <div class="col-sm-6 col-6 mb-3 m-0 ">
                        <div class="form-floating mb-1">
                            <label for="floatingemail">ลิงค์ (*ถ้ามี)</label>
                            <?= $this->Form->input('link', ['class' => 'form-control ', 'placeholder' => 'ลิงค์อื่นๆ']); ?>
                        </div>
                    </div>
                    <div class="col-sm-6 col-6 mb-3 m-0 ">
                        <div class="form-floating mb-1">
                            <label for="floatingemail">เอกสารประกอบ (*ถ้ามี)</label>
                            <input type="file" name="file" class="form-control">
                            <input type="hidden" name="fileOld" class="form-control" value="<?= $file->file ?>">
                            <small class="text-muted mt-2">ไฟล์ปัจจุบัน : <a href="<?= $this->Url->build($file->file) ?>">ดาวน์โหลด</a></small>
                        </div>
                    </div>
                    <div class="col-sm-12 col-12 mb-3 m-0 ">
                        <div class="form-floating mb-3">
                            <label for="floatingemail">สถานะการใช้งาน</label>
                            <div class="form-check">
                                <input class="form-check-input " type="radio" name="status" value='1' <?= ($file->status == 1) ? 'checked' : ''  ?>>
                                <label class="form-check-label text-success" for="flexRadioDefault1">
                                    เปิดการใช้งาน
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value='0' <?= ($file->status == 0) ? 'checked' : ''  ?>>
                                <label class="form-check-label " for="flexRadioDefault2">
                                    ปิดการใช้งาน
                                </label>
                            </div>

                        </div>
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
                    $('#FileImgPreviews').attr('src', e.target.result);
                    $('#FileImgPreviews').attr('hidden', false);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#FileImg").change(function() {
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
                    url: "<?= $this->Url->build(['controller' => 'File', 'action' => 'delete']) ?>",
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