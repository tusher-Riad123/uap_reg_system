<div class="card-body">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <ul>
                @foreach ($students as $student)
                    <li>{{ $student->user_name }} - {{ $student->course_name }} - {{ $student->credit }} - Total Credit - {{ $student->total }} <a href="approve/{{ $student->id }}" class="btn btn-sm btn-success mx-3">Accept</a><a href="deny/{{ $student->id }}" class="btn btn-sm btn-danger">Deny</a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
