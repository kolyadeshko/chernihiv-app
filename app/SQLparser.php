<?php


namespace App;


class SQLparser
{

    public function getCondition(&$conditionArray)
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
            }
            else if(!in_array($key,['limit','ordering','orderby'])){
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
    public function getOrdering(&$sqlParams){
        $returnExpression = ' ';
        $orderByValue = $sqlParams['orderby'];
        $orderingValue = $sqlParams['ordering'];
        if (isset($orderByValue)){
            $returnExpression .= "ORDER BY `$orderByValue` ";
            unset($sqlParams['orderby']);
            $ordering = '';
            if (isset($orderingValue)){
                $ascValues = ["+", "asc", "incr", "^"];
                $descValues = ["-", "desc",];
                if (in_array($orderingValue, $ascValues)) {
                    $ordering = " ASC ";
                } elseif (in_array($orderingValue, $descValues)) {
                    $ordering = " DESC ";
                }
                unset($sqlParams["ordering"]);
            }
            $returnExpression .= $ordering;
        }
        return $returnExpression;
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

