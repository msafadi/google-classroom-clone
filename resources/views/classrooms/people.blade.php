<x-dashboard-layout :title="$classroom->name">
    @include('classrooms._classroom-header')

    <div class="row">
        <div class="col-md-12">
            <h3>{{ __('Teachers') }}</h3>
            @foreach ($users->where('pivot.role', 'teacher')->all() as $user)
            <div class="border-bottom p-3">
                {{ $user->name }} - {{ $user->pivot->role }}
            </div>
            @endforeach
            <hr class="mb-4">
            <h3>{{ __('Students') }}</h3>
            @foreach ($users->where('pivot.role', 'student')->all() as $user)
            <div class="border-bottom p-3 d-flex justify-content-between">
                <div>
                    {{ $user->name }} - {{ $user->pivot->role }}
                </div>
                <form action="{{ route('classrooms.users.remove', $classroom->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <button type="submit" class="btn btn-sm btn-danger">{{ __('Remove') }}</button>
                </form>
            </div>
            @endforeach
        </div>
    </div>
</x-dashboard-layout>