<?php
function dbconnect()
{
	$link = mysql_connect('study.localhost','root','test');
	if(!$link){
		die('failed to connect'.mysql_error());
	}
	$selected_db = mysql_select_db('youtube',$link);
	if(!$selected_db){
		die('failed to select'.mysql_error());
	}
}

function h($validation)
{
	return htmlspecialchars($validation, ENT_QUOTES, 'UTF-8');
}

function mre($word)
{
	return mysql_real_escape_string($word);
}

?>