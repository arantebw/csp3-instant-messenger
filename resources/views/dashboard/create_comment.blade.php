<!-- dashboard/create_comment.blade.php -->
<section class="row message-maker">
    <div class="col-sm-9 offset-sm-3 col-md-10 offset-md-2">
        <form method="post" action="/comment/{{ $message->id }}/create">
            {{ csrf_field() }}

            <!-- Create new comment -->
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Type in your comment then hit Enter" id="comment" name="comment" required>

                <!-- New comment -->
                <span class="input-group-btn">
                    <button class="btn btn-outline-primary chat-btn" type="submit" title="Send comment">
	                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                    </button>
                </span>
            </div><!-- /input-group -->
        </form>
    </div> <!-- /col-sm-12 -->
</section><!-- /row -->
<br>
