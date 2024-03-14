<?php
defined('BASEPATH') or exit('No direct script access allowed');

function ceklogin()
{
	$ci = get_instance();
	if (!$ci->session->userdata('username')) {
		redirect('login');
	} else {
		$role_id = $ci->session->userdata('role_id');
	}
}
