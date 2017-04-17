@extends ('layouts.master_alternative')

@section ('header')
    @include ('layouts.header')
@endsection

@section ('content')
<div class="col-md-8 col-md-offset-4" style="margin:0 auto;padding: 70px 0 70px 0;">
    <div class="card">
        <h3 class="card-header">Create a new team</h3>

        <!-- <img class="card-img-top" src="/img/team.jpg"> -->

        <div class="card-block">
            <h4 class="card-title">Special title treatment</h4>

            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>

            <form class="form-group" action="" method="post">
                {{ csrf_field() }}

                <input class="form-control form-control-lg" type="text" placeholder="your-team-name">
                <br>

                <a href="#" class="btn btn-primary form-control form-control-lg" type="submit">Create team</a>
            </form>
        </div>
    </div>
</div>
@endsection

@section ('footer')
    @include ('layouts.footer')
@endsection
