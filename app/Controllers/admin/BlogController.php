<?php
namespace App\Controllers\admin;
use App\Models\BlogModel;
use CodeIgniter\Controller;

class BlogController extends Controller{
    

    public function index(){

        
        #initialize model;
        $model=new BlogModel();
    
        
        $data['result']=$model->findAll();
        
        //echo '<pre>';
        //print_r($data);

        return view('adminpanel/viewBlog',$data);
    }

    public function addBlog(){

        return view('adminpanel/addBlog');
    }

    public function addBlog_Post()
    {

        #start session
        $session=session();

    
        #initialize model;
        $model=new BlogModel();
    


        #check if the valūes are posted from form or not
    
    
        #store blog details in variable
        $blog_title=$this->request->getVar('blog_title');
        $blog_desc=$this->request->getVar('blog_desc');

        #check whether title and desc are not blank
        if($blog_title && $blog_desc != null)
        {

            #if they are not validate the image 
            $image=$this->validate([
            'file'=>'uploaded[file]', 
            'mime_in[file,image/jpg,image/jpeg,image/png]',
            
            ]);

            #if image is not found error is shown
            if(!$image)
            {
                $session->setFlashdata('error','Please upload an image.');
                return redirect()->to(site_url('admin/BlogController/addBlog'));

            }
            #else file is stored in the server and filedetails are stored in an array
            else
            {
                #storing image into storage
                $img=$this->request->getFile('file');
                $img_name=$img->getRandomName();
                $img->move('uploads',$img_name);

                #storing image details into an array
                $data = [
                    'name' =>  $img_name,
                    'type'  => $img->getClientMimeType()
                ];
            
                #storing image name with full path
                $blog_img="/uploads"."/".$data['name'];

                #storing blog data into an array to insert it in database
                $insertData=[
                    'blog_title'=>$blog_title,
                    'blog_description'=>$blog_desc,
                    'blog_img'=>$blog_img
                ];

                #insertion of data into database using model
                $model->insert($insertData);

                #insertion successful and redirecting to same page with notification
                $session->setFlashdata('inserted','Blog added successfully. ');

                return redirect()->to(site_url('admin/BlogController/addBlog'));  
            }
        }
        #values not entered in form will give redirect on same page with error
        else
        {
            $session->setFlashdata('error','Please enter blog details. ');

            return redirect()->to(site_url('admin/BlogController/addBlog'));
        }


    }

    #edit blog
    public function editBlog($edit_id)
    {
        #start session
        $session=session();
        
        $model=new BlogModel();
 
        $id=$edit_id;
         
        $data['result']=$model->where('blog_id',$id)->first();

        return view('adminpanel/editBlog',$data);

    }

    public function editBlog_post($editPost_id)
    {
       #start session
       $session=session();

    
       #initialize model;
       $model=new BlogModel();
   


       #check if the valūes are posted from form or not
   
   
       #store blog details in variable
       $blog_title=$this->request->getVar('blog_title');
       $blog_desc=$this->request->getVar('blog_desc');

       #check whether title and desc are not blank
       if($blog_title && $blog_desc != null)
       {

           #if they are not validate the image 
           $image=$this->validate([
           'file'=>'uploaded[file]', 
           'mime_in[file,image/jpg,image/jpeg,image/png]',
           
           ]);

           #if image is not found error is shown
           if(!$image)
           {
               $session->setFlashdata('imageError','Please upload an image.');
               return redirect()->to(site_url('admin/BlogController/editBlog/'.$editPost_id));

           }
           #else file is stored in the server and filedetails are stored in an array
           else
           {
               #storing image into storage
               $img=$this->request->getFile('file');
               $img_name=$img->getRandomName();
               $img->move('uploads',$img_name);

               #storing image details into an array
               $data = [
                   'name' =>  $img_name,
                   'type'  => $img->getClientMimeType()
               ];
           
               #storing image name with full path
               $blog_img="/uploads"."/".$data['name'];

               #storing blog data into an array to insert it in database
               $insertData=[
                   'blog_title'=>$blog_title,
                   'blog_description'=>$blog_desc,
                   'blog_img'=>$blog_img
               ];

               $id=$editPost_id;

               #insertion of data into database using model
               $model->save($insertData);

               #insertion successful and redirecting to same page with notification
               $session->setFlashdata('updated','Blog updated succesfully successfully. ');

               return redirect()->to(site_url('admin/BlogController'));  
           }
       }
       #values not entered in form will give redirect on same page with error
       else
       {
           $session->setFlashdata('updateError','Please enter blog details. ');

           return redirect()->to(site_url('admin/BlogController/editBlog/'.$editPost_id));
       }

    }

    #delete blog
    public function deleteBlog($delete_id)
    {
        #start session
        $session=session();
        
        $model=new BlogModel();

        $id=$delete_id;
        
        $response=$model->where('blog_id',$id);
        $response=$model->delete();
        
        if($response==true)
        {
            $session->setFlashdata('deleted','Blog Deleted Successfully');
            return $this->response->redirect(site_url('/admin/BlogController'));
        }
        else{
            $session->setFlashdata('error','Server error');

            return redirect()->to(site_url('admin/BlogController'));

        }



    }
}

?>