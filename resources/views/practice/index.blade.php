@extends('layouts.app')

@section('content')
    @if (\Session::has('success'))
        <div class="alert alert-success">
            {!! \Session::get('success') !!}
        </div>
    @endif
    <div class="" id="cards"></div>

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
