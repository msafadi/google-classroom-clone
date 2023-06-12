@php
    $links = [
        'classrooms.stream' => __('Stream'),
        'classrooms.classwork' => __('Classwork'),
        'classrooms.people' => __('People'),
    ];
@endphp
<div class="d-flex flex-wrap">
    <h2>{{ $classroom->name }}</h2>
    <div>
        <ul class="nav nav-pills">
            @foreach ($links as $route => $text)
            <li class="nav-item">
                <a class="nav-link @if(Route::is($route)) active @endif" href="{{ route($route, $classroom->id) }}">{{ $text }}</a>
            </li>
            @endforeach
        </ul>
    </div>
</div>