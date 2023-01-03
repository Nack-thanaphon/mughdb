<?php $this->assign('title', 'แก้ไข'); ?>

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



    .image-area {
        width: 100%;
    }

    .image-area img {
        position: relative;
        max-width: 100%;
        height: auto;
    }

    .remove-image {
        position: absolute;
        top: 0px;
        right: 0px;
        padding-right: 5px;
        text-decoration: none;
        -webkit-transition: background 0.5s;
        transition: background 0.5s;
    }
</style>
<?php $this->assign('title', 'อัพเดตอัลบั้มรูปภาพ'); ?>

<div class="row my-3 m-1">
    <div class="col-12 d-flex justify-content-between mb-3">
        <div>
            <small class="text-muted">Update Gallery Systems </small>
            <h3 class="m-0 p-0">อัพเดตอัลบั้มรูปภาพ</h3>
        </div>
        <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="m-0 p-0  text-reset my-auto">
            <h3 class="fas fa-arrow-alt-circle-left my-auto"></h3>
        </a>
    </div>
    <div class="col-12 col-md-12 col-lg-8">
        <div class="card p-3">
            <div class="d-flex justify-content-end py-2 my-auto">
                <h6 class="fas fa-trash-alt my-auto" type="button" onclick="deletePosts(<?= $gallery->id ?>)"></h6>
            </div>
            <input type="hidden" id="pId" value="<?= $gallery->id ?>">
            <?= $this->Form->create($gallery, ["enctype" => "multipart/form-data"]) ?>
            <div class="form-group">
                <div class="form-floating mb-1">
                    <label>วันเดือนปี</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar"></i></span>
                        </div>
                        <input type="text" name="date" class="form-control editnew" value="<?= $gallery->date ?>">
                    </div>
                </div>
                <div class="form-floating mb-1">
                    <label>หัวข้อ</label>
                    <?= $this->Form->input('name', ['class' => 'form-control ', 'placeholder' => 'ชื่ออัลบั้ม']); ?>
                </div>
                <div class="form-floating mb-1">
                    <label>รายละเอียดอัลบั้มรูปภาพ</label>
                    <textarea name="detail" id="editor1" rows="10" cols="80" required><?= $gallery->detail ?></textarea>
                </div>

                <div class=" row m-0 p-0 ">
                    <div class="col-12 col-sm-12 m-0 p-0">
                        <div class="form-floating mb-1">
                            <label>สถานะอัลบั้มรูปภาพ</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value='1' <?= ($gallery->status = 1) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    เผยแพร่
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value='0' <?= ($gallery->status = 0) ? 'checked' : ''; ?>>
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
    <div class="col-12 col-md-12 col-lg-4 m-0">
        <div class="card p-1">
            <div class="d-flex justify-content-between my-auto m-1">
                <p class="my-2 p-0">รูปภาพปก<br>
                    <span>
                        <small class="text-muted cover-warning">**กรุณาอัพโหลดภาพหน้าปก</small>
                    </span>
                </p>
                <label class="my-2 p-0" for="imagecover"><i class="fas fa-arrow-circle-up"></i></label>

                <input type="file" id="imagecover" class="d-none">

            </div>

            <div class="row m-0 p-0">
                <div class="col-12  m-0 p-0" id="getPostsCoverImg">
                </div>
            </div>
        </div>
        <div class="card p-1">
            <div class="d-flex justify-content-between my-auto m-1">
                <p class="my-2 p-0">รูปภาพประกอบ
                    <br>
                    <span>
                        <small class="text-muted img-warning">**กรุณาอัพโหลดภาพ</small>
                    </span>
                </p>
                <label class="my-2 p-0" for="images"><i class="fas fa-arrow-circle-up"></i></label>
                <input type="file" id="images" class="d-none" multiple>

            </div>

            <div class="multiimages row m-0 p-0" id="getPostsImg">

            </div>
        </div>
        <?= $this->Form->button(__('บันทึกข้อมูล'), ['class' => 'btn btn-primary w-100 m-1']) ?>
        <?= $this->Form->end() ?>
    </div>

