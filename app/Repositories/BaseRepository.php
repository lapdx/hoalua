<?php

/**
 * Created by PhpStorm.
 * User: tuanpa
 * Date: 7/2/18
 * Time: 3:12 PM
 */

namespace App\Repositories;

class BaseRepository
{

    static $operationList = [
        'eq' => '=',
        'gt' => '>',
        'gte' => '>=',
        'lt' => '<',
        'lte' => '<=',
        'ne' => '!='
    ];

    public function getData($filter = [])
    {
        if(!array_key_exists('columns', $filter)) {
            $filter['columns'] = ['*'];
        }
        if(!array_key_exists('page_id', $filter)) {
            $filter['page_id'] = 1;
        }
        if(!array_key_exists('order_by', $filter)) {
            $filter['order_by'] = ['id', 'desc'];
        }
        $query = $this->query($filter);
        if(array_key_exists('page_size', $filter)) {
            $query->forPage($filter['page_id'], $filter['page_size']);
        }
        return $query->get($filter['columns']);
    }

    public function getCount($filter = [])
    {
        return $this->query($filter)->count();
    }

    public function paginator($filter = [])
    {
        $count = $this->getCount($filter);
        $pageSize = $filter['page_size'];
        $pageId = $filter['pageId'];
        $pageCount = ceil($count / $pageSize);
        $hasNext = true;
        if ($pageId == $pageCount) {
            $hasNext = false;
        }
        $paginator = [
            'has_next' => $hasNext,
            'total_count' => $count,
            'page_count' => $pageCount,
            'limit' => (int)$pageSize,
            'offset' => ($pageId - 1) * $pageSize,
        ];
        return $paginator;
    }

    public function query($filter = [])
    {
        $query = call_user_func(static::MODEL . '::query');
        $tableName = call_user_func(static::MODEL . '::getTableName');
        $operations = static::$operationFilter;
        foreach ($operations as $operation => $operationData) {
            if(!$operationData || count($operationData) == 0) {
                continue;
            }
            foreach ($operationData as $operationItem) {
                list($keyFilter, $column) = $this->getFilterAndColumn($operationItem, $tableName);
                if(!array_key_exists($keyFilter, $filter)) {
                    continue;
                }
                $value = $filter[$keyFilter];
                if (array_key_exists($operation, self::$operationList)) {
                    $query->where($column, self::$operationList[$operation], $value);
                } else if($operation == 'like') {
                    $query->where($column, 'LIKE', '%' . $value . '%' );
                } else if($operation == 'in') {
                    $query->whereIn($column, $value);
                } else if($operation == 'nin') {
                    $query->whereNotIn($column, $value);
                }
            }

        }
        if(array_key_exists('order_by', $filter)) {
            list($column, $direction) = $filter['order_by'];
            $query->orderBy($tableName . '.' . $column, $direction);
        }
        return $query;
    }

    protected function getFilterAndColumn($operationItem, $tableName) {
        $key = $operationItem;
        $column = $operationItem;
        if(is_array($operationItem)) {
            $key = $operationItem['filter'];
            $column = $operationItem['column'];
        }
        if(!str_contains($column, '.')) {
            $column = $tableName  . '.' . $column;
        }
        return [$key, $column];
    }


}
