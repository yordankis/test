<?php
/**
 * It returns the content of a file.
 *
 * @param filename The name of the file you want to read.
 *
 * @return The file contents as an string array.
 */
function get_file_content($filename)
{
    if (file_exists($filename)) {
        return file($filename);
    } else {
        return false;
    }
}

/**
 * It takes a string of comma separated values, each value being a day of the week and a time range,
 * and returns the salary for that week.
 *
 * @param employee_data a string containing the employee's work schedule.
 *
 * @return The salary for the employee.
 */
function calculate_salary($employee_data)
{
    $days_of_week = ['MO' => 1, 'TU' => 1, 'WE' => 1, 'TH' => 1, 'FR' => 1, 'SA' => 2, 'SU' => 2];
    $hour_value_data = [
        '1' => ['0' => '', '9' => 25, '18' => 15, '24' => 20],
        '2' => ['0' => '', '9' => 30, '18' => 20, '24' => 25],
    ];
    $salary = 0;
    $dayly_data = explode(',', $employee_data);
    foreach ($dayly_data as $data) {
        $day = substr($data, 0, 2);
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
 * It takes an array of strings, each of which is a line of input, and for each line, it splits the
 * line into two parts, the name and the work data, and then it calculates the salary for the work data
 * and prints the name and salary
 *
 * @param data an array of strings, each of which represents a line of input.
 */

function process($data)
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
 * If the results are not an array, exit. Otherwise, loop through the results and print the name and
 * salary of each employee. If there is an error, print the error.
 *
 * @param results The array of results from the function.
 */
function print_result($results)
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
