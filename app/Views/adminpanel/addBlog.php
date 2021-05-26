<?php echo view('/adminpanel/header.php'); ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

    <h2>Add Blog</h2>

    <?php if(session()->getFlashdata('inserted')):?>
                    <div class="alert alert-success"><?= session()->getFlashdata('inserted') ?></div>
    <?php endif;?>

    <?php if(session()->getFlashdata('error')):?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif;?>

    <form enctype="multipart/form-data" action="<?php echo site_url('admin/BlogController/addBlog_Post') ?>"  method='post'>

        <div class="form-group">
            <input type="text" class="form-control" name="blog_title" placeholder="Title" >
        
        </div>

        <div class="form-group">
            <textarea class="form-control" name="blog_desc" placeholder="Description" ></textarea>
        
        </div>

        <div class="form-group">
            <input type="file" class="form-control" name="file" placeholder="Image" >
        
        </div>

        <button type="submit" class="btn btn-primary">Add Blog</button> 
    
    
    </form>
      

      
    </main>
  </div>
</div>

    

    
  </body>
</html>