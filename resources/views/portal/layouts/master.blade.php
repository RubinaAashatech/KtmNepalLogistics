<!doctype html>
<html lang="en">
@php
$sitesetting = App\Models\SiteSetting::first();
$services = App\Models\Service::all();
$export_guide = App\Models\Post::whereType('export_guide')
    ->latest()
    ->first();
$import_guide = App\Models\Post::whereType('import_guide')
    ->latest()
    ->first();
@endphp
@include('portal.includes.head')

<body>

    @include('portal.includes.nav')

    @include('portal.includes.tracking')

    @yield('content')

    @include('portal.includes.footer')

    @include('portal.includes.scripts.scripts')

    <x-toast />

</body>

</html>
