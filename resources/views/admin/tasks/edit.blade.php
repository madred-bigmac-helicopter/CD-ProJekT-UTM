@extends('admin.layouts.dashboard')

@section('content')
    {!! Form::open(['action' => ['App\Http\Controllers\Admin\TaskController@update', $task->id],
'class' => 'form', 'style' => 'background-color: #fff']) !!}
    {{--    <form class="form" style="background-color: #fff" action="{{route('task.store')}}" method="post">--}}
    <div class="card-body">
        <div class="form-group row">
            <div class="col-lg-6">
                <label>Name
                    <span class="text-danger">*</span></label>
                <input name="name" type="text" class="form-control" placeholder="Enter task name" required value="{{$task->name}}"/>
                <span class="form-text text-muted">Please enter task name</span>
            </div>
            <div class="col-lg-6">
                <label for="Textarea">Description
                    <span class="text-danger">*</span></label>
                <textarea name="description" class="form-control" id="Textarea" rows="3">{{$task->description}}</textarea>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-6">
                <label>Flag
                    <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input name="flag" type="text" class="form-control" placeholder="Enter your flag" required value="{{$task->flag}}"/>
                </div>
                <span class="form-text text-muted">Please enter your flag</span>
            </div>
            <div class="col-lg-6">
                <label>Hint</label>
                <div class="input-group">
                    <input name="hint" type="text" class="form-control" placeholder="Enter your hint" value="{{$task->hint}}"/>
                </div>
                <span class="form-text text-muted">Please enter your hint</span>
            </div>

        </div>
        <div class="form-group row">

            <div class="col-lg-6">
                <label for="Select1">Difficulty
                    <span class="text-danger">*</span></label>
                <select class="form-control" id="Select1" name = "difficulty" >
                    <option value="0">Easy</option>
                    <option value="1">Medium</option>
                    <option value="2">Hard</option>
                </select>
            </div>
            <div class="col-lg-6">
                <label for="Select">Category
                    <span class="text-danger">*</span></label>
                <select class="form-control" id="Select" name="category">
                    <option value="0">Web Exploitation</option>
                    <option value="1">Cryptography</option>
                    <option value="2">Reverse Engineering</option>
                    <option value="3">Forensics</option>
                    <option value="4">General Skills</option>
                    <option value="5">Binary Exploitation</option>
                    <option value="6">Uncategorized</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-6">
                <label>Point
                    <span class="text-danger">*</span></label>
                <div class="input-group">

                    <input name="points" type="number" class="form-control" placeholder="Enter your task's point" required value="{{$task->points}}"/>

                </div>
                <span class="form-text text-muted">Please enter task's points</span>
            </div>
            <div class="col-lg-6">
                <label>Hint cost
                    <span class="text-danger">*</span></label>
                <div class="input-group">

                    <input name="hint_cost" type="number" class="form-control" placeholder="Enter your hint's cost" value="{{$task->hint_cost}}"/>

                </div>
                <span class="form-text text-muted">Please enter hint's cost</span>
            </div>
        </div>

    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-lg-6">
                {{--                <button type="submit" class="btn btn-primary mr-2">Save</button>--}}
                {{ Form::button('Save', ['type' => 'submit', 'class' => 'btn btn-primary mr-2']) }}

                {{--                <button type="reset" class="btn btn-secondary">Cancel</button>--}}
            </div>
            {{--            <div class="col-lg-6 text-lg-right">--}}
            {{--                <button type="reset" class="btn btn-danger">Delete</button>--}}
            {{--            </div>--}}
        </div>
    </div>
    {!! Form::close() !!}
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script >
        $(document).ready(function (){
            let selectedD = "{{$task->difficulty}}"
            let selectedC = "{{$task->category}}"
            let s = $('#Select1').children().eq(selectedD);
            let c = $('#Select').children().eq(selectedC);
            s.prop('selected',true);
            c.prop('selected',true);
        })
    </script>

@endsection
