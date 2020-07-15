<?php

namespace App\Http\Controllers;

use Exception;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\Helpers\CustomGuzzleBuilder;
use App\Helpers\QueryFilterBuilder;

class Controller extends BaseController
{
    //use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function reformatData() {
        try {

            $results = (new CustomGuzzleBuilder())->get_method('https://jsonplaceholder.typicode.com/posts');
            $comments = (new CustomGuzzleBuilder())->get_method('https://jsonplaceholder.typicode.com/comments');
        

            $response = array();
            foreach($results['content'] as $key => $value) {
                $response[$key]['post_id'] = $value['id'];
                $response[$key]['post_title'] = $value['title'];
                $response[$key]['post_body'] = $value['body'];
                $response[$key]['total_number_of_comments'] = collect($comments['content'])->where('postId',$value['id'])->count();
        
            }

        } catch(Exception $exception) {

            throw $exception;

        }
        

        return collect($response)->sortByDesc('total_number_of_comments');
    }

    public function getAllPost() {
        try {

            $response = $this->reformatData();
        
        } catch(Exception $exception) {

            throw $exception;

        }

        return response()->json(compact('response'));
    }

    public function getPostByID($post_id) {
        try {
        
            $response = (new CustomGuzzleBuilder())->get_method("https://jsonplaceholder.typicode.com/posts/$post_id");

        } catch(Exception $exception) {

            throw $exception;

        }

        return response()->json(compact('response'));
    }

    public function getAllComment() {
        try {
        
            $results = (new CustomGuzzleBuilder())->get_method('https://jsonplaceholder.typicode.com/comments');
            $response = $results['content'];

        } catch(Exception $exception) {

            throw $exception;

        }

        return response()->json(compact('response'));
    }

    
    public function getFilteringComment(Request $request) {

        try {
            $search_data = $request->all();
            
            $results = (new CustomGuzzleBuilder())->get_method('https://jsonplaceholder.typicode.com/comments');

            $response = collect($results['content'])
                    ->when(!empty($search_data['id']), function ($query) use ($search_data){
                        return $query->where('id', $search_data['id']);
                    })
                    ->when(!empty($search_data['postId']), function ($query) use ($search_data){
                        return $query->where('postId', $search_data['postId']);
                    })
                    ->when(!empty($search_data['name']), function ($query) use ($search_data){
                        $name = $search_data['name'];
                        return $query->where('name',$name);
                    })
                    ->when(!empty($search_data['email']), function ($query) use ($search_data){
                        $email = $search_data['email'];
                        return $query->where('email',$email);
                    })
                    ->when(!empty($search_data['body']), function ($query) use ($search_data){
                        $body = $search_data['body'];
                        //return $query->where('body', 'like', '%'. $search_data['body'].'%');
                        return $query->where('body',$body);
                    });

        
        } catch(Exception $exception) {

            throw $exception;

        }

        return response()->json(compact('response'));
    }



}
