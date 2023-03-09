<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Blogs extends CI_Controller {
	 function __construct()
    {
        parent::__construct();
        $this->load->database();       	       	
    }

public function index()
	{
		$getData = $this->Common_model->getBlog();
		$data = array("BlogData"=>$getData);
		$this->load->view('blog/list',$data);
	}
	
public function create()
	{
		$data = array(
				'action' =>site_url('Blogs/create_action'),
				'button'=>'Create',
				'heading'=>'Create Blog',
				'blog_title'=>set_value('blog_title'),
				'blog_body'=>set_value('blog_body'),
				'blog_is_question'=>set_value('blog_is_question'),'is_blog_public'=>set_value('is_blog_public'),
				'blogpost_id' => set_value('blogpost_id'),
	    		'error' =>'');
		$this->load->view('blog/form',$data);
	}

public function create_action()
	{
		$data = array("blog_title"=>$this->input->post('blog_title'),
							"blog_body"=>$this->input->post('blog_body'),
							"blog_is_question"=>$this->input->post('blog_is_question'),
							"is_blog_public"=>$this->input->post('is_blog_public'),
							"blog_post_by"=>$_SESSION['FES_admin']['user_uuid'],	
							"blog_post_timestamp"=>date('Y-m-d'),"is_deleted"=>'No');
                    		$this->Common_model->save('blogs',$data);                    		
                    		$this->session->set_flashdata('message',"Record has been created successfully");
                    		redirect('Blogs/index');		              				
	}

public function update($blogpost_id)
	{
		$row= $this->Common_model->getData("blogs","1","blogpost_id='".$blogpost_id."'");	
		$data = array(
		'button'=>'Update',
		'heading'=>'Update Blog',
		'action'=>site_url('Blogs/update_action'),
		'blogpost_id' => set_value('blogpost_id', $row->blogpost_id),
		'blog_title' => set_value('blog_title', $row->blog_title),
		'blog_body' => set_value('blog_body', $row->blog_body),
		'blog_is_question' => set_value('blog_is_question', $row->blog_is_question),'is_blog_public' => set_value('is_blog_public', $row->is_blog_public),
		'error' =>'');
		$this->load->view('blog/form',$data);
	}

public function update_action()
	{
		
			$row= $this->Common_model->getData("blogs","1","blogpost_id='".$_POST['blogpost_id']."'");
			$data = array("blog_title"=>$this->input->post('blog_title'),
	                      "blog_body"=>$this->input->post('blog_body'),
	                      "blog_is_question"=>$this->input->post('blog_is_question'),"is_blog_public"=>$this->input->post('is_blog_public'),
	                      "modified_by"=>$_SESSION['FES_admin']['user_uuid'],
						  "modified_date"=>date('Y-m-d'));
	                	$this->Common_model->save('blogs',$data,"blogpost_id='".$row->blogpost_id."'");
						$this->session->set_flashdata('message',"Record has been updated successfully");
	        			redirect('Blogs/index');				
}

public function reply($blogpost_id)
	{
		$cond = "b.blogpost_id='".$blogpost_id."'";
		$getData = $this->Common_model->getBlogReply($cond);
		$data = array("BlogRData"=>$getData,'blogpost_id'=>$blogpost_id);
		$this->load->view('blog/rlist',$data);
	}

public function Rcreate($blogpost_id)
	{
		$row= $this->Common_model->getData("blogs","1","blogpost_id='".$blogpost_id."'");
		//print_r($row->blogpost_id);exit;
		$data = array(
				'action' =>site_url('Blogs/reply_action'),
				'button'=>'Create',
				'heading'=>'Blog Reply',
				'blogpost_id' => set_value('blogpost_id', $blogpost_id),
				'blog_title' => set_value('blog_title', $row->blog_title),
				'blog_body' => set_value('blog_body', $row->blog_body),
				'blog_is_question' => set_value('blog_is_question', $row->blog_is_question),
				'is_blog_public'=>set_value('is_blog_public',$row->is_blog_public),
				'blog_answer_body'=>set_value('blog_answer_body'),
				'blog_answer_reply_id' => set_value('blog_answer_reply_id'),
	    		'error' =>'');
		$this->load->view('blog/rform',$data);
	}

public function reply_action()
	{
		$blogpost_id = $this->input->post('blogpost_id');
		$timestamp = time();
		$data = array("blog_answer_body"=>$this->input->post('blog_answer_body'),"reply_post_id"=>$blogpost_id,
							"user_id"=>$_SESSION['FES_admin']['user_uuid'],"reply_timestamp"=>date('Y-m-d H:i:s'));
                    		$this->Common_model->save('blog_replies',$data);                    		
                    		$this->session->set_flashdata('message',"Record has been created successfully");
                    		redirect('Blogs/reply/'.$blogpost_id);		              				
	}	
// Delete Functionality  
public function delete($blogpost_id)
	{
		if($blogpost_id)
		{
			$data = array("is_deleted"=>'Yes',"deleted_date"=>date('Y-m-d'),"deleted_by"=>$_SESSION['FES_admin']['user_uuid']);
			$this->Common_model->save("blogs",$data,"blogpost_id='".$blogpost_id."'");
			$this->session->set_flashdata('message',"Record has been deleted successfully");
        	redirect('Blogs/index');
		}
		else
		{
			$this->session->set_flashdata('message',"<span style='color:red'>No record found</span>");
        	redirect('Blogs/index');
		}
	}
}