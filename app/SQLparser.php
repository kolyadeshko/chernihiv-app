<?php


namespace App;


class SQLparser
{

    public function getCondition($conditionArray)
    {
        if (empty($conditionArray)) return "";
        //
        $conditions = [];
        $orderBy = "";
        $ordering = "";
        foreach ($conditionArray as $key => $value) {
            if (empty($value)) continue;
            $condition = "";
            if (
                is_string($value) && preg_match_all("/^(\d*):(\d*)$/i", $value, $match)
            ) {
                // извлекаем из массива match максимальное и минимальное значения
                $min = $match[1][0];
                $max = $match[2][0];
                var_dump(!($min && $max));
                if (!$min && !$max) continue;
                // получаем выражение с больше(и/или)меньше
                $condition = $this->getMinMaxCondition($key,$min,$max);
            } elseif ($key === "orderby") {
                $orderBy = $this->getOrderBy($value);
            } elseif ($key === "ordering") {
                $ordering = $this->getOrdering($value);
            }
            else if($key !== "limit"){
                $condition = $this->getOther($key, $value);
            }
            if ($condition) array_push($conditions, $condition);
        }
        $orderingString = "";
        if ($orderBy) $orderingString = $orderBy . $ordering;
        $whereSting = "";
        if (!empty($conditions)) $whereSting =
            " WHERE " . join(" AND ", $conditions);
        return $whereSting . $orderingString ;
    }

    // Метод который возвращает выражения типа id =5 или names IN ("Kolya","Oleg")
    protected function getOther($key, $value)
    {
        if (is_array($value)) {
            return "$key IN (" . join(",", array_map(function ($v) {
                    return '"' . $v . '"';
                }, $value)) . ")";
        } else {
            return "$key = :$key";
        }
    }

    public function getLimit(&$sqlParams){
        $returnExpression = " LIMIT ";
        $limit = $sqlParams["limit"];
        unset($sqlParams['limit']);
        if (is_string($limit)) return $returnExpression . $limit;
        if (is_array($limit)){
            $startPosition = $limit[0];
            $limit = $limit[1];
            return $returnExpression . "$startPosition , $limit";
        }
        return "";
    }

    //метод который возвращает выражение сортировки
    protected function getOrderBy($value)
    {
        $fields = '';
        if (is_array($value)) {
            $fields = join(',', $value);
        } elseif (is_string($value)) {
            $fields = $value;
        }
        return " ORDER BY " . $fields;

    }

    // метод который метод сортироки(по возрастанию или убыванию)
    protected function getOrdering($value)
    {
        $ordering = '';
        $ascValues = ["+", "asc", "incr", "^"];
        $descValues = ["-", "desc",];
        if (in_array($value, $ascValues)) {
            $ordering = " ASC ";
        } elseif (in_array($value, $descValues)) {
            $ordering = " DESC ";
        }
        return $ordering;
    }

    // метод который возвращает выражение с больше или меньше
    protected function getMinMaxCondition($field,$min,$max)
    {
        // оператор который будет между min и max (AND или OR)
        $operator = '';
        if ($min && $max){
            $min < $max ? $operator = "AND" : $operator = "OR";
        }
        $max ? $maxString = "$field < $max" : $maxString = "";
        $min ? $minString = "$field > $min" : $minString = "";
        return "($minString $operator $maxString)";
    }



    public function getInsertExpression($table,$data)
    {
        $keys = array_keys($data);
        $keyString = join(",", $keys);
        $valueString = join(",", array_map(function ($v) {
            return ":" . $v;
        }, $keys));
        return "INSERT INTO `$table` ($keyString) VALUES ($valueString)";
    }

}

