@extends('layouts.user_type.auth')
@section('title', 'Thêm mới chi nhánh')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Thêm mới chi nhánh</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('agencies.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <!-- Tên chi nhánh -->
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Tên chi nhánh <span class="field-required"> *</span></label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                                   placeholder="Nhập tên chi nhánh" value="{{ old('name') }}" required>

                            <!-- Hiển thị lỗi cho tên chi nhánh -->
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Số điện thoại -->
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror"
                                   placeholder="Nhập số điện thoại" value="{{ old('phone') }}">

                            <!-- Hiển thị lỗi cho số điện thoại -->
                            @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Địa chỉ -->
                        <div class="col-md-6 mb-3">
                            <label for="address" class="form-label">Địa chỉ</label>
                            <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror"
                                   placeholder="Nhập địa chỉ" value="{{ old('address') }}">

                            <!-- Hiển thị lỗi cho địa chỉ -->
                            @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                                   placeholder="Nhập email" value="{{ old('email') }}">

                            <!-- Hiển thị lỗi cho email -->
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Nút hành động -->
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-2">Lưu</button>
                        <a href="{{ route('agencies.index') }}" class="btn btn-secondary">Hủy</a>
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
