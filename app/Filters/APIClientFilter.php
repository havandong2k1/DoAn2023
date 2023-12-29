<?php
namespace App\Filters;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Class APIClientFilter
 * @package App\Filters
 * Created by dungnk
 */

class APIClientFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        try{
            if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
                $allParams = $request->getJSON(true);
                if(isset($allParams['app_token']) == false){
                    //Params are not valid
                    $data['error_server'] = '0xAPIx001';
                    echo json_encode($data);
                    exit(1);
                }
                //Check api-tokens
                if($allParams['app_token'] != API_APPS_TOKEN){
                    $data['error_server'] = '0xAPIx002';
                    echo json_encode($data);
                    exit(1);
                }
            }else{
                //Refuse for this request
                $data['error_server'] = '0xAPIx003';
                echo json_encode($data);
                exit(1);
            }
        }catch (\Exception $ex){
            //Error is not exactly
            $data['error_server'] = '0xAPIx004';
            echo json_encode($data);
            exit(1);
        }
    }
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}