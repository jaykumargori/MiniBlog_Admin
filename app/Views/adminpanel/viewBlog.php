<?php echo view('/adminpanel/header.php'); ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      
      <h2>View Blog</h2>

      <?php if(session()->getFlashdata('deleted')):?>
                    <div class="alert alert-success"><?= session()->getFlashdata('deleted') ?></div>
    <?php endif;?>

    <?php if(session()->getFlashdata('updated')):?>
                    <div class="alert alert-success"><?= session()->getFlashdata('updated') ?></div>
    <?php endif;?>

      <?php if(session()->getFlashdata('error')):?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif;?>

    <?php if(session()->getFlashdata('empty')):?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('empty') ?></div>
    <?php endif;?>
      

      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>Sr No.</th>
              <th>Title</th>
              <th>Description</th>
              <th>Image</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>

          <?php

            if($result)
            {
              $counter=1;
              foreach ($result as $key=> $value )
              {
               echo " <tr>
                      <td>".$counter."</td>
                      <td>".$value['blog_title']."</td>
                      <td>".$value['blog_description']."</td>
                      <td><img src=".base_url().$value['blog_img']." class='img-fluid' width='150' height='100'></img></td>
                      <td><a class=\"btn btn-info\" href='" .site_url('admin/BlogController/editBlog/'.$value['blog_id']). "'>Edit</a></td>
                      <td><a class=\"btn delete btn-danger\" href='".site_url('admin/BlogController/deleteBlog/'.$value['blog_id'])."'>Delete</a></td>
                      </tr> ";
                $counter ++;

              }
            }
            else{
              #start session
              $session=session();

              $session->setFlashdata('empty','You do not have any blogs to display.');
              return redirect()->to(site_url('admin/BlogController'));

            }
          
          ?> 
          </tbody>
        </table>
      </div>

      
    </main>
  </div>
</div>
 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  

<!-- <script type="text/javascript">
        $(".delete").click(function(){

          var delete_id=$(this).attr('data-id');

          var bool=confirm("Are you sure you want to delete the blog ?");

          if(bool)
          {
            $.ajax({

              url:'<?= base_url().'/admin/BlogController/deleteBlog' ?>',
              type:'post',
              data:{'delete_id':delete_id},
              success: function(response){

                console.log(response);

              }



            });
          }

        });
      
</script> -->

    

    
  </body>
</html>