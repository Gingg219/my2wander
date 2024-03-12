@extends('admin.layout.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2 p">
                        <div class="col-lg-8">
                            <div class="form-inline">
                                <div class="form-group mb-2">
                                    <input type="text" class="form-control dropdown-toggle" placeholder="Search..." id="search" name="search">
                                </div>
                                <div class="form-group mx-sm-3 mb-2">
                                    <label for="status-select" class="mr-2">Status</label>
                                    <select class="custom-select" id="status-select" name="status">
                                        <option value="all">All</option>
                                        <option value="1">Published</option>
                                        <option value="0">Pending</option>
                                    </select>
                                </div> 
                            </div>                            
                        </div>
                        <div class="col-lg-4">
                            <div class="text-lg-right">
                                <a href="{{ route('admin.posts.create') }}">
                                    <button type="button" class="btn btn-danger mb-2 mr-2">
                                        <i class="mdi mdi-post-outline mr-1"></i> Add New Post
                                    </button>
                                </a>
                            </div>
                        </div><!-- end col-->
                    </div>
                    <div id="data-table">
                        {{-- Table Posts --}}
                        @include ('admin.posts.table')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
<script>
    $(document).ready(function () {

        $('#search').on('keyup', function(e) {
            updateData();
        });

        $('#status-select').on('change', function(e) {
            updateData();
        });

        function updateData() {
            var search = $('#search').val();
            var status = $('#status-select').val();
            var data = {
                'search': search,
                'status': status
            };

            fetch_post_data(data);
        }
    });
    
    let debounce;
    function fetch_post_data(data) {
        clearTimeout(debounce);
        debounce = setTimeout(() => {
        $.ajax({
            url: "{{ route('admin.posts.index') }}",
            method: "GET",
            data: data,
            success: function(data) {
                    $('#data-table').fadeOut(70, function() {
                        $('#data-table').html(data);
                        $('#data-table').fadeIn(70);
                    });
            },
            error: function(xhr, status, error) {
                alert("Đã xảy ra lỗi: " + error);
            }
        });
            }, 1000);
    }
</script>
@endpush
