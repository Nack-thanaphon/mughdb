<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="/" class="text-decoration-none">
        <div class="pl-4 my-2 text-white">

            <small class="text-muted">ระบบเว็บไซต์</small>
            <h6 class=" m-0 p-0">MUGH</h6>
        </div>
    </a>

    <div class="sidebar">
        <div class="mt-3 pb-1 mb-2 d-flex m-0 p-0">

            <div class="px-3">
                <small class="text-white"> <?= $userData->name ?></small> <br>
                <small class="text-secondary"><?= $userData->role ?></small>
            </div>
        </div>
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> -->

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header text-secondary text-uppercase"><small>Management space</small></li>
                <li class="nav-item">
                    <a href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'dashboard', 'action' => 'index']) ?>" class="nav-link">
                        <i class="nav-icon fas fa-database"></i>
                        <p class="text-bold text-uppercase">
                            หน้าหลัก
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'posts', 'action' => 'index']) ?>" class="nav-link">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p class="text-bold text-uppercase">
                        ข่าวสาร
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'banner', 'action' => 'index']) ?>" class="nav-link">
                        <i class="nav-icon fab fa-font-awesome-flag"></i>
                        <p class="text-bold text-uppercase">
                        แบนเนอร์
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'events', 'action' => 'index']) ?>" class="nav-link">
                        <i class="nav-icon fas fa-calendar-day"></i>
                        <p class="text-bold text-uppercase">
                        กิจกรรม
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'file', 'action' => 'index']) ?>" class="nav-link">
                        <i class="nav-icon fas fa-bookmark"></i>
                        <p class="text-bold text-uppercase">
                            เอกสาร
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'education', 'action' => 'index']) ?>" class="nav-link">
                        <i class="nav-icon  fas fa-book"></i>
                        <p class="text-bold text-uppercase">
                             หลักสูตร
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'newsletter', 'action' => 'index']) ?>" class="nav-link">
                        <i class="nav-icon fas fa-envelope-open-text"></i>
                        <p class="text-bold text-uppercase">
                            จดหมายข่าว
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'gallery', 'action' => 'index']) ?>" class="nav-link">
                        <i class="nav-icon fas fa-fw fa-table"></i>
                        <p class="text-bold text-uppercase">
                            คลังรูปภาพ
                        </p>
                    </a>
                </li>
                <li class="nav-header text-secondary text-uppercase"><small>System Area</small></li>

                <?php if ($userData->type_id == 1) { ?>
                    <li class="nav-item">
                        <a href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'Users', 'action' => 'index']) ?>" class="nav-link">
                            <i class="nav-icon fas fa-users-cog"></i>
                            <p class="text-bold text-uppercase">
                                ผู้ใช้งาน
                            </p>
                        </a>
                    </li>
                <?php } ?>

                <li class="nav-item">
                    <a href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'contact', 'action' => 'index']) ?>" class="nav-link">
                        <i class="nav-icon fas fa-address-card"></i>
                        <p class="text-bold text-uppercase">
                            ช่องทางการติดต่อ
                        </p>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'chats', 'action' => 'index']) ?>" class="nav-link">
                        <i class="fas fa-info-circle"></i>
                        <p class="text-bold text-uppercase">
                            รายงาน
                        </p>
                    </a>
                </li> -->

                <li class="nav-item">
                    <a onclick="logout()" type="button" class="nav-link">
                        <i class="nav-icon fas fa-sign-out"></i>
                        <p class="text-bold text-uppercase">
                            ออกจากระบบ
                        </p>
                    </a>
                </li>
            </ul>
        </nav>

    </div>

</aside>

<!-- Modal -->
<div class="modal" id="userData" tabindex="-1" role="dialog" aria-labelledby="userDataLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userDataLabel">ข้อมูลผู้ใช้งาน</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <div class="row p-3 ">
                    <div class="col-12  my-2">
                        <h3>รูปภาพประจำตัว</h3>
                    </div>
                    <div class="col-4  my-2">
                        <div class="row m-0 py-3 my-auto w-100" style="overflow: hidden;">
                            <a data-fslightbox href="<?php echo $this->Url->build($userData->image, ['fullBase' => true]); ?>">
                                <img id="user_image_file" src="<?php echo $this->Url->build($userData->image, ['fullBase' => true]); ?>" class="w-75" style="">
                            </a>
                        </div>
                        <!-- <img src="https://www.pngall.com/wp-content/uploads/5/User-Profile-PNG.png" class="w-100 " alt=""> -->
                    </div>
                    <div class="col-8">
                        <div class="form-floating mb-3">
                            <label for="floatingemail" class="text-muted">ชื่อ-นามสกุล</label>
                            <h5 class=" text-uppercase"><?= $userData->name ?></h5>
                        </div>
                        <div class="form-floating mb-3">
                            <label for="floatingemail" class="text-muted">อีเมลล์ผู้ใช้งาน</label>
                            <h5 class=""><?= $userData->email ?></h5>
                        </div>

                        <div class="form-floating mb-3">
                            <label for="floatingemail" class="text-muted">ตำแหน่งผู้ใช้งาน</label>
                            <h5 class=""><?= $userData->type ?></h5>
                        </div>

                        <div class="form-floating mb-3">
                            <label for="floatingemail" class="text-muted">สถานะผู้ใช้งาน</label>
                            <h5 class=""><?= $userData->role ?></h5>
                        </div>

                        <div class="form-floating mb-3 m-0 p-0">
                            <label for="floatingemail" class="text-muted">สถานะการยืนยันตัวตน</label>
                            <p class=""><?= ($userData->verified == 1) ? '<i class="fas fa-check-circle text-success"></i> ยืนยันตัวตนเรียบร้อย</small>' : '<i class="fas fa-times-circle text-danger"></i> รอการยืนยันตัวตน</small>' ?>

                        </div>

                        <div class="form-floating mb-3 m-0 p-0">
                            <label for="floatingemail" class="text-muted">สถานะผู้ใช้งาน</label>
                            <p class=""><?= ($userData->status == 1) ? '<i class="fas fa-check-circle text-success"></i> กำลังใช้งาน</small>' : '<i class="fas fa-times-circle text-danger"></i>ไม่ได้ใช้งาน</small>' ?>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'Users', 'action' => 'profile', $userData->token]) ?>" type="button" class="btn btn-primary">อัพเดตข้อมูลผู้ใช้งาน</a>
            </div>
        </div>
    </div>
</div>

<script>
    function Userdata() {
        $('#userData').modal('show')
    }

    function logout() {
        Swal.fire({
            title: 'ออกจากระบบ',
            text: "คุณต้องการออกจากระบบใช่ไหม!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ใช่, ฉันต้องการ!',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '<?= $this->Url->build(['prefix' => false, 'controller' => 'users', 'action' => 'logout']) ?>'
            }
        })
    }
</script>