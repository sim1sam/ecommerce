@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Newsletter Settings')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Newsletter Settings')}}</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
              <div class="breadcrumb-item">{{__('admin.Newsletter Settings')}}</div>
            </div>
          </div>

          <div class="section-body">
            <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.newsletter-setting.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">{{__('admin.Title')}} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="title" value="{{ $newsletterSetting->title ?? 'Stay Updated' }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">{{__('admin.Button Text')}}</label>
                                        <input type="text" class="form-control" name="button_text" value="{{ $newsletterSetting->button_text ?? 'SUBSCRIBE' }}">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="">{{__('admin.Subtitle')}} <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="subtitle" rows="3" required>{{ $newsletterSetting->subtitle ?? 'Be the first to know! Subscribe for exclusive updates on new collections & sales. Plus enjoy 10% off your first order.' }}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">{{__('admin.Background Color')}}</label>
                                        <input type="color" class="form-control" name="background_color" value="{{ $newsletterSetting->background_color ?? '#8B5CF6' }}" style="height: 50px;">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">{{__('admin.Text Color')}}</label>
                                        <input type="color" class="form-control" name="text_color" value="{{ $newsletterSetting->text_color ?? '#FFFFFF' }}" style="height: 50px;">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">{{__('admin.Button Color')}}</label>
                                        <input type="color" class="form-control" name="button_color" value="{{ $newsletterSetting->button_color ?? '#000000' }}" style="height: 50px;">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">{{__('admin.Status')}}</label>
                                        <select name="status" class="form-control">
                                            <option value="1" {{ ($newsletterSetting->status ?? 1) == 1 ? 'selected' : '' }}>{{__('admin.Active')}}</option>
                                            <option value="0" {{ ($newsletterSetting->status ?? 1) == 0 ? 'selected' : '' }}>{{__('admin.Inactive')}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">{{__('admin.Update')}}</button>
                            </div>
                        </form>
                    </div>
                  </div>
                </div>
          </div>
        </section>
      </div>
@endsection
