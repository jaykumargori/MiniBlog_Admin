<?php

namespace App\Controllers\admin;
use CodeIgniter\Controller;

class DashboardController extends Controller {

    public function index(){

        #initialize session
        $session=session();
        $session->get('_username');
        

        return view('adminpanel/Dashboard');

    }
}


?>