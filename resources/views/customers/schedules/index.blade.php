@extends('layouts.user_type.auth')

@section('title', 'Danh sách lịch tập luyện')

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        <div class="container-fluid py-4">
            <div class="row mb-4">
                <div class="col-6">
                    <h4>Danh sách lịch tập luyện</h4>
                </div>
                @if(!auth()->user()->is_protected)
                    <div class="col-6 text-end">
                        <a href="{{route('customer_schedules.create')}}" class="btn bg-gradient-success"><i
                                    class="bi bi-plus-circle me-2"></i> Thêm mới</a>
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <form action="#" method="GET" class="d-inline">
                                <div class="input-group w-30">
                                    <input type="text"
                                           name="search"
                                           class="form-control custom-input"
                                           placeholder="Nhập tên dịch vụ hoặc khách hàng"
                                           value="{{ old('search', request('search')) }}">
                                    <span class="input-group-text">
            <i class="bi bi-search"></i>
        </span>
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
                                            Người hướng dẫn
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Thời gian bắt đầu
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Thời gian kết thúc
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Ghi chú
                                        </th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($items) > 0)
                                        @foreach($items as $item)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <img src="https://st4.depositphotos.com/8055500/30873/v/450/depositphotos_308737798-stock-illustration-calendar-vector-icon-black-illustration.jpg"
                                                                 class="avatar avatar-sm me-3"
                                                                 alt="user1">
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <p class="text-sm font-weight-bol mb-0">{{$item->customer->name ?? ''}}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-bol mb-0">{{$item->user->name ?? ''}}</p>
                                                </td>
                                                <td class="align-middle text-left">
                                                    <span class="text-sm">{{ $item->start_time ? \Carbon\Carbon::parse($item->start_time)->format('H:i d/m/Y') : '-' }}</span>
                                                </td>
                                                <td class="align-middle text-left">
                                                    <span class="text-sm">
                                                        {{ $item->end_time ? \Carbon\Carbon::parse($item->end_time)->format('H:i d/m/Y') : '-' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-bol mb-0">{{$item->note}}</p>
                                                </td>
                                                <td class="align-middle">
                                                    <form action="{{ route('customer_schedules.destroy', ['id' => $item->id]) }}"
                                                          method="POST" style="display:inline;"
                                                          onsubmit="return confirm('Bạn có chắc chắn muốn xóa không?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="border-0 bg-transparent p-0 text-danger"
                                                                data-toggle="tooltip" data-original-title="Delete user">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
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
                                    {{ $items->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
@endsection
