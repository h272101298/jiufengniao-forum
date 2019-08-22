<?php

namespace App\Http\Controllers\Admin;

use App\Modules\Manager\Model\Manager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ManagerController extends Controller
{
    //
    public function index(){
        $data=Manager::all();
        return view('admin.manager.index',compact('data'));
    }
}
