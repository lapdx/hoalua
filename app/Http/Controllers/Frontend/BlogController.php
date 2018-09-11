<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    protected function listItem($page = 0) {
        $data = $this->blogRepository->getData(['page_size'=>13, 'page_id'=>$page, 'statusNotIn' =>['delete', 'pending']]);
        $paginator = $this->blogRepository->paginator(['page_size'=>13, 'pageId'=>$page, 'statusNotIn' =>['delete', 'pending']]);

        $listBlog = [
          "status" => "successful",
          "message" => "successful",
          "result"=> [
            "data"=>$data,
            "pageId" =>$page-1,
            "pageSize"=>13,
            "recordsCount"=>$paginator['total_count'],
            "pagesCount"=>$paginator['page_count'],
            "hasNext" =>$paginator['has_next'],
          ]
        ];
        return view('frontend.blog.list', array('listBlog' => $listBlog, 'title' => 'Blog'));
    }

    protected function detail($slug) {
        if(!empty($slug)) {
            $result = $this->blogRepository->getData(['slug'=>$slug, 'statusNotIn' =>['delete', 'pending']]);
            if($result->toArray()) {
                $breadcrumbs = $this->getBreadcrumbs($result[0], 'blog');
                return view('frontend.blog.detail', array('itemBlog' => $result[0], 'breadcrumbs' => $breadcrumbs, 'title' => $result[0]['title'] ));
            }else{
                return view('errors.404');
            }

        }else{
            return view('errors.404');
        }
    }
    
    protected function blogCategory($slug, $page = 0){
      $categoryId = $this->categoryRepository->getData(['slug' => $slug, 'type' => 'blog'])->toArray();
      if(!empty($categoryId)) {
        $data = $this->blogRepository->getData(['page_id' => $page, 'page_size' => 12, 'category_id' => $categoryId[0]['id']]);
        $paginator = $this->blogRepository->paginator(['pageId' => $page, 'page_size' => 12, 'category_id' => $categoryId[0]['id']]);
        $listBlog = [
          "status" => "successful",
          "message" => "successful",
          "result"=> [
            "data"=>$data,
            "pageId" =>$page-1,
            "pageSize"=>13,
            "recordsCount"=>$paginator['total_count'],
            "pagesCount"=>$paginator['page_count'],
            "hasNext" =>$paginator['has_next'],
          ]
        ];
        return view('frontend.blog.list-categories', array('listBlog' => $listBlog, 'slug' => $slug, 'title' => 'Category '. $categoryId[0]['title'] ));
      }else{
          return view('errors.404');
      }
      
    }
}
