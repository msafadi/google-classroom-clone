<x-dashboard-layout :title="__('Create Classroom')">
    <h2>{{ __('Create Classroom') }}</h2>
    <div>
        <a href="{{ route('classrooms.index') }}" class="btn btn-sm btn-dark">{{ __('Back to classrooms') }}</a>
    </div>
    
    <form action="{{ route('classrooms.store') }}" method="post">
        @csrf
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('Classroom Name' )}}">
            <label for="name">{{ __('Classroom Name' )}}</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="section" name="section" placeholder="{{ __('Classroom Section' )}}">
            <label for="section">{{ __('Classroom Section' )}}</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="subject" name="subject" placeholder="{{ __('Classroom Subject' )}}">
            <label for="subject">{{ __('Classroom Subject' )}}</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="room" name="room" placeholder="{{ __('Classroom Room' )}}">
            <label for="room">{{ __('Classroom Room' )}}</label>
        </div>
        <div>
            <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
        </div>
    </form>
</x-dashboard-layout>