<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;
use App\Validations\AdminsRules;

class Validation
{
    //--------------------------------------------------------------------
    // Setup
    //--------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public $ruleSets = [
        Rules::class,  //kiểm tra cơ bản bao gồm các luật thông thường như kiểm tra sự tồn tại, chiều dài, ký tự đặc biệt, ...
        FormatRules::class, // kiểm tra định dạng của dữ liệu đầu vào, chẳng hạn kiểm tra định dạng số điện thoại, email, URL, ...
        FileRules::class,// kiểm tra tính hợp lệ của tệp tin (file) đầu vào, bao gồm kiểm tra kích thước, định dạng, loại MIME, .
        CreditCardRules::class,// kiểm tra tính hợp lệ của số thẻ tín dụng (credit card) dựa trên định dạng của nó.
        //Register for Home-Rules
        AdminsRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public $templates = [
        'list' => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    //--------------------------------------------------------------------
    // Rules for User login
    //--------------------------------------------------------------------
    public $rulesAdminLogin = [
        'email' => 'required',
        'password' => 'required',
    ];
    /*Validating messsages for  User login, append from rules'name _errors*/
    public $rulesAdminLogin_errors = [
        "email" => [
            "required" => "Bạn cần nhập địa chỉ email",
        ],
        'password' => [
            'required' => "Bạn cần nhập mật khẩu",
        ],
    ];
    public $rulesEditStudent = [
        'name' => 'required|min_length[1]|max_length[100]',
        'class' => 'required|min_length[1]|max_length[50]',
        'sex' => 'required|in_list[Nam,Nữ]',
        'address' => 'required|min_length[1]|max_length[200]',
        'math_score' => 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[10]',
        'chemistry_score' => 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[10]',
        'physics_score' => 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[10]'
    ];
    /*Validating messsages*/
    public  $rulesEditStudent_errors = [
        "name" => [
            'required' => 'Bạn phải nhập đầy đủ họ và tên',
        ],
        "class" => [
            'required' => 'Bạn phải nhập đầy đủ lớp',
        ],
        "address" => [
            'required' => 'Bạn chưa nhập địa chỉ',
        ],
        "math_score" => [
            'required' => 'Bạn chưa nhập điểm Toán',
            'greater_than_equal_to'=> 'Bạn hãy nhập điểm từ "0"'
        ],
        "chemistry_score" => [
            'required' => 'Bạn bạn chưa nhập điểm Hóa',
        ],
        "physics_score" => [
            'required' => 'Bạn chưa nhập điểm Lý',
        ],
    ];
    public $rulesCreateStudent=[
        'name' => 'required|min_length[1]|max_length[100]',
        'class' => 'required|min_length[1]|max_length[50]',
        'sex' => 'required|in_list[Nam,Nữ]',
        'address' => 'required|min_length[1]|max_length[200]',
        'math_score' => 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[10]',
        'chemistry_score' => 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[10]',
        'physics_score' => 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[10]'
    ];
    public $rulesCreateStudent_errors=[
        "name" => [
            'required' => 'Bạn phải nhập đầy đủ họ và tên',
        ],
        "class" => [
            'required' => 'Bạn phải nhập đầy đủ lớp',
        ],
        "address" => [
            'required' => 'Bạn chưa nhập địa chỉ',
        ],
        "math_score" => [
            'required' => 'Bạn chưa nhập điểm Toán',
            'greater_than_equal_to'=> 'Bạn hãy nhập điểm từ "0"'
        ],
        "chemistry_score" => [
            'required' => 'Bạn bạn chưa nhập điểm Hóa',
        ],
        "physics_score" => [
            'required' => 'Bạn chưa nhập điểm Lý',
        ],
    ];
}
