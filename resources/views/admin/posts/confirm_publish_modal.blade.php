<!-- Modal -->
<div id="confirmPublish" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="text-center">
                    <i class="dripicons-warning h1 text-warning"></i>
                    <h4 class="mt-2">The status of the post is changed</h4>
                    {{-- <p class="mt-3">You just changed the status of a post</p> --}}
                    <button type="button" class="btn btn-warning my-2" data-dismiss="modal">Continue</button>
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script>
        $(document).ready(function () {
            $('.post-status-switch').on('change', function (e) {
                var postId = $(this).data('switch');
                $.ajax({
                    url: '/admin/posts/update/status/' + postId,
                    method: 'POST',
                    data: postId,
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function(response) {
                    },
                    error: function(xhr, status, error) {

                    }
                });
            });
        });
    </script>
@endpush
