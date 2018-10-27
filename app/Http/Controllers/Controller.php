<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController {

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    protected function getCategories() {
        $retVal = [];
        $categories = DB::table('category')->where('status', '=', 'active')->orderBy('sorder','desc')->get();
        foreach ($categories as $item) {
            if (isset($retVal[$item->parent_id])) {
                $retVal[$item->parent_id][] = $item;
            } else {
                $retVal[$item->parent_id] = [$item];
            }
        }
        return $retVal;
    }

    protected function getNews() {
        $retVal = [];
        $newsConfig = DB::table('parameter')->where('param_key', '=', 'home.news')->first();
        if (!empty($newsConfig)) {
            $newsIds = json_decode($newsConfig->param_value);
            if (!empty($newsIds)) {
                $retVal = DB::table('blog')->whereIn('id', $newsIds)->where('status', '=', 'active')->get();
            }
        }
        return $retVal;
    }

}
