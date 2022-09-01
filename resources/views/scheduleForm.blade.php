@extends('layouts.app')

@section('content')
<div class="container">
    <div class="text-center">
        <a href="{{url('/teacherform')}} " style="font-size:20px">Teachers</a>&nbsp;&nbsp;
        <a href="{{url('/scheduleform')}} " style="font-size:20px">Schedule</a>
    </div>
    <br />
    <div style="margin:0 auto;width:70%;float:right">
        <div style="width:20%;margin:0 auto">
            <select onchange="showSchedule(this.value)" class=" form-control" id="teachername" name="teachername">
            </select>
            <br />
        </div>

        <table id="scheduletable" class="table  border-0 w-100">
            <thead>
                <tr>

                    <th class="text-uppercase">Class</th>
                    <th class="text-uppercase">Subject</th>
                    <th class="text-uppercase">From</th>
                    <th class="text-uppercase">To</th>
                    <th class="text-uppercase">Duration</th>
                </tr>
            </thead>
            <tbody id="teachersscheduledata">
            </tbody>
        </table>

    </div>
    <div style="margin:0 auto;width:20%;float:left">
        <h3>Add Schedule</h3>
        <form action="{{url('/addschedule')}} " method="POST">
            @csrf
            <div class=" form-group">
                <label for="text">Class:</label>
                <input type="text" class="form-control" id="class" placeholder="Enter Class" name="class" required>
            </div>
            <div class="form-group">
                <label for="text">Subject:</label>
                <input type="text" class="form-control" id="subject" placeholder="Enter Qualification" name="subject"
                    required>
            </div>
            <div class="form-group">
                <label for="text">Time From:</label>
                <input type="time" class="form-control" id="fromtime" placeholder="Example 8:30" name="fromtime"
                    required>
            </div>
            <div class="form-group">
                <label for="text">Time To:</label>
                <input type="time" class="form-control" id="totime" placeholder="Example 10:30" name="totime" required>
            </div>
            <div class="form-group">
                <label for="text">Teacher:</label>
                <select class="form-control" id="teachernameform" name="teachernameform"></select>
            </div>
            <br />
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
    $('#scheduletable').DataTable();
    //Get Clients
    $.ajax({
        url: "{{url('get-teachers-name')}}",
        type: "get",
        success: function(response) {
            var data = response;
            var len = 0;
            if (data != null) {
                len = data.length;
            }
            if (len > 0) {
                $("#existingclients").empty();
                for (var i = 0; i < len; i++) {
                    var id = data[i].id;
                    var name = data[i].name;
                    var option = "<option  value='" + id + "'>" + name +
                        "</option>";
                    $("#teachernameform").append(option);
                    $("#teachername").append(option);
                }
            }
        }

    });

});

function showSchedule(value) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "{{url('get-teachers-schedule')}}",
        data: "teacherid=" + value,
        success: function(response) {
            $("#teachersscheduledata").empty();
            $("#teachersscheduledata").append(response.result);
        }
    });
}
</script>