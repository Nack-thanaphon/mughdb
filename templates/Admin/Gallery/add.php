<style>
    label#largeFile:after {
        position: absolute;
        width: 100%;
        max-width: 800px;

    }

    label#largeFile input#file {
        width: 0px;
        height: 0px;
    }
</style>
<?php $this->assign('title', 'เพิ่มอัลบั้มรูปภาพ'); ?>

<div class="row my-3 m-2">
    <div class="col-12 d-flex justify-content-between mb-3">
        <div>
            <small class="text-muted">Insert gallery Systems </small>
            <h3 class="m-0 p-0">เพิ่มอัลบั้มรูปภาพ</h3>
        </div>
        <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="m-0 p-0  text-reset my-auto">
            <h3 class="fas fa-arrow-alt-circle-left my-auto"></h3>
        </a>
    </div>
    <div class="col-12 col-md-12 col-lg-8">
        <div class="card p-3">
            <?= $this->Form->create($GalleryData, ["enctype" => "multipart/form-data"]) ?>
            <div class="form-group">
                <div class="form-floating mb-1">
                    <label>วันเดือนปี</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar"></i></span>
                        </div>
                        <input type="text" name="date" class="form-control" id="addnew" value="">
                    </div>
                </div>
                <div class="form-floating mb-1">
                    <label>หัวข้อ</label>
                    <?= $this->Form->input('name', ['class' => 'form-control ', 'placeholder' => 'ชื่ออัลบั้ม']); ?>
                </div>
                <div class="form-floating mb-1">
                    <label>รายละเอียดอัลบั้มรูปภาพ</label>
                    <textarea name="detail" id="editor1" rows="10" cols="80" required></textarea>
                </div>

                <div class=" row m-0 p-0 ">
                    <div class="col-12 col-sm-12 m-0 p-0">
                        <div class="form-floating mb-1">
                            <label>สถานะอัลบั้มรูปภาพ</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value='1' checked>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    เผยแพร่
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value='0'>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    ไม่เผยแพร่
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-12 col-lg-4">
        <div class="card  p-2">
            <div class="d-flex justify-content-between my-auto m-1">
                <p class="my-2 p-0">รูปภาพปก <br>
                    <span>
                        <small class="text-muted cover-warning">**กรุณาอัพโหลดภาพหน้าปก</small>
                    </span>
                </p>
                <label class="my-2 p-0" for="imagecover"><i class="fas fa-arrow-circle-up"></i></label>
                <input type="file" id="imagecover" name="imagecover" class="d-none">

            </div>
            <div class="row m-0 p-0">
                <div class="col-12  m-0 p-0">
                    <img id="singleimages" class="w-100">
                </div>
            </div>
        </div>
        <div class="card  p-2">
            <div class="d-flex justify-content-between my-auto m-1">
                <p class="my-2 p-0">รูปภาพประกอบ
                    <br>
                    <span>
                        <small class="text-muted img-warning">**กรุณาอัพโหลดภาพ</small>
                    </span>
                </p>
                <label class="my-2 p-0" for="images"><i class="fas fa-arrow-circle-up"></i></label>
                <input type="file" name="images[]" id="images" class="d-none" multiple>
            </div>
            <div class="row m-0 p-0">
                <div class="multiimages">
                </div>
            </div>
        </div>
        <?= $this->Form->button(__('บันทึกข้อมูล'), ['class' => 'btn btn-primary w-100 m-1 saveData', 'disabled' => true]) ?>
        <?= $this->Form->end() ?>
    </div>

</div>

<script>
    CKEDITOR.replace('editor1');
    
    $(function() {
        $('#imagecover').on('change', function() {
            singleimagesPreview(this);
            $('.cover-warning').hide()
            $('.saveData').attr('disabled', false)
        });
        $('#images').on('change', function() {
            multiimagesPreview(this, 'div.multiimages');
            $('.img-warning').hide()
        });
    });
    $(function() {
        $("#addnew").datepicker({
            todayHighlight: true, // to highlight the today's date
            format: 'dd-MM-yyyy',
            autoclose: true,
            todayHighlight: true
        }).datepicker('update', new Date());
    });
</script>