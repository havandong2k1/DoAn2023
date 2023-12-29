
<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">

<head>
    <meta charset="utf-8">
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>    <link rel="shortcut icon" href="<?php echo base_url('public/assets/User/images/favicon.ico'); ?>" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css"
          integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600|Open+Sans:400,600,700" rel="stylesheet">

    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js" ></script>
<!--    <script src="--><?php //echo base_url('public/assets/admin/js/dataTable.js'); ?><!--"></script>-->
    <link rel="stylesheet" href="<?php echo base_url('public/assets/admin/css/easion.css'); ?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
    <script src="<?php echo base_url('public/assets/admin/js/chart-js-config.js'); ?>"></script>
    <link rel="shortcut icon" href="<?php echo base_url('public/assets/User/images/favicon.ico');?>" type="image/x-icon"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <title>Sinh Viên</title>
</head>
<div class="dash">
    <div class="dash-nav dash-nav-dark">
        <header>
            <a href="javascript::void()" class="menu-toggle">
                <i class="fas fa-bars"></i>
            </a>
            <a href="<?= base_url('admin/home-list') ?>" class="easion-logo"><i class="fas fa-sun"></i> <span>HVĐ</span></a>
        </header>
        <nav class="dash-nav-list">
            <a href="#" class="dash-nav-item">
                <i class="fas fa-home"></i> Thống kê </a>
            <div class="dash-nav-dropdown">
                <a href="javascript::void(0)" class="dash-nav-item dash-nav-dropdown-toggle">
                    <i class="fas fa-users"></i> Sinh Viên </a>
                <div class="dash-nav-dropdown-menu">
                    <a href="<?= base_url('admin/view-list') ?>" class="dash-nav-dropdown-item">Danh sách</a>
                </div>
            </div>
            <div class="dash-nav-dropdown">
                <a href="javascript::void(0)" class="dash-nav-item dash-nav-dropdown-toggle">
                    <i class="fas fa-cube"></i> Gói dịch vụ </a>
                <div class="dash-nav-dropdown-menu">
                    <a href="purchase-list.html" class="dash-nav-dropdown-item">Danh sách</a>
                    <a href="purchase-add.html" class="dash-nav-dropdown-item">Thêm mới</a>
                </div>
            </div>
            <div class="dash-nav-dropdown">
                <a href="javascript::void(0)" class="dash-nav-item dash-nav-dropdown-toggle">
                    <i class="fas fa-comments"></i> Đánh giá </a>
                <div class="dash-nav-dropdown-menu">
                    <a href="comment-list.html" class="dash-nav-dropdown-item">Danh sách</a>
                    <a href="comment-add.html" class="dash-nav-dropdown-item">Thêm mới</a>
                </div>
            </div>
            <a href="contacts.html" class="dash-nav-item">
                <i class="fas fa-info"></i>Liên hệ
            </a>
        </nav>
    </div>
    <div class="dash-app">
        <header class="dash-toolbar">
            <a href="javascript::void()" class="menu-toggle">
                <i class="fas fa-bars"></i>
            </a>
            <a href="javascript::void()" class="searchbox-toggle">
                <i class="fas fa-search"></i>
            </a>
            <form class="searchbox" action="javascript::void()">
                <a href="javascript::void()" class="searchbox-toggle"> <i class="fas fa-arrow-left"></i> </a>
                <button type="submit" class="searchbox-submit"> <i class="fas fa-search"></i> </button>
                <input type="text" class="searchbox-input" placeholder="Nhập thông tin tìm kiếm">
            </form>
            <div class="tools">
                <a href="https://www.youtube.com/channel/UCwBHZqLqgZUTWLLaQLfoJ1g?sub_confirmation=1" target="_blank" class="tools-item">
                    <i class="fab fa-youtube"></i>
                </a>
                <a href="javascript::void()" class="tools-item">
                    <i class="fas fa-bell"></i>
                    <i class="tools-item-count">4</i>
                </a>
                <div class="dropdown tools-item">
                    <a href="#" class="" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false">
                        <i class="fas fa-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                        <a class="dropdown-item" href="javascript::void()">Profile</a>
                        <a class="dropdown-item" href="login.html">Logout</a>
                    </div>
                </div>
            </div>
        </header>
    </div>

    <div class="dash">
        <div class="dash-app">
            <main class="dash-content">
                <div class="container-fluid">
                    <h1 class="dash-title">Thông tin Sinh Viên</h1>
                </div>
                <div class="d-flex justify-content-start">
                    <a href="<?= base_url('admin/add-list') ?>" class="btn btn-success mb-2" onclick="return confirm('Bạn có chắc muốn thêm không')" > Thêm mới</a><br>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card easion-card">
                            <div class="card-header">
                                <div class="easion-card-icon">
                                    <i class="fas fa-table"></i>
                                </div>
                                <div class="easion-card-title">Bảng Sinh Viên</div>
                            </div>
                            <div class="card-body ">
                                <tbody>
                                <?php

                                $excellentCount = 0;
                                $goodCount = 0;
                                $poorCount = 0;
                                foreach ($students as $st):

                                    $totalScore = ($st['math_score'] + $st['chemistry_score'] + $st['physics_score']) / 3;
                                    if ($totalScore >= 8.0) {
                                        // Điểm giỏi
                                        $excellentCount++;
                                    } elseif ($totalScore >= 6.5) {
                                        // Điểm khá
                                        $goodCount++;
                                    } else {
                                        // Điểm kém
                                        $poorCount++;
                                    }
                                    ?>
                                    <tr>
                                        <!-- Các cột dữ liệu khác -->
                                    </tr>
                                <?php
                                endforeach;
                                ?>
                                </tbody>
                                <table id="dataTable" class="table table-striped table-hover"  >
                                    <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Tên</th>
                                        <th scope="col" >Lớp</th>
                                        <th scope="col">Giới Tính</th>
                                        <th scope="col">Địa chỉ</th>
                                        <th scope="col">Điểm Toán</th>
                                        <th scope="col">Điểm Hóa</th>
                                        <th scope="col">Điểm Lý</th>
                                        <th scope="col">Tổng điểm</th>
                                        <th scope="col">Chức năng</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($students as $st): ?>
                                        <tr><td><?php echo $st['id_student']; ?></td>
                                            <td><?php echo $st['name']; ?></td>
                                            <td><?php echo $st['class']; ?></td>
                                            <td><?php echo $st['sex']; ?></td>
                                            <td><?php echo $st['address']; ?></td>
                                            <td><?php echo $st['math_score']; ?></td>
                                            <td><?php echo $st['chemistry_score']; ?></td>
                                            <td><?php echo $st['physics_score']; ?></td>
                                            <td><?php echo number_format($st['math_score'] + $st['chemistry_score'] + $st['physics_score']) / 3; ?></td>
                                            <td>
                                                <a href="<?= site_url('admin/edit-list/' . $st['id_student']) ?>" class="btn btn-primary btn-sm" >Sửa</a>
                                                <!-- Phần tử kích hoạt sự kiện click -->
                                                <button class="btn btn-danger btn-sm  delete-student" data-id="<?= $st['id_student']?>">Xóa</button>


                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <!-- Các dòng mã HTML khác -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <h4>Số học sinh giỏi: <?php echo $excellentCount; ?></h4>
                                    </div>
                                    <div class="col-md-4">
                                        <h4>Số học sinh khá: <?php echo $goodCount; ?></h4>
                                    </div>
                                    <div class="col-md-4">
                                        <h4>Số học sinh kém: <?php echo $poorCount; ?></h4>
                                    </div>
                                </div>
                                <!-- Các dòng mã HTML khác -->

                            </div>

                        </div>
                    </div>
                </div>
        </div>
    </div>
    </main>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
