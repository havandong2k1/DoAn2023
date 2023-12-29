<?php 
namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class MyNoAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        //Force https for request
        if (! $request->isSecure()) {
            force_https();
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}