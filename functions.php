<?php
function get_file_content($filename)
{
    if (file_exists($filename)) {
        return file($filename);
    } else {
        echo 'error: missing filename ' . $filename;
        return false;
    }
}
function calculate_salary($employee_data)
{
    $days_of_week = [ 'MO' => 1, 'TU' => 1, 'WE' => 1, 'TH' => 1, 'FR' => 1, 'SA' => 2, 'SU' => 2 ];
    $hour_value_data = [
        '1' => [ '0' => '', '9' => 25, '18' => 15, '24' => 20 ],
        '2' => [ '0' => '', '9' => 30, '18' => 20, '24' => 25 ]
    ];
    $salary = 0;
    $dayly_data = explode(',', $employee_data);
    foreach ($dayly_data as $data) {
        $day = substr($data, 0, 2);
        $keys = array_keys($hour_value_data[$days_of_week[$day]]);
        if (!in_array($day, $keys)) return false;
        $value_set = $days_of_week[$day];
        $data = substr($data, 2);
        $hours = explode('-', $data);
        if (count($hours) != 2) return false;
        $start = explode(':', $hours[0])[0];
        $end = explode(':', $hours[1])[0];
        $end = $end != '00' ? $end : 24;
        if ($end < $start) return false;

        for ($i = 1; $i < 4; $i++) {
            $hours = (count(array_intersect(range($start, $end), range($keys[$i - 1], $keys[$i]))) - 1);
            $hours = $hours < 0 ? 0 : $hours;
            $salary += $hours * $hour_value_data[$value_set][$keys[$i]];
        }
    }
    return $salary;
}
function process($data)
{
    foreach ($data as $line) {
        $line_data = explode('=', $line);
        if (count($line_data) == 1) {
            echo 'Syntax error on line ' . $line . "\n";
        } else {
            $name = $line_data[0];
            $salary = calculate_salary($line_data[1]);
            if ($salary !== false) {
                echo "The amount to pay $name is: $salary USD\n";
            } else {
                echo "error in $name work data\n";
            }
        }
    }
}