</div>


<script>
    CKEDITOR.replace('editor1');
    var PostsId = $('#pId').val();
    var CoverId = 0
    GetPostsImg()

    function GetPostsImg() {
        $.ajax({
            url: "<?= $this->Url->build(['action' => 'getGalleryImg']) ?>",
            type: "post",
            data: {
                id: PostsId
            },
            dataType: 'json',
            headers: {
                'X-CSRF-token': $('meta[name="csrfToken"]').attr('content')
            },
            success: function(resp) {
                let CoverImageData = resp.cover
                let ImageData = resp.img
                let CoverImg = ''
                let Img = ''

                for (i = 0; i < CoverImageData.length; i++) {
                    CoverId = CoverImageData[i].id
                    CoverImg += `<img id="singleimages" src="<?php echo $this->Url->build('${CoverImageData[i].name}', ['fullBase' => true]); ?>" class="w-100">`
                }
                for (i = 0; i < ImageData.length; i++) {
                    Img += ` <div class="image-area col-3 m-0 p-0">
                    <img src="<?php echo $this->Url->build('${ImageData[i].name}', ['fullBase' => true]); ?>" class="p-1">
                    <a type="button" class="remove-image" onclick="delete_img(${ImageData[i].id})" style="display: inline;">&#215;</a>
                    </div>`
                }

                $("#getPostsCoverImg").html(CoverImg)
                $("#getPostsImg").html(Img)
            }
        })
    }

    $('#imagecover').on('change', function() {
        var formData = new FormData();
        let id = CoverId
        let gallery_id = PostsId

        formData.append("id", id)
        formData.append("gallery_id", gallery_id)
        formData.append('files', $('input[type=file]')[0].files[0]);

        $.ajax({
            url: "<?= $this->Url->build(['controller' => 'Image', 'action' => 'galleryCoverAdd']) ?>",
            type: 'post',
            data: formData,
            id,
            PostsId,
            contentType: false,
            cache: false,
            processData: false,
            headers: {
                'X-CSRF-token': $('meta[name="csrfToken"]').attr('content')
            },
            success: function(response) {
                toastr["success"]("อัพโหลดสำเร็จ")
                GetPostsImg()
            }
        })
    })

    $('#images').on('change', function() {
        var formData = new FormData();
        let gallery_id = PostsId
        formData.append("gallery_id", gallery_id)
        var totalfiles = document.getElementById('images').files.length;
        for (var index = 0; index < totalfiles; index++) {
            formData.append("files[]", document.getElementById('images').files[index]);
        }

        $.ajax({
            url: "<?= $this->Url->build(['controller' => 'Image', 'action' => 'galleryImageAdd']) ?>",
            type: 'post',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            headers: {
                'X-CSRF-token': $('meta[name="csrfToken"]').attr('content')
            },
            success: function(response) {
                toastr["success"]("อัพโหลดสำเร็จ")
                GetPostsImg()
            }
        })
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
                toastr["success"]("ดำเนินการลบสำเร็จ")

                window.location = ('<?= $this->Url->build(['action' => 'index']) ?>')
            }
        })
    }


    function delete_img(id) {
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
                    url: "<?= $this->Url->build(['controller' => 'image', 'action' => 'delete']) ?>",
                    type: "post",
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    headers: {
                        'X-CSRF-token': $('meta[name="csrfToken"]').attr('content')
                    },
                    success: function(resp) {
                        if (resp.responseData = true) {
                            toastr["success"]("ดำเนินการลบสำเร็จ")
                        }
                    }
                })
                GetPostsImg()
            }
        })

    }
    $(document).ready(function() {
        $(".editnew").datepicker({
            todayHighlight: true, // to highlight the today's date
            format: 'dd-m-yyyy',
            autoclose: true,
        });
    })
</script>