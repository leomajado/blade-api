<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">New Post</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group">
                    <form method="POST" action="{{ route('post.store') }}" id="frmsavepost">
                        @csrf
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" id="ptitle">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" name="description" id="pdescription">
                    </form>
                </div>
            </div>

                <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button
                    type="submit"
                    class="btn btn-primary"
                    form="frmsavepost"
                >
                Save
                </button>
            </div>

        </div>
    </div>
</div>
