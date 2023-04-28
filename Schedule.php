<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Schedule extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auth_model');
		$this->load->model('Schedule_model','course_model');
		$this->load->model('Dashboard_model', 'Dashboard');
		// if($_SESSION['user_id']==null || $_SESSION['user_id']==''){
		// 	redirect(base_url('auth/register'));
		// }
		if (!($_SESSION['user_id'] > 0 && $_SESSION['is_admin'] && $_SESSION['user_type'] == 1)) {
			// print_r($_SESSION);
			redirect('auth/login');
		}
		// if($_SESSION['domain_name']!=array_shift((explode('.', $_SERVER['HTTP_HOST'])))){
		// 	redirect('auth/login');
		// }	
		// $domain_name = array_shift((explode('.', $_SERVER['HTTP_HOST'])));
		$domain_name = DOMAIN_NAME;
		$domain_details = $this->Auth_model->get_domain_details_by_name($domain_name);
		if ($domain_details->status < 1) {
			redirect('Deactive_account');
		}
	}

    // sumit schedule start.....................................................................

		public function schedule()
		{
			$this->load->view('include/header_new');

			$data = [];
			$course = $this->course_model->video_type_course_list();
			$data['courses'] = $course;
			// print_r($data); die;

			
			$this->load->view('course/schedule/add_schedule',$data);
			$this->load->view('include/footer_new');
		}

		public function add_schedule(){
		
			$data=[];
			$domain_id=$this->session->userdata('domain_registration_id');		
			$this->load->view('include/header_new',$data);
			$user_id=$_SESSION['user_id'];
			
			if($this->input->post()){
				$post_data=$this->input->post();
				// echo'<pre>';
				// print_r($post_data);die;
				if(($post_data['start_date'] <= $post_data['end_date']) && $post_data['start_time'] && $post_data['end_time']){
					$start_date=$post_data['start_date'];
					$end_date=$post_data['end_date'];
					$total_days=$this->get_total_days_from_two_date_time($start_date,$end_date);	
					$schedule_arr=[
						'mentor_id'=>0,
						'status'=>1,
						'added_on'=>Date('Y-m-d H:i:s'),
						'added_by'=>$this->session->userdata('user_id'),
						'domain_id'=>$domain_id,
						'type'=> 3,
						'course_id'=>$post_data['course_id'],
					];
					// 	echo'<pre>';
					// print_r($schedule_arr);die;
					$booked=0;
					$not_booked=0;
					for ($i=0; $i <$total_days ; $i++) {
						$update_start_date=date('Y-m-d', strtotime("+$i day", strtotime($start_date)));					
						$exclude_day=strtolower(date('D',strtotime($update_start_date)));
						#exclude days validation
						// print_r($post_data);die;
						if(!(in_array($exclude_day,$post_data['exclude_days']))){
							if($post_data){
									// echo'<pre>';
								//    print_r($post_data);die;
								   $end_time=$post_data['end_time'];
								   $start_time=$post_data['start_time'];
								   #starttime and end time validtion #start time should be lower 
								   if($start_time < $end_time){
									   $start_date_time= date('Y-m-d H:i:s', strtotime("$update_start_date $start_time"));
									   $end_date_time= date('Y-m-d H:i:s', strtotime("$update_start_date $end_time"));
									//    $time_arr=$this->get_total_minutes_from_two_date_time($start_date_time,$end_date_time);
	
									//    print_r($time_arr);die;
									   $schedule_arr['start_date_time']=$start_date_time;
									   $schedule_arr['end_date_time']=$end_date_time;
									//    echo'<pre>';
									//    print_r($schedule_arr);die;
									   $schedule_res=$this->course_model->add_schedule($schedule_arr);	
									   if($schedule_res){
										   $booked++;
									   }else{
										   $not_booked++;
									   }	
								   }
							}					
						}					
					}				
					
					if($booked && $not_booked){
						$msg="Total $booked Schedule added Successfully , <br>Total $not_booked Schedule Not added...Schedule already exist in same time";
						$this->session->set_flashdata('message',$msg);
						redirect("course/schedule");
					}else{
						if($booked){
							$msg="Total $booked Schedule added Successfully";
							$this->session->set_flashdata('message',$msg);
							redirect("course/schedule");
						}elseif($not_booked){
							$data['post_data']=$post_data;
							$msg="Total $not_booked Schedule Not added...Schedule already exist in same time ";
							$this->session->set_flashdata('msg',$msg);
							redirect("course/schedule");
						}else{
							$msg="Schedule Not added...";
							$this->session->set_flashdata('msg',$msg);
							redirect("course/schedule");
						}
					}
				}else{
					$data['post_data']=$post_data;
					$this->session->set_flashdata('msg','All Fields Requirements');
					redirect("course/schedule");
			
				}
			}else{
				$this->load->view('course/schedule/add_schedule');
			}		
			$this->load->view('include/footer_new');
		}
	
		public function get_total_days_from_two_date_time($start_date_time=null,$end_date_time=null){
			// print_r($start_date_time);die;
			if($start_date_time && $end_date_time){
				$start_date = new DateTime($start_date_time);
				$since_start = $start_date->diff(new DateTime($end_date_time));				
				return ($since_start->days+1);			
			}else{
				return false;
			}		
		}
	
		public function get_total_minutes_from_two_date_time($start_date_time=null,$end_date_time=null){
			if($start_date_time && $end_date_time){
				$start_date = new DateTime($start_date_time);
				$since_start = $start_date->diff(new DateTime($end_date_time));				
				$minutes = $since_start->days * 24 * 60;
				$minutes += $since_start->h * 60;
				$minutes += $since_start->i;
				$time_count=(int)($minutes/30);
				$time_arr=[];
				for ($i=0; $i <$time_count; $i++) { 
					$end = date("Y-m-d H:i:s",strtotime($start_date_time." +30 minutes"));
					$time_arr[$i]['start_date_time']=$start_date_time;
					$time_arr[$i]['end_date_time']=$end;
					$start_date_time=$end;
				}
				return $time_arr;
			}else{
				return false;
			}		
		}
    // sumit schedule end.....................................................................	
}
?>