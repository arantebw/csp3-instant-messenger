<!-- members/direct_message_maker.blade.php -->
<section class="row message-maker">
    <div class="col-sm-9 offset-sm-3 col-md-10 offset-md-2">
        <form method="post" action="/direct-messages/{{ $u2->id }}/create">
            {{ csrf_field() }}

            <!-- Create new direct message -->
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Type in your direct message then hit Enter" id="body" name="body" required>

                <!-- New direct_message -->
                <span class="input-group-btn">
                    <button class="btn btn-outline-primary chat-btn" type="submit" title="Send direct message">
	                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                    </button>
                </span>
            </div><!-- /input-group -->
        </form>
    </div> <!-- /col-sm-12 -->
</section><!-- /row -->
<br>
