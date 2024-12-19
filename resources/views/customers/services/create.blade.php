@extends('layouts.user_type.auth')

@section('title', 'Thêm mới dich vụ khách hàng')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Thêm mới dịch vụ khách hàng</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('customer_services.store') }}" method="POST">
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
                            <label for="service_id" class="form-label">Chọn dịch vụ <span
                                        class="field-required"> *</span></label>
                            <select name="service_id" id="service_id" class="form-select" required>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}"
                                            data-price="{{ $service->price }}">{{ $service->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @if(auth()->user()->is_protected)
                            <div class="col-md-6 mb-3">
                                <label for="agency_id" class="form-label">Chi nhánh <span
                                            class="field-required"> *</span></label>
                                <select name="agency_id" id="agency_id" class="form-select" required>
                                    @foreach($agencies as $agency)
                                        <option value="{{ $agency->id }}">{{ $agency->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        <div class="col-md-6 mb-3">
                            <label for="amount" class="form-label">Thành tiền</label>
                            <input type="text" name="amount" id="amount"
                                   value="{{ number_format($service->price, 0, ',', '.') }}"
                                   class="form-control"
                                   placeholder="Thành tiền">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="end_time" class="form-label">Ngày kết thúc</label>
                            <input type="date" name="end_time" id="end_time"
                                   value="{{ isset($service->end_date) ? $service->end_date->format('Y-m-d') : '' }}"
                                   class="form-control"
                                   placeholder="Ngày kết thúc">
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
    <script>
        const amountInput = document.getElementById('amount');

        amountInput.addEventListener('input', function (e) {
            let value = e.target.value.replace(/[^0-9]/g, '');

            value = new Intl.NumberFormat('vi-VN').format(value);

            e.target.value = value;
        });

        amountInput.addEventListener('blur', function (e) {
            let value = e.target.value.replace(/[^0-9]/g, '');
            if (value) {
                e.target.value = new Intl.NumberFormat('vi-VN').format(value);
            }
        });
        document.addEventListener('DOMContentLoaded', function () {
            const serviceSelect = document.getElementById('service_id');
            const amountInput = document.getElementById('amount');

            serviceSelect.addEventListener('change', function () {
                const selectedOption = serviceSelect.options[serviceSelect.selectedIndex];
                const price = selectedOption.getAttribute('data-price') || 0;

                amountInput.value = parseInt(price).toLocaleString('vi-VN');
            });
        });
    </script>
@endsection
