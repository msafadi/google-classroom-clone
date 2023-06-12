<x-dashboard-layout :title="__('Classrooms')">
    <h2>{{ __('Classrooms') }}</h2>
    <div>
        <a href="{{ route('classrooms.create') }}" class="btn btn-sm btn-success">{{ __('Create new class') }}</a>
        <a href="#" class="btn btn-sm btn-primary">{{ __('Join class') }}</a>
    </div>
    <div class="row">
        @foreach($classrooms as $classroom)
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $classroom->name }}</h5>
                    <a href="{{ route('classrooms.show', $classroom->id) }}"
                        class="btn btn-primary">{{ __('View class') }}</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</x-dashboard-layout>