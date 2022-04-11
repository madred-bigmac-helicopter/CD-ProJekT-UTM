@extends('layouts.app')

@section('content')
    <div class="col-md-5 col-lg-4 col-xl-3 offset-xl-1">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Filters</h3></div>
            {{--            <div class="card-body">--}}
            {{--                <form class=""><label for="name-search" class="">Search by Name</label>--}}
            {{--                    <div class="input-group"><input id="name-search" aria-label="Challenge name search" type="text"--}}
            {{--                                                    class="form-control" value="">--}}
            {{--                        <div class="input-group-append"><span class="input-group-text"><svg aria-hidden="true"--}}
            {{--                                                                                            focusable="false"--}}
            {{--                                                                                            data-prefix="fas"--}}
            {{--                                                                                            data-icon="magnifying-glass"--}}
            {{--                                                                                            class="svg-inline--fa fa-magnifying-glass "--}}
            {{--                                                                                            role="img"--}}
            {{--                                                                                            xmlns="http://www.w3.org/2000/svg"--}}
            {{--                                                                                            viewBox="0 0 512 512"--}}
            {{--                                                                                            color="black"><path--}}
            {{--                                        fill="currentColor"--}}
            {{--                                        d="M500.3 443.7l-119.7-119.7c27.22-40.41 40.65-90.9 33.46-144.7C401.8 87.79 326.8 13.32 235.2 1.723C99.01-15.51-15.51 99.01 1.724 235.2c11.6 91.64 86.08 166.7 177.6 178.9c53.8 7.189 104.3-6.236 144.7-33.46l119.7 119.7c15.62 15.62 40.95 15.62 56.57 0C515.9 484.7 515.9 459.3 500.3 443.7zM79.1 208c0-70.58 57.42-128 128-128s128 57.42 128 128c0 70.58-57.42 128-128 128S79.1 278.6 79.1 208z"></path></svg></span>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </form>--}}
            {{--            </div>--}}
            {{--            <div class="card-header"><h4 class="card-title">Category Filter</h4></div>--}}
            <div class="card-body">
                <ul class="filter-list list-group">
                    {!! Form::open(['action' => ['App\Http\Controllers\TaskController@group'],
                'class' => 'form', 'style' => 'background-color: #fff']) !!}
                    <input type="checkbox" id="WebExploitation" name="category[]" value="0">
                    <label for="WebExploitation">Web Exploitation</label><br>

                    <input type="checkbox" id="Cryptography" name="category[]" value="1">
                    <label for="Cryptography">Cryptography</label><br>

                    <input type="checkbox" id="Reverse Engineering" name="category[]" value="2">
                    <label for="ReverseEngineering">Reverse Engineering</label><br>

                    <input type="checkbox" id="forensics" name="category[]" value="3">
                    <label for="forensics">Forensics</label><br>

                    <input type="checkbox" id="GeneralSkills" name="category[]" value="4">
                    <label for="GeneralSkills">GeneralSkills</label><br>

                    <input type="checkbox" id="BinaryExploitation" name="category[]" value="5">
                    <label for="BinaryExploitation">Binary Exploitation</label><br>

                    <input type="checkbox" id="Uncategorized" name="category[]" value="6">
                    <label for="Uncategorized">Uncategorized</label><br>
                    {{ Form::button('Search', ['type' => 'submit', 'class' => 'btn btn-primary mr-2']) }}
                    {!! Form::close() !!}
                </ul>
            </div>

        </div>
    </div>

    <div class="col-md-7 col-lg-8 col-xl-7" id="cards">

    </div>

        <script>
            $(document).ready(function () {
                var data = JSON.stringify({
                    'category': "all",
                })
                $.ajax({
                    type: "post",
                    url: "/practice/group",
                    data: data,
                    contentType: 'application/json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (res){
                        let cards =  $('#cards')
                        cards.empty();
                        cards.append(res);


                    }
                });
            })
        </script>
@endsection
