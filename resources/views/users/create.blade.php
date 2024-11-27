@extends('layouts.user_type.auth')
@section('title', 'Thêm mới nhân viên')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Thêm mới nhân viên</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Tên nhân viên <span
                                        class="field-required"> *</span></label>
                            <input type="text" name="name" id="name" class="form-control"
                                   placeholder="Nhập tên nhân viên" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Số điện thoại <span
                                        class="field-required"> *</span></label>
                            <input type="text" name="phone" id="phone" class="form-control"
                                   placeholder="Nhập số điện thoại" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="address" class="form-label">Địa chỉ</label>
                            <input type="text" name="address" id="address" class="form-control"
                                   placeholder="Nhập địa chỉ">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="gender" class="form-label">Giới tính </label>
                            <select name="gender" id="gender" class="form-select">
                                <option value="0">Nữ</option>
                                <option value="1">Nam</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="dob" class="form-label">Ngày sinh</label>
                            <input type="date" name="dob" id="dob" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="role" class="form-label">Vai trò <span class="field-required"> *</span></label>
                            <select name="role" id="role" class="form-select" required>
                                <option value="2">Nhân viên quản lý</option>
                                <option value="3">Huấn luyện viên</option>
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
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-2">Lưu</button>
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Hủy</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<style>
    .field-required {
        color: red;
    }
</style>