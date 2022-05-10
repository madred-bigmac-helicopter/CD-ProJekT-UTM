@extends('admin.layouts.dashboard')

@section('content')
    {!! Form::open(['action' => ['App\Http\Controllers\Admin\TaskController@store'],
'class' => 'form', 'style' => 'background-color: #fff; margin-left:150px; margin-top:100px', "enctype" => "multipart/form-data"]) !!}
    {{--    <form class="form" style="background-color: #fff" action="{{route('task.store')}}" method="post">--}}
    <div class="card-body">
        <div class="form-group row">
            <div class="col-lg-6">
                <label>Name
{{--                    <span class="text-danger">*</span>--}}
                </label>
                <input name="name" type="text" class="form-control @if ($errors->has('name')) is-invalid @endif" placeholder="Enter task name" required/>
                <span class="form-text text-muted">Please enter task name</span>
                @if ($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->getBag('default')->first('name') }}
                    </div>
                @endif
            </div>
            <div class="col-lg-6">
                <label for="Textarea">Description
{{--                    <span class="text-danger">*</span>--}}
                </label>
                <textarea name="description" class="form-control" id="Textarea" rows="3"></textarea>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-6">
                <label>Flag
{{--                    <span class="text-danger">*</span>--}}
                </label>
                <div class="input-group">
                    <input name="flag" type="text" class="form-control" placeholder="Enter your flag" required/>
                </div>
                <span class="form-text text-muted">Please enter your flag</span>
            </div>
            <div class="col-lg-6">
                <label>Hint</label>
                <div class="input-group">
                    <input name="hint" type="text" class="form-control" placeholder="Enter your hint"/>
                </div>
                <span class="form-text text-muted">Please enter your hint</span>
            </div>

        </div>
        <div class="form-group row">

            <div class="col-lg-6">
                <label for="Select1">Difficulty
{{--                    <span class="text-danger">*</span>--}}
                </label>
                <select class="form-control" id="Select1" name = "difficulty">
                    <option value="0">Easy</option>
                    <option value="1">Medium</option>
                    <option value="2">Hard</option>
                </select>
            </div>
            <div class="col-lg-6">
                <label for="Select">Category
{{--                    <span class="text-danger">*</span>--}}
                </label>
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
{{--                    <span class="text-danger">*</span>--}}
                </label>
                <div class="input-group">

                    <input name="points" type="number" class="form-control" placeholder="Enter your task's point" required/>

                </div>
                <span class="form-text text-muted">Please enter task's points</span>
            </div>
            <div class="col-lg-6">
                <label>Hint cost
{{--                    <span class="text-danger">*</span>--}}
                </label>
                <div class="input-group">

                    <input name="hint_cost" type="number" class="form-control" placeholder="Enter your hint's cost"/>

                </div>
                <span class="form-text text-muted">Please enter hint's cost</span>
            </div>
            <div class="form-group">
                <label>File</label>
                <div class="custom-file">
                    <input name="file" type="file" class="custom-file-input" id="customFile"/>
                    <label class="custom-file-label selected" for="customFile"></label>
                </div>
            </div>
        </div>

    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-lg-6">
                {{--                <button type="submit" class="btn btn-primary mr-2">Save</button>--}}
                {{ Form::button('Save', ['type' => 'submit', 'class' => 'btn btn-primary mr-2']) }}
                {!! Form::close() !!}
                {{--                <button type="reset" class="btn btn-secondary">Cancel</button>--}}
            </div>
            {{--            <div class="col-lg-6 text-lg-right">--}}
            {{--                <button type="reset" class="btn btn-danger">Delete</button>--}}
            {{--            </div>--}}
        </div>
    </div>
    </form>
@endsection
