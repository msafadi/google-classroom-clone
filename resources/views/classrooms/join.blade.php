<x-dashboard-layout :title="__('Join Classroom')">
    <h2>{{ __('Join Classroom') }}: {{ $classroom->name }}</h2>
    
    @if (session()->has('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    
    <form action="{{ route('classrooms.join', $classroom->id) }}" method="post">
        @csrf
        @if (request('code'))
        <input type="hidden" name="code" value="{{ request('code') }}">
        @else
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="code" name="code" placeholder="{{ __('Classroom Code' )}}">
            <label for="code">{{ __('Classroom Code' )}}</label>
        </div>
        @endif
        <div>
            <button type="submit" class="btn btn-primary">{{ __('Join') }}</button>
        </div>
    </form>
</x-dashboard-layout>