<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class BlogReplies extends CI_Controller {
function __construct()
    {
        parent::__construct();
        $this->load->database();             	
    }
public function index()
	{
		$getData = $this->Common_model->getRBlog();
		$data = array("BlogRepliesData"=>$getData);
		$this->load->view('blogReply/list',$data);
	}
	
public function Cresourses($replyId)
	{
		$data = array(
				'action' =>site_url('BlogReplies/CresoursesAction'),
				'button'=>'Create',
				'heading'=>'Create Blog Resourse',
				'blog_resourses_resourse_url'=>set_value('blog_resourses_resourse_url'),
				'blog_resources_comment'=>set_value('blog_resources_comment'),
				'blog_resourses_post_id' => set_value('blog_resourses_post_id'),
				'blog_resources_reply_id' =>set_value('blog_resources_reply_id',$replyId),
	    		'error' =>'');
		$this->load->view('blogReply/form',$data);
	}
public function CresoursesAction()
{
	if(!empty($_POST['blog_resources_resource_url']))
	{
		$arrayData = array('blog_resources_resource_url' =>$this->input->post('blog_resources_resource_url'),'blog_resources_comment'=>$this->input->post('blog_resources_comment'),'blog_resources_reply_id'=>$this->input->post('blog_resources_reply_id'));
		$this->Common_model->save('blog_resources',$arrayData);
		redirect('BlogResourses/index');
	}
	else{
		redirect('BlogReplies/index');
	}
}
}