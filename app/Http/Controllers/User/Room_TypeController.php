<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Traits\CommonIndexTrait;
use App\Traits\CommonShowTrait;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class Room_TypeController extends Controller
{
    use ResponseTrait, CommonIndexTrait, CommonShowTrait;

    public function index()
    {
        return $this->Room_Type_index();
    }

    public function show($id)
    {
        return $this->Room_Type_show($id);
    }
}
