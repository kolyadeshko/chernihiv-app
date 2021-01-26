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
            if (preg_match_all("/^(\w+)@minmax$/i", $key, $match)) {
                // извлекаем из массива название поля
                $field = $match[1][0];
                // получаем выражение с больше или меньше
                $condition = $this->getMinMaxCondition($value, $field);
            } elseif ($key === "orderby") {
                $orderBy = $this->getOrderBy($value);
            } elseif ($key === "ordering") {
                $ordering = $this->getOrdering($value);
            } else {
                $condition = $this->getOther($key, $value);
            }
            if ($condition) array_push($conditions, $condition);
        }
        $orderingString = "";
        if ($orderBy) $orderingString = $orderBy . $ordering;
        $whereSting = "";
        if (!empty($conditions)) $whereSting =
            " WHERE " . join(" AND ", $conditions);
        return $whereSting . $orderingString;
    }

    // Метод который возвращает выражения типа id =5 или names IN ("Kolya","Oleg")
    protected function getOther($key, $value)
    {
        if (is_array($value)) {
            return "$key IN (" . join(",", array_map(function ($v) {
                    return '"' . $v . '"';
                }, $value)) . ")";
        } else {
            return $key . "=" . $value;
        }
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
    protected function getMinMaxCondition($maxMin, $field)
    {
        // массив с условиями
        $maxMinCondition = [];
        // проверяем существует ли в массиве максимальное значение
        if (isset($maxMin['max'])) {
            array_push($maxMinCondition, "$field < " . $maxMin["max"]);
        }
        // проверяем существует ли в массиве минимальное значение
        if (isset($maxMin["min"])) {
            array_push($maxMinCondition, "$field > " . $maxMin['min']);
        }
        // если массив пустой, возвращаем пустую строку
        if (empty($maxMinCondition)) return "";
        // в противном случае соединяем элементы массива с разделителем AND
        $maxMinCondition = join(" AND ", $maxMinCondition);
        return $maxMinCondition;
    }

    function getInsertExpression($data){
        $keysArr = array_keys($data);
        $keysString = join(",",$keysArr);
        $valueString = join(",",array_map(function ($v){ if ($v===null){ return 'NULL';} return "'".$v."'";},$data));
        return "($keysString) VALUES ($valueString)";
    }
}

