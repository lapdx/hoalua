<?php
/**
 * Created by PhpStorm.
 * User: tuanpa
 * Date: 7/2/18
 * Time: 3:12 PM
 */

namespace App\Repositories;
use App\Models\Tag;

class TagRepository extends BaseRepository {

    const MODEL = Tag::class;


//'title', 'slug', 'description', 'meta_tile', 'meta_description', 'meta_keywords'

    static $operationFilter = [
        'eq' => [
            'id',
            'title',
            'slug',
            [
                'filter' => 'tag_id',
                'column' => 'tag_refer.tag_id'
            ],
            [
                'filter' => 'refer_type',
                'column' => 'tag_refer.refer_type'
            ],
            [
                'filter' => 'refer_id',
                'column' => 'tag_refer.refer_id'
            ]

        ],
        //>
        'gt' => [],
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
        'lte' => [],
        //!=
        'ne' => [],
        //not in
        'nin' => [],
        //in
        'in' => [],
    ];

    public function query($filter = []) {
        $query = parent::query($filter);
        if(array_key_exists('tag_id', $filter)
            || array_key_exists('refer_type', $filter)
            || array_key_exists('refer_id', $filter)
            || array_key_exists('coupon_id', $filter)
        ) {
            $query->join('tag_refer', 'tag_refer.tag_id', '=', 'tag.id');
        }
        if(array_key_exists('coupon_id', $filter)) {
            $query->where('refer_id', '=', $filter['coupon_id'])
                ->where('refer_type', '=', $filter['coupon']);
        }
        return $query;
    }
}