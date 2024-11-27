@extends('layouts.user_type.auth')
@section('title', 'Danh sách nhân viên')

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        <div class="container-fluid py-4">
            <div class="row mb-4">
                <div class="col-6">
                    <h4>Danh sách nhân viên</h4>
                </div>
                <div class="col-6 text-end">
                    <a href="{{ route('users.create') }}" class="btn bg-gradient-success">
                        <i class="bi bi-plus-circle me-2"></i> Thêm mới
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <form action="#" method="GET" class="d-inline">
                                <div class="input-group w-30">
                                    <input type="text" name="search" class="form-control custom-input"
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
                                            Nhân viên
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Thông tin
                                        </th>
                                        <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Quyền hạn
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Ngày tạo
                                        </th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($users) > 0)
                                        @foreach($users as $user)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <img src="https://static.vecteezy.com/system/resources/thumbnails/024/983/914/small/simple-user-default-icon-free-png.png"
                                                                 class="avatar avatar-sm me-3"
                                                                 alt="user1">
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <a
                                                                    href="{{route('users.edit', ['user_id' =>$user->id])}}"
                                                                    class="mb-0 text-sm label-name">{{$user->name}}</a>
                                                            <p class="text-xs text-secondary mb-0">{{$user->phone}}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">{{$user->gender ? 'Nam' : 'Nữ'}}</p>
                                                    <p class="text-xs text-secondary mb-0">{{$user->agency ? $user->agency->name : ''}}</p>
                                                </td>
                                                <td class="align-middle text-center">
                                                <span class="text-xs font-weight-bold mb-0">
                                                    @if ($user->role == 1)
                                                        Quản trị viên
                                                    @elseif ($user->role == 2)
                                                        Nhân viên quản trị
                                                    @elseif ($user->role == 3)
                                                        Huấn luyện viên
                                                    @else
                                                        Vai trò không xác định
                                                    @endif
                                                </span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-xs font-weight-bold mb-0">{{ $user->created_at->format('d/m/Y') }}</span>
                                                </td>
                                                <td class="align-middle">
                                                    <a href="{{route('users.edit', ['user_id' => $user->id])}}"
                                                       class="text-warning font-weight-bold text-xs"
                                                       data-toggle="tooltip" data-original-title="Edit user">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>

                                                    <span class="mx-2">|</span>

                                                    <form action="{{ route('users.destroy', ['user_id' => $user->id]) }}"
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
                                    {{ $users->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
