<?php
/**
 * Created by PhpStorm.
 * User: tuanpa
 * Date: 7/2/18
 * Time: 3:12 PM
 */

namespace App\Repositories;
use App\Models\Store;

class StoreRepository extends BaseRepository {

    const MODEL = Store::class;


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
        'like' => [
            [
                'filter' => 'search_title',
                'column' => 'title'
            ],
        ]
    ];

    public function query($filter = []) {
        $query = parent::query($filter);
        if(array_key_exists('category_id', $filter)) {
            $query->join('store_n_category', 'store_n_category.store_id', '=', 'store.id')
                ->where('store_n_category.category_id', '=', $filter['category_id']);
        }
        if(array_key_exists('category_ids', $filter)) {
            $query->join('store_n_category', 'store_n_category.store_id', '=', 'store.id')
                ->whereIn('store_n_category.category_id', $filter['category_ids']);
        }
        return $query;
    }
}