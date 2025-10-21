<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsletterSetting;

class NewsletterSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $newsletterSetting = NewsletterSetting::first();
        return view('admin.newsletter_setting', compact('newsletterSetting'));
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => 'required',
            'subtitle' => 'required',
        ];
        $customMessages = [
            'title.required' => trans('admin_validation.Title is required'),
            'subtitle.required' => trans('admin_validation.Subtitle is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        $newsletterSetting = NewsletterSetting::first();
        if (!$newsletterSetting) {
            $newsletterSetting = new NewsletterSetting();
        }

        $newsletterSetting->title = $request->title;
        $newsletterSetting->subtitle = $request->subtitle;
        $newsletterSetting->background_color = $request->background_color ?? '#8B5CF6';
        $newsletterSetting->text_color = $request->text_color ?? '#FFFFFF';
        $newsletterSetting->button_text = $request->button_text ?? 'SUBSCRIBE';
        $newsletterSetting->button_color = $request->button_color ?? '#000000';
        $newsletterSetting->status = $request->status ?? 1;
        $newsletterSetting->save();

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege' => $notification, 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
