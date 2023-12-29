<?php

namespace App\Controllers;

use App\Models\PlansModel;
use App\Models\UsersModel;
use App\Models\PlanDetailsModel;

class User extends BaseController
{
    /**
     * index as list of users Page for this controller.
     */
    public function index()
    {
        $currentPageNumber = 1;
        $allParams = [];
        $userModel = new UsersModel();
        $plansModel = new PlansModel();
        //keep search conditions on session
        if ($this->request->getVar('for_search') != false) {
            $allParams = $this->request->getGet();
            session()->set('users.search', $allParams);
        } else {
            if ($this->request->getVar('for_menu') != false) {
                // dd(555);
                if (isset($_SESSION['users.page']) == true) {
                    session()->remove('users.page');
                }
                if (isset($_SESSION['users.search']) == true) {
                    session()->remove('users.search');
                }
            }
            //get conditions from session
            if (isset($_SESSION['users.search']) == true) {
                $allParams = session()->get('users.search');
            }
        }
        if(isset($allParams['plan_id'])&&$allParams['plan_id']=='-1'){
            unset($allParams['plan_id']);
        }
        if(isset($allParams['is_fake_data'])&&$allParams['is_fake_data']=='-1'){
            unset($allParams['is_fake_data']);
        }
        $showOnly = isset($allParams['show_only']) ? $allParams['show_only'] : "";
        $manualWhere = '';
        if($showOnly == "only-locked"){
            $manualWhere = "tbl_users.user_lock = 1";
        }else if($showOnly == "only-expired"){
            $manualWhere = "tbl_users.plan_end_date < '" . date('Y-m-d') . "'";
        }
        $itemPerpage = $this->utils->getItemPerPages();
        $userModel->search($allParams, $manualWhere);
        $totals = $userModel->countAllResults(false);
        $countPages = $this->utils->getCountPages($totals, $itemPerpage);
        //get current page number
        if ($this->request->getVar('page_users') != false) {
            //changed page => set session
            $currentPageNumber = $this->request->getVar('page_users');
            $_SESSION['users.page'] = $currentPageNumber;
        } else {
            if (session()->get('users.page') == true
                && $this->request->getVar('for_menu') == false) {
                $sessionPage = session()->get('users.page');
                if ($sessionPage <= $countPages) {
                    $currentPageNumber = $sessionPage;
                }
            }
        }
        $conditions = [
            'tbl_plans.status' => 1,
            'tbl_plans.deleted_at'=>null,
        ];
        $withSelect = "tbl_plans.plan_id, tbl_plans.plan_code, tbl_plans.status,
						tbl_plans.plan_type, tbl_plans_langs.plan_name";
        $withJoin = "tbl_plans_langs";
        $withJoinConditions = "tbl_plans_langs.plan_id = tbl_plans.plan_id AND tbl_plans_langs.deleted_at IS NULL AND tbl_plans_langs.lang_code = '" . DEFAULT_LANG_CODE . "'";
        $plans = $plansModel->getByConditions($conditions, '', $withSelect, $withJoin, $withJoinConditions);

        $data = [
            'users' => $userModel->paginate($itemPerpage, 'users', $currentPageNumber),
            'pager' => $userModel->pager,
            'totals' => $totals,
            'dataSearch' => $allParams,
            'plans' => $plans,
            'item_perpage'  =>  $itemPerpage,
            'planSearch' => isset($planSearch)?$planSearch:'',
        ];
        return view('User/index', $data);
    }

