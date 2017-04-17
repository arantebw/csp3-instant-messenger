<section class="row">
    <div class="col-sm-12">
        <form method="post" action="/message/create">
            {{ csrf_field() }}

            <div class="input-group">
                <input type="text" class="form-control" placeholder="Type in your message then hit Enter" id="message" name="message" required>

                <!-- File upload -->
                <span class="input-group-btn">
                    <button class="btn btn-primary chat-btn" type="button" title="Send a file">
                        <i class="fa fa-upload" aria-hidden="true"></i>
                    </button>
                </span>

                <!-- Send message -->
                <span class="input-group-btn">
                    <button class="btn btn-primary chat-btn" type="submit" title="Send message">
                        <i class="fa fa-paper-plane" aria-hidden="true"></i>
                    </button>
                </span>
            </div><!-- /input-group -->
        </form>
    </div> <!-- /col-sm-12 -->
</section><!-- /row -->
<br>
