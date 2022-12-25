<div class="row my-3 m-2">
    <div class="col-12 d-flex justify-content-between mb-3">
        <div>
            <small class="text-muted">Insert Newsletter Systems </small>
            <h3 class="m-0 p-0"><i class="fas fa-plus-circle"></i> เพิ่มจดหมายข่าว</h3>
        </div>
        <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="m-0 p-0  text-reset my-auto">
            <h3 class="fas fa-arrow-alt-circle-left my-auto"></h3>
        </a>
    </div>

    <div class="col-12 col-md-12 col-lg-12 card">
        <div class="row p-3 ">

            <div class="form-group col-12 col-sm-12 my-auto ">
                <?= $this->Flash->render() ?>
                <?= $this->Form->create($Newsletter, ["enctype" => "multipart/form-data"]); ?>
                <div class="row m-0 p-0">
                    <div class="col-12 col-sm-12 m-0 p-0 mb-2">
                        <label > <i class="fas fa-chevron-circle-up"></i> อัพโหลดเอกสารข่าว</label> <br>
                        <input type="file" name="file" class=" mb-3" id="NewsletterImg">
                    </div>
                    <div class="col-12 col-sm-12 m-0 p-0">
                        <div class="form-floating mb-1">
                            <label>ประจำเดือน</label>
                            <div class="input-group mb-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar"></i></span>
                                </div>
                                <input type="text" name="date" class="form-control addnew" value="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-floating my-3">
                    <label for="floatingemail">หัวข้อจดหมายข่าว</label>
                    <?= $this->Form->input('title', ['class' => 'form-control ', 'placeholder' => 'หัวข้อจดหมายข่าว']); ?>
                </div>
                <div class="form-group mb-3">
                    <label for="exampleFormControlTextarea1">รายละเอียด</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="detail" placeholder="รายละเอียด"></textarea>
                </div>
                <div class="form-floating mb-3">
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
                    $('#NewsletterImgPreviews').attr('src', e.target.result);
                    $('#NewsletterImgPreviews').attr('hidden', false);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#NewsletterImg").change(function() {
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