    /**
     * detail user Page for this controller.
     */
    public function detail($user_id = 0, $user_email = "")
    {
        $data = [];
        $userModel = new UsersModel();
        //get param
        $conditions = [
            'tbl_users.deleted_at'  =>  null,
        ];
        if ($user_id > 0) {
            $conditions['tbl_users.user_id'] = $user_id;
        }else if($user_email != ""){
            $conditions['tbl_users.user_email'] = $user_email;
        }
        $withSelect = "tbl_users.*, tbl_plans_langs.plan_name, tbl_plans_details_langs.view_name, tbl_plans_details.used_price";
        $withJoinTable1 = "tbl_plans";
        $withJoinCondition1 = "tbl_plans.plan_id = tbl_users.plan_id AND tbl_plans.deleted_at is null";
        $withJoinTable2 = "tbl_plans_details";
        $withJoinCondition2 = "tbl_plans_details.plan_detail_id = tbl_users.plan_detail_id AND tbl_plans_details.deleted_at is null";
        $withJoinTable3 = "tbl_plans_langs";
        $withJoinCondition3 = "tbl_plans_langs.plan_id = tbl_plans.plan_id AND tbl_plans_langs.deleted_at is null AND tbl_plans_langs.lang_code = '" . DEFAULT_LANG_CODE . "'";
        $withJoinTable4 = "tbl_plans_details_langs";
        $withJoinCondition4 = "tbl_plans_details.plan_detail_id = tbl_plans_details_langs.plan_detail_id AND tbl_plans_details_langs.deleted_at is null AND tbl_plans_details_langs.lang_code = '" . DEFAULT_LANG_CODE . "'";
        $userObj = $userModel->getFirstByConditions($conditions, '', $withSelect,
            $withJoinTable1, $withJoinCondition1, '',
            $withJoinTable2, $withJoinCondition2, '',
            $withJoinTable3, $withJoinCondition3, 'left',
            $withJoinTable4, $withJoinCondition4, 'left'
        );
        if($userObj!=false){
            $data['userObj'] = $userObj;
            $data['user_id'] = $userObj['user_id'];
        }
        return view('User/detail', $data);
    }

    public function setDataForEdit($data, $userId){
        $plansModel = new PlansModel();
        $userModel = new UsersModel();
        $planDetailModel = new PlanDetailsModel();
        $conditions = [
            'tbl_plans.status' => 1,
            'tbl_plans.deleted_at'	=>	null,
            'tbl_plans.is_api_only'	=>	0,
            'tbl_plans.is_applied_features'	=>	1,
        ];
        $withSelect = "tbl_plans.*, tbl_plans_langs.plan_name, tbl_plans_langs.note";
        $withJoinTable1 = "tbl_plans_langs";
        $withJoinCondition1 = "tbl_plans_langs.plan_id = tbl_plans.plan_id AND tbl_plans_langs.deleted_at is null AND tbl_plans_langs.lang_code = '" . DEFAULT_LANG_CODE . "'";
        $plans = $plansModel->getByConditions($conditions, '', $withSelect, $withJoinTable1, $withJoinCondition1, 'left');
        $data['plans'] = $plans;
        //get param
        if ($userId > 0) {
            //get infor of server to load on view
            $data['user_id'] = $userId;
            if(!isset($data["userObj"])){
                $userObj = $userModel->getDataById($userId);
                $userObj['plan_end_date'] = date_create($userObj['plan_end_date'])->format('Y-m-d');
                $data['userObj'] = $userObj;
            }
            //Get list plan detail by plan_id of this User
            if(isset($data["userObj"]) && isset($data["userObj"]['user_plan_id'])){
                $conditions = [
                    'tbl_plans_details.plan_id' => $data["userObj"]['user_plan_id'],
                    'tbl_plans_details.deleted_at'	=>	null,
                ];
                $withSelect = "tbl_plans_details.*, tbl_plans_details_langs.view_name";
                $withJoinTable1 = "tbl_plans_details_langs";
                $withJoinCondition1 = "tbl_plans_details.plan_detail_id = tbl_plans_details_langs.plan_detail_id AND tbl_plans_details_langs.deleted_at is null AND tbl_plans_details_langs.lang_code = '" . DEFAULT_LANG_CODE . "'";
                $listPlanDetails = $planDetailModel->getByConditions($conditions, '', $withSelect, $withJoinTable1, $withJoinCondition1, 'left');
                $data['listPlanDetails'] = $listPlanDetails;
            }
        }
        return $data;
    }

