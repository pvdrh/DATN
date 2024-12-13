@extends('layouts.user_type.guest')

@section('content')

    <main class="main-content d-flex align-items-center min-vh-100"
          style="position: relative; background: rgba(0, 0, 0, 0.7);">
        <!-- Background image with opacity -->
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-image: url('https://cdn.unityfitness.vn/2024/09/khu-tap-gym-2.webp'); background-size: cover; background-position: center; opacity: 0.8; z-index: -1;"></div>

        <section class="w-100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                        <div class="card card-plain mt-4"
                             style="background-color: #ffffff; border-radius: 15px; box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2); padding: 20px;">
                            <div class="card-header pb-0 text-left bg-transparent">
                                <h3 class="font-weight-bolder text-info text-gradient text-center">Bắt đầu quản lý phòng
                                    GYM của bạn</h3>
                                <p class="mb-4 text-center"></p>
                            </div>
                            <div class="card-body">
                                <form role="form" method="POST" action="/session">
                                    @csrf
                                    <label for="phone" class="font-weight-bold">Số điện thoại</label>
                                    <div class="mb-3">
                                        <input type="text" class="form-control" name="phone" id="phone"
                                               placeholder="Nhập số điện thoại của bạn" aria-label="Phone"
                                               aria-describedby="phone-addon">
                                        @error('phone')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <label for="password" class="font-weight-bold">Mật khẩu</label>
                                    <div class="mb-3">
                                        <input type="password" class="form-control" name="password" id="password"
                                               placeholder="Nhập mật khẩu" aria-label="Password"
                                               aria-describedby="password-addon">
                                        @error('password')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-primary w-100 mt-4 mb-0"
                                                style="padding: 10px 20px; font-size: 16px; transition: background-color 0.3s;">
                                            Đăng nhập
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
