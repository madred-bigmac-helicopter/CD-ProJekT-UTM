@extends('admin.layouts.dashboard')

@section('content')

    <!--begin::Wrapper-->
    <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper"
         style="padding-top: 0 ; padding-left: 0; width: 130%">

        <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
            <!--begin::Entry-->
            <div class="d-flex flex-column-fluid">
                <div class="container">
                    <div class="card card-custom">
                        {{--                        <div class="card-header flex-wrap border-0 pt-6 pb-0">--}}
                        {{--                            <div class="card-toolbar">--}}
                        {{--                                <!--begin::Button-->--}}
                        {{--                                <a href="#" class="btn btn-primary font-weight-bolder">--}}
                        {{--											<span class="svg-icon svg-icon-md">--}}
                        {{--												<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Design/Flatten.svg-->--}}
                        {{--												<svg xmlns="http://www.w3.org/2000/svg"--}}
                        {{--                                                     xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"--}}
                        {{--                                                     height="24px" viewBox="0 0 24 24" version="1.1">--}}
                        {{--													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
                        {{--														<rect x="0" y="0" width="24" height="24"/>--}}
                        {{--														<circle fill="#000000" cx="9" cy="15" r="6"/>--}}
                        {{--														<path--}}
                        {{--                                                            d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z"--}}
                        {{--                                                            fill="#000000" opacity="0.3"/>--}}
                        {{--													</g>--}}
                        {{--												</svg>--}}
                        {{--                                                <!--end::Svg Icon-->--}}
                        {{--											</span>New Record</a>--}}
                        {{--                                <!--end::Button-->--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        <div class="card-body">
                            <!--begin: Search Form-->
                            <!--begin::Search Form-->
                            <div class="mb-7">
                                <div class="row align-items-center">
                                    <div class="col-lg-9 col-xl-8">
                                        <div class="row align-items-center">
                                            <div class="col-md-4 my-2 my-md-0">
                                                <div class="input-icon">
                                                    <input type="text" class="form-control"
                                                           placeholder="Search..."
                                                           id="kt_datatable_search_query"/>
                                                    <span>
																	<i class="flaticon2-search-1 text-muted"></i>
																</span>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-xl-4 mt-5 mt-lg-0">
                                        <a href="#"
                                           class="btn btn-light-primary px-6 font-weight-bold">Search</a>
                                    </div>
                                </div>
                            </div>
                            <!--end::Search Form-->
                            <!--end: Search Form-->
                            <!--begin: Datatable-->
                            <div class="datatable datatable-bordered datatable-head-custom"
                                 id="kt_datatable"></div>
                            <!--end: Datatable-->
                        </div>
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::Entry-->
        </div>
        <!--end::Content-->
        <!--begin::Footer-->
        <!--end::Footer-->
    </div>
    <script>


        var KTDatatableRemoteAjaxDemo = {
            init: function () {
                var t;
                t = $("#kt_datatable").KTDatatable({
                    data: {
                        type: "remote",
                        source: {
                            read: {
                                url: "/admin/users", map: function (t) {
                                    var a = t;
                                    return void 0 !== t.data && (a = t.data), a
                                }
                            }
                        },
                        pageSize: 10,
                        serverPaging: !0,
                        serverFiltering: !0,
                        serverSorting: !0
                    },
                    layout: {scroll: !1, footer: !1},
                    sortable: !0,
                    pagination: !0,
                    search: {input: $("#kt_datatable_search_query"), key: "generalSearch"},
                    columns: [{
                        field: "RecordID",
                        title: "#",
                        sortable: "asc",
                        width: 30,
                        type: "number",
                        selector: !1,
                        textAlign: "center"
                    },
                        {
                            field: "id", title: "ID", template: function (t) {
                                return t.id
                            }
                        },
                        {
                            field: "name", title: "Name", template: function (t) {
                                return t.name
                            }
                        },
                        {
                            field: "email", title: "email", template: function (t) {
                                return t.email
                            }
                        },
                        {
                            field: "role", title: "Role", template: function (t) {
                                return t.role
                            }
                        },

                        {
                            field: "Actions",
                            title: "Actions",
                            sortable: !1,
                            width: 125,
                            overflow: "visible",
                            autoHide: !1,
                            template: function (t) {
                                return '                        <div class="dropdown dropdown-inline">                                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">                                <ul class="navi flex-column navi-hover py-2">                                    <li class="navi-header font-weight-bolder text-uppercase font-size-xs text-primary pb-2">                                        Choose an action:                                    </li>                                    <li class="navi-item">                                        <a href="#" class="navi-link">                                            <span class="navi-icon"><i class="la la-print"></i></span>                                            <span class="navi-text">Print</span>                                        </a>                                    </li>                                    <li class="navi-item">                                        <a href="#" class="navi-link">                                            <span class="navi-icon"><i class="la la-copy"></i></span>                                            <span class="navi-text">Copy</span>                                        </a>                                    </li>                                    <li class="navi-item">                                        <a href="#" class="navi-link">                                            <span class="navi-icon"><i class="la la-file-excel-o"></i></span>                                            <span class="navi-text">Excel</span>                                        </a>                                    </li>                                    <li class="navi-item">                                        <a href="#" class="navi-link">                                            <span class="navi-icon"><i class="la la-file-text-o"></i></span>                                            <span class="navi-text">CSV</span>                                        </a>                                    </li>                                    <li class="navi-item">                                        <a href="#" class="navi-link">                                            <span class="navi-icon"><i class="la la-file-pdf-o"></i></span>                                            <span class="navi-text">PDF</span>                                        </a>                                    </li>                                </ul>                            </div>                        </div>                        <a href="/admin/users/edit/' + t.id + '" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">                            <span class="svg-icon svg-icon-md">                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">                                        <rect x="0" y="0" width="24" height="24"/>                                        <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>                                        <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>                                    </g>                                </svg>                            </span>                        </a>                                           '
                            }
                        }]
                }),
                    $("#kt_datatable_search_status").on("change", (function () {
                        t.search($(this).val().toLowerCase(), "Status")
                    })),
                    $("#kt_datatable_search_type").on("change", (function () {
                        t.search($(this).val().toLowerCase(), "Type")
                    })),
                    $("#kt_datatable_search_status, #kt_datatable_search_type").selectpicker()
            }
        };
        $(document).ready(function () {
            KTDatatableRemoteAjaxDemo.init()
        });

    </script>

@endsection
