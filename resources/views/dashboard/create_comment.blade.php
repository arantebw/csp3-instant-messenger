<!-- dashboard/create_comment.blade.php -->
<section class="row">
    <div class="col-sm-12">
        <form method="post" action="/comment/{{ $message->id }}/create">
            {{ csrf_field() }}

            <div class="input-group">
                <!-- Comment body -->
                <input type="text" class="form-control" placeholder="Type in your comment then hit Enter" id="comment" name="comment" required>

                <span class="input-group-btn">
                    <!-- New file upload -->
                    <button class="btn btn-primary chat-btn" type="button" title="Send a file">
                        <i class="fa fa-upload" aria-hidden="true"></i>
                    </button>
                </span>

                <span class="input-group-btn">
                    <!-- New comment -->
                    <button class="btn btn-primary chat-btn" type="submit" title="Send comment">
	                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                    </button>
                </span>
            </div><!-- /input-group -->
        </form>
    </div> <!-- /col-sm-12 -->
</section><!-- /row -->
<br>
