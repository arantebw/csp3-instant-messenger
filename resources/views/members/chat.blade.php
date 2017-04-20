@foreach ($team as $t)
	{{ $t->name }}
@endforeach

@foreach ($user1 as $u1)
	{{ $u1->first_name . ' ' . $u1->last_name }}
@endforeach

@foreach ($user2 as $u2)
	{{ $u2->first_name . ' ' . $u2->last_name }}
@endforeach