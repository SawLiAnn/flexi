@props(['weeks'])

<table class="m-auto text-center month">
    <thead>
        <tr>
            <th>Mo</th>
            <th>Tu</th>
            <th>We</th>
            <th>Th</th>
            <th>Fr</th>
            <th>Sa</th>
            <th>Su</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($weeks as $days)
        <tr>
            @foreach ($days as $day)
            <td>
                <a href="{{ $day['path'] }}" class="
        block
        py-2
        hover:bg-gray-300
        {{ ! $day['withinMonth'] ? 'text-gray-300' : '' }}
    ">
                    {{ $day['day'] }}
                </a>
            </td>
            @endforeach
        </tr>
        @endforeach
    </tbody>
</table>