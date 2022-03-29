<?php

function read_excel($filepath){
    ini_set('error_reporting', 0);
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    require_once "../PHPExcel/Classes/PHPExcel.php"; //подключаем наш фреймворк

    $ar=array(); // инициализируем массив
    $inputFileType = PHPExcel_IOFactory::identify($filepath); // узнаем тип файла, excel может хранить файлы в разных форматах, xls, xlsx и другие
    $objReader = PHPExcel_IOFactory::createReader($inputFileType); // создаем объект для чтения файла
    $objPHPExcel = $objReader->load($filepath); // загружаем данные файла в объект
    $ar = $objPHPExcel->getActiveSheet()->toArray(); // выгружаем данные из объекта в массив
    return $ar; //возвращаем массив
}

function array_multisort_value(){
    $args = func_get_args();
    $data = array_shift($args);
    foreach ($args as $n => $field) {
        if (is_string($field)) {
            $tmp = array();
            foreach ($data as $key => $row) {
                $tmp[$key] = $row[$field];
            }
            $args[$n] = $tmp;
        }
    }
    $args[] = &$data;
    call_user_func_array('array_multisort', $args);
    return array_pop($args);
}

?>