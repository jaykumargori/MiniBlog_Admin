<?php  
namespace App\Controllers\admin;
use App\Models\LoginModel;
use CodeIgniter\Controller;


class LoginController extends Controller{

    

    

    public function index(){

        

        helper(['form']);
        return view('adminpanel/Login');
    }


    #Login
    function login(){

        #start session
        $session=session();

        #initialize model;
        $model=new LoginModel();

        

        #store values from form
        $username=$this->request->getVar('username');
        $password=$this->request->getVar('password');

        #validation
        #search for data in the database with $username and store the first row of results
        $searchedData=$model->where('_username',$username)->first();

        #if username is matched verify the password
        if($searchedData)
        {
            #store password from searched data into var
            $pass=$searchedData['_password'];

            

            #if password verified store the searched data as session data
            if($pass==$password)
            {
                $ses_data=[
                    'uid'=>$searchedData['uid'],
                    '_username'=>$searchedData['_username'],
                    '_password'=>$searchedData['_password'],
                    'logged_in'=> TRUE,

                ];

                #set the session data
                $session->set($ses_data);

                #return to dashboard
                return redirect()->to(site_url('admin/DashboardController'));
            }
            else
            {
                #password is wrong
                $session->setFlashdata('msg','Wrong Password');
                return redirect()->to(site_url('admin/LoginController'));
            }
        }
        else
        {
            #email not found
            $session->setFlashdata('msg','Invalid Email');
            return redirect()->to(site_url('admin/LoginController'));
        }
   
    }

    #Logout
    public function logout(){

        #intialize and destroy session
        $session=session();
        $session->destroy();

        #Redirect to Login
        return redirect()->to(site_url('admin/LoginController'));
    }
}


?>