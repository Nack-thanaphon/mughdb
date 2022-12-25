<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="<?= $this->Url->Build(['controller' => 'dashboard']) ?>" class="my-2 mx-auto text-reset text-white">
        <div class="nav-item ">
            <div class="px-3">
                <a class="navbar-brand" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'Home', 'action' => 'index']) ?>">
                    <img src="<?= $this->Url->image('logo.png') ?> " width="50" height="50" alt="">
                </a>
            </div>
        </div>
    </a>

    <div class="sidebar">
        <div class="mt-3 pb-1 mb-2 d-flex m-0 p-0">
            <?php foreach ($userData as $row) : ?>
                <div class="px-3">
                    <small class="text-white"> <?= $row->name ?></small> <br>
                    <small class="text-secondary"><?= $row->role ?></small>
                </div>
            <?php endforeach; ?>
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
                        <i class="fas fa-database"></i>
                        <p class="text-bold text-uppercase">
                            หน้าหลัก
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'posts', 'action' => 'index']) ?>" class="nav-link">
                        <i class="fas fa-newspaper"></i>
                        <p class="text-bold text-uppercase">
                            จัดการ ข่าวสาร
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'banner', 'action' => 'index']) ?>" class="nav-link">
                        <i class="fab fa-font-awesome-flag"></i>
                        <p class="text-bold text-uppercase">
                            จัดการ แบนเนอร์
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'events', 'action' => 'index']) ?>" class="nav-link">
                        <i class="fas fa-calendar-day"></i>
                        <p class="text-bold text-uppercase">
                            จัดการ กิจกรรม
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'file', 'action' => 'index']) ?>" class="nav-link">
                        <i class="fas fa-bookmark"></i>
                        <p class="text-bold text-uppercase">
                            จัดการ เอกสาร
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'education', 'action' => 'index']) ?>" class="nav-link">
                        <i class="fas fa-book"></i>
                        <p class="text-bold text-uppercase">
                            จัดการ หลักสูตร
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'newsletter', 'action' => 'index']) ?>" class="nav-link">
                        <i class="fas fa-envelope-open-text"></i>
                        <p class="text-bold text-uppercase">
                            จัดการ จดหมายข่าว
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'gallery', 'action' => 'index']) ?>" class="nav-link">
                        <i class="fas fa-fw fa-table"></i>
                        <p class="text-bold text-uppercase text-muted">
                            จัดการ คลังรูปภาพ
                        </p>
                    </a>
                </li>
                <li class="nav-header text-secondary text-uppercase"><small>System Area</small></li>
                <li class="nav-item">
                    <a href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'Users', 'action' => 'index']) ?>" class="nav-link">
                        <i class="fas fa-users-cog"></i>
                        <p class="text-bold text-uppercase">
                            จัดการ ผู้ใช้งาน
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'contact', 'action' => 'index']) ?>" class="nav-link">
                        <i class="fas fa-address-card"></i>
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
                        <i class="fas fa-sign-out"></i>
                        <p class="text-bold text-uppercase">
                            ออกจากระบบ
                        </p>
                    </a>
                </li>
            </ul>
        </nav>

    </div>

</aside>


<script>
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