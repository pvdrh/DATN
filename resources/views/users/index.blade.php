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
                                                    @if (!$user->is_protected)
                                                        <span class="mx-2">|</span>
                                                        <form action="{{ route('users.destroy', ['user_id' => $user->id]) }}"
                                                              method="POST" style="display:inline;"
                                                              onsubmit="return confirm('Bạn có chắc chắn muốn xóa không?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                    class="border-0 bg-transparent p-0 text-danger"
                                                                    data-toggle="tooltip"
                                                                    data-original-title="Delete user">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </form>
                                                    @endif

                                                    @if(auth()->user()->role == 1)
                                                        <span class="mx-2">|</span>
                                                        <a href="#"
                                                           class="text-dark font-weight-bold text-sm change-password-user-btn"
                                                           data-user-id="{{ $user->id }}"
                                                           data-toggle="tooltip"
                                                           data-original-title="Đặt lại mật khẩu">
                                                            <i class="bi bi-key"></i>
                                                        </a>
                                                    @endif
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
    <!-- Modal Đổi Mật Khẩu -->
    <div class="modal fade" id="changePasswordUserModal" tabindex="-1" aria-labelledby="changePasswordModalUserLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordModalUserLabel">Đổi mật khẩu người dùng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Body -->
                <div class="modal-body">
                    <form id="changePasswordUserForm">
                        <input type="hidden" id="userId">
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">Mật khẩu mới</label>
                            <input type="password" class="form-control" id="newPasswordUser"
                                   placeholder="Nhập mật khẩu mới">
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Xác nhận mật khẩu mới</label>
                            <input type="password" class="form-control" id="confirmPasswordUser"
                                   placeholder="Nhập lại mật khẩu mới">
                        </div>
                    </form>
                </div>
                <!-- Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-primary" id="resetPassword">Lưu thay đổi</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const changePasswordUserModal = document.getElementById("changePasswordUserModal");

            changePasswordUserModal.addEventListener("hidden.bs.modal", function () {
                document.getElementById("changePasswordUserForm").reset();
                document.getElementById("userId").value = "";
            });
            document.querySelectorAll(".change-password-user-btn").forEach(button => {
                button.addEventListener("click", function() {
                    const userId = this.getAttribute("data-user-id");
                    document.getElementById("userId").value = userId;
                    const modal = new bootstrap.Modal(document.getElementById("changePasswordUserModal"));
                    modal.show();
                });
            });

            document.getElementById("resetPassword").addEventListener("click", function() {
                const userId = document.getElementById("userId").value;
                const newPassword = document.getElementById("newPasswordUser").value;
                const confirmPassword = document.getElementById("confirmPasswordUser").value;

                if (newPassword !== confirmPassword) {
                    alert("Mật khẩu xác nhận không khớp!");
                    return;
                }

                fetch("{{ route('change.changePassword') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        user_id: userId,
                        new_password: newPassword,
                        new_password_confirmation: confirmPassword
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            location.reload();
                        } else {
                            alert("Có lỗi xảy ra: " + (data.message || "Không xác định"));
                        }
                    })
                    .catch(error => {
                        console.error("Error:", error);
                        alert("Đã xảy ra lỗi kết nối. Vui lòng thử lại!");
                    });
            });
        });
    </script>

@endsection
