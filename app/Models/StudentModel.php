<?php
  namespace App\Models;
  use CodeIgniter\Model;
  class StudentModel extends BaseModel
  {
     protected $table = 'student';
     protected $primaryKey = 'id_student';
     protected $allowedFields = ['name', 'class', 'sex', 'address','math_score','chemistry_score','physics_score'];

      public function deleteStudent($id_student)
      {
          // Thực hiện xóa sinh viên dựa trên khóa chính
          $this->where('id_student', $id_student)->delete();
          return true;
      }

  }
