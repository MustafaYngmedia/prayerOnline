<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function fileUpload($file){
        $fileName = time().'.'.$file->getClientOriginalExtension();
        $current_date = date('Y-m-d');
        $file->move('uploads/'.$current_date.'/', $fileName);
        return '/uploads/'.$current_date.'/'.$fileName;
    }
}
