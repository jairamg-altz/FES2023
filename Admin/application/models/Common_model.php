<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Common_model extends CI_Model
{
    public $table = 'users_details';
    public $id = 'uuid';
    public $order = 'DESC';
    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }


    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($table,$cond)
    {
        $this->db->where($cond);
        $this->db->delete($table);
    }

    // get all
    function get_all_with_cond($table,$cond)
    {
        $this->db->where($cond);
        return $this->db->get($table)->result();
    }

    // get single
    function get_single_with_cond($table,$cond)
    {
        $this->db->where($cond);
        return $this->db->get($table)->row();
    }

   
   // Insert Update data
    function save($table,$data,$cond='')
    {
        
        if($cond=='')
        { 
            $this->db->insert($table, $data); 
        }
        if(!empty($cond))
        {
            
            $this->db->where($cond);
            $this->db->update($table, $data);
        }

    }    

    //get data 
     function getData($table,$type='',$cond='',$order='',$groupBy='',$limit='')
    {
       
        if(!empty($cond)){ $this->db->where($cond);}
        if(!empty($order)){ $this->db->order_by($order);}  
        if(!empty($groupBy)){ $this->db->group_by($groupBy);}
        if(!empty($limit)){ $this->db->limit($limit, $start);}
        if($type==''){ return $this->db->get($table)->result(); } else { return $this->db->get($table)->row();}
           
    }

     public function chk_duplication($tblname, $condition)
   {
        $this->db->where($condition);
        return $this->db->get($tblname)->row();
   }
   
   public function getFeedbacks($cond){
    $this->db->select("feedbacks.*,u.first_name,u.middle_name,u.last_name");
    $this->db->from('feedbacks');
    $this->db->join('users_details u', 'u.user_uuid = feedbacks.created_by', 'inner');
     $this->db->where($cond);
    //$this->db->order_by("feedbacks.id",'ASC');
    $query = $this->db->get();
        return $query->result();
   }
 public function getFeedbackResponse($cond){
    $this->db->select("u.first_name,u.middle_name,u.last_name,r.*");
    $this->db->from('feedbacks');
    $this->db->join('responses r', 'r.feedback_uuid = feedbacks.feedback_id', 'inner');
    $this->db->join('users_details u', 'u.user_uuid = r.created_by', 'inner');
     $this->db->where($cond);
    $this->db->order_by("feedbacks.feedback_id",'ASC');
    $query = $this->db->get();
        return $query->result();
   }

 public function getProjectMap(){
    $this->db->select("u.first_name,u.middle_name,u.last_name,pm.*,p.project_name");
    $this->db->from('project_mapping pm');
    $this->db->join('project_details p', 'p.project_id = pm.project_id', 'inner');
    $this->db->join('users_details u', 'u.user_uuid = pm.user_id', 'inner');
    // $this->db->where($cond);
    //$this->db->order_by("feedbacks.id",'ASC');
    $query = $this->db->get();
        return $query->result();
   }    
  public function getProjectCol(){
    $this->db->select("pc.*,p.project_name");
    $this->db->from('project_column pc');
    $this->db->join('project_details p', 'p.project_id = pc.project_id', 'inner');
    //$this->db->join('users_details u', 'u.user_uuid = pm.user_id', 'inner');
    // $this->db->where($cond);
    //$this->db->order_by("feedbacks.id",'ASC');
    $query = $this->db->get();
        return $query->result();
   }
   public function getProjectVal(){
    $this->db->select("pv.*,p.project_name");
    $this->db->from('project_values pv');
    $this->db->join('project_details p', 'p.project_id = pv.project_id', 'inner');
    //$this->db->join('users_details u', 'u.user_uuid = pm.user_id', 'inner');
    // $this->db->where($cond);
    //$this->db->order_by("feedbacks.id",'ASC');
    $query = $this->db->get();
        return $query->result();
   }
 public function getBlog(){
    $this->db->select("b.*,u.first_name,u.middle_name,u.last_name");
    $this->db->from('blogs b');
    $this->db->join('users_details u', 'u.user_uuid = b.blog_post_by', 'inner');
    $this->db->where('b.is_deleted','No');
    //$this->db->order_by("feedbacks.id",'ASC');
    $query = $this->db->get();
    return $query->result();
   }
   public function getBlogReply($cond){
    $this->db->select("b.blog_title,b.blog_body,b.blog_is_question,u.first_name,u.middle_name,u.last_name,br.*");
    $this->db->from('blogs b');
    $this->db->join('blog_replies br', 'br.reply_post_id = b.blogpost_id', 'inner');
    $this->db->join('users_details u', 'u.user_uuid = br.user_id', 'inner');
    $this->db->where($cond);
    $this->db->order_by("br.blog_answer_reply_id",'ASC');
    $query = $this->db->get();
    return $query->result();
   }
