<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class HomeController extends BaseController
{
    public function index()
    {
        $x = 3;
        echo "hello " . $x;
        echo "hello 1";
        echo "hello 2";
        echo "hello 3";
        echo "hello 4";

        return "test xdebug";
    }

    public function test2()
    {
        $x = 3;
        echo "hello " . $x;
        echo "hello 1";
        echo "hello 2";
        echo "hello 3";
        echo "hello 4";

        return "test xdebug";
    }
}
