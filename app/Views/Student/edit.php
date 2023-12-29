
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="<?php echo  base_url('public/assets/User/images/favicon.ico');?>" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css"
          integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600|Open+Sans:400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('public/assets/admin/css/easion.css'); ?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
    <script src="<?php echo base_url('public/assets/admin/js/chart-js-config.js'); ?>"></script>
    <title>Tiều đề</title>
</head>
<body>
<div class="dash">
    <div class="dash-app">
        <main class="dash-content">
            <div class="container-fluid">
                <h1 class="dash-title">Trang chủ / Thông tin sinh viên / Sửa</h1>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card easion-card">
                            <div class="card-header">
                                <div class="easion-card-icon">
                                    <i class="fas fa-chart-bar"></i>
                                </div>
<!--                                --><?php //@$studentObj['name']?>
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
                            <form action="<?=site_url('admin/update-list') ?>" method="post"  >
                                <input type="hidden" name="id_student" value="<?php echo isset($studentObj['id_student']) ? $studentObj['id_student'] : ''; ?>">
                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="inputEmail4">Họ và tên:</label>
                                        <input type="text" name="name" class="form-control" id="name" value="<?php echo isset($studentObj['name']) ? $studentObj['name'] : ''; ?>">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputState">Lớp:</label>
                                        <input type="text" name="class" class="form-control" id="class" value="<?php echo isset($studentObj['class']) ? $studentObj['class'] : ''; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAddress">Giới tính:</label>
                                    <input name="sex" type="radio" value="Nam" <?php echo (isset($studentObj) && $studentObj['sex'] == 'Nam') ? 'checked' : ''; ?> />Nam||
                                    <input name="sex" type="radio" value="Nữ" <?php echo (isset($studentObj) && $studentObj['sex'] == 'Nữ') ? 'checked' : ''; ?> />Nữ
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="password">Địa chỉ:</label>
                                        <input type="text" name="address" class="form-control" id="address" value="<?php echo isset($studentObj['address']) ? $studentObj['address'] : ''; ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="password">Điểm Toán:</label>
                                        <input type="text" name="math_score" class="form-control" id="math_score" value="<?php echo isset($studentObj['math_score']) ? $studentObj['math_score'] : ''; ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="password">Điểm Lý:</label>
                                        <input type="text" name="physics_score" class="form-control" id="physics_score" value="<?php echo isset($studentObj['physics_score']) ? $studentObj['physics_score'] : ''; ?>">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="password">Điểm Hóa:</label>
                                        <input type="text" name="chemistry_score" class="form-control" id="chemistry_score" value="<?php echo isset($studentObj['chemistry_score']) ? $studentObj['chemistry_score'] : ''; ?>">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                                    <a href="<?php echo base_url('admin/view-list');?>" id="btn-reset-edit-user"  type="reset" class="btn btn-secondary">Quay lại</a>
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

</body>

</html>