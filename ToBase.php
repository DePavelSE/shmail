<?php
include("index.html");
$_MsgBox=fopen("MBox.txt","a");

/*
* Собираем сообщение из переменных формы ввода для записи в мэйлбокс
* Формат: date/time/email_to/subj/msg/email_from/report
*/
$msg_to_box=
$_REQUEST['date']
.substr_replace($_REQUEST['time'],"",2,3)."|"
.$_REQUEST['to']."|";
if(!$_REQUEST['subj']){
	$msg_to_box.="Без темы"."|";
	}else{
		$msg_to_box.=$_REQUEST['subj']."|";
	}
$msg_to_box.=$_REQUEST['msg']."|"
.$_REQUEST['from']."|"
.$_REQUEST['checkme']."|"."\r\n";

//Запись сообщения в мэйлбокс
if(fwrite($_MsgBox,$msg_to_box))
	echo "Сообщение зарегистрировано.";
fclose($_MsgBox);

//Сортировка по времени
$arr_msgbox = file("MBox.txt");//файл в массив
sort($arr_msgbox,SORT_STRING);//сортировка

$_MsgBox=fopen("MBox.txt","w"); //массив в файл построчно  
foreach($arr_msgbox as $key=>$val){
	fwrite($_MsgBox,$val);	
}   
fclose($_MsgBox);

?>
