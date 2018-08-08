<?php
/**
 * Created by PhpStorm.
 * User: tuanpa
 * Date: 7/2/18
 * Time: 3:12 PM
 */

namespace App\Repositories;
use App\Models\Comment;

class CommentRepository extends BaseRepository {

    const MODEL = Comment::class;


//   'name', 'email', 'user_id', 'refer_id', 'refer_type',
// 'parent_id', 'content', 'status', 'create_time', 'update_time'
    static $operationFilter = [
        'eq' => [
            'id',
            'email',
            'user_id',
            'refer_id',
            'refer_type',
            'parent_id',
            'status',

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
            'name'
        ]
    ];

    public function query($filter = []) {
        $query = parent::query($filter);
        return $query;
    }

    public function getTreeComment($referId, $referType) {
        $listComment = $this->getData([
            'refer_id' => $referId,
            'refer_type' => $referType,
            'order_by' => 'asc'
        ]);
        $rebuildListComment = array();
        //parent or not children comment
        foreach($listComment as $commentObj){
            if(!$commentObj->parent_id || $commentObj->parent_id == 0){
                $commentObj->children = [];
                $rebuildListComment[$commentObj->id] = $commentObj;
            }  else if (isset($rebuildListComment[$commentObj->id])) {
                $rebuildListComment[$commentObj->id]->children = $commentObj;
            }
        }
        

        return $rebuildListComment;
    }
}