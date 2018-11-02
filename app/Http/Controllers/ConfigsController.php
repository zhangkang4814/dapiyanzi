<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Config;

class ConfigsController extends Controller
{
    public function index()
    {
        return view('configs.config');
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $config = Config::create($data);
        if($config) {
            session()->flash('success', '添加成功！');
            return redirect('config');
        } else {
            session()->flash('error', '添加失败！');
            return back();
        }       
    }
}
