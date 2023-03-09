<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/css/a09forumcreatepost.css" />
<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/css/fstyleguide.css" />
 <body style="margin: 0; background: #ffffff">
  <?php $this->load->view('common/header'); ?>
    <input type="hidden" id="anPageName" name="page" value="a09forumcreatepost" />
    <div class="container-center-horizontal">
      <div class="a09forumcreatepost screen">
        <div class="overlap-group6">
        </div>
        <div class="overlap-group10">
          <div class="create-post poppins-bold-white-48px">Reply Post</div>
          <div class="name-copy circularstd-medium-white-24px">
            Share your ideas, finding, or questions <br />with the community.
          </div>
        </div>
        <div class="overlap-group9">
          <div class="overlap-group5">
            <div class="overlap-group8">
              <div class="sub-menu">
                <div class="flex-row-2">
                  <a href="<?= site_url('Forum/index');?>"><div class="feed poppins-normal-cod-gray-18px">Feed</div></a>
                  <div class="categories poppins-normal-cod-gray-18px">Categories</div>
                  <a href="<?= site_url('Forum/CreatePost');?>"><div class="my-posts poppins-normal-cod-gray-18px">My Posts</div></a>
                  <div class="compose poppins-bold-cod-gray-18px">Compose</div>
                </div>
                <img class="line-1" src="<?= base_url()?>assets/img/forum/09forumdesktop-line-416F1AD7-4AD4-4753-A9EF-CC2DB03F5B90.png" />
              </div>
              <img
                class="rectangle-1"
                src="<?= base_url()?>assets/img/forum/09forumcreate-post-rectangle-1015A9DE-D589-43B0-BAB3-BEB5A2CCB862@2x.png"
              />
            </div>
            <div class="flex-row-3">
              <div class="overlap-group7">
               <form action="<?= site_url('Forum/replyAction');?>">
  <!-- <div class="mb-3">
    <label for="exampleInputtext" class="form-label"><h4>Title</h4></label>
    <input type="text" class="form-control"  placeholder="Enter Title" name="title">
    
  </div> -->
  <input type="hidden" name="discussion_id" value="<?= $postId;?>">
  <div class="mb-3">
    <label for="exampleInputDescription" class="form-label"><h4>Description</h4></label>
    <textarea class="form-control" rows="20" cols="50" name="desc"></textarea>
  </div>
  <!-- <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div> -->
  <div class="group-2"><div class="publish"><button class="btn btn-primary">PUBLISH</button></div></div>
</form>       
</div>              
          </div>
          <p class="x01-be-respectful-to poppins-medium-black-14px">
            01. Be Respectful to others.<br />02. Lorem Ipsum.<br />03. Doler sit amet coniscure.<br />04. The post will
            be publicly visible on IBIS.<br />05. Others users can Like, Comment and Share<br />your posts.
          </p>
        </div>
      </div>
    </div>    
<?php $this->load->view('common/footer'); ?>
  </body>