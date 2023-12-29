<?php

namespace App\Controllers;
class Home extends BaseController
{
    public function login()
    {
        $data = [];
        try{
            //Xử lý logic login
        }
        catch(\Exception $e){
            //Xử lý ngoại lệ
        }
        //Đẩy ra view và dữ liệu $data
        return view('Home/login',$data);
    }
    /*Logout
    * destroy all admin data from session and do admin logged out
    */
    public function logout()
    {
        session()->destroy();
        //Redirect đến action login
        return redirect()->to(base_url('home/login'));
    }
}
