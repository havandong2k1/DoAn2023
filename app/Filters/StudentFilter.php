<?php
namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use PHPUnit\TextUI\Exception;

class StudentFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Do something here
        try{
            if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
                $dataReceives = $request->getJSON(true);
                if(isset($dataReceives['test_student'])== false) {
                    $data['error_server'] = '1CRR01';
                    echo json_encode($data);
                    exit(1);
                }
                if($dataReceives['test_student'] != API_APPS_TOKEN){
                        $data['error_server'] = '1CRRO2';
                        echo json_encode($data);
                        exit(1);
                    }
            }else{
                    $data['error_server']='1CRR03';
                    echo json_encode($data);
                    exit(1);
                }
        }catch(\Exception $ex){
            $data['error_server']='1CRR04';
            echo json_encode ($data);
            exit(1);

        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}