<?php
/**
 * Created by PhpStorm.
 * User: tuanpa
 * Date: 7/2/18
 * Time: 3:12 PM
 */

namespace App\Repositories;
use App\Models\Category;

class CategoryRepository extends BaseRepository {

    const MODEL = Category::class;


//'title', 'slug', 'type', 'description', 'sorder', 'image', 'auto_text',
//'website', 'affiliate_link', 'origin_link', 'status', 'vote_up', 'vote_down',
//'meta_title', 'meta_description', 'meta_keywords', 'views', 'clicks', 'creator_id',
//'creator_name', 'modifier_id', 'modifier_name', 'create_time', 'update_time', 'coupon_count',
//'inactive_affiliate'

    static $operationFilter = [
        'eq' => [
            'id',
            'title',
            'slug',
            'status',
            'creator_id',
            'type',

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
            [
                'filter' => 'rightFrom',
                'column' => 'right_value'
            ],
        ],
        //<
        'lt' => [
            
        ],
        // <=
        'lte' => [
            [
                'filter' => 'createTo',
                'column' => 'create_time'
            ],
            [
                'filter' => 'leftTo',
                'column' => 'left_value'
            ],
            [
                'filter' => 'rightTo',
                'column' => 'right_value'
            ],
            [
                'filter' => 'depthTo',
                'column' => 'depth'
            ],
        ],
        //!=
        'ne' => [],
        //not in
        'nin' => [],
        //in
        'in' => [
            [
                'filter' => 'statuses',
                'column' => 'status'
            ],
            [
                'filter' => 'ids',
                'column' => 'id'
            ]
        ],
    ];

    public function query($filter = []) {
        $query = parent::query($filter);
        if(array_key_exists('coupon_id', $filter)) {
            $query->join('coupon_n_category', 'coupon_n_category.category_id', '=', 'category.id')
                ->where('coupon_n_category.coupon_id', '=', $filter['coupon_id']);
        }
        if(array_key_exists('store_id', $filter)) {
            $query->join('store_n_category', 'store_n_category.category_id', '=', 'category.id')
                ->where('store_n_category.store_id', '=', $filter['store_id']);
        }
        return $query;
    }
}