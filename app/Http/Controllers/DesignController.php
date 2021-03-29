<?php

namespace App\Http\Controllers;

use App\Models\Design;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\User;

class DesignController extends Controller
{
    public function public()
    {
        $datadesign = Design::all();
        $row = 1;
        $datareview = Review::where('row', $row)->get();
        $datareview2 = Review::where('row', $row + 1)->get();
        return view('index', ['datadesign' => $datadesign, 'datareview' => $datareview, 'datareview2' => $datareview2]);
    }

    public function product_detail($id)
    {
        $dt = Design::where('id', $id)->get();
        $dtf = Design::find($id);
        $user_id = $dtf->user_id;
        $user = User::where('id', $user_id)->get();
        // dd($dt->all());
        return view('public-detail-product', ['dt' => $dt, 'user' => $user]);
    }

    function view_design(Request $request)
    {
        if ($request->has('category')) {
            $datadesign = Design::where('title', 'LIKE', '%' . $request->category . '%')->get();
        } else {
            $datadesign = Design::latest()->get();
        }
        return view('fragment.design', compact('datadesign'));
    }

    function dashboard_design(Request $request)
    {
        if ($request->has('category')) {
            $datadesign = Design::where('title', 'LIKE', '%' . $request->category . '%')->get();
        } else {
            $datadesign = Design::latest()->get();
        }
        return view('fragment.dashboard-design', compact('datadesign'));
    }

    public function view_designer()
    {
        if (auth()->user()->role == 'user') {
            return redirect('/dashboard');
        }
        $id = auth()->user()->id;
        $datadesign = Design::where('user_id', $id)->get();
        return view('dashboard-designer.index', compact('datadesign'));
    }

    public function store(Request $request)
    {
        $data = $request->design;
        $filename = $data->getClientOriginalName();

        $dataupload = new Design;
        $dataupload->name = $request->name;
        $dataupload->avatar = $request->avatar;
        $dataupload->user_id = $request->user_id;
        $dataupload->title = $request->title;
        $dataupload->design = $filename;

        $data->move(public_path() . '/assets/design/', $filename);
        $dataupload->save();

        return redirect('/dashboard/designer');
    }

    public function update(Request $request, $id)
    {
        $change = Design::findorfail($id);
        $firstname = $change->design;

        $data = [
            'title' => $request->title,
            'design' => $firstname,
        ];

        $request->design->move(public_path() . '/assets/design/', $firstname);
        $change->update($data);
        return redirect('/dashboard/designer');
    }

    public function destroy($id)
    {
        $delete = Design::findorfail($id);

        $file = public_path('/assets/design/') . $delete->design;
        if (file_exists($file)) {
            @unlink($file);
        }

        $delete->delete();
        return back();
    }
}
