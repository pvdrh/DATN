<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
     navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        {{--        <nav aria-label="breadcrumb">--}}
        {{--            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">--}}
        {{--            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>--}}
        {{--            <li class="breadcrumb-item text-sm text-dark active text-capitalize" aria-current="page">{{ str_replace('-', ' ', Request::path()) }}</li>--}}
        {{--            </ol>--}}
        {{--            <h6 class="font-weight-bolder mb-0 text-capitalize">{{ str_replace('-', ' ', Request::path()) }}</h6>--}}
        {{--        </nav>--}}
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 d-flex justify-content-end" id="navbar">
            <ul class="navbar-nav justify-content-end">
                <li class="nav-item dropdown d-flex align-items-center">
                    <a class="nav-link dropdown-toggle text-body font-weight-bold px-0" href="#" id="userDropdown"
                       role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person"></i> <span class="d-sm-inline d-none">{{auth()->user()->name}}</span>
                    </a>
                    <!-- Dropdown Menu -->
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown"
                        style="min-width: 180px; margin-top: -40px !important;">
                        <li>
                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                                <i class="bi bi-shield-lock me-2"></i>Đổi mật khẩu
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ url('/logout') }}">
                                <i class="bi bi-box-arrow-right me-2"></i>Đăng xuất
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- Modal Đổi Mật Khẩu -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="changePasswordModalLabel">Đổi mật khẩu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Body -->
            <div class="modal-body">
                <form id="changePasswordForm">
                    <div class="mb-3">
                        <label for="currentPassword" class="form-label">Mật khẩu hiện tại</label>
                        <input type="password" class="form-control" id="currentPassword"
                               placeholder="Nhập mật khẩu hiện tại">
                    </div>
                    <div class="mb-3">
                        <label for="newPassword" class="form-label">Mật khẩu mới</label>
                        <input type="password" class="form-control" id="newPassword" placeholder="Nhập mật khẩu mới">
                    </div>
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Xác nhận mật khẩu mới</label>
                        <input type="password" class="form-control" id="confirmPassword"
                               placeholder="Nhập lại mật khẩu mới">
                    </div>
                </form>
            </div>
            <!-- Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-primary" id="savePassword">Lưu thay đổi</button>
            </div>
        </div>
    </div>
</div>

<style>
    .dropdown .dropdown-toggle:after, .dropend .dropdown-toggle:after, .dropstart .dropdown-toggle:after, .dropup .dropdown-toggle:after {
        display: none !important;
    }

    .dropdown .dropdown-menu:before {
        display: none !important;
    }
</style>

<script>
    document.getElementById("savePassword").addEventListener("click", function () {
        const currentPassword = document.getElementById("currentPassword").value;
        const newPassword = document.getElementById("newPassword").value;
        const confirmPassword = document.getElementById("confirmPassword").value;

        if (newPassword !== confirmPassword) {
            alert("Mật khẩu mới và xác nhận mật khẩu không khớp!");
            return;
        }

        fetch("{{ route('change.password') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                current_password: document.getElementById("currentPassword").value,
                new_password: document.getElementById("newPassword").value,
                new_password_confirmation: document.getElementById("confirmPassword").value
            })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert("Có lỗi xảy ra: " + data.message);
                }
            })
            .catch(error => console.error("Error:", error));

    });
    document.addEventListener("DOMContentLoaded", function () {
        const changePasswordModalNav = document.getElementById("changePasswordModal");

        changePasswordModalNav.addEventListener("hidden.bs.modal", function () {
            document.getElementById("changePasswordForm").reset();
        });
    });

</script>

<!-- End Navbar -->