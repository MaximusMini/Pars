<?php

all_images();



function all_images(){
	for($i=1; $i<=25; $i++){
	$url = 'https://resheba.net/GDZ/6-mat-2018/1/'.$i.'.png';
	$name = explode('/', $url)[6];
	$path = '../../images/';
	$ddd = file_get_contents($url);
	file_put_contents('../images/'.$name, $ddd);	
}

}

function one_images(){
	$url = 'https://resheba.net/GDZ/6-mat-2018/0/11.png';
	$name = explode('/', $url)[6];
	$path = '../../images/';
	$ddd = file_get_contents($url);
	file_put_contents('../images/'.$name, $ddd);
}