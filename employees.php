<?php
function get_file_content($filename)
{
    if (file_exists($filename)) {
        return file($filename);
    } else {
        echo 'error: missing filename '.$filename;
        return false;
    }
}
function delta(a,b)
{
    return (a-b)>0?a-b:0;
}
function calculate_salary($employee_data){
    $days_of_week = [
        'MO' => 1,
        'TU' => 1,
        'WE' => 1,
        'TH' => 1,
        'FR' => 1,
        'SA' => 2,
        'SU' => 2 
    ];
    $hour_value_data = [
        '1' => [
            '9'=>25,
            '18'=>15,
            '24'=>20
        ],
        '2' => [
            '9'=>30,
            '18'=>20,
            '24'=>25
        ] 
        ];
    $salary = 0;
    $dayly_data = explode(',',$employee_data);
    foreach ($dayly_data as $data) {
        $day = substr($data,0,2);
        $value_set = $hour_value_data[$day];
        $data = substr($data,2);
        $hours = explode('-',$data);
        $start = $hours[0];
        $end = $hours[1];
        $total = $end - $star;
    }
}
function process($data)
{
    foreach ($data as $line) {
        $line_data = explode('=', $line);
        if (count($line_data) == 1) {
            echo 'Syntax error on line '.$line."\n";
            } else {
                $name = $line_data[0];
                $salary = calculate_salary($line_data[1]);
            }
        }
        $result[$set[0]] = $set[1];

    }
    return $result;
}
$filename = readline('enter filename:');
$data = get_file_content($filename);
if ($data) {
    process($data);
}
?>