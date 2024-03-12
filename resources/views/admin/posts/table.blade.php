
<table class="table table-striped table-centered mb-0" id="table-data">
    <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Author</th>
            <th>Created</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        @foreach ($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->user->name }}</td>
                <td>{{ $post->created_at }}</td>
                <td>
                    <!-- Success Switch-->
                    <input class="post-status-switch" type="checkbox" id="switchStatus{{ $post->id }}" {{ $post->status == App\Enums\PublishedEnum::Published ? 'checked' : '' }} data-switch="{{ $post->id }}"/>
                    <label for="switchStatus{{ $post->id }}" data-on-label="On" data-off-label="Off" data-toggle="modal" data-target="#confirmPublish"></label>
                </td>
                <td class="table-action" style="">
                    <div data-toggle="modal" data-target="#exampleModal" class="action-preview" style="cursor: pointer" id="btnPreviewPost"
                    data-url="{{ route('admin.posts.show', ['post_id' => $post->id]) }}"
                    data-edit="{{ route('admin.posts.edit', ['post_id' => $post->id]) }}"
                    data-id="{{ $post->id }}"
                    onclick="getData({{ $post->id }})">
                        <i class="mdi mdi-eye"></i>
                    </div>
                    <a href="{{ route('admin.posts.edit', ['post_id' => $post->id]) }}" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                    <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                </td>
            </tr>
        @endforeach
    </thead>
    <tbody></tbody>
</table>
@include('admin.posts.view_modal')
@include('admin.posts.confirm_publish_modal')
{{ $posts->onEachSide(3)->links() }}