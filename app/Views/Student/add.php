
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <base href="<?= base_url() ?>" >
    <link rel="shortcut icon" href="<?php echo  base_url('public/assets/User/images/favicon.ico');?>" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css"
          integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600|Open+Sans:400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('public/assets/admin/css/easion.css');?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
    <script src="<?php echo base_url('public/assets/admin/js/chart-js-config.js'); ?>"></script>
    <title>Thêm dữ liệu</title>

</head>

<body>
<div class="dash">
    <div class="dash-app">
        <main class="dash-content">
            <div class="container-fluid">
                <h1 class="dash-title">Trang chủ / Sinh Viên/ Thêm mới</h1>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card easion-card">
                            <div class="card-header">
                                <div class="easion-card-icon">
                                    <i class="fas fa-chart-bar"></i>
                                </div>
                                <div class="easion-card-title"> Thêm mới sinh viên </div>
                            </div>
<!--                            --><?php //@studentList[null] ?>
                            <div class="easion-card-title"> Thông tin </div>
                            <?php if (isset($errors)) : ?>
                                <div class="alert alert-danger">
                                    <ul>
                                        <?php foreach ($errors as $error) : ?>
                                            <li><?= esc($error) ?></li>
                                        <?php endforeach ?>
                                    </ul>
                                </div>
                            <?php endif ?>
                            <div class="card-body ">
                                <form action="<?=site_url('admin/submit-list') ?>" method="post" name="add_create" id="add_create" >
                                    <div class="form-row">
                                        <div class="form-group col-md-8">
                                            <label for="name">Họ và tên:</label>
                                            <input name="name" type="text" class="form-control" id="name"
                                                   placeholder="Họ và tên" value="<?= old('name') ?>">

                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="class">Lớp</label>
                                            <input name="class" type="text" class="form-control" id="class" value="<?= old('class') ?>">
                                        </div>

                                        <div class="form-group col-md-8">
                                            <label for="sex">Giới Tính</label>
                                            <select class="form-control" id="sex" name="sex">
                                                <option value="">-- Chọn giới tính --</option>
                                                <option value="Nam"<?= old('sex') == 'Nam' ? ' selected' : '' ?>>Nam</option>
                                                <option value="Nữ"<?= old('sex') == 'Nữ' ? ' selected' : '' ?>>Nữ</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="address" >Địa chỉ</label>
                                            <input name="address" type="text" class="form-control" id="address" placeholder="Nhập vào địa chỉ" value="<?= old('address') ?>">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="math_score">Điểm Toán</label>
                                            <input name="math_score" type="text" class="form-control" id="math_score" placeholder="Nhập vào điểm toán" value="<?= old('math_score') ?>">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="chemistry_score">Điểm Hóa</label>
                                            <input name="chemistry_score" type="text" class="form-control" id="chemistry_score" placeholder="Nhập vào điểm hóa" value="<?= old('chemistry_score') ?>" >
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="physics_score">Điểm Lý</label>
                                            <input name="physics_score" type="text" class="form-control" id="physics_score" placeholder="Nhập vào điểm lý" >
                                        </div>
                                        <div>

                                    <button type="submit" class="btn btn-success">Xác nhận</button>
                                    <a href="admin/view-list" id="btn-reset-edit-user"  type="reset" class="btn btn-secondary">Quay lại</a>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
<script src="<?php echo base_url('public/assets/admin/js/easion.js'); ?>"></script>
<script src="https://cdn.jsdelivr.net/gh/jquery/jquery@3.6.4/dist/jquery.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js" ></script>

</body>
</html>