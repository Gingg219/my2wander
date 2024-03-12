<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-backdrop="static"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Preview</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body" id="contentPostPreview">
            
        </div>
        <div class="modal-footer">
            <button id="closeModalPreview" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button data-url="{{ route('admin.posts.edit', ['post_id' => $post->id]) }}" class="btn btn-primary" id="btnEditPost" tabindex="-1" role="a" aria-disabled="true">Edit</button>
        </div>
        </div>
    </div>
</div>
@push('js')
    <script>
        async function getData(id) {
            await $.ajax({
                url: '/admin/posts/show/'+id,
                type: 'GET',
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: (data) => {
                    $('#contentPostPreview').html(data.content);
                },
                error: (data) => {
                    showToastFail(data.error);
                }
            });
        };
        $('#btnEditPost').click(function (e) { 
            e.preventDefault();
            var urlEdit = $('#btnEditPost').data('url');
            window.location.href = urlEdit;
        });

    </script>
@endpush
