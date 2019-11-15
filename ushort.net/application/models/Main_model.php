<?php
/*	Kolovaj Vladimir Andreevich
		kolovaj.vladimir@gmail.com
    St.Petersburg
    15.11.2019
*/

defined('BASEPATH') OR exit('No direct script access allowed');

class Main_model extends CI_Model {

  public function __construct(){
    $this->load->database();
  }

  // Булевая функция для проверки наличия записи в БД
  public function not_in_db($url, $type){
    $query = $this->db->query('SELECT * FROM urls WHERE '.$type.'="'.$url.'" LIMIT 1');
    $row = $query->row();
    if(empty($row)){
      return TRUE;
    }
    else return FALSE;
  }

  // Функция для получения сокращенной ссылки из БД
  public function get_short_url($user_url){
    $query = $this->db->query('SELECT short_url FROM urls WHERE user_url="'.$user_url.'" LIMIT 1');
    $row = $query->row();
    $result = $row -> short_url;
    return $result;

  }

  // Функция для получения полной ссылки из БД (для редиректа)
  public function get_user_url($short_url){
    $query = $this->db->query('SELECT user_url FROM urls WHERE short_url="'.$short_url.'" LIMIT 1');
    $row = $query->row();
    $result = $row -> user_url;
    return $result;

  }

  // Функция для добавления новой записи в БД
  public function add_new_urls_in_db($user_url, $short_url){
    $sql = "INSERT INTO urls (user_url, short_url) VALUES ('".$user_url."', '".$short_url."')";
    $this->db->query($sql);
  }

  // Функция генерации сокращения
  public function generate_short_url(){
    $chars="qazxswedcvfrtgbnhyujmkiolpQAZXSWEDCVFRTGBNHYUJMKIOLP";
    // Определяем количество символов в $chars
    $size=StrLen($chars)-1;
    // Определяем пустую переменную, в которую и будем записывать символы.
    $generated=null;
    $max = 5;
    // Создаём сокращение
    while($max--)
      $generated.=$chars[rand(0,$max)];
    return 'http://'.$_SERVER['HTTP_HOST'].'/'.$generated;
    }

}
?>
