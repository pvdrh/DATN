@extends('layouts.user_type.auth')
@section('title', 'Thêm mới dịch vụ')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Thêm mới dịch vụ</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('services.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Tên dịch vụ <span
                                        class="field-required"> *</span></label>
                            <input type="text" name="name" id="name"
                                   class="form-control"
                                   placeholder="Nhập tên dịch vụ" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="duration" class="form-label">Thời gian</label>
                            <input type="text" name="duration" id="duration" class="form-control"
                                   placeholder="Nhập thời gian dịch vụ">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="price" class="form-label">Giá dịch vụ</label>
                            <input type="text" name="price" id="price" class="form-control"
                                   placeholder="Nhập giá dịch vụ">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Trạng thái <span
                                        class="field-required"> *</span></label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="1">Hoạt động</option>
                                <option value="0">Không hoạt động</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="agency_id" class="form-label">Chi nhánh <span
                                        class="field-required"> *</span></label>
                            <select name="agency_id" id="agency_id" class="form-select" required>
                                @foreach($agencies as $agency)
                                    <option value="{{ $agency->id }}">{{ $agency->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="type" class="form-label">Loại dịch vụ <span
                                        class="field-required"> *</span></label>
                            <select name="type" id="type" class="form-select" required>
                                <option value="1">Dịch vụ tập luyện</option>
                                <option value="2">Dịch vụ cá nhân</option>
                                <option value="3">Dịch vụ khác</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="description" class="form-label">Mô tả </label>
                            <textarea name="description" id="description" class="form-control" rows="3"
                                      placeholder="Nhập mô tả dịch vụ"></textarea>
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
