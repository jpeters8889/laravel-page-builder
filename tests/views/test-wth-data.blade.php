<html lang="en">
<head>
    @include('page-view-builder::header')
</head>

<body>
<h1>Hello World</h1>
<ul>
    @foreach($list as $item)
        <li>{{ $item }}</li>
    @endforeach
</ul>
</body>
</html>
