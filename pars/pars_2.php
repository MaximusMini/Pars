<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Парсер-2</title>
</head>
<body>
   
   
   
   <?php
    // подключение phpQuery
    include_once('../phpQuery.php');
    // получаем файл
		//$file = file_get_contents('https://www.khl.ru/stat/teams/468/powerplay-gf/');
		// функция для использования библиотеки curl
		function curl_get ($url, $referer = 'http://google.com'){
			$ch = curl_init();// инициализируем curl
			// задаем параметры (опции) curl 
			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_HEADER,0);
			curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 6.1; rv:42.0) Gecko/20100101 Firefox/42.0');
			curl_setopt($ch, CURLOPT_REFERER,$referer);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,true); // результат работы curl возвращается, а не выводиться
			//  выполняем запрос curl
			$data = curl_exec($ch);
			curl_close($ch);
			return $data;
		}
		$file = curl_get('https://www.khl.ru/stat/teams/468/powerplay-gf/');
    
    //echo $file;
    
    //создаем объекты класса phpQuery
    $file_phpQuery = phpQuery::newDocument($file);
    // делаем запрос на поиск нужной информации
    $result = $file_phpQuery->find('table.nowrap.stripe.compact.hover');
    
    
    echo gettype($result).'<br>';
    
	// массив команд
	$arr_t = [
			["id_team"=>1,"name"=>"Авангард"],
			["id_team"=>2,"name"=>"Автомобилист"],
			["id_team"=>3,"name"=>"Адмирал"],
			["id_team"=>4,"name"=>"Ак Барс"],
			["id_team"=>5,"name"=>"Амур"],
			["id_team"=>6,"name"=>"Барыс"],
			["id_team"=>7,"name"=>"Витязь"],
			["id_team"=>8,"name"=>"ХК Динамо М"],
			["id_team"=>9,"name"=>"Динамо Мн"],
			["id_team"=>10,"name"=>"Динамо Р"],
			["id_team"=>11,"name"=>"Йокерит"],
			["id_team"=>12,"name"=>"Куньлунь РС"],
			["id_team"=>13,"name"=>"Лада"],
			["id_team"=>14,"name"=>"Локомотив"],
			["id_team"=>15,"name"=>"Металлург Мг"],
			["id_team"=>16,"name"=>"Нефтехимик"],
			["id_team"=>17,"name"=>"Салават Юлаев"],
			["id_team"=>18,"name"=>"Северсталь"],
			["id_team"=>19,"name"=>"Сибирь"],
			["id_team"=>20,"name"=>"СКА"],
			["id_team"=>21,"name"=>"Слован"],
			["id_team"=>22,"name"=>"ХК Сочи"],
			["id_team"=>23,"name"=>"Спартак"],
			["id_team"=>24,"name"=>"Торпедо"],
			["id_team"=>25,"name"=>"Трактор"],
			["id_team"=>26,"name"=>"ЦСКА"],
			["id_team"=>27,"name"=>"Югра"],
		];
	
	// массив для сбора данных
	$team = array();
    
	$g=1;
	
    foreach ($result as $val){
        //echo '<br>'.$g.'--'.pq($val)->find('span.e-club_name')->text();
		//$team['name_team']= pq($val)->find('tr:nth-child(1) span.e-club_name')->text();
		//$g++;
		for ($t=1; $t<28; $t++){
			// получаем имя команды
			$name_team = pq($val)->find('tr:nth-child('.$t.') span.e-club_name')->text();
			// поиск id команды в массиве $arr_t по её названию, взятому из парсинга
			for ($tt=0; $tt<27; $tt++){
				if(array_search($name_team, $arr_t[$tt]) == 'name'){
					// определить id команды
					//echo '<br>+****************************'.$arr_t[$tt]['id_team'];
					$team[$t]['id_team'] = $arr_t[$tt]['id_team'];
				}
			}
			// название команды
			$team[$t]['name_team'] = $name_team;
			// количество сыгранных игр
			$team[$t]['games'] 						= pq($val)->find('tr:nth-child('.$t.') td:nth-child(3)')->text();
			// количество полученных численных преимуществ
			$team[$t]['total_power_play'] 			= pq($val)->find('tr:nth-child('.$t.') td:nth-child(4)')->text();
			// шайб заброшенных в большинстве
			$team[$t]['goals_power_play'] 			= pq($val)->find('tr:nth-child('.$t.') td:nth-child(5)')->text();
			// процент реализованных численных преимуществ
			$team[$t]['perc_power_play']			= pq($val)->find('tr:nth-child('.$t.') td:nth-child(6)')->text();
			// шайбы пропущенные в большинстве
			$team[$t]['goals_against_power_play'] 	= pq($val)->find('tr:nth-child('.$t.') td:nth-child(7)')->text();
			// количество численных преимуществ полученных соперником
			$team[$t]['total_power_kill'] 			= pq($val)->find('tr:nth-child('.$t.') td:nth-child(8)')->text();
			// шайбы, пропущенные в меньшинстве
			$team[$t]['goals_against_power_kill'] 	= pq($val)->find('tr:nth-child('.$t.') td:nth-child(9)')->text();
			// процент нереализованных численных преимуществ соперников
			$team[$t]['perc_power_kill'] 			= pq($val)->find('tr:nth-child('.$t.') td:nth-child(10)')->text();
			// шайбы, заброшенные в меньшинстве
			$team[$t]['goals_power_kill'] 			= pq($val)->find('tr:nth-child('.$t.') td:nth-child(11)')->text();
		}
    }
    
    printArray($team);
    
    
    function printArray($arr){
        echo '<pre>'.print_r($arr,true).'</pre>';
    }
    
    ?>
   
   
    
</body>
</html>