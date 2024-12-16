@extends('layouts.user_type.auth')
@section('title', 'Cập nhật mới trang')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Thêm mới trang</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('pages.update', ['page_id' => $page->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="slug" class="form-label">Nhập slug <span
                                        class="field-required"> *</span></label>
                            <input type="text" name="slug" id="slug" class="form-control"
                                   placeholder="Nhập slug" value="{{$page->slug}}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Trạng thái <span class="field-required"> *</span></label>
                            <select name="status" id="status" class="form-select" required>
                                <option @if($page->status == 1) selected @endif value="1">Kích hoạt</option>
                                <option @if($page->status == 0) selected @endif value="0">Không kích hoạt</option>
                            </select>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="content" class="form-label">Nội dung trang <span
                                        class="field-required"> *</span></label>
                            <textarea name="content" id="content" class="form-control"
                                      placeholder="Nhập nội dung trang" required> {{$page->content}} </textarea>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-2">Lưu</button>
                        <a href="{{ route('pages.index') }}" class="btn btn-secondary">Hủy</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<style>
    .field-required {
        color: red;
    }
</style>