    /**
     * edit user Page for this controller.
     */
    public function edit($user_id = 0)
    {
        $data = [];
        $userModel = new UsersModel();
        if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
            //set data for validating
            $allParams = $this->request->getPost(null, FILTER_SANITIZE_STRING);
            if(isset($allParams['user_plan_id'])){
                $allParams['plan_id'] = $allParams['user_plan_id'];
            }
            //Should reset from previous running
            $this->validation->reset();
            //Run validating with rules
            if (!$this->validation->run($allParams, 'rulesUserAdmin')) {
                $data["errors"] = $this->validation->getErrors();
                $data["userObj"] = $allParams;
                $data = $this->setDataForEdit($data, $user_id);
                return view('User/edit', $data);
            }
            //added by dungnk: if changed plan => ignored on 05/07/2022
            /*$oldPlanId = (isset($allParams['old_plan_id'])==true)?$allParams['old_plan_id']:0;
            $newPlanId = (isset($allParams['plan_id'])==true)?$allParams['plan_id']:0;
            if($oldPlanId != $newPlanId){
                //add to new plan
                $data = $this->utils->addPlanToUser($user_id, $newPlanId, $data);
                if(isset($data['error_content'])==true){
                    $data["userObj"] = $allParams;
                    $data = $this->setDataForEdit($data, $user_id);
                    return view('User/edit', $data);
                }
            }*/
            //check exist when changed email
            $isExist = $userModel->checkExistField('user_email', $allParams, $user_id);
            if($isExist==true){
                $errors['user_email'] = "Địa chỉ email đã tồn tại!";
                $data["errors"] = $errors;
                $data["userObj"] = $allParams;
                $data = $this->setDataForEdit($data, $user_id);
                return view('User/edit', $data);
            }
            $allParams['plan_end_date'] = date_create($allParams['plan_end_date'])->format('Y-m-d h:i:s');
            //save to database
            $userModel->update($user_id, $allParams);
            //End-of
            //redirect to server list
            session()->setFlashdata('msg_success', 'Thành công!');
            return redirect()->to(base_url('user'));
        }
        $data = $this->setDataForEdit($data, $user_id);
        return view('User/edit', $data);
    }

    public function loadPlanDetails($plan_id)
    {
        $data = [];
        if($plan_id > 0){
            $planDetailsModel = new PlanDetailsModel();
            $conditions = [
                'tbl_plans_details.plan_id' => $plan_id,
                'tbl_plans_details.deleted_at'	=>	null,
            ];
            $withSelect = "tbl_plans_details.*, tbl_plans_details_langs.view_name";
            $withJoinTable1 = "tbl_plans_details_langs";
            $withJoinCondition1 = "tbl_plans_details.plan_detail_id = tbl_plans_details_langs.plan_detail_id AND tbl_plans_details_langs.deleted_at is null AND tbl_plans_details_langs.lang_code = 'VN'";
            $listPlanDetails = $planDetailsModel->getByConditions($conditions, '', $withSelect, $withJoinTable1, $withJoinCondition1, 'left');
            $data['planDetails'] = $listPlanDetails;
        }
        return view('User/Includes/load_plan_details', $data);
    }

    public function changePlanDetails(){
        $data = [];
        $data['csrf'] = csrf_hash();
        //get data from ajax
        if($this->request->getVar('planDetailsJson')!=false){
            $jsonDatas = $this->request->getPost('planDetailsJson', FILTER_SANITIZE_STRING);
            $planDetailsModel = new PlanDetailsModel();
            $planDetailId = (isset($jsonDatas['plan_detail_id']))?$jsonDatas['plan_detail_id']:0;
            $planStartDate = (isset($jsonDatas['plan_start_date']))?$jsonDatas['plan_start_date']:'';
            if($planDetailId > 0 && $planStartDate != ''){
                //Get plan detail by ID
                $withSelect = "durations";
                $planDetailObj = $planDetailsModel->getById($planDetailId, $withSelect);
                if($planDetailObj){
                    $startDate = date_create($planStartDate)->format('Y-m-d');
                    $data['plan_end_date'] = date('Y-m-d', strtotime($startDate. ' + ' . $planDetailObj['durations'] . ' months'));
                    $data['exit_code'] = "0";
                    echo json_encode($data);
                    exit(1);
                }
            }
            $data['exit_code'] = "1";
            echo json_encode($data);
            exit(1);
        }
        $data['exit_code'] = "1";
        echo json_encode($data);
        exit(1);
    }

    public function changePlan(){
        $data = [];
        $data['csrf'] = csrf_hash();
        //get data from ajax
        if($this->request->getVar('planJson')!=false){
            $jsonDatas = $this->request->getPost('planJson', FILTER_SANITIZE_STRING);
            $planModel = new PlansModel();
            $planId = (isset($jsonDatas['plan_id']))?$jsonDatas['plan_id']:0;
            if($planId > 0){
                //Get plan detail by ID
                $withSelect = "ft_simutaneous_connections";
                $planObj = $planModel->getById($planId, $withSelect);
                if($planObj){
                    $data['limit_devices'] = $planObj['ft_simutaneous_connections'];
                    $data['exit_code'] = "0";
                    echo json_encode($data);
                    exit(1);
                }
            }
            $data['exit_code'] = "1";
            echo json_encode($data);
            exit(1);
        }
        $data['exit_code'] = "1";
        echo json_encode($data);
        exit(1);
    }

    /* delete/ lock/ unlock multi-users*/
    public function actionUser()
    {
        if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
            $userModel = new UsersModel();
            $userIds = $this->request->getPost('userIds');
            $actionName = $this->request->getPost('action_name');
            $arrIds = explode(',', $userIds);
            $dataUpdate = [];
            if($actionName == "deletes"){
                $dataUpdate['deleted_at'] = date('Y-m-d H:i:s');
            }else if($actionName == "locks"){
                $dataUpdate['user_lock'] = 1;
            }else if($actionName == "unlocks"){
                $dataUpdate['user_lock'] = 0;
            }
            $conditions = [];
            if($actionName == "locks"){
                $conditions['user_lock'] = 0;
            }else if($actionName == "unlocks"){
                $conditions['user_lock'] = 1;
            }
            $userModel->updateDataByIds($arrIds, $dataUpdate, $conditions);
            session()->setFlashdata('msg_success', 'Thành công');
            //redirect to list
            return redirect()->to(base_url('user'));
        }
    }

    /*delete the user
	* show pop-up to confirm
	*/
    public function deleteUser()
    {
        if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
            $userModel = new UsersModel();
            $userId = $this->request->getPost('user_id');
            $userModel->deleteById($userId);
            session()->setFlashdata('msg_success', 'Thành công');
            //redirect to list
            return redirect()->to(base_url('user'));
        }
    }

    /*lock the user
	* show pop-up to confirm
	*/
    public function lockUser()
    {
        if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
            $userModel = new UsersModel();
            $userId = $this->request->getPost('user_id');
            $dataUpdate = [
                'user_lock' =>  1,
            ];
            $conditions = [
                'user_id'   =>  $userId,
            ];
            $userModel->updateDataByConditions($conditions, $dataUpdate);
            session()->setFlashdata('msg_success', 'Thành công');
            //redirect to list
            return redirect()->to(base_url('user'));
        }
    }

    /*unlock the user
	* show pop-up to confirm
	*/
    public function unlockUser()
    {
        if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
            $userModel = new UsersModel();
            $userId = $this->request->getPost('user_id');
            $dataUpdate = [
                'user_lock' =>  0,
            ];
            $conditions = [
                'user_id'   =>  $userId,
            ];
            $userModel->updateDataByConditions($conditions, $dataUpdate);
            session()->setFlashdata('msg_success', 'Thành công');
            //redirect to list
            return redirect()->to(base_url('user'));
        }
    }

    public function ajax_fill_user_by_email()
    {
        $data = [];
        $data['csrf'] = csrf_hash();
        if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
            $email = $this->request->getVar('user_email');
            $userModel = new UsersModel();
            $users = $userModel->getLikeConditionsAjax(['deleted_at' => null],['user_email'=>$email]);

            if($users != false) {
                $data['exit_code'] = "0";
                $data['users'] = $users;
                echo json_encode($data);
                exit(1);
            }
        }
        $data['exit_code'] = "1";
        echo json_encode($data);
        exit(1);
    }

    public function ajax_fill_user_by_affiliate_code()
    {
        $data = [];
        $data['csrf'] = csrf_hash();
        if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
            $affiliate = $this->request->getVar('affiliate_code');
            $userModel = new UsersModel();
            $users = $userModel->getLikeConditionsAjax(['deleted_at' => null],['affiliate_code'=>$affiliate]);

            if($users != false) {
                $data['exit_code'] = "0";
                $data['users'] = $users;
                echo json_encode($data);
                exit(1);
            }
        }
        $data['exit_code'] = "1";
        echo json_encode($data);
        exit(1);
    }

    public function ajax_fill_user_by_api_token()
    {
        $data = [];
        $data['csrf'] = csrf_hash();
        if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
            $api_token = $this->request->getVar('api_token');
            $userModel = new UsersModel();
            $users = $userModel->getLikeConditionsAjax(['deleted_at' => null],['api_token'=>$api_token]);

            if($users != false) {
                $data['exit_code'] = "0";
                $data['users'] = $users;
                echo json_encode($data);
                exit(1);
            }
        }
        $data['exit_code'] = "1";
        echo json_encode($data);
        exit(1);
    }
}
