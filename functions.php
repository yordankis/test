<?php

/**
 * It returns the content of a file.
 * 
 * @param string filename The name of the file to read.
 * 
 * @return array|bool the content of the file or false in case of error.
 */
function get_file_content(string $filename)
{
    if (file_exists($filename)) {
        return file($filename);
    } else {
        return false;
    }
}


/**
 * It takes a string of comma separated values, each value being a day of the week and a time range,
 * and returns the total salary for that week
 * 
 * @param string employee_data a string containing the employee's data for the week.
 * 
 * @return int|bool The salary of the employee or false in case of error.
 */
function calculate_salary(string $employee_data)
{
    $days_of_week = ['MO' => 1, 'TU' => 1, 'WE' => 1, 'TH' => 1, 'FR' => 1, 'SA' => 2, 'SU' => 2];
    $hour_value_data = [
        '1' => ['0' => '', '9' => 25, '18' => 15, '24' => 20],
        '2' => ['0' => '', '9' => 30, '18' => 20, '24' => 25],
    ];
    $salary = 0;
    $daily_data = explode(',', $employee_data);
    foreach ($daily_data as $data) {
        $day = substr($data, 0, 2);
        if (!in_array($day,array_keys($days_of_week))) {
            return false;
        }
        $keys = array_keys($hour_value_data[$days_of_week[$day]]);
        if (!in_array($day, $keys)) {
            return false;
        }
        $value_set = $days_of_week[$day];
        $data = substr($data, 2);
        $hours = explode('-', $data);
        if (count($hours) != 2) {
            return false;
        }
        $start = explode(':', $hours[0])[0];
        $end = explode(':', $hours[1])[0];
        $end = $end != '00' ? $end : 24;
        if ($end < $start) {
            return false;
        }

        for ($i = 1; $i < 4; $i++) {
            $hours = (count(array_intersect(range($start, $end), range($keys[$i - 1], $keys[$i]))) - 1);
            $hours = $hours < 0 ? 0 : $hours;
            $salary += $hours * $hour_value_data[$value_set][$keys[$i]];
        }
    }
    return $salary;
}

/**
 * It takes an array of strings, each string is a line of data, and returns an array of arrays, each
 * array is a line of data with either an error or a name and salary.
 * 
 * @param array data The data to be processed.
 * 
 * @return An array of arrays.
 */
function process(array $data)
{
    $result = [];
    foreach ($data as $line) {
        $line_data = explode('=', $line);
        if (count($line_data) == 1) {
            $result[] = [
                'error' => 'Syntax error on line ' . $line,
            ];
        } else {
            $name = $line_data[0];
            $salary = calculate_salary($line_data[1]);
            if ($salary !== false) {
                $result[] = [
                    'name' => $name,
                    'salary' => $salary,
                ];
            } else {
                $result[] = [
                    'error' => 'Syntax error on' . $name . " data",
                ];
            }
        }
    }
    return $result;
}


/**
 * If the results are not an array, exit. Otherwise, loop through the results and if there's an error,
 * print it. Otherwise, print the name and salary
 * 
 * @param array results An array of results from the function.
 */
function print_result(array $results)
{
    if (!is_array($results)) {
        exit;
    } else {
        foreach ($results as $result) {
            if (isset($result['error'])) {
                echo $result['error'] . "\n";
            } else {
                echo "The amount to pay " . $result['name'] . " is: " . $result['salary'] . " USD\n";
            }
        }
    }
}
