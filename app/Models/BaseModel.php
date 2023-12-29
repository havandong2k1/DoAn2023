<?php

namespace App\Models;

use CodeIgniter\Model;

class BaseModel extends Model
{
    protected $table = ''; // Tên bảng cần thao tác
    protected $primaryKey = ''; // Tên trường primary key của bảng
    protected $useTimestamps = true; // Sử dụng timestamps để tự động thêm giá trị cho các trường created_at và updated_at
    protected $createdField = 'created_at'; // Tên trường dùng để lưu thời gian tạo bản ghi
    protected $updatedField = 'updated_at'; // Tên trường dùng để lưu thời gian cập nhật bản ghi
    protected $allowedFields = []; // Các trường được phép thêm/sửa trong bảng
    protected $useSoftDeletes = true; // Sử dụng soft deletes để xoá mềm bản ghi
    protected $deletedField = 'deleted_at'; // Tên trường dùng để lưu thời gian xoá mềm bản ghi

}
