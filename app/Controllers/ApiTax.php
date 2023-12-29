<?php

namespace App\Controllers;

class ApiTax extends BaseController
{
    public function getListusers()
    {
        $user1 =[
            'name' => 'dungnk',
            'age' => '40'
        ];
        $user2 =[
            'name' => 'donghv',
            'age' => '22'
        ];
        $array = [];
        array_push($array, $user1);
        array_push($array, $user2);
        $data['code'] = 'success';
        $data['users'] = $array;
       return $this->response->setJSON($data);
    }
    public function getStudentList()
    {
        $user=[
            'name' => "Hà Văn Đông",
            'age' => '22'
        ];
        $arry=[];
        array_push($arry,$user);
        $data['list_code']= 'test';
        $data['users'] = $arry;
        return $this->response->setJSON($data);
    }
}
