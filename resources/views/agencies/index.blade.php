@extends('layouts.user_type.auth')
@section('title', 'Danh sách chi nhánh')

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        <div class="container-fluid py-4">
            <div class="row mb-4">
                <div class="col-6">
                    <h4>Danh sách chi nhánh</h4>
                </div>
                <div class="col-6 text-end">
                    <a href="{{route('agencies.create')}}" class="btn bg-gradient-success"><i
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
                                           placeholder="Nhập tên chi nhánh hoặc số điện thoại..."
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
                                            Tên chi nhánh
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Số điện thoại
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Email
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Địa chỉ
                                        </th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($agencies) > 0)
                                        @foreach($agencies as $agency)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <img style="object-fit: cover"
                                                                 src="https://www.finardproperties.com/sites/default/files/styles/large/public/blogpost-1.jpg?itok=Nx-7b2xU"
                                                                 class="avatar avatar-sm me-3"
                                                                 alt="avatar">
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <a href="{{route('agencies.edit', ['agency_id' => $agency->id])}}"
                                                               class="mb-0 text-sm label-name">{{$agency->name}}</a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-bol mb-0">{{$agency->phone}}</p>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-sm">{{$agency->email}}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <p class="text-sm font-weight-bol mb-0">{{$agency->address}}</p>
                                                </td>
                                                <td class="align-middle">
                                                    <a href="{{route('agencies.edit', ['agency_id' => $agency->id])}}"
                                                       class="text-warning font-weight-bold text-xs"
                                                       data-toggle="tooltip" data-original-title="Edit user">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>

                                                    <span class="mx-2">|</span>

                                                    <form action="{{ route('agencies.destroy', ['agency_id' => $agency->id]) }}"
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
                                    {{ $agencies->links('pagination::bootstrap-4') }}
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
