<section class="row message-maker">
    <div class="col-sm-9 offset-sm-3 col-md-10 offset-md-2">
        <form method="post" action="/message/create">
            {{ csrf_field() }}

            <!-- Create group message -->
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Type in your message then hit Enter" id="message" name="message" required>

                <!-- Send message -->
                <span class="input-group-btn">
                    <button class="btn btn-outline-primary chat-btn" type="submit" title="Send message">
                        <i class="fa fa-paper-plane" aria-hidden="true"></i>
                    </button>
                </span>
            </div><!-- /input-group -->
        </form>
    </div> <!-- /col-sm-12 -->
</section><!-- /row -->
<br>
