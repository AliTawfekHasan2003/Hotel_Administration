<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Traits\CommonIndexTrait;
use App\Traits\CommonShowTrait;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    use ResponseTrait, CommonIndexTrait, CommonShowTrait;

    public function index()
    {
       return $this->Service_index();
    }

    public function show($id)
    {
        return $this->Service_show($id);
    }
}
