@extends('layouts.admin-dashboard')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-5 border-bottom">
        <h1 class="h2">Roles</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <a class="btn btn-sm btn-outline-success" href="{{ route('roles.create') }}">Add new role</a>
            </div>
        </div>
    </div>

    @if (\Session::has('success'))
        <div class="alert alert-success">
            {!! \Session::get('success') !!}
        </div>
    @endif
    <table class="table table-hover">
        <thead class="thead-dark">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col" width="160"></th>
        </tr>
        </thead>
        <tbody>

        @foreach ($roles as $role)
            <tr>
                <th scope="row">{{ $role->id }}</th>
                <td>{{ $role->name }}</td>
                <td>
                    <a class="btn btn-link text-primary" href="{{ route('roles.edit', ['id' => $role->id]) }}">
                        <i class="far fa-edit"></i>
                    </a>

                    <button class="btn btn-link text-danger remove-roles" id="id" value="{{$role->id}}">
                        <i class="fas fa-trash-alt"></i>
                    </button>

                </td>

            </tr>
        @endforeach
        </tbody>
    </table>
    <ul class="pagination justify-content-center mt-5">
        <li class="page-item ">
            <a class="page-link" href="{{$roles->previousPageUrl()}}" tabindex="-1">Previous</a>
        </li>
        @for($i=1; $i<=$roles->lastPage();$i++)
            <li class="page-item"><a class="page-link" href="{{$roles->url($i)}}">{{$i}}</a></li>
        @endfor
        <li class="page-item">
            <a class="page-link" href="{{$roles->nextPageUrl()}}">Next</a>
        </li>
    </ul>
    <script>
        setTimeout(function () {
                $("body").on("click", ".remove-roles", function () {
                    var id = (this.value);
                    swal(
                        {
                            title: "Are you sure?",
                            text: "Once deleted, you will not be able to recover this!",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                        }
                    )

                        .then((willDelete) => {
                            if (willDelete) {
                                var data = JSON.stringify({
                                    'id': id,
                                })
                                $.ajax({
                                    type: "post",
                                    url:  "/admin/roles/delete/" + id,
                                    data: data,
                                    contentType: 'application/json'
                                });
                                swal("Your role has been deleted!", {
                                    icon: "success",
                                });

                                $(this)
                                    .closest("tr")
                                    .remove();


                            }
                        });

                })
            },

            500);
    </script>
@endsection
