<?php
/*	Kolovaj Vladimir Andreevich
		kolovaj.vladimir@gmail.com
		St.Petersburg
		15.11.2019
*/

defined('BASEPATH') OR exit('No direct script access allowed');

class Redirect extends CI_Controller {


	public function index()
	{
		// Получение адреса из запроса
		$addres = $_SERVER['REQUEST_URI'];

		// Обрезка адреса
		$addres = explode('/', $addres);

		// Проверка адреса на условия
		if (count($addres)==2 && mb_strlen($addres[1])==5){
				$this->load->model("Main_model");
				$addres = 'http://'.$_SERVER['HTTP_HOST'].'/'.$addres[1];
				// Проверка указанного адреса на наличие в БД и редирект.
				if (!$this->Main_model->not_in_db($addres, 'short_url')){
					$url_for_redirect = $this->Main_model->get_user_url($addres);
					header('Location: '.$url_for_redirect);
					exit();
				}
				else show_404();
		} else show_404();
	}
}
?>
