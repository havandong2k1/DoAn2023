<?php
namespace App\Validations;
use App\Models\AdminsModel;
use App\Models\ServersModel;
use App\Models\PlansModel;

class AdminsRules{
	/*check email & password of admin is mapping on the database
	* true; not mapped
	* false: mapped
	* use for validate of login-admin
	*/
	public function verifyAdmin(string $str, string $fields, array $data){
		$model = new AdminsModel();
		$admin = $model->where('admin_email', $data['admin_email'])
					  ->first();
		if(!$admin)
		  return false;
		return password_verify($data['admin_password'], $admin['admin_password']);
	}
	
	/*check user_email exists on the database
	* true; exist
	* false: not exist
	* use for validate of login-user
	*/
	public function existEmail(string $str, string $fields, array $data){
		$model = new AdminsModel();
		$admin = $model->where('admin_email', $data['admin_email'])
					  ->first();
		if(!$admin)
		  return false;
		return true;
	}
	
	/*check plan_code doesn't exists on the database
	* true; not exist
	* false: exist
	* use for validate of add/edit-plan
	*/
	public function notExistCode(string $str, string $fields, array $data){
		$model = new PlansModel();
		$plan = $model->where('plan_code', $data['plan_code'])
					  ->first();
		if($plan)
		  return false;
		return true;
	}
    public function check_date(string $str, string $fields, array $data){
        $model = new PlansModel();
        $date = time();
        $inputDate = strtotime($data['plan_end_date']);


        if($inputDate<=$date)
            return false;
        return true;
    }
}