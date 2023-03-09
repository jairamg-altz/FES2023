<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Visitors extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
    }    

public function profile()
    {
        $postData = array("user_uuid"=> $this->uri->segment(3));
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => API_URL.'/Apis/GetProfile',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($postData),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response);
        $profileData = array();
        if ($response->success == '1') {
            $profileData = $response->user_detail;
            //print_r($profileData);exit;
        }
        $getReward = $this->Crud_model->GetData('user_observation_statistics','',"user_id='".$this->uri->segment(3)."'",'','','','1');
        if(!empty($getReward))
        {
            $totalReward = $getReward->observation_count+$getReward->observation_withimage_count+$getReward->observation_with_audio_count+$getReward->observation_with_video_count+$getReward->observation_species_rarity_dd+$getReward->observation_species_rarity_nt+$getReward->observation_species_rarity_vu+$getReward->observation_species_rarity_en+$getReward->observation_species_rarity_cr+$getReward->observation_dynamic_value+$getReward->blog_count+$getReward->replies_count+$getReward->identification_count;
       // print_r($totalReward);exit;
        $getNoviceR = $this->Crud_model->GetData('dynamic_reward_weightages','',"dynamic_reward_title='Novice'",'','','','1');
        $getWatcherR = $this->Crud_model->GetData('dynamic_reward_weightages','',"dynamic_reward_title='Watcher'",'','','','1');
        $getAvid_WatcherR = $this->Crud_model->GetData('dynamic_reward_weightages','',"dynamic_reward_title='Avid_Watcher'",'','','','1');
        $getObserverR = $this->Crud_model->GetData('dynamic_reward_weightages','',"dynamic_reward_title='Observer'",'','','','1');
        $getCommunity_ParticipantR = $this->Crud_model->GetData('dynamic_reward_weightages','',"dynamic_reward_title='Community_Participant'",'','','','1');
        $getCommunity_ChampionR = $this->Crud_model->GetData('dynamic_reward_weightages','',"dynamic_reward_title='Community_Champion'",'','','','1');
        $getContributorR = $this->Crud_model->GetData('dynamic_reward_weightages','',"dynamic_reward_title='Contributor'",'','','','1');
        $getResearcherR = $this->Crud_model->GetData('dynamic_reward_weightages','',"dynamic_reward_title='Researcher'",'','','','1');
        $getExpertR = $this->Crud_model->GetData('dynamic_reward_weightages','',"dynamic_reward_title='Expert'",'','','','1');
        $GetLicense = $this->Crud_model->GetData('data_licenses','','','data_licenses_id');
        $data = array(
            'profileData' => $profileData,'GetLicense'=>$GetLicense,'totalReward'=>$totalReward,'getNoviceR'=>$getNoviceR->dynamic_reward_weightage_from,'getWatcherR'=>$getWatcherR->dynamic_reward_weightage_from,'getAvid_WatcherR'=>$getAvid_WatcherR->dynamic_reward_weightage_from,'getObserverR'=>$getObserverR->dynamic_reward_weightage_from,'getCommunity_ParticipantR'=>$getCommunity_ParticipantR->dynamic_reward_weightage_from,'getCommunity_ChampionR'=>$getCommunity_ChampionR->dynamic_reward_weightage_from,'getContributorR'=>$getContributorR->dynamic_reward_weightage_from,'getResearcherR'=>$getResearcherR->dynamic_reward_weightage_from,'getExpertR'=>$getExpertR->dynamic_reward_weightage_from);
        $this->load->view('visitor_profile', $data);
    } else {
        $GetLicense = $this->Crud_model->GetData('data_licenses','','','data_licenses_id');
        $data = array(
            'profileData' => $profileData,'GetLicense'=>$GetLicense,'totalReward'=>0,'getNoviceR'=>0,'getWatcherR'=>0,'getAvid_WatcherR'=>0,'getObserverR'=>0,'getCommunity_ParticipantR'=>0,'getCommunity_ChampionR'=>0,'getContributorR'=>0,'getResearcherR'=>0,'getExpertR'=>0);
        $this->load->view('visitor_profile', $data);
    }
        
    }
}
?>