@extends('layouts.user_type.auth')

@section('title', 'Thêm mới lịch tập luyện')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Thêm mới lịch tập luyện</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('customer_schedules.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="customer_id" class="form-label">Chọn khách hàng <span
                                        class="field-required"> *</span></label>
                            <select name="customer_id" id="customer_id" class="form-select" required>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="user_id" class="form-label">Chọn huấn luyện viên <span
                                        class="field-required"> *</span></label>
                            <select name="user_id" id="user_id" class="form-select" required>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="start_date" class="form-label">Thời gian bắt đầu</label>
                            <input type="datetime-local" name="start_date" id="start_date"
                                   class="form-control"
                                   value="{{ old('start_date', isset($startDate) ? $startDate->format('Y-m-d\TH:i') : '') }}">

                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="note" class="form-label">Ghi chú</label>
                            <textarea name="note" id="note"
                                      class="form-control"
                                      placeholder="Ghi chú">{{ old('note') }}</textarea>
                        </div>

                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-2">Lưu</button>
                        <a href="{{ route('customers.index') }}" class="btn btn-secondary">Hủy</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
