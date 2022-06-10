<style>
    p {
        color: black;
        display: -webkit-box;
        max-width: 200px;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    p:hover {
        color: #0025ff;
    }
</style>
<div style="display: flex; flex-direction: row">
    <div>
        <div class="card ">
            <div class="card-header"><h3 class="card-title">Filters</h3></div>
            {{--                        <div class="card-body">--}}
            {{--                            <form class=""><label for="name-search" class="">Search by Name</label>--}}
            {{--                                <div class="input-group"><input id="name-search" aria-label="Challenge name search" type="text"--}}
            {{--                                                                class="form-control" value="">--}}
            {{--                                    <div class="input-group-append"><span class="input-group-text"><svg aria-hidden="true"--}}
            {{--                                                                                                        focusable="false"--}}
            {{--                                                                                                        data-prefix="fas"--}}
            {{--                                                                                                        data-icon="magnifying-glass"--}}
            {{--                                                                                                        class="svg-inline--fa fa-magnifying-glass "--}}
            {{--                                                                                                        role="img"--}}
            {{--                                                                                                        xmlns="http://www.w3.org/2000/svg"--}}
            {{--                                                                                                        viewBox="0 0 512 512"--}}
            {{--                                                                                                        color="black"><path--}}
            {{--                                                    fill="currentColor"--}}
            {{--                                                    d="M500.3 443.7l-119.7-119.7c27.22-40.41 40.65-90.9 33.46-144.7C401.8 87.79 326.8 13.32 235.2 1.723C99.01-15.51-15.51 99.01 1.724 235.2c11.6 91.64 86.08 166.7 177.6 178.9c53.8 7.189 104.3-6.236 144.7-33.46l119.7 119.7c15.62 15.62 40.95 15.62 56.57 0C515.9 484.7 515.9 459.3 500.3 443.7zM79.1 208c0-70.58 57.42-128 128-128s128 57.42 128 128c0 70.58-57.42 128-128 128S79.1 278.6 79.1 208z"></path></svg></span>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </form>--}}
            {{--                        </div>--}}
            {{--                        <div class="card-header"><h4 class="card-title">Category Filter</h4></div>--}}
            <div class="card-body">
                <ul class="filter-list list-group">


                    <label><input class="pristine" type="checkbox" id="WebExploitation"
                                  name="category[]" value="0"> <span>
                        Web Exploitation
                    </span></label><br>

                    <label><input class="pristine" type="checkbox" id="WebExploitation"
                                  name="category[]" value="1"> <span>
                        Cryptography
                    </span></label><br>

                    <label><input class="pristine" type="checkbox" id="WebExploitation"
                                  name="category[]" value="2"> <span>
                       Reverse Engineering
                    </span></label><br>

                    <label><input class="pristine" type="checkbox" id="WebExploitation"
                                  name="category[]" value="3"> <span>
                                           Forensics

                    </span></label><br>

                    <label><input class="pristine" type="checkbox" id="WebExploitation"
                                  name="category[]" value="4"> <span>
                                            GeneralSkills

                    </span></label><br>

                    <label><input class="pristine" type="checkbox" id="WebExploitation"
                                  name="category[]" value="5"> <span>
                                           Binary Exploitation

                    </span></label><br>

                    <label><input class="pristine" type="checkbox" id="WebExploitation"
                                  name="category[]" value="6"> <span>
                                           Uncategorized

                    </span></label><br>

                    <button class="btn btn-primary" type="button" id="search-btn">Search</button>
                </ul>
            </div>
        </div>
    </div>

    <div class="container ">
        @if($task == null)
            <span style="font-size: 50px; width: 700px; margin-top: 150px"> Sorry, nothing to show</span>
        @else
            <div style="display: grid;
        grid-template-columns: repeat(4, 1fr );
        gap: 10px;
  grid-auto-rows: 175px;">

                @foreach($task as $item)
                    {{--                @if(count($item)>0)--}}
                    <a type="button" class="" style="color: transparent;" data-toggle="modal"
                       data-target="#exampleModalCenter" onclick="modal({{$item->id}})" id="modal_id"
                       modal_id="{{$item->id}}">
                        <div class="card">
                            <div class="face face1">
                                <div class="content" style="display: flex;flex-direction: column;align-items: center;">
                                    <img
                                        src="{{asset('png-transparent-encryption-cryptography-computer-icons-computer-network-key-computer-network-text-objects-removebg-preview.png')}}">
                                    @if($user->tasks()->where('id',$item['id'])->exists())
                                        <p style="color: #00d200; font-size: 15px">Done</p>

                                    @endif
                                    @if($item->category == 0)
                                        <h3 class="body-md mt-1 card-title">Web Exploitation</h3>
                                    @endif
                                    @if($item->category == 1)
                                        <h3 class="body-md mt-1 card-title">Cryptography</h3>
                                    @endif
                                    @if($item->category == 2)
                                        <h3 class="body-md mt-1 card-title">Reverse Engineering</h3>
                                    @endif
                                    @if($item->category == 3)
                                        <h3 class="body-md mt-1 card-title">Forensics</h3>
                                    @endif
                                    @if($item->category == 4)
                                        <h3 class="body-md mt-1 card-title">General Skills</h3>
                                    @endif
                                    @if($item->category == 5)
                                        <h3 class="body-md mt-1 card-title">Binary Exploitation</h3>
                                    @endif
                                    @if($item->category == 6)
                                        <h3 class="body-md mt-1 card-title">Uncategorized</h3>
                                    @endif
                                </div>
                            </div>

                            <div class="face face2" style="tab-index: 1000">
                                <div class="content">
                                    <div
                                        style="display: flex;flex-direction: row;justify-content: space-between; margin-bottom: 7px; width: 150px">
                                        <p><b>{{$item->name}}</b></p>
                                        <p>{{$item->points}}</p>
                                    </div>

                                    <p>{{$item->description}}</p>
                                </div>

                            </div>

                        </div>
                        {{--                @endif--}}
                    </a>

                @endforeach
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalCenterTitle" aria-hidden="false"
                     style=" z-index:55555555 !important; color: #333">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content" style="background: #333333">
                            <div class="modal-header" style="border: transparent">
                                <h4 class="modal-title" id="exampleModalLongTitle"
                                    style="color: white;font-family: Consolas; margin-top: 15px">
                                </h4>
                                <span style="color: red; font-size: 25px" hidden id="wrong-alert">Wrong Flag</span>
                                @if($user->tasks()->where('id',$item['id'])->exists())
                                    <span style="color: green; font-size: 25px" hidden
                                          id="correct-alert">Correct Flag</span>
                                @else
                                    <span style="color: green; font-size: 25px" hidden
                                          id="correct-alert">Correct Flag</span>
                                @endif
                            </div>
                            <div class="modal-body"
                                 style="color: white; font-family: Consolas;display:flex;flex-direction: column">
                                <span id="modal-description"></span>
                                <input hidden id="selected_modal_id">
                                <a id="download-route">Download data</a>

                                <label
                                    style="display: flex;flex-direction: column; align-items: start; margin-top: 20px">
                                    <span>Flag</span>
                                    <input style="margin-top: 7px; color: black" type="text" id="flag-input"/>
                                </label>

                                <div id="hint" data-value=""  style="display: flex;justify-content: flex-end;">
{{--                                    <button type="button" hidden class="btn btn-success" id="hint_cost_button"></button>--}}
                                </div>


                                {{--                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"--}}
                                {{--                                             fill="currentColor" class="bi bi-question-square-fill" viewBox="0 0 16 16">--}}
                                {{--                                            <path--}}
                                {{--                                                d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.496 6.033a.237.237 0 0 1-.24-.247C5.35 4.091 6.737 3.5 8.005 3.5c1.396 0 2.672.73 2.672 2.24 0 1.08-.635 1.594-1.244 2.057-.737.559-1.01.768-1.01 1.486v.105a.25.25 0 0 1-.25.25h-.81a.25.25 0 0 1-.25-.246l-.004-.217c-.038-.927.495-1.498 1.168-1.987.59-.444.965-.736.965-1.371 0-.825-.628-1.168-1.314-1.168-.803 0-1.253.478-1.342 1.134-.018.137-.128.25-.266.25h-.825zm2.325 6.443c-.584 0-1.009-.394-1.009-.927 0-.552.425-.94 1.01-.94.609 0 1.028.388 1.028.94 0 .533-.42.927-1.029.927z"/>--}}
                                {{--                                        </svg>--}}


                            </div>

                            <input hidden type="text" value="" id="task-id">
                            <div class="modal-footer" style="border: black solid 1px">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="submit-flag" onclick="flagSubmit()">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                @endif
            </div>
    </div>
</div>

<script>
    function modal(id) {
        let exampleModalLongTitle = $("#exampleModalLongTitle");
        let modal_description = $("#modal-description");
        let task_id = $("#task-id");
        let route = $("#download-route");
        let selected_modal_id = $("#selected_modal_id");
        selected_modal_id.val(null)
        // let hint = $('#hint');
        let hintB = $('#hint_cost_button');

        $.ajax({
            type: "post",
            url: "/practice/modal/" + id,
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (res) {
                exampleModalLongTitle.empty();
                modal_description.empty();
                task_id.empty();
                selected_modal_id.val(res["id"])
                exampleModalLongTitle.append(res["name"])
                modal_description.append(res["description"])


                if (res['hint'] !== null) {
                    // hint.removeAttr('hidden')
                    $('#hint').empty();
                    $('#hint').append('<button type="button" hidden class="btn btn-success" onclick="getHint()" id="hint_cost_button"></button>')
                    hintB.removeAttr('hidden')
                    $('#hint_cost_button').append("Hint cost " + res["hint_cost"]);
                    // hint.attr('data-value', (res["hint"]));
                    // hint.attr('cost', (res["hint_cost"]));
                }
                task_id.val(res["id"]);
                if (res["file"] == null) {
                    route.attr("hidden", true)
                } else {
                    let routeName = "/practice/file/" + res['file'];
                    route.attr("hidden", false)
                    route.attr("href", routeName);
                }
            }
        });
    }

     function getHint () {
        let hint = $('#hint');
        console.log('asdasd')
        // console.log(hint)
        hint.empty();
        let id = $("#selected_modal_id").val();

        $.ajax({
            type: "post",
            url: "/practice/hint/" + id,
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (res) {
                console.log(res)
                hint.append(res)
                // hint.attr('id', '')
            }
        });
        // $(this).append($(this).attr('data-value'));
    }
</script>

<script>
    $("#search-btn").on('click', function () {
        var category = $.map($('input[name="category[]"]:checked'), function (c) {
            return c.value;
        })
        if (category.length === 0) {
            category = "all";
        }
        var data = JSON.stringify({
            category,
        })
        $.ajax({
            type: "post",
            url: "/practice/group",
            data: data,
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (res) {
                let cards = $('#cards')
                cards.empty();
                cards.append(res);
            }
        });
    })
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        this.forms[0].addEventListener("change", e => {
            e.target.removeAttribute("class");
        });
    });
</script>

<script>
    function flagSubmit() {
        let id = $("#task-id").val();
        let flag = $("#flag-input").val();
        $("#wrong-alert").attr("hidden", true);

        if (!flag == '') {
            $.ajax({
                type: "post",
                url: "/practice/submit/" + flag + "/" + id,
                contentType: 'application/json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (res) {
                    if (res === 'fail') {
                        $("#correct-alert").attr("hidden", true);
                        $("#wrong-alert").removeAttr("hidden");
                    } else {
                        $("#wrong-alert").attr("hidden", true);
                        $("#correct-alert").removeAttr("hidden");
                        setTimeout(() => {
                            location.reload();
                        }, 1500)
                    }
                }
            });
        } else {
            $("#correct-alert").attr("hidden", true);
            $("#wrong-alert").attr("hidden", true);
        }
    }
</script>
