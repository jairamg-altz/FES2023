<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Crud_model extends CI_Model {
function __construct()
{
    parent::__construct();
    $this->load->database();
}
public function GetData($table, $field = '', $condition = '', $group = '', $order = '', $limit = '', $result = '')
    {
        if ($field != '')
            $this->db->select($field);
        if ($condition != '')
            $this->db->where($condition);
        if ($order != '')
            $this->db->order_by($order);
        if ($limit != '')
            $this->db->limit($limit);
        if ($group != '')
            $this->db->group_by($group);
        if ($result != '') {
            $return =  $this->db->get($table)->row();
        } else {
            $return =  $this->db->get($table)->result();
        }
        return $return;
    }
    public function GetDataArr($table, $field = '', $condition = '', $group = '', $order = '', $limit = '', $result = '')
    {
        if ($field != '')
            $this->db->select($field);
        if ($condition != '')
            $this->db->where($condition);
        if ($order != '')
            $this->db->order_by($order);
        if ($limit != '')
            $this->db->limit($limit);
        if ($group != '')
            $this->db->group_by($group);
        if ($result != '') {
            $return =  $this->db->get($table)->row_array();
        } else {
            $return =  $this->db->get($table)->result_array();
        }
        return $return;
    }
    public function SaveData($table,$data,$condition='')
    {
        $DataArray = array();
        if(!empty($data))
        {
            if(empty($condition))
            {
                $data['created']=date("Y-m-d H:i:s");
                $data['modified']=date("Y-m-d H:i:s");
            } else {
                $data['modified']=date("Y-m-d H:i:s");
            }
        }
        $table_fields = $this->db->list_fields($table);
        foreach($data as $field=>$value)
        {
            if(in_array($field,$table_fields))
            {
                $DataArray[$field]= $value;
            }
        }
       
        if($condition != '')
        {
            $this->db->where($condition);
            $this->db->update($table, $DataArray);
         
        }else{
            $this->db->insert($table, $DataArray);
        }
    }

    public function DeleteData($table, $condition = '', $limit = '')
    {
        if ($condition != '')
            $this->db->where($condition);
        if ($limit != '')
            $this->db->limit($limit);
        $this->db->delete($table);
    }
    function GetSingleData($table, $field = '', $cond = '')
    {
        if ($field != '')
            $this->db->select($field);
        if ($cond != '')
            $this->db->where($cond);
        return $this->db->get($table)->row();
    }
    function GetSingleDataArr($table, $field = '', $cond = '')
    {
        if ($field != '')
            $this->db->select($field);
        if ($cond != '')
            $this->db->where($cond);
        return $this->db->get($table)->row_array();
    }
    public function save($table,$data,$cond='')
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
public function projectList($cond)
{
    $this->db->select("pd.*,pm.access");
    $this->db->from('project_details pd');
    $this->db->join('project_mapping pm', 'pm.project_id = pd.project_id', 'inner');
    $this->db->where($cond);
    //$this->db->order_by("t.tag_id",'DESC');
    $query = $this->db->get();
    return $query->result();
}
public function projectSList($cond)
{
    $this->db->select("pd.*,pm.access");
    $this->db->from('project_details pd');
    $this->db->join('project_mapping pm', 'pm.project_id = pd.project_id', 'inner');
    $this->db->where($cond);
    //$this->db->order_by("t.tag_id",'DESC');
    $query = $this->db->get();
    return $query->row();
}
public function blogList()
{
    $this->db->select("b.*,u.first_name,u.last_name,u.profileimage_id");
    $this->db->from('blogs b');
    $this->db->join('users_details u', 'u.user_uuid = b.blog_post_by', 'inner');
    $this->db->where("u.role!='Admin'");
    $this->db->order_by("b.blog_post_timestamp",'DESC');
    $query = $this->db->get();
    return $query->result();
}    
public function blogListToID($cond)
{
    $this->db->select("b.*,u.first_name,u.last_name,u.profileimage_id");
    $this->db->from('blogs b');
    $this->db->join('users_details u', 'u.user_uuid = b.blog_post_by', 'inner');
    $this->db->where($cond);
    //$this->db->order_by("t.tag_id",'DESC');
    $query = $this->db->get();
    return $query->row();
}
public function Forom()
{
    $this->db->select("d.*,u.first_name,u.last_name,u.profileimage_id,u.user_uuid");
    $this->db->from('discussions d');
    $this->db->join('users_details u', 'u.user_uuid = d.created_by', 'inner');
    //$this->db->where($cond);
    $this->db->order_by("d.date_time",'DESC');
    $query = $this->db->get();
    return $query->result();
}
public function CatForom($cond)
{
    $this->db->select("d.*,u.first_name,u.last_name,u.profileimage_id,u.user_uuid");
    $this->db->from('discussions d');
    $this->db->join('users_details u', 'u.user_uuid = d.created_by', 'inner');
    $this->db->where($cond);
    $this->db->order_by("d.date_time",'DESC');
    $query = $this->db->get();
    return $query->result();
}
public function ForomS()
{
    $this->db->select("d.*,u.first_name,u.last_name,u.profileimage_id,u.user_uuid");
    $this->db->from('discussions d');
    $this->db->join('users_details u', 'u.user_uuid = d.created_by', 'inner');
    $this->db->where("u.user_uuid='".$_SESSION[SESSION_NAME]['user_uuid']."'");
    $this->db->order_by("d.date_time",'DESC');
    $query = $this->db->get();
    return $query->result();
}
public function ForomDetail($cond)
{
    $this->db->select("d.*,u.first_name,u.last_name,u.profileimage_id,u.user_uuid");
    $this->db->from('discussions d');
    $this->db->join('users_details u', 'u.user_uuid = d.created_by', 'inner');
    $this->db->where($cond);
    //$this->db->order_by("t.tag_id",'DESC');
    $query = $this->db->get();
    return $query->row();
}
public function GetPCInput($pcond)
{
    $this->db->select("pc.*");
    $this->db->from('project_column pc');
    $this->db->join('project_column_masters pcm', 'pcm.attribute_name != pc.attribute_name', 'inner');
    $this->db->where($pcond);
    //$this->db->order_by("t.tag_id",'DESC');
    $query = $this->db->get();
    return $query->result();
}
public function getLatestObj($Ocond)
{
    $this->db->select("os.observation_id,rl.file_uri as url,ud.first_name,ud.last_name,ud.profileimage_id,ud.user_uuid,t.scientific_name,l.decimal_latitude,l.decimal_longitude,os.checklist_id,l.geo_privacy");
    $this->db->from('observation os');
    $this->db->join('taxon t', 't.observation_id = os.observation_id', 'inner');
    $this->db->join('location l', 'l.observation_id = os.observation_id', 'inner');
    $this->db->join('record_level rl', 'rl.observation_id = os.observation_id', 'inner');
    $this->db->join('users_details ud', 'ud.user_uuid = os.created_by', 'inner');
    $this->db->where($Ocond);
    $this->db->order_by("os.date_time",'DESC');
    $query = $this->db->get();
    return $query->row();
}
public function getLatestObjList($Lcond)
{
    $this->db->select("os.observation_id,rl.file_uri as url,ud.first_name,ud.last_name,ud.profileimage_id,ud.user_uuid,t.vernacular_name,t.scientific_name,l.decimal_latitude,l.decimal_longitude,l.geo_privacy,oc.recorded_by,oc.individual_count");
    $this->db->from('observation os');
    $this->db->join('occurence oc', 'oc.observation_id = os.observation_id', 'inner');
    $this->db->join('taxon t', 't.observation_id = os.observation_id', 'inner');
    $this->db->join('location l', 'l.observation_id = os.observation_id', 'inner');
    $this->db->join('record_level rl', 'rl.observation_id = os.observation_id', 'inner');
    $this->db->join('users_details ud', 'ud.user_uuid = os.created_by', 'inner');
    $this->db->where($Lcond);
    //$this->db->GROUP BY('os.observation_id');
    $this->db->order_by("os.date_time",'DESC');
    //
    $query = $this->db->get();
    return $query->result();
}

public function ForomDas()
{
    $this->db->select("d.*,u.first_name,u.last_name,u.profileimage_id,u.user_uuid");
    $this->db->from('discussions d');
    $this->db->join('users_details u', 'u.user_uuid = d.created_by', 'inner');
    $this->db->where("u.role!='Admin'");
    $this->db->order_by("d.date_time",'DESC');
    $query = $this->db->get();
    return $query->result();
}
public function Coxeprts()
{
    $this->db->select("c.*,u.first_name,u.last_name,u.profileimage_id,u.user_uuid");
    $this->db->from('coxs c');
    $this->db->join('users_details u', 'u.email = c.expert_email', 'inner');
    //$this->db->where($cond);
    //$this->db->order_by("t.tag_id",'DESC');
    $query = $this->db->get();
    return $query->result();
}
public function Lobservs()
{
    $this->db->select("o.*,rl.file_uri");
    $this->db->from('observation o');
    $this->db->join('record_level rl', 'rl.observation_id = o.observation_id', 'INNER JOIN');
    //$this->db->where($cond);
    $this->db->order_by("o.date_time",'DESC');
    //$this->db->group_by("rl.observation_id");
    $query = $this->db->get();
    return $query->result();
}
public function ForomReply($cond)
{
    $this->db->select("dr.*,u.first_name,u.last_name,u.profileimage_id,u.user_uuid");
    $this->db->from('discussion_responses dr');
    $this->db->join('users_details u', 'u.user_uuid = dr.created_by', 'inner');
    $this->db->where($cond);
    $this->db->order_by("dr.date_time",'DESC');
    $query = $this->db->get();
    return $query->result();
}
public function DBlogMedia()
{
    $this->db->select("bm.*,u.first_name,u.last_name,u.profileimage_id,u.user_uuid,b.blog_title,b.blog_body");
    $this->db->from('blog_medias bm');
    $this->db->join('blogs b', 'b.blogpost_id = bm.blog_id', 'inner');
    $this->db->join('users_details u', 'u.user_uuid = bm.created_by', 'inner');
    $this->db->where("bm.blog_activity='post' and bm.blog_media_type='image'");
    $this->db->order_by("bm.created_date_time",'DESC');
    $query = $this->db->get();
    return $query->result();
}

public function PFeedbacksDatas($cond)
    {
        $this->db->select('f.*,u.first_name,u.middle_name,u.last_name');    
        $this->db->from('feedbacks f');
        $this->db->join('users_details u','u.user_uuid = f.created_by','inner');
        $this->db->where($cond);
        return $this->db->get()->result();
    }
    public function PFeedbacksDatasD($cond)
    {
        $this->db->select('f.*,u.first_name,u.middle_name,u.last_name');    
        $this->db->from('feedbacks f');
        $this->db->join('users_details u','u.user_uuid = f.created_by','inner');
        $this->db->where($cond);
        return $this->db->get()->result();
    }
    public function PFeedbacksResponseD($cond)
    {
        $this->db->select('r.*,u.first_name,u.middle_name,u.last_name');    
        $this->db->from('feedbacks f');
        $this->db->join('responses r','r.feedback_uuid = f.feedback_id','inner');
        $this->db->join('users_details u','u.user_uuid = r.created_by','inner');
        $this->db->where($cond);
        return $this->db->get()->result();
    }

public function GetUserDetails($cond)
{
        $this->db->select('u.*,w.website_url,w.visibility');    
        $this->db->from('users_details u');
        $this->db->join('user_website w','w.user_uuid = u.user_uuid','inner');
        $this->db->where($cond);
        return $this->db->get()->row();
} 
public function GetActiveUser($Acond)
{
        $this->db->select('u.*');    
        $this->db->from("users_details u");
        $this->db->join("observation o",'o.created_by = u.user_uuid','inner');
        //$this->db->join("discussions d",'d.created_by = u.user_uuid','inner');
        //$this->db->join("blogs b",'b.blog_post_by = u.user_uuid','inner');
        $this->db->where($Acond);
        $this->db->group_by('u.user_uuid,u.user_uuid');
        return $this->db->get()->result();
}

public function GetMappingColumnM($cond)
{
        $this->db->select('pm.*,pc.*');    
        $this->db->from("project_mapping pm");
        $this->db->join("project_column pc",'pc.project_id = pm.project_id','inner');
        $this->db->where($cond);
    //$this->db->group_by('users_details.user_uuid,users_details.id');
        return $this->db->get()->result();
}      

public function GetProjectDetails()
{
        $this->db->select('p.*,pm.access');    
        $this->db->from("project_details p");
        $this->db->join("project_mapping pm",'pm.project_id = p.project_id','inner');
        //$this->db->where($cond);
    //$this->db->group_by('users_details.user_uuid,users_details.id');
        return $this->db->get()->result();
}

public function GetBlogData()
{
        $this->db->select('b.blogpost_id,b.blog_title as title,b.blog_body as body,b.blog_is_question as question,b.blog_post_timestamp as timestamp,b.is_blog_public as public,u.first_name,u.middle_name,u.last_name');
        $this->db->from("blogs b");
        $this->db->join("users_details u",'u.user_uuid = b.blog_post_by','inner');
        return $this->db->get()->result();
}

public function GetBlogReplyDetails()
{
        $this->db->select('b.blogpost_id,b.blog_title as title,b.blog_body as body,b.blog_is_question as question,b.blog_post_timestamp as timestamp,b.is_blog_public as public,br.blog_answer_body as answer,br.reply_timestamp as replyTimestamp,u.first_name as rfirstName,u.middle_name as rmiddleName,u.last_name as rlastName');    
        $this->db->from("blog_replies br");
        $this->db->join("blogs b",'b.blogpost_id = br.reply_post_id','inner');
        $this->db->join("users_details u",'u.user_uuid = br.user_id','inner');
        //$this->db->where($cond);
    //$this->db->group_by('users_details.user_uuid,users_details.id');
        return $this->db->get()->result();
}

public function GetReplyResourseDetails($cond)
{
        $this->db->select('rr.blog_resources_resource_url as resource_url,u.first_name as rfirstName,u.middle_name as rmiddleName,u.last_name as rlastName,rr.blog_resources_comment as comment');    
        $this->db->from("blog_resources rr");
        $this->db->join("users_details u",'u.user_uuid = rr.blog_resources_reply_user_uuid','inner');
        $this->db->where($cond);
    //$this->db->group_by('users_details.user_uuid,users_details.id');
        return $this->db->get()->result();
}

public function GetDiscussionForumDetails()
{
        $this->db->select('d.text_msg,d.date_time,d.subject,d.like_no,u.first_name,u.middle_name,u.last_name');    
        $this->db->from("discussions d");
        $this->db->join("users_details u",'u.user_uuid = d.created_by','inner');
        return $this->db->get()->result();
}

public function GetDiscussionForumRDetails()
{
        $this->db->select('d.text_msg,dr.text_msg as response_msg,dr.like_no,dr.datetime,u.first_name,u.middle_name,u.last_name');
        $this->db->from("discussion_responses dr");
        $this->db->join("discussions d",'d.forum_id = dr.discussion_foroum_id','inner');
        $this->db->join("users_details u",'u.user_uuid = d.created_by','inner');
        return $this->db->get()->result();
}
public function GetDataUplodCount($cond)
{
        $this->db->select('us.uploaded_records_count,us.uploaded_images_count');
        $this->db->from("data_attributes d");
        $this->db->join("upload_data_sessions us",'us.upload_session_id = d.upload_data_id','inner');
        $this->db->where($cond);
        return $this->db->get()->row();
}
function get_single_with_cond($table,$cond)
    {
        $this->db->where($cond);
        return $this->db->get($table)->row();
    }
public function GetobservationD($cond)
{
        $this->db->select('DISTINCT(o.observation_id),o.checklist_id,e.event_date,e.event_time,c.travelled_distance,c.party_count,c.observation_type,t.scientific_name,t.kingdom,t.phylum,t.class,t.order,t.family,t.subfamily,t.genus,oc.recorded_by,oc.individual_count,rl.dynamic_properties,o.created_by,o.need_id');
        $this->db->from("observation as o");
        $this->db->join("checklist as c",'c.checklist_id = o.checklist_id','inner');
        $this->db->join("record_level as rl",'rl.observation_id = o.observation_id','inner');
        $this->db->join("taxon as t",'t.observation_id = o.observation_id','inner');
        $this->db->join("occurence as oc",'oc.observation_id = o.observation_id','inner');
        $this->db->join("event as e",'e.observation_id = o.observation_id','inner');
        $this->db->join("location as l",'l.observation_id = o.observation_id','inner');
        $this->db->where($cond);
        return $this->db->get()->result();
}
public function GetImgScientD($cond)
{
        $this->db->select('t.scientific_name,b.m_sn,b.m_cn,file_uri');
        $this->db->from("bird_id_keys b");
        $this->db->join("taxon t",'t.scientific_name = b.m_sn','inner');
        $this->db->join("record_level rl",'rl.observation_id = t.observation_id','inner');
        $this->db->where($cond);
        $this->db->group_by('t.scientific_name,b.m_sn,b.m_cn,rl.file_uri,');
        //$this->order_by('t.scientific_name','ASC');
        return $this->db->get()->result();
}
public function GetChecklistObjD($cond)
{
        $this->db->select('rl.file_uri,o.observation_id');
        $this->db->from("observation as o");
        $this->db->join("record_level as rl",'rl.observation_id = o.observation_id','inner');
        $this->db->where($cond);
        //$this->db->group_by('c.checklist_id,rl.file_uri');
        return $this->db->get()->result();
}    
}

/* End of file Crud_model.php */

?>