@extends('layouts.user_type.auth')
@section('title', 'Danh sách dịch vụ')

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        <div class="container-fluid py-4">
            <div class="row mb-4">
                <div class="col-6">
                    <h4>Danh sách dịch vụ</h4>
                </div>
                <div class="col-6 text-end">
                    <a href="{{route('services.create')}}" class="btn bg-gradient-success"><i
                                class="bi bi-plus-circle me-2"></i> Thêm mới</a>
                </div>
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
                                           placeholder="Nhập tên dịch vụ"
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
                                            Tên dịch vụ
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Giá
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Thời gian
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Chi nhánh
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Loại dịch vụ
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Trạng thái
                                        </th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($services) > 0)
                                        @foreach($services as $service)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <img style="object-fit: cover"
                                                                 src="https://cdn2.iconfinder.com/data/icons/hotel-12/24/hotel-fitness-room-512.png"
                                                                 class="avatar avatar-sm me-3"
                                                                 alt="avatar">
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <a href="{{route('services.edit', ['service_id' => $service->id])}}"
                                                               class="mb-0 text-sm label-name">{{$service->name}}</a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-bol mb-0">{{number_format($service->price)}}</p>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-sm">{{$service->duration}}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <p class="text-sm font-weight-bol mb-0">{{$service->agency->name}}</p>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <p class="text-sm font-weight-bol mb-0">@if($service->type === 1)
                                                            Dịch vụ tập luyện
                                                        @elseif($service->type === 2)
                                                            Dịch vụ cá nhân
                                                        @else
                                                            Dịch vụ khác
                                                        @endif</p>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <p class="text-sm font-weight-bol mb-0">@if($service->status)
                                                            <span class="badge badge-sm bg-gradient-success">Hoạt động</span>
                                                        @else
                                                            <span class="badge badge-sm bg-gradient-warning">Không hoạt động</span>
                                                        @endif</p>
                                                </td>
                                                <td class="align-middle">
                                                    <a href="{{route('services.edit', ['service_id' => $service->id])}}"
                                                       class="text-warning font-weight-bold text-xs"
                                                       data-toggle="tooltip" data-original-title="Edit user">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>

                                                    <span class="mx-2">|</span>

                                                    <form action="{{ route('services.destroy', ['service_id' => $service->id]) }}"
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
                                    {{ $services->links('pagination::bootstrap-4') }}
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
