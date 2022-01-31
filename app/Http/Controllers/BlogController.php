<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Blog;
use Illuminate\Support\Facades\Redis;

class BlogController extends Controller
{



    /**
     * return list of posts
     *
     * @param [type] $id
     * @return void
     */
    public function index($id)
    {

        $cachedBlog = Redis::get('blog_' . $id);


        if (isset($cachedBlog)) {
            $blog = json_decode($cachedBlog, FALSE);

            return response()->json([
                'status_code' => 201,
                'message' => 'Fetched from redis',
                'data' => $blog,
            ]);
        } else {
            $blog = Blog::find($id);
            Redis::set('blog_' . $id, $blog);

            return response()->json([
                'status_code' => 201,
                'message' => 'Fetched from database',
                'data' => $blog,
            ]);
        }
    }



    /**
     * update a post
     *
     * @param Request $request
     * @param [type] $id
     * @return void
     */
    public function update(Request $request, $id)
    {

        $update = Blog::findOrFail($id)->update($request->all());

        if ($update) {

            // Delete blog_$id from Redis
            Redis::del('blog_' . $id);

            $blog = Blog::find($id);
            // Set a new key with the blog id
            Redis::set('blog_' . $id, $blog);

            return response()->json([
                'status_code' => 201,
                'message' => 'User updated',
                'data' => $blog,
            ]);
        }
    }



    /**
     * Delete post from database and Redis
     *
     * @param [type] $id
     * @return void
     */
    public function delete($id)
    {

        Blog::findOrFail($id)->delete();
        Redis::del('blog_' . $id);

        return response()->json([
            'status_code' => 201,
            'message' => 'Blog deleted'
        ]);
    }
}
