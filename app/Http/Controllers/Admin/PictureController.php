<?php

namespace App\Http\Controllers\Admin;

use App\Models\Picture;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PictureController extends Controller
{
    public function destroy(Picture $picture){
        $picture->delete();
        return '';
    }
}
