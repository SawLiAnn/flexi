<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Document</title>
</head>

<body>

    <div class="p-4 mb-8 text-4xl text-center text-white bg-gray-900">
        {{ $calendar['year'] }}
    </div>

    <div class="grid grid-cols-3 gap-8 px-8 pb-8">
        @foreach ($calendar['months'] as $month)
        <div>
            <div class="p-4 mb-4 text-2xl text-center text-white bg-gray-900 dark:bg-gray-800">
                {{ $month['month'] }}
            </div>

            <x-month :weeks="$month['weeks']" />
        </div>
        @endforeach
    </div>
</body>

</html>