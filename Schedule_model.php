<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Schedule_model extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->leco = $this->load->database('leco', TRUE);
	}

    // sumit schedule start.....................................................................

    public function add_schedule($schedule_arr){
        if($schedule_arr['domain_id']){
            $schedule_arr['type']=3;	
            $course_id=$schedule_arr['course_id'];
            unset($schedule_arr['course_id']);
            $this->db->select('schedule.id,schedule.start_date_time,schedule.end_date_time');
            $this->db->from('schedule');
            $this->db->join('schedule_course_map','schedule_course_map.schedule_id=schedule.id','left');
            $this->db->group_start();
            $this->db->group_start();
            $this->db->where('schedule.start_date_time >=',$schedule_arr['start_date_time']);
            $this->db->where('schedule.start_date_time <=',$schedule_arr['end_date_time']);
            $this->db->group_end();
            $this->db->or_group_start();
            $this->db->where('schedule.end_date_time >',$schedule_arr['start_date_time']);
            $this->db->where('schedule.end_date_time <',$schedule_arr['end_date_time']);
            $this->db->group_end();
            $this->db->group_end();
            $this->db->where('schedule.status',1);
            $this->db->where('schedule_course_map.course_id',$course_id);
            $this->db->where('schedule.type',$schedule_arr['type']);
            $this->db->where('schedule.domain_id',$schedule_arr['domain_id']);
            $schedules=$this->db->get()->result();
            // print_r($schedules);die;
            if(!empty($schedules)){
                return false;
            }else{
                $this->db->insert('schedule',$schedule_arr);
                $schedule_id=$this->db->insert_id();				
                if($schedule_id){					
                    $schedule_course_arr['schedule_id']=$schedule_id;
                    $schedule_course_arr['course_id']=$course_id;
                    $this->db->insert('schedule_course_map',$schedule_course_arr);
                    return $schedule_id;
                }
            }
        }
    }
		
    // sumit schedule end.....................................................................	
}
?>