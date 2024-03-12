@extends('admin.layout.master')
@section('content')
<div class="row" data-select2-id="11">
    <div class="col-12" data-select2-id="10">
        <div class="card" data-select2-id="9">
            <div class="card-body" data-select2-id="8">
                <form id="create-table" enctype="multipart/form-data">
                @csrf
                <div class="row" data-select2-id="7">
                    <div class="col-xl-6" data-select2-id="6">
                        <div class="form-group">
                            <label >Title</label>
                            <input type="text" id="projectname" class="form-control" placeholder="Enter Title" name="title" value="{{ old('title') }}">
                        <div class="invalid-feedback print-error-msg" style="display:none" id="title">
                        </div>
                        <div class="form-group">
                            <label >Meta Title</label>
                            <input type="text" id="projectname" class="form-control" placeholder="Enter Title" name="meta_title" value="{{ old('title') }}">
                            <div class="invalid-feedback print-error-msg" style="display:none" id="meta_title">
                        </div>
                        <div class="form-group">
                            <label >Contents</label>
                            <textarea id="summernote" name="content"></textarea>
                            <div class="invalid-feedback print-error-msg" style="display:none" id="content">
                        </div>
                        <input type="hidden" value="0" name="status">
                        <div class="form-group">
                            <label>Categories</label>
                            <select class="select2 form-control select2-multiple" name="categories[]" data-toggle="select2" multiple="multiple" data-placeholder="Choose ...">
                            @foreach ($categories as $category )
                                <option value="{{ intval($category->id) }}">{{ $category->title }}</option> 
                            @endforeach
                            </select>
                            <div class="invalid-feedback print-error-msg" style="display:none" id="categories[]">
                        </div>
                        <div class="form-group">
                            <label>Tags</label>
                            <select class="select2 form-control select2-multiple" name="tags[]" data-toggle="select2" multiple="multiple" data-placeholder="Choose ...">
                                @foreach ($tags as $tag )
                                    <option value="{{ intval($tag->id) }}">{{ $tag->title }}</option> 
                                @endforeach
                            </select>
                            <div class="invalid-feedback print-error-msg" style="display:none" id="tags[]">
                        </div>

                        <div class="form-group">
                            <label for="project-overview">Parent-posts</label>
                            
                            <select class="form-control select2" data-toggle="select2" name="parent_id">
                                <option value="">Null</option>
                                @foreach ($posts as $post )
                                    <option value="{{intval($post->id) }}">{{ $post->title }}</option> 
                                @endforeach
                            </select>
                            <div class="invalid-feedback print-error-msg" style="display:none" id="parent_id">
                        </div>
                    </div>
                    <!-- end col-->
                    <div class="col-xl-6">
                        <div class="form-group d-flex justify-content-end">
                            <button class="text-uppercase btn btn-primary btn-lg mr-1" type="submit" id="btn-createPost"><i class="mdi mdi-post-outline mr-1"></i> Create </button>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </form>
            </div> <!-- end card-body -->
        </div> <!-- end card-->
    </div> <!-- end col-->
</div>

@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    $(document).ready(function () {

        imageFiles = [];
        $('#summernote').summernote({
            placeholder: 'Hello World',
            tabsize: 2,
            height: 300,
            callbacks: {
                onImageUpload: function(files) {
                    for (var i = 0; i < files.length; i++) {
                        imageFiles.push(files[i]);
                    }
                    
                    for (var i = 0; i < files.length; i++) {
                        var reader = new FileReader();
                        reader.onloadend = function () {
                            var imgNode = document.createElement('img');
                            imgNode.setAttribute('src', reader.result);
                            $('#summernote').summernote('insertNode', imgNode);
                        }
                        reader.readAsDataURL(files[i]);
                    }
                }
            }
        });
        
        $('#btn-createPost').on('click', function (e) {
            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var formData = new FormData();
        
            // Thêm tất cả các tệp hình ảnh vào FormData
            for (var i = 0; i < imageFiles.length; i++) {
                formData.append('images[]',  imageFiles[i]);
            }
            var data;
            $.ajax({
                url: "{{ route('admin.posts.upload_image') }}", // Đường dẫn tới phương thức xử lý tải ảnh trên máy chủ
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                // Phản hồi từ máy chủ nên chứa một mảng các đường dẫn đến các ảnh đã lưu trữ
                    var imageUrls = response;

                    // Lấy text dạng html từ trình soạn thảo
                    var html = $('#summernote').summernote('code');

                    // Tạo một đối tượng DOM từ text html
                    var dom = new DOMParser().parseFromString(html, 'text/html');

                    // Lấy tất cả các thẻ img trong đối tượng DOM
                    var images = dom.getElementsByTagName('img');

                    // Duyệt qua từng thẻ img và xóa thuộc tính src
                    for (var i = 0; i < images.length; i++) {
                        images[i].setAttribute('src', "{{ asset('storage') }}" +"/"+ imageUrls[i]);
                    }

                    // Chuyển đối tượng DOM trở lại text html
                    var newHtml = dom.documentElement.innerHTML;

                    // Chèn lại text html vào trình soạn thảo
                    $('#summernote').summernote('code', newHtml);

                    data = $('#create-table').serialize();

                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.posts.store') }}",
                        data: data,
                        dataType: "json",
                        success: function (data) {
                            if(data && data['status'] == 200){
                                // showToastSuccess(data);
                                $.NotificationApp.send(data.titile, data.message, "top-right", "#9EC600", "info");
                                $('html, body').animate({ scrollTop: 0 }, 'slow');
                                setTimeout(function() {
                                    window.location.href = "{{ route('admin.posts.index') }}";
                                }, 2000);
                            }else {
                                showToastFail(data);
                            }
                        },
                        error: function(data) {
                            printErrorMsg(data.responseJSON.errors);
                        }
                    });

                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
            
        });
    });
</script>
@endpush