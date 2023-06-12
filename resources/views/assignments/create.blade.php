<x-dashboard-layout :title="__('Create Assignment')">
    <h2>{{ __('Create Assignment') }}</h2>
    <div>
        <a href="{{ route('classrooms.assignments.index', $classroom->id) }}" class="btn btn-sm btn-dark">{{ __('Back to classrooms') }}</a>
    </div>
    
    <form action="{{ route('classrooms.assignments.store', $classroom->id) }}" method="post">
        @csrf
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="title" name="title" placeholder="{{ __('Title' )}}">
            <label for="title">{{ __('Title' )}}</label>
        </div>
        <div class="form-floating mb-3">
            <textarea class="form-control" id="description" name="description" placeholder="{{ __('Description' )}}">
            <label for="description">{{ __('Description' )}}</label>
        </div>
        <div class="form-floating mb-3">
            <input type="number" class="form-control" id="points" name="points" placeholder="{{ __('Points' )}}">
            <label for="points">{{ __('Points' )}}</label>
        </div>
        <div class="form-floating mb-3">
            <input type="datetime-local" class="form-control" id="due" name="due" placeholder="{{ __('Due' )}}">
            <label for="due">{{ __('Due' )}}</label>
        </div>
        <div>
            <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
        </div>
    </form>
</x-dashboard-layout>