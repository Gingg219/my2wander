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
                            <input type="text" id="projectname" class="form-control" placeholder="Enter Title" name="title" value="{{ $post->title }}">
                        <div class="invalid-feedback print-error-msg" style="display:none" id="title">
                        </div>
                        <div class="form-group">
                            <label >Meta Title</label>
                            <input type="text" id="projectname" class="form-control" placeholder="Enter Title" name="meta_title" value="{{ $post->meta_title }}">
                            <div class="invalid-feedback print-error-msg" style="display:none" id="meta_title">
                        </div>
                        <div class="form-group">
                            <label >Contents</label>
                            <textarea id="summernote" name="content">{{ $post->content }}</textarea>
                            <div class="invalid-feedback print-error-msg" style="display:none" id="content">
                        </div>
                        <input type="hidden" value="0" name="status">
                        <div class="form-group">
                            <label>Categories</label>
                            <select class="select2 form-control select2-multiple" name="categories[]" data-toggle="select2" multiple="multiple" data-placeholder="Choose ...">
                            @foreach ($categories as $category )
                                <option value="{{ intval($category->id) }}" {{$post->categories->contains('id', intval($category->id)) ? 'selected' : ''}}>{{ $category->title }}</option> 
                            @endforeach
                            </select>
                            <div class="invalid-feedback print-error-msg" style="display:none" id="categories[]">
                        </div>
                        <div class="form-group">
                            <label>Tags</label>
                            <select id="tags" class="select2 form-control select2-multiple" name="tags[]" data-toggle="select2" multiple="multiple" data-placeholder="Choose ...">
                            @foreach ($tags as $tag )
                                <option value="{{ intval($tag->id) }}" {{$post->tags->contains('id', intval($tag->id)) ? 'selected' : ''}}>{{ $tag->title }}</option> 
                            @endforeach
                            </select>
                            <div class="invalid-feedback print-error-msg" style="display:none" id="tags[]">
                        </div>

                        <div class="form-group">
                            <label for="project-overview">Parent-posts</label>
                            
                            <select class="form-control select2" data-toggle="select2" name="parent_id">
                                <option value="">Null</option>
                                @foreach ($posts as $value => $key )
                                    <option value="{{ $key }}" {{ $post->parent_id == $key ? 'selected' : '' }}>{{ $value }}</option> 
                                @endforeach
                            </select>
                            <div class="invalid-feedback print-error-msg" style="display:none" id="parent_id">
                        </div>
                    </div>
                    <!-- end col-->
                    <div class="col-xl-6">
                        <div class="form-group">
                            <button class="btn btn-primary btn-block" type="submit" id="btn-createPost"><i class="mdi mdi-post-outline mr-1"></i> Save </button>
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
       
        $('#summernote').summernote({
            placeholder: 'Hello Bootstrap 4',
            tabsize: 2,
            height: 300,
            callbacks: {
                onImageUpload: function(files) {

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    var formData = new FormData();
                
                    for (var i = 0; i < files.length; i++) {
                        formData.append('images[]', files[i]);
                    }
                    $.ajax({
                        url: "{{ route('admin.posts.upload_image') }}", // Đường dẫn tới phương thức xử lý tải ảnh trên máy chủ
                        method: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            var imageUrls = response;

                            imageUrls.forEach(function(imageUrl) {
                                var imgNode = document.createElement('img');
                                var url = "{{ asset('storage') }}" +"/"+ imageUrl;
                                imgNode.setAttribute('src', url);
                                $('#summernote').summernote('insertNode', imgNode);
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                }
            }
        });

        $('#btn-createPost').on('click', function (e) {
            e.preventDefault();
            var markupStr = $('#summernote').summernote('code');
            formData = $('#create-table').serialize();
            $.ajax({
                type: "POST",
                url: "{{ route('admin.posts.store') }}",
                data: formData,
                dataType: "json",
                success: function (data) {
                    if(data && data['status'] == 200){
                        showToastSuccess(data);
                        location.reload();
                    }else {
                        showToastFail(data);
                    }
                },
                error: function(data) {
                    printErrorMsg(data.responseJSON.errors);
                }
            });
        });
    });
</script>
@endpush