<?php

namespace App\Controllers;
use App\Models\StudentModel;
use CodeIgniter\Controllers;

class StudentController extends BaseController
{
    public function index()
    {
        $studentModel = new StudentModel();
         $data = array('students' => $studentModel->findAll());
            //lấy dữ liệu data
         return View('Student/view',$data);
    }
    public function create()
    {
      return View('Student/add');
    }
    public function store()
    {
//        $tong = $this->utils->calculateSumPoints(5, 6, 7);
        $studentModel = new StudentModel();
        $studentStore= $this->request->getPost(null,FILTER_SANITIZE_STRING);
        $this->validation->reset();
        if(!$this->validation->run($studentStore,'rulesCreateStudent')){
            $data['errors']= $this->validation->getErrors();
            return view('Student/add',$data);
        }
            $studentModel->insert($studentStore);
            return $this->response->redirect(base_url('admin/view-list'));
    }
    public function edit($id = null)
    {
        $studentModel = new StudentModel();
        $data=[];
        if(isset($id)){
            $data['studentObj'] = $studentModel->find($id);
        }
        return View('Student/edit', $data);
    }
    public function update()
    {
        $data=[];
        $studentModel = new StudentModel();
        $studentUpdate = $this->request->getPost(null, FILTER_SANITIZE_STRING);
        $this->validation->reset();
        if (!$this->validation->run($studentUpdate, 'rulesEditStudent')) {
            // Mảng lỗi trả về
            $data['studentObj'] = $studentUpdate;
            $data['errors'] = $this->validation->getErrors();
            return view('Student/edit',$data);
        }
        $studentModel->save($studentUpdate);
        return $this->response->redirect(base_url('admin/view-list'));
    }
    public function deleteStudent()
    {
        try{
            $request = service('request');
            $id_student = $request->getPost('id_student');
            // Xóa dữ liệu từ Model
            $studentModel = new StudentModel();
            $studentModel->delete($id_student);
            // Trả về dữ liệu Ajax
            $response = [
                'status' => 'success',
                'message' => 'Xóa sinh viên thành công'
            ];

            return $this->response->setJSON($response);

        }catch (\Exception $ex){

            // Trả về dữ liệu Ajax
            $response = [
                'status' => 'failed',
                'message' => 'Xóa sinh viên lỗi'
            ];

            return $this->response->setJSON($response);

        }
    }
    public function getTotalScore($id = null)
    {
        $studentModel = new StudentModel();
        $student = $studentModel->find($id);

        // Kiểm tra nếu sinh viên tồn tại
        if ($student) {
            $mathScore = $student['math_score'];
            $chemistryScore = $student['chemistry_score'];
            $physicsScore = $student['physics_score'];

            // Tính tổng điểm
            $totalScore = $mathScore + $chemistryScore + $physicsScore;

            // Gửi dữ liệu tổng điểm sang view
            $data['totalScore'] = $totalScore;
            $data['student'] = $student;

            // Load view và truyền dữ liệu sang view
            return view('Student/view', $data);
        } else {
            // Xử lý khi sinh viên không tồn tại
            return "Sinh viên không tồn tại";
        }
    }
}
