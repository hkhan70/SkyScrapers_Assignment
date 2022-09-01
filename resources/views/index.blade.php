@extends('layouts.app')

@section('content')
<div class="container">
    <div class="text-center">
        <a href="{{url('/teacherform')}} " style="font-size:20px">Teachers</a>&nbsp;&nbsp;
        <a href="{{url('/scheduleform')}} " style="font-size:20px">Schedule</a>
    </div>
</div>
@endsection