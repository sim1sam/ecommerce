@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Features')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Features')}}</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
              <div class="breadcrumb-item">{{__('admin.Features')}}</div>
            </div>
          </div>

          <div class="section-body">
            <a href="javascript:;" data-toggle="modal" data-target="#createFeature" class="btn btn-primary"><i class="fas fa-plus"></i> {{__('admin.Add New')}}</a>
            <div class="row mt-4">
                <div class="col">
                  <div class="card">
                    <div class="card-body">
                      <div class="table-responsive table-invoice">
                        <table class="table table-striped" id="dataTable">
                            <thead>
                                <tr>
                                    <th>{{__('admin.SN')}}</th>
                                    <th>{{__('admin.Title')}}</th>
                                    <th>{{__('admin.Icon')}}</th>
                                    <th>{{__('admin.Sort Order')}}</th>
                                    <th>{{__('admin.Status')}}</th>
                                    <th>{{__('admin.Action')}}</th>
                                  </tr>
                            </thead>
                            <tbody>
                                @foreach ($features as $index => $feature)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ $feature->title }}</td>
                                        <td><i class="{{ $feature->icon }}"></i></td>
                                        <td>{{ $feature->sort_order }}</td>
                                        <td>
                                            @if($feature->status == 1)
                                                <span class="badge badge-success">{{__('admin.Active')}}</span>
                                            @else
                                                <span class="badge badge-danger">{{__('admin.Inactive')}}</span>
                                            @endif
                                        </td>
                                        <td>
                                        <a href="javascript:;" data-toggle="modal" data-target="#editFeature-{{ $feature->id }}" class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></a>

                                        <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteData({{ $feature->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                  @endforeach
                            </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
          </div>
        </section>
      </div>

      <!--Create Modal -->
      <div class="modal fade" id="createFeature" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                      <div class="modal-header">
                              <h5 class="modal-title">{{__('admin.Create Feature')}}</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                          </div>
                  <div class="modal-body">
                      <div class="container-fluid">
                        <form action="{{ route('admin.feature.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">{{__('admin.Title')}}</label>
                                <input type="text" class="form-control" name="title" required>
                            </div>
                            <div class="form-group">
                                <label for="">{{__('admin.Description')}}</label>
                                <textarea class="form-control" name="description" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">{{__('admin.Icon')}} (FontAwesome class)</label>
                                <input type="text" class="form-control" name="icon" placeholder="fas fa-truck" required>
                                <small class="text-muted">Example: fas fa-truck, fas fa-headset, fas fa-undo, fas fa-shield-alt</small>
                            </div>
                            <div class="form-group">
                                <label for="">{{__('admin.Sort Order')}}</label>
                                <input type="number" class="form-control" name="sort_order" value="0">
                            </div>
                            <div class="form-group">
                                <label for="">{{__('admin.Status')}}</label>
                                <select name="status" class="form-control">
                                    <option value="1">{{__('admin.Active')}}</option>
                                    <option value="0">{{__('admin.Inactive')}}</option>
                                </select>
                            </div>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('admin.Close')}}</button>
                            <button type="submit" class="btn btn-primary">{{__('admin.Save')}}</button>
                        </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      {{-- edit modal --}}
      @foreach ($features as $feature)
        <div class="modal fade" id="editFeature-{{ $feature->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                                <h5 class="modal-title">{{__('admin.Edit Feature')}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                        <form action="{{ route('admin.feature.update',$feature->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="">{{__('admin.Title')}}</label>
                                <input type="text" class="form-control" name="title" value="{{ $feature->title }}" required>
                            </div>
                            <div class="form-group">
                                <label for="">{{__('admin.Description')}}</label>
                                <textarea class="form-control" name="description" rows="3">{{ $feature->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="">{{__('admin.Icon')}} (FontAwesome class)</label>
                                <input type="text" class="form-control" name="icon" value="{{ $feature->icon }}" placeholder="fas fa-truck" required>
                                <small class="text-muted">Example: fas fa-truck, fas fa-headset, fas fa-undo, fas fa-shield-alt</small>
                            </div>
                            <div class="form-group">
                                <label for="">{{__('admin.Sort Order')}}</label>
                                <input type="number" class="form-control" name="sort_order" value="{{ $feature->sort_order }}">
                            </div>
                            <div class="form-group">
                                <label for="">{{__('admin.Status')}}</label>
                                <select name="status" class="form-control">
                                    <option value="1" {{ $feature->status == 1 ? 'selected' : '' }}>{{__('admin.Active')}}</option>
                                    <option value="0" {{ $feature->status == 0 ? 'selected' : '' }}>{{__('admin.Inactive')}}</option>
                                </select>
                            </div>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('admin.Close')}}</button>
                            <button type="submit" class="btn btn-primary">{{__('admin.Update')}}</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      @endforeach

<script>
    function deleteData(id){
        $("#deleteForm").attr("action",'{{ url("admin/feature/") }}'+"/"+id)
    }
</script>
@endsection
