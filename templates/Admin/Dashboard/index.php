<?php $this->assign('title', 'หน้าหลัก'); ?>

<div class="row  m-0 py-3 p-0">
    <div class="col-12 col-md-12 col-lg-12 p-3">
        <h3>หน้าหลัก</h3>
    </div>
    <div class="col-12 col-md-12 col-lg-8 m-0 p-0 ">
        <div class="row m-0 p-0">
            <div class="col-12 col-lg-4 m-0  ">
                <div class="mb-2 p-3 m-0 p-0 rounded card ">
                    <div class="row m-0 p-0 ">
                        <div class="m-0 p-0 col-3 text-center text-primary m-auto">
                            <h1 class="fas fa-chalkboard-teacher m-0 p-0 "></h1>
                        </div>
                        <div class=" col-9 my-auto">
                            <small class="m-0 p-0 text-muted">จำนวนผุ้เข้าชมทั้งหมด</small>
                            <h5 class="mt-2"><?= number_format((float)$countVisiter) ?>
                                <span class="m-0 p-0">
                                    <small class="m-0 p-0">/ ครั้ง</small>
                                </span>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12  col-lg-4 m-0">
                <div class="mb-2 p-3 m-0 p-0 rounded card ">
                    <div class="row m-0 p-0 ">
                        <div class="m-0 p-0 col-3 text-center text-primary m-auto">
                            <h1 class="fas fa-book m-0 p-0"></h1>
                        </div>
                        <div class=" col-9 my-auto">
                            <small class="m-0 p-0 text-muted">จำนวนหลักสูตรทั้งหมด</small>
                            <h5 class="mt-2"><?= $countCauses ?>
                                <span class="m-0 p-0">
                                    <small class="m-0 p-0">/ หลักสูตร</small>
                                </span>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12  col-lg-4 m-0">
                <div class="mb-2 p-3 m-0 p-0 rounded card ">
                    <div class="row m-0 p-0 ">
                        <div class="m-0 p-0 col-3 text-center text-primary m-auto">
                            <h1 class="fas fa-users-cog m-0 p-0"></h1>
                        </div>
                        <div class=" col-9 my-auto ">
                            <small class="m-0 p-0 text-muted">จำนวนผู้ใช้งานทั้งหมด</small>
                            <h5 class="mt-2"><?= $countUsers ?>
                                <span class="m-0 p-0">
                                    <small class="m-0 p-0">/ ผู้ใช้งาน</small>
                                </span>
                            </h5>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12 m-0  d-none d-sm-block">
                <div class="card ">
                    <div class="card-body ">
                        <div class=" m-0 p-2">
                            <p class="text-primary m-0 p-0">ยอดเข้าชมเว็บไซต์ ประจำปี <?= $thaiyear ?></p>
                        </div>
                        <div class="chart ">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>

                            <div id="chart" class=" m-0 p-0">
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <div class="col-12 col-md-12 col-lg-4 h-100 d-none d-sm-block">
        <div class="row m-0 p-0 mb-2">
            <div class="card  w-100 p-3 m-2 m-sm-0">
                <p class="text-primary m-0 p-0">เข้าระบบล่าสุด</p>
                <hr class="m-0 pb-2">
                <table>
                    <tbody>
                        <?php
                        if ($getUserlogData) {
                            foreach ($getUserlogData as $key => $value) : ?>
                                <tr>
                                    <td colspan="2" class="pb-2">
                                        <p class="m-0 p-0"><?= (!empty(($value->user['name']))) ? $value->user['name'] : "รอข้อมูลผู้ใช้งาน" ?></p>
                                        <small class="m-0 p-0 text-muted">เวลา: <?= $value->created ?></small>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php } else { ?>
                            <tr>
                                <td>
                                    <p class="text-muted m-0 p-0">ไม่มีข้อมูล</p>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="btn btn text-right m-0 p-0 mt-3">
                    <a type="button" onclick="viewsUserlog()" class="text-muted">อ่านต่อทั้งหมด </a>
                </div>
            </div>
        </div>
        <div class="row m-0 p-0 mb-2">
            <div class="card h-100 w-100 p-3 m-2 m-sm-0">
                <p class="text-primary m-0 p-0">ข่าวสารล่าสุด</p>
                <hr class="m-0 pb-2">
                <table>
                    <tbody>
                        <?php
                        if ($getPosts) {
                            // pr($getPosts);die;
                            foreach ($getPosts as $key => $value) : ?>
                                <tr>
                                    <td colspan="2" class="pb-2 ">
                                        <div class="d-flex justify-content-between">
                                            <small class="text-muted "><?= $value->posts_type['pt_name'] ?></small>
                                            <small class="text-muted"><?= $value->p_date ?></small>
                                        </div>
                                        <p class="m-0 p-0"><?= $value->p_title ?></p>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php } else { ?>
                            <tr>
                                <td>
                                    <p class="text-muted m-0 p-0">ไม่มีข้อมูล</p>
                                </td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
                <div class="btn btn text-right m-0 p-0 mt-3">
                    <a href="<?= $this->Url->build(['controller' => 'posts', 'action' => 'index']) ?>" class="text-muted">อ่านต่อทั้งหมด </a>
                </div>
            </div>
        </div>
    </div>
</div>





<!-- Modal -->
<div class="modal" id="viewsData" tabi="-1" role="dialog" aria-labelledby="viewsDataLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title" id="viewsDataLabel">
                    <p class="m-0 p-0 text-primary">เข้าระบบล่าสุด</p>
                    <small class="text-muted">Lastes User Login Data</small>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" style="height: 450px; overflow-y: scroll;">
                <table class="table m-0 p-0">
                    <thead class="thead-dark">
                        <tr>
                            <th class="w-90">รายชื่อ</th>
                            <th class="w-10">วันที่เข้าระบบ</th>
                        </tr>
                    </thead>
                    <tbody id="userlogData">


                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>



<script>
    $(function() {
        let year = <?= $thaiyear ?>;
        var options = {
            chart: {
                width: "100%",
                type: 'bar',
                height: 'auto',
                toolbar: {
                    export: {
                        csv: {
                            filename: 'ยอดเข้าชมประจำปี ' + year + '',
                            columnDelimiter: ',',
                            headerCategory: 'ประจำเดือน',
                            headerValue: 'value',
                            headerValue: year,
                            dateFormatter(timestamp) {
                                return new Date(timestamp).toDateString()
                            }
                        },
                    },
                },

            },

            series: [{
                name: 'ยอดเข้าชม',
                data: <?= $amount ?>

            }],
            xaxis: {
                categories: <?= $month ?>
            },
            legend: {
                position: "right",
                verticalAlign: "top",
                containerMargin: {
                    left: 35,
                    right: 60
                }
            },
            responsive: [{
                breakpoint: 1000,
                options: {
                    plotOptions: {
                        bar: {
                            horizontal: false
                        }
                    },
                    legend: {
                        position: "bottom"
                    }
                }
            }],
        }

        var chart = new ApexCharts(document.querySelector("#chart"), options);

        chart.render();
    })



    function viewsUserlog() {
        $.LoadingOverlay("show");
        $.ajax({
            url: "<?= $this->Url->build(['action' => 'userlogview']) ?>",
            type: "get",
            dataType: 'json',
            headers: {
                'X-CSRF-token': $('meta[name="csrfToken"]').attr('content')
            },
            success: function(resp) {
                let data = resp.userlog


                html = ''
                for (let i = 0; i < data.length; i++) {
                   
                 let date = moment(data[i].created).format("Do MMMM YYYY, h:mm:ss a");
                    html += `
                        <tr>
                            <td> <small>${data[i].user['name']}</small> </td>
                            <td  class="text-muted text-wrap"><small>${date}</small> </td>
                        </tr>
                       
                 `
                }
                $.LoadingOverlay("hide");
                $('#userlogData').html(html)
                $('#viewsData').modal('show')
            }
        })
    }
</script>