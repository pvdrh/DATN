@extends('layouts.user_type.auth')
@section('title', 'Cập nhật thông tin nhân viên')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Cập nhật thông tin {{$user->name}}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('users.update', ['user_id' => $user->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Tên nhân viên <span
                                        class="field-required"> *</span></label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" id="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   placeholder="Nhập tên nhân viên" required>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Số điện thoại <span
                                        class="field-required"> *</span></label>
                            <input style="pointer-events: none" type="text" name="phone"
                                   value="{{ old('phone', $user->phone) }}" id="phone"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   placeholder="Nhập số điện thoại" required>
                            @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="address" class="form-label">Địa chỉ</label>
                            <input type="text" name="address" value="{{ old('address', $user->address) }}" id="address"
                                   class="form-control @error('address') is-invalid @enderror"
                                   placeholder="Nhập địa chỉ">
                            @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="gender" class="form-label">Giới tính </label>
                            <select name="gender" id="gender" class="form-select">
                                <option @if($user->gender === 0) selected @endif value="0">Nữ</option>
                                <option @if($user->gender === 1) selected @endif value="1">Nam</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="dob" class="form-label">Ngày sinh</label>
                            <input type="date" name="dob" value="{{ old('dob', $user->dob) }}" id="dob"
                                   class="form-control @error('dob') is-invalid @enderror" required>
                            @error('dob')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="role" class="form-label">Vai trò <span class="field-required"> *</span></label>
                            <select name="role" id="role" @if($user->role == 1) style="pointer-events: none" @endif
                            class="form-select @error('role') is-invalid @enderror" required>
                                @if($user->role == 1)
                                    <option @if(old('role', $user->role) == 1) selected @endif value="1">Quản trị viên
                                    </option>
                                @endif
                                <option @if(old('role', $user->role) == 2) selected @endif value="2">Nhân viên quản lý
                                </option>
                                <option @if(old('role', $user->role) == 3) selected @endif value="3">Huấn luyện viên
                                </option>
                            </select>
                            @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="agency_id" class="form-label">Chi nhánh <span
                                        class="field-required"> *</span></label>
                            <select name="agency_id" id="agency_id"
                                    class="form-select @error('agency_id') is-invalid @enderror" required>
                                @foreach($agencies as $agency)
                                    <option @if(old('agency_id', $user->agency_id) == $agency->id) selected
                                            @endif value="{{ $agency->id }}">
                                        {{ $agency->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('agency_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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