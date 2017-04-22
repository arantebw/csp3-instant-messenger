@if (session('info'))
<div class="alert alert-info alert-dismissible text-center" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
  </button>
  <span>{{ session('info') }}</span>
</div>
@endif
