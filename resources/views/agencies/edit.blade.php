@extends('layouts.user_type.auth')
@section('title', 'Cập nhật thông tin chi nhánh')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Cập nhật chi nhánh {{$agency->name}}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('agencies.update', ['agency_id' => $agency->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Tên chi nhánh <span
                                        class="field-required"> *</span></label>
                            <input type="text" name="name" value="{{$agency->name}}" id="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   placeholder="Nhập tên chi nhánh" required>

                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input type="text" name="phone" id="phone"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   placeholder="Nhập số điện thoại" value="{{ $agency->phone }}">
                            @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="address" class="form-label">Địa chỉ</label>
                            <input type="text" name="address" id="address"
                                   class="form-control @error('address') is-invalid @enderror"
                                   placeholder="Nhập địa chỉ" value="{{ $agency->address }}">
                            @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   placeholder="Nhập email" value="{{ $agency->email }}">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
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
