<?php
/*	Kolovaj Vladimir Andreevich
		kolovaj.vladimir@gmail.com
		St.Petersburg
		15.11.2019
*/

defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {


	public function index()
	{

		// Подключаем модель
		$this->load->model("Main_model");
		// Получение url от пользователя и проверка на post
		$user_url = $this->input->post('user_url');
		if($user_url){
			// Проверка наличия такого url в БД
			if($this->Main_model->not_in_db($user_url, 'user_url')){
				// Подбор уникального сокращения для url
				do{
					$short_url = $this->Main_model->generate_short_url();
				}
				while(!$this->Main_model->not_in_db($short_url, 'short_url'));
				// Запись URL и нового сокращения в БД
				$this->Main_model->add_new_urls_in_db($user_url, $short_url);
			} else {
				$short_url = $this->Main_model->get_short_url($user_url);
			}
			//
			$data ['short_url'] = $short_url;
			$this->load->view('main_page', $data);
		}
		else $this->load->view('main_page');
	}
}
