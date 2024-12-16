@extends('layouts.user_type.auth')
@section('title', 'Lịch sử giao dịch')

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        <div class="container-fluid py-4">
            <div class="row mb-4">
                <div class="col-6">
                    <h4>Lịch sử giao dịch</h4>
                </div>
                <div class="col-6 text-end">
                    <a href="{{route('transactions.export')}}" class="btn btn-success me-2">
                        <i class="bi bi-file-earmark-excel me-2"></i> Xuất Excel
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <form method="GET" class="d-inline">
                                <div class="input-group align-items-center" style="gap: 20px">
                                    <!-- Agency Filter -->
                                    @if (empty(auth()->user()->agency_id))
                                        <div>
                                            <select name="agency_id" class="form-control"
                                                    style="">
                                                <option value="">Chọn chi nhánh</option>
                                                @foreach ($agencies as $agency)
                                                    <option value="{{ $agency->id }}" {{ request('agency_id') == $agency->id ? 'selected' : '' }}>
                                                        {{ $agency->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                    <div>
                                        <input type="date" name="start_date" class="form-control"
                                               style="" placeholder="Từ ngày"
                                               value="{{ request('start_date') }}">
                                    </div>
                                    <!-- Date Range Start -->
                                    <!-- Date Range End -->
                                    <div>
                                        <input type="date" name="end_date" class="form-control"
                                               style="" placeholder="Đến ngày"
                                               value="{{ request('end_date') }}">
                                    </div>
                                    <!-- Search Button -->
                                    <button type="submit" class="btn" style="margin-bottom: 0; border-radius: 8px">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Tên khách hàng
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Thành tiền
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Dịch vụ
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Chi nhánh
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Người tạo
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Ngày tạo
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($transactions) > 0)
                                        @foreach($transactions as $transaction)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <p
                                                                    class="mb-0 text-sm label-name">{{$transaction->customer->name}}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-bol mb-0">{{number_format($transaction->amount)}}</p>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-sm">{{$transaction->service->name}}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <p class="text-sm font-weight-bol mb-0">{{$transaction->agency->name}}</p>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <p class="text-sm font-weight-bol mb-0">{{$transaction->user->name}}</p>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <p class="text-sm font-weight-bol mb-0">{{ \Carbon\Carbon::parse($transaction->created_at)->format('d-m-Y') }}</p>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7" class="text-center"><img
                                                        src="https://www.carflow.qa/images/empty_item.svg"
                                                        alt="Not Found" style="width: 150px; margin: 20px 0;">
                                                <p class="text-secondary">Không tìm thấy bản ghi nào!</p></td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-end mt-3" style="margin-right: 16px;">
                                    {{ $transactions->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
