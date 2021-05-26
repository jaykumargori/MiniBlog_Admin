

<?php echo view('/adminpanel/header.php'); ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

    <h2>Edit Blog</h2>
     
    <?php if(session()->getFlashdata('imageError')):?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('imageError') ?></div>
    <?php endif;?>

    <?php if(session()->getFlashdata('updateError')):?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('updateError') ?></div>
    <?php endif;?>

    <form enctype="multipart/form-data" action=<?= site_url('admin/BlogController/editBlog_post/'.$result['blog_id']) ?>  method='post'>

        <div class="form-group">
            <input type="text" value="<?= $result['blog_title'] ?>" class="form-control" name="blog_title" placeholder="Title" >
        
        </div>

        <div class="form-group">
            <textarea class="form-control" name="blog_desc" placeholder="Description" ><?= $result['blog_description'] ?></textarea>
        
        </div>

        <div class="form-group">
        <img src="<?= base_url().$result['blog_img'] ?>" class='img-fluid' width='500' ></img>
            <input type="file" class="form-control"  name="file" placeholder="Image" >
        
        </div>

        <button type="submit" class="btn btn-primary">Update Blog</button> 
    
    
    </form>
      

      
    </main>
  </div>
</div>

    

    
  </body>
</html>