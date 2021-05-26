<?php
namespace App\Models;
use CodeIgniter\Model;


class LoginModel extends Model{

    protected $table="backendusers";
    protected $allowedField=['uid','_username','_password',];
}


?>
