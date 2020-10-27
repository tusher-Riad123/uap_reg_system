<div class="card-body">
    <form method="POST" action="/course-register/{{ Auth::user()->id }}">
        @csrf

        <div class="form-group row">
            <label for="credit" class="col-md-4 col-form-label text-md-right">Enter Course Credit of this semester</label>

            <div class="col-md-6">
                <input type="text" class="form-control @error('credit') is-invalid @enderror" name="credit" value="{{ old('credit') }}" required autocomplete="email" autofocus>

                @error('credit')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">Subjects</label>

            <div class="col-md-6">
                <select class="custom-select" name="course_id[]" id="inputGroupSelect04" multiple>
                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->name }} - Credit - {{ $course->credit }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    Submit
                </button>
            </div>
        </div>
    </form>
</div>
