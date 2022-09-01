@extends('layouts.app')

@section('content')
<div class="container">
    <div class="text-center">
        <a href="{{url('/teacherform')}} " style="font-size:20px">Teachers</a>&nbsp;&nbsp;
        <a href="{{url('/scheduleform')}} " style="font-size:20px">Schedule</a>
    </div>
    <br />
    <div style="margin:0 auto;width:70%;float:right">
        <table id="teachertable" class="table  border-0 w-100">
            <thead>
                <tr>

                    <th class="text-uppercase">Name</th>
                    <th class="text-uppercase">Qualification</th>
                    <th class="text-uppercase">From</th>
                    <th class="text-uppercase">To</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($teachers as $item)
                <tr>
                    <td>{{$item->name}}</td>
                    <td>{{$item->qualification}}</td>
                    <td>{{$item->from}}</td>
                    <td>{{$item->to}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    <div style="margin:0 auto;width:20%;float:left">
        <h3>Add Teacher</h3>
        <form action="{{url('/addteacher')}} " method="POST">
            @csrf
            <div class=" form-group">
                <label for="text">Name:</label>
                <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" required>
            </div>
            <div class="form-group">
                <label for="text">Qualification:</label>
                <input type="text" class="form-control" id="qualification" placeholder="Enter Qualification"
                    name="qualification" required>
            </div>
            <div class="form-group">
                <label for="text">Time From:</label>
                <input type="time" class="form-control" id="fromtime" placeholder="Example 8:30" name="fromtime"
                    required>
            </div>
            <div class="form-group">
                <label for="text">Time To:</label>
                <input type="time" class="form-control" id="totime" placeholder="Example 10:30" name="totime" required>
            </div><br />
            @if (\Session::has('success'))
            <h6 style="color:green">{!! \Session::get('success') !!}</h6>
            @endif
            @if (\Session::has('error'))
            <h6 style="color:red">{!! \Session::get('error') !!}</h6>
            @endif
            <div class="form-group">
                <button type="submit" class="btn btn-default" style="background-color:blue;color:white">Submit</button>
            </div>

        </form>
    </div>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('#teachertable').DataTable();
});
</script>