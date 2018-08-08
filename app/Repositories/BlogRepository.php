<?php
/**
 * Created by PhpStorm.
 * User: tuanpa
 * Date: 7/2/18
 * Time: 3:12 PM
 */

namespace App\Repositories;
use App\Models\Blog;

class BlogRepository extends BaseRepository {

    const MODEL = Blog::class;

// 'title', 'slug', 'content', 'image', 'status', 'meta_title',
// 'meta_description', 'meta_keywords',  'create_time', 'update_time'


    static $operationFilter = [
        'eq' => [
            'id',
            'title',
            'slug',
            'status',
            [
                'filter' => 'category_id',
                'column' => 'blog_n_category.category_id'
            ],
            [
                'filter' => 'blog_category',
                'column' => 'blog_n_category.blog_id'
            ],
            [
                'filter' => 'tag_id',
                'column' => 'tag_refer.tag_id'
            ],

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
        'nin' => [
            [
                'filter' => 'statusNotIn',
                'column' => 'status'
            ],
        ],
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
        'like'=> []
    ];

    public function query($filter = []) {
        $query = parent::query($filter);
        if(array_key_exists('category_id', $filter)
            || array_key_exists('blog_category', $filter)
        ) {
            $query->join('blog_n_category', 'blog.id', '=', 'blog_n_category.blog_id')
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