<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
class HomeController extends BaseController
{
    public function index()
    {
        $data=[];
        return view('Layouts/default', $data); // Sử dụng hàm view() để tải view "Layout/default"
    }
}
?>