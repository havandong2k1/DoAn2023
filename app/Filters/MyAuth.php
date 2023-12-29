<?php 
namespace App\Filters;

use App\Models\AdminsModel;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Model;

class MyAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        //Force https for request
        if (! $request->isSecure()) {
            force_https();

        }
        $previous_uri = $request->getPath();
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('Home/login?previous_uri=' . $previous_uri));
        } else {
            if (session()->get('admin_id') == true) {
                $adminModel = new AdminsModel();
                $conditions = [
                    'admin_id' => session()->get('admin_id'),
                    'deleted_at' => null,
                ];
                $adminObj = $adminModel->getByConditions($conditions);
                if ($adminObj == false) {
                    session()->destroy();
                    return redirect()->to(base_url('Home/login?previous_uri=' . $previous_uri));
                }
            }
        }
    }
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}