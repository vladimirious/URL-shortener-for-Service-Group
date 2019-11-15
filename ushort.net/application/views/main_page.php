<?php
/*	Kolovaj Vladimir Andreevich
		kolovaj.vladimir@gmail.com
		St.Petersburg 
		15.11.2019
*/

defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<title>URL shortener</title>
</head>
<body>
	<div>
		<form method="post" action="">
		<input name="user_url" type="url"/>
		<button type="submit">Сократить</button><BR>
		<? if(isset($short_url)) echo $short_url; ?>
		</form>
	</div>
</body>
</html>
