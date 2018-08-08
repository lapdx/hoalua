<?php
/**
 * Created by PhpStorm.
 * User: tuanpa
 * Date: 7/2/18
 * Time: 3:12 PM
 */

namespace App\Repositories;
use App\Models\Config;

class ConfigRepository extends BaseRepository {

    const MODEL = Config::class;

// 'key', 'value', 'type', 'data_type', 'title', 'description', 'create_time', 'update_time'


    static $operationFilter = [
        'eq' => [
            'id',
            'key',
            'type',
            'data_type',
            'title',

        ],
        //>
        'gt' => [

        ],
        // >=
        'gte' => [
            [
                'filter' => 'createFrom',
                'column' => 'create_time'
            ],
        ],
        //<
        'lt' => [],
        // <=
        'lte' => [
            [
                'filter' => 'createTo',
                'column' => 'create_time'
            ],
        ],
        //!=
        'ne' => [],
        //not in
        'nin' => [],
        //in
        'in' => [],
        'like'=> []
    ];

    public function query($filter = []) {
        $query = parent::query($filter);
        if(array_key_exists('category_id', $filter)
            || array_key_exists('blog_category', $filter)
        ) {
            $query->join('blog_n_category', 'p.id', '=', 'blog_n_category.blog_id')
                ->join('category', 'blog_n_category.category_id', '=', 'category.id');
        }
        if(array_key_exists('tag_id', $filter)) {
            $query->leftJoin('tag_refer', 'p.id', '=', 'tag_refer.refer_id')
                ->join('tag', 'tag_refer.tag_id', '=', 'tag.id')
                ->where('tag_refer.refer_type', '=', 'blog');
        }
        return $query;
    }
}