public function getRBlog(){
    $this->db->select("b.blog_title,b.blog_body,b.blog_is_question,u.first_name,u.middle_name,u.last_name,br.*");
    $this->db->from('blog_replies br');
    $this->db->join('blogs b', 'b.blogpost_id  = br.reply_post_id', 'inner');
    $this->db->join('users_details u', 'u.user_uuid = br.user_id', 'inner');
    //$this->db->where($cond);
    $this->db->order_by("br.blog_answer_reply_id",'ASC');
    $query = $this->db->get();
    return $query->result();
   }
public function getResourseReply(){
    $this->db->select("b.blog_title,br.blog_answer_body,brs.*");
    $this->db->from('blog_resources brs');
    $this->db->join('blog_replies br', 'br.blog_answer_reply_id = brs.blog_resources_reply_id', 'inner');
    $this->db->join('blogs b', 'b.blogpost_id = br.reply_post_id', 'inner');    
    //$this->db->join('users_details u', 'u.user_uuid = br.user_id', 'inner');
    //$this->db->where($cond);
    //$this->db->order_by("br.blog_answer_reply_id",'ASC');
    $query = $this->db->get();
    return $query->result();
   }
public function getLikes(){
    $this->db->select("br.blog_answer_body,l.*,u.first_name,u.middle_name,u.last_name");
    $this->db->from('likes l');
    $this->db->join('blog_replies br', 'br.blog_answer_reply_id = l.reply_id', 'inner');
    $this->db->join('users_details u', 'u.user_uuid = br.user_id', 'inner');
    //$this->db->where($cond);
    $this->db->order_by("l.post_id",'DESC');
    $query = $this->db->get();
    return $query->result();
   }
public function getTags(){
    $this->db->select("b.blog_title,t.*");
    $this->db->from('tags t');
    $this->db->join('blogs b', 'b.blogpost_id = t.post_id', 'inner');    
    //$this->db->join('users_details u', 'u.user_uuid = br.user_id', 'inner');
    //$this->db->where($cond);
    $this->db->order_by("t.tag_id",'DESC');
    $query = $this->db->get();
    return $query->result();
   }
public function getDiscussionForum(){
    $this->db->select("d.*,u.first_name,u.middle_name,u.last_name");
    $this->db->from('discussions d');
    $this->db->join('users_details u', 'u.user_uuid = d.created_by', 'inner');
    //$this->db->where($cond);
    //$this->db->order_by("t.tag_id",'DESC');
    $query = $this->db->get();
    return $query->result();
   }
public function getDRData(){
    $this->db->select("dr.*,u.first_name,u.middle_name,u.last_name,d.created_by,d.text_msg as forum");
    $this->db->from('discussion_responses dr');
    $this->db->join('discussions d', 'd.forum_id = dr.discussion_foroum_id', 'inner');
    $this->db->join('users_details u', 'u.user_uuid = d.created_by', 'inner');
    //$this->db->where($cond);
    //$this->db->order_by("t.tag_id",'DESC');
    $query = $this->db->get();
    return $query->result();
   } 
public function getspType(){
    $this->db->select("st.*,sm.*");
    $this->db->from('species_type st');
    $this->db->join('species_master sm', 'sm.species_master_id = st.species_master_id', 'inner');
    //$this->db->join('users_details u', 'u.user_uuid = d.created_by', 'inner');
    //$this->db->where($cond);
    //$this->db->order_by("t.tag_id",'DESC');
    $query = $this->db->get();
    return $query->result();
   }
public function getDuploadsData(){
    $this->db->select("du.*,u.first_name,u.last_name,u.data_upload_status");
    $this->db->from('data_uploads du');
    $this->db->join('users_details u', 'u.user_uuid = du.user_id', 'inner');
    //$this->db->where($cond);
    //$this->db->order_by("t.tag_id",'DESC');
    $query = $this->db->get();
    return $query->result();
   } 
public function getMaxData(){
    $this->db->select("MAX(dynamic_reward_weightage_to) as breward");
    $this->db->from('dynamic_reward_weightages');
    //$this->db->where($cond);
    //$this->db->order_by("t.tag_id",'DESC');
    $query = $this->db->get();
    return $query->row();
   }
public function getDistric($table)
{
    $this->db->distinct();
    $this->db->select('category');
    //$this->db->where('record', $record);
    $query = $this->db->get($table);
    return $query->result();
}                                 
}