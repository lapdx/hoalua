<?php
/**
 * Created by PhpStorm.
 * User: tuanpa
 * Date: 7/2/18
 * Time: 3:12 PM
 */

namespace App\Repositories;
use App\Models\Coupon;

class CouponRepository extends BaseRepository {

    const MODEL = Coupon::class;
    //'title', 'image', 'description', 'slug', 'type',
    // 'parent_id', 'related_category', 'sorder', 'left_value', 'right_value',
    // 'depth', 'vote_up', 'vote_down', 'meta_title', 'meta_description',
    // 'meta_keywords', 'status', 'creator_id', 'modifier_id', 'create_time', 'update_time'
    static $operationFilter = [
        'eq' => [
            'id',
            'slug',
            'parent_id',
            'host',
            'status',
            'store_id'

        ],
        //>
        'gt' => [

        ],
        // >=
        'gte' => [
            [
                'filter' => 'create_time_from',
                'column' => 'create_time'
            ],
        ],
        //<
        'lt' => [],
        // <=
        'lte' => [
            [
                'filter' => 'create_time_to',
                'column' => 'create_time'
            ],
        ],
        //!=
        'ne' => [],
        //not in
        'nin' => [],
        'in' => [
            [
                'filter' => 'statuses',
                'column' => 'status'
            ],
            [
                'filter' => 'ids',
                'column' => 'id'
            ],
            [
                'filter' => 'store_ids',
                'column' => 'store_id'
            ],
        ],
        'like' => [
            'like_title',
        ]
    ];

    public function query($filter = []) {
        $query = parent::query($filter);
        if(array_key_exists('join_store', $filter)) {
            $query->join('store', 'coupon.store_id', '=', 'store.id');
        }
        if(array_key_exists('category_id', $filter)) {
            $query->join('coupon_n_category', 'coupon_n_category.coupon_id', '=', 'coupon.id')
                ->where('coupon_n_category.category_id', '=', $filter['category_id']);
        }
        return $query;
    }
}