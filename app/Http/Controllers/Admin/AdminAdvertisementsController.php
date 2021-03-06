<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeAdvertisement;
use App\Models\SidebarAdvertisement;
use App\Models\TopAdvertisement;
use Illuminate\Http\Request;

class AdminAdvertisementsController extends Controller
{
    public function home_ad_show()
    {
        $home_ad_data = HomeAdvertisement::where('id', 1)->first();
        return view('admin.advertisement.home_view', compact('home_ad_data'));
    }

    public function home_ad_update(Request $request)
    {
        $home_ad_data = HomeAdvertisement::where('id', 1)->first();
        if ($request->hasFile('above_search_ad')) {
            $request->validate([
                'above_search_ad' => 'image|mimes:jpg,jpeg,png,gif'
            ]);
            unlink(public_path('admin/uploads/' . $home_ad_data->above_search_ad));
            $ext = $request->file('above_search_ad')->extension();
            $file_name = 'above_search_ad' . '.' . $ext;
            $request->file('above_search_ad')->move(public_path('admin/uploads/'), $file_name);
            $home_ad_data->above_search_ad = $file_name;
        }
        if ($request->hasFile('above_footer_ad')) {
            $request->validate([
                'above_footer_ad' => 'image|mimes:jpg,jpeg,png,gif'
            ]);
            unlink(public_path('admin/uploads/' . $home_ad_data->above_footer_ad));
            $ext = $request->file('above_footer_ad')->extension();
            $file_name = 'above_footer_ad' . '.' . $ext;
            $request->file('above_footer_ad')->move(public_path('admin/uploads/'), $file_name);
            $home_ad_data->above_footer_ad = $file_name;
        }
        $home_ad_data->above_search_ad_url = $request->above_search_ad_url;
        $home_ad_data->above_search_ad_status = $request->above_search_ad_status;
        $home_ad_data->above_footer_ad_url = $request->above_footer_ad_url;
        $home_ad_data->above_footer_ad_status = $request->above_footer_ad_status;
        $home_ad_data->update();

        return redirect()->back()->with('success', 'C???p Nh???t Qu???ng C??o Th??nh C??ng');
    }


    public function top_ad_show()
    {
        $top_ad_data = TopAdvertisement::where('id', 1)->first();
        return view('admin.advertisement.top_view', compact('top_ad_data'));
    }
    public function top_ad_update(Request $request)
    {
        $top_ad_data = TopAdvertisement::where('id', 1)->first();
        if ($request->hasFile('top_ad')) {
            $request->validate([
                'top_ad' => 'image|mimes:jpg,jpeg,png,gif'
            ]);
            unlink(public_path('admin/uploads/' . $top_ad_data->top_ad));
            $ext = $request->file('top_ad')->extension();
            $file_name = 'top_search_ad' . '.' . $ext;
            $request->file('top_ad')->move(public_path('admin/uploads/'), $file_name);
            $top_ad_data->top_ad = $file_name;
        }

        $top_ad_data->top_ad_url = $request->top_ad_url;
        $top_ad_data->top_ad_status = $request->top_ad_status;
        $top_ad_data->update();

        return redirect()->back()->with('success', 'C???p Nh???t Qu???ng C??o Th??nh C??ng');
    }
    public function sidebar_ad_show()
    {
        $sidebar_ad_data = SidebarAdvertisement::get();
        return view('admin.advertisement.sidebar_view', compact('sidebar_ad_data'));
    }
    public function sidebar_ad_create()
    {
        return view('admin.advertisement.sidebar_create');
    }

    public function sidebar_ad_store(Request $request)
    {
        $request->validate([
            'sidebar_ad' => 'required|image|mimes:jpg,jpeg,png,gif'
        ], [
            'sidebar_ad.required' => ' ???nh kh??ng ???????c b??? tr???ng'
        ]);
        $now = time();
        $ext = $request->file('sidebar_ad')->extension();
        $file_name = 'sidebar_search_ad' . $now . '.' . $ext;
        $request->file('sidebar_ad')->move(public_path('admin/uploads/'), $file_name);
        $sidebar_ad_data = new SidebarAdvertisement();

        $sidebar_ad_data->sidebar_ad = $file_name;
        $sidebar_ad_data->sidebar_ad_url = $request->sidebar_ad_url;
        $sidebar_ad_data->sidebar_ad_location = $request->sidebar_ad_location;
        $sidebar_ad_data->save();
        return redirect()->back()->with('success', 'Th??m M???i Qu???ng C??o Th??nh C??ng');
    }

    public function sidebar_ad_edit($id)
    {
        $sidebar_ad_data = SidebarAdvertisement::where('id', $id)->first();
        return view('admin.advertisement.sidebar_edit', compact('sidebar_ad_data'));
    }

    public function sidebar_ad_update(Request $request, $id)
    {
        $sidebar_ad_data = SidebarAdvertisement::where('id', $id)->first();

        if ($request->hasFile('sidebar_ad')) {
            $request->validate([
                'sidebar_ad' => 'required|image|mimes:jpg,jpeg,png,gif'
            ]);
            $now = time();
            unlink(public_path('admin/uploads/' . $sidebar_ad_data->sidebar_ad));
            $ext = $request->file('sidebar_ad')->extension();
            $file_name = 'sidebar_search_ad' . $now . '.' . $ext;
            $request->file('sidebar_ad')->move(public_path('admin/uploads/'), $file_name);
            $sidebar_ad_data->sidebar_ad = $file_name;
        }

        $sidebar_ad_data->sidebar_ad_url = $request->sidebar_ad_url;
        $sidebar_ad_data->sidebar_ad_location = $request->sidebar_ad_location;
        $sidebar_ad_data->update();
        return redirect()->route('admin_sidebar_ad_show')->with('success', 'C???p Nh???t Qu???ng C??o Th??nh C??ng');
    }

    public function sidebar_ad_delete($id)
    {
        $sidebar_ad_data = SidebarAdvertisement::where('id', $id)->first();
        unlink(public_path('admin/uploads/' . $sidebar_ad_data->sidebar_ad));
        $sidebar_ad_data->delete();

        return redirect()->back()->with('success', 'X??a Qu???ng C??o Th??nh C??ng');
    }
}
