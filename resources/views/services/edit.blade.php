@extends('layouts.user_type.auth')
@section('title', 'Cập nhật dịch vụ')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Thêm mới dịch vụ</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('services.update', ['service_id' => $service->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Tên dịch vụ <span
                                        class="field-required"> *</span></label>
                            <input type="text" name="name" id="name"
                                   class="form-control" value="{{$service->name}}"
                                   placeholder="Nhập tên dịch vụ" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="duration" class="form-label">Thời gian</label>
                            <input type="text" value="{{$service->duration}}" name="duration" id="duration"
                                   class="form-control"
                                   placeholder="Nhập thời gian dịch vụ">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="price" class="form-label">Giá dịch vụ</label>
                            <input type="text" value="{{$service->price}}" name="price" id="price" class="form-control"
                                   placeholder="Nhập giá dịch vụ">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Trạng thái <span
                                        class="field-required"> *</span></label>
                            <select name="status" id="status" class="form-select" required>
                                <option @if($service->status === 1) selected @endif value="1">Hoạt động</option>
                                <option @if($service->status === 0) selected @endif value="0">Không hoạt động</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="agency_id" class="form-label">Chi nhánh <span
                                        class="field-required"> *</span></label>
                            <select name="agency_id" id="agency_id" class="form-select" required>
                                @foreach($agencies as $agency)
                                    <option @if($service->agency->id ===  $agency->id) selected
                                            @endif value="{{ $agency->id }}">{{ $agency->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="type" class="form-label">Loại dịch vụ <span
                                        class="field-required"> *</span></label>
                            <select name="type" id="type" class="form-select" required>
                                <option @if($service->type === 1) selected @endif value="1">Dịch vụ tập luyện</option>
                                <option @if($service->type === 2) selected @endif value="2">Dịch vụ cá nhân</option>
                                <option @if($service->type === 3) selected @endif value="3">Dịch vụ khác</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="description" class="form-label">Mô tả </label>
                            <textarea name="description" id="description" class="form-control" rows="3"
                                      placeholder="Nhập mô tả dịch vụ">{{$service->description}}</textarea>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-2">Lưu</button>
                        <a href="{{ route('services.index') }}" class="btn btn-secondary">Hủy</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