<script src="<?php echo base_url('public/assets/admin/js/easion.js'); ?>"></script>
<script src="<?php echo base_url('public/assets/admin/js/jqueryTable.js');?>"></script>
<script>
    $(document).ready(function () {
        $('#dataTable').DataTable({
            "language": {
                "lengthMenu": "Hiển thị _MENU_ dòng",
                "zeroRecords": "Không có dữ liệu",
                "info": "Hiển thị trang _PAGE_ trên _PAGES_ trang",
                "infoEmpty": "Không có dữ liệu",
                "search": "Tìm kiếm: ",
                paginate: {
                    previous: '‹',
                    next: '›'
                },
            }
        });
    });
</script>
<script>
    $(document).on('click', '.delete-student', function() {
        var id_student = $(this).data('id');
        var url = 'https://donghv-ci4.onoffice.vn/admin/delete-list/'; // Đường dẫn URL của API xóa sinh viên
        var confirmDelete = confirm('Bạn có chắc chắn muốn xóa sinh viên này?'); // Thêm confirm để xác nhận xóa

        if (confirmDelete) {
            // Gửi request Ajax
            $.ajax({
                url: url + id_student,
                type: 'POST',
                data: {id_student: id_student},
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.status == 'success') {
                        alert(response.message);
                        // Reload trang hoặc làm gì đó khác sau khi xóa thành công
                    } else {
                        alert('Xóa sinh viên thất bại');
                    }
                },
                error: function() {
                    alert('Có lỗi xảy ra. Vui lòng thử lại sau.');
                }
            });
        }
        // Nếu không xóa, không làm gì cả
    });
</script>

</body>
</html>