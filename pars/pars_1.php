<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Парсер-1</title>
</head>
<body>
   
   
   
   <?php
    // подключение phpQuery
    include_once('../phpQuery.php');
    // получаем файл
    $file = file_get_contents('../temp/pechat_opros_html_kod.txt');
    
    //echo $file;
    
    //создаем объекты класса phpQuery
    $file_phpQuery = phpQuery::newDocument($file);
    // делаем запрос на поиск нужной информации
    $result = $file_phpQuery->find('div.freebirdFormviewerViewItemsTextShortText.freebirdFormviewerViewItemsTextDisabledText.freebirdThemedInput');
    
    
    echo gettype($result);
    
    
    foreach ($result as $val){
        //$val = trim($val);
        //echo '<br>'.pq($val)->text()[0];
        // проверяем первый символ на цифру
        $digital_array = [0,1,2,3,4,5,6,7,8,9];
        if(pq($val)->text()[0]=='0' || pq($val)->text()[0]=='1' || pq($val)->text()[0]=='2' || pq($val)->text()[0]=='3' || pq($val)->text()[0]=='4' || pq($val)->text()[0]=='5' || pq($val)->text()[0]=='6' || pq($val)->text()[0]=='7' || pq($val)->text()[0]=='8' || pq($val)->text()[0]=='9'){
            //echo '<br>'.pq($val)->text();
            //echo '<br>'.pq($val)->text()[0];
        }else{
            echo '<br>'.pq($val)->text();
        }
    }
    
    //printArray($result);
    
    
    function printArray($arr){
        echo '<pre>'.print_r($arr,true).'</pre>';
    }
    
    ?>
   
   
    
</body>
</html>