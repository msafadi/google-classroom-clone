<x-dashboard-layout :title="$classroom->name">
    @include('classrooms._classroom-header')

    <div class="row">
        <div class="col-md-2">
            <div class="border rounded p-3">
                <h6>{{ __('Classroom Code') }}</h6>
                <div class="fs-3 text-primary">{{ $classroom->code }}</div>
            </div>
        </div>
        <div class="col-md-10">

        </div>
    </div>
</x-dashboard-layout>