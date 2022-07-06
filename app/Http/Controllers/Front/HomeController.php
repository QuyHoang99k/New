<?php

namespace App\Http\Controllers\Front;

use App\Models\Post;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Models\HomeAdvertisement;
use App\Http\Controllers\Controller;
use App\Models\SubCategory;

class HomeController extends Controller
{
    public function index()
    {
        $home_ad_data = HomeAdvertisement::where('id', 1)->first();
        $setting_data = Setting::where('id', 1)->first();
        $post_data = Post::with('SubCategory')->orderBy('id', 'DESC')->get();
        $sub_category_data = SubCategory::orderBy('sub_category_order', 'asc')->where('show_on_home', 'Show')->get();
        return view('frontend.home', compact('home_ad_data', 'setting_data', 'post_data', 'sub_category_data'));
    }
}
