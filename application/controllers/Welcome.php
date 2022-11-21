<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		// $this->load->view('register');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model("main_models");
	}
	function _remap($method, $params=array())
    {
        $methodToCall = method_exists($this, $method) ? $method : 'index';
        return call_user_func_array(array($this, $methodToCall), $params);
    }
	
	public function index($data = [])
	{
		$test = $this->uri->segment(2);
		$this->load->library('pagination');
		$config["base_url"] = base_url("index.php/welcome");
		$config['use_page_numbers'] = TRUE;
		$config['uri_segment'] = 2;
		$config['per_page'] = 4;
		$config['num_link'] = 2;
		$config['total_rows'] = $this->db->get('users')->num_rows();
		$this->pagination->initialize($config);
		$data['fetch_data'] = $this->db->get("users",$config['per_page'],$test);

		$data['pagination'] = $this->pagination->create_links();
		// $data['fetch_data'] = $this->main_models->fetch_data("users");
		$this->load->view('welcome_message', $data);
	}
	public function formvalidation($image = "")
	{


		$this->form_validation->set_rules('fname', 'Firstname', 'required');
		$this->form_validation->set_rules('lname', 'Lastname', 'required');
		$this->form_validation->set_rules('uname', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == FALSE) {
			$data['message'] = validation_errors();
		} else {
			if ($image != "") {
				$insert_data = array(
					'avatar'  => $image,
					'firstname'  => $this->input->post("fname"),
					'lastname' => $this->input->post("lname"),
					'username'  => $this->input->post("uname"),
					'password' => $this->input->post("password"),
				);
				$this->main_models->insert_data("users", $insert_data);
			}
			else{
				$update_data = array(
					'firstname'  => $this->input->post("fname"),
					'lastname' => $this->input->post("lname"),
					'username'  => $this->input->post("uname"),
					'password' => $this->input->post("password"),
				);
				$this->main_models->update_data("users", $update_data,$this->input->post("hidden_id"));
			}
			redirect(base_url() . 'index.php/welcome/inserted');
		}
		$this->index($data);
	}
	public function imagevalidation()
	{

		$config['upload_path'] = './upload/';
		$config['allowed_types'] = 'jpg|jpeg|png|gif';
		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('image')) {
			$data = array('error' => $this->upload->display_errors());
			$this->index($data);
		} else {

			$file = $this->upload->data();
			$this->formvalidation($file["file_name"]);
		}
	}
	public function edituser()
	{
		$user_id = $this->uri->segment(3);
		$data["user_data"] = $this->main_models->fetch_single_data("users", $user_id);
		
		$this->index($data);
	}
	
	public function deleteuser()
	{
		
        $room_id = $this->uri->segment(3);
        $this->main_models->delete_data("users", $room_id);
        redirect(base_url());
	}
	public function inserted()
	{
		$this->index();
	}
}
