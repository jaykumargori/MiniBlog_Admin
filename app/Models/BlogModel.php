<?php
namespace App\Models;
use CodeIgniter\Model;


class BlogModel extends Model{

    protected $table="articles";
    protected $allowedFields=['blog_id','blog_title','blog_description','blog_img'];

    
}


?>