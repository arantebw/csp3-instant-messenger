@extends ('layouts.master_alternative')

@section ('title')
    reoslack &middot; Thank you for using Reoslack!
@endsection

@section ('header')
<div class="container-fluid main-header blue-header">
    @include ('layouts.header_content')
</div>
@endsection

@section ('content')
<div class="col-md-8 col-md-offset-4" style="margin:0 auto;padding: 70px 0 70px 0;">
    @include ('layouts.errors')

    <div class="card">
        <h3 class="card-header text-center">Thank for using Reoslack!</h3>

        <div class="card-block">
            <p>You are now completely logged out.</p>
        </div>
    </div>
</div>
@endsection
