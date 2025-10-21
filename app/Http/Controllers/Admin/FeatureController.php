<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feature;

class FeatureController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $features = Feature::orderBy('sort_order')->get();
        return view('admin.feature', compact('features'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required',
            'icon' => 'required',
        ];
        $customMessages = [
            'title.required' => trans('admin_validation.Title is required'),
            'icon.required' => trans('admin_validation.Icon is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        $feature = new Feature();
        $feature->title = $request->title;
        $feature->description = $request->description;
        $feature->icon = $request->icon;
        $feature->sort_order = $request->sort_order ?? 0;
        $feature->status = $request->status ?? 1;
        $feature->save();

        $notification = trans('admin_validation.Create Successfully');
        $notification = array('messege' => $notification, 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $feature = Feature::find($id);
        return response()->json(['feature' => $feature], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'title' => 'required',
            'icon' => 'required',
        ];
        $customMessages = [
            'title.required' => trans('admin_validation.Title is required'),
            'icon.required' => trans('admin_validation.Icon is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        $feature = Feature::find($id);
        $feature->title = $request->title;
        $feature->description = $request->description;
        $feature->icon = $request->icon;
        $feature->sort_order = $request->sort_order ?? 0;
        $feature->status = $request->status ?? 1;
        $feature->save();

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege' => $notification, 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $feature = Feature::find($id);
        $feature->delete();
        $notification = trans('admin_validation.Delete Successfully');
        $notification = array('messege' => $notification, 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
