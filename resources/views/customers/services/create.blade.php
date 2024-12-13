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
                                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="amount" class="form-label">Thành tiền</label>
                            <input type="text" name="amount" id="amount"
                                   value="{{ number_format($service->price, 0, ',', '.') }}"
                                   class="form-control"
                                   placeholder="Thành tiền">
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
    </script>
@endsection
