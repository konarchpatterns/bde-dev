@extends('layouts.dashboard')

@section('style')
    <style type="text/css">
        select {
            color: blue !important;
        }

        label {
            color: black !important;
        }


        table#comp-table td,
        th {
            position: relative;
            padding-left: 4px !important;
            padding-right: 4px !important;
            padding-top: 15px !important;
            padding-bottom: 15px !important;
            vertical-align: middle;
            overflow: hidden !important;
            text-overflow: ellipsis !important;

            font-size: 14px;
            clear: both;
            border-collapse: collapse;
            table-layout: fixed;
            word-wrap: break-word;
            max-width: 100px !important;

            white-space: nowrap !important;
            color: black;
            border: 1px #979DD6 solid;
            border-right: none;
            border-left: none;

        }

        .followupvisible {
            display: none;
        }

        .Comp {

            width: 100% !important;

        }

        .Phon {

            width: 100% !important;
        }

        .Stat {

            width: 100% !important;

        }

        .Coun {

            width: 100% !important;
        }

        .Time {

            width: 100% !important;
        }

        .Disp {

            width: 100% !important;
        }

        .Clie {
            width: 100% !important;
        }

        .User {

            width: 100% !important;
        }

        .Assi {

            width: 100% !important;
        }

    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-2">
            <h5>Click Clients</h5>
            <input type="hidden" name="worktype" id="worktypeid" value="{{ auth()->user()->workfrom }}">
        </div>
        <div class="col-md-4">
            <a href="javascript:void(0);" class="btn btn-sm btn-outline btn-danger mr-2 ml-5" id="delsession"
                data-toggle="tooltip" data-placement="top" title="Refresh Table">
                <i class="fa fa-refresh" aria-hidden="true"></i>
            </a>
        </div>
        <div class="col-md-6">
        <select id="duration" class="btn btn-warning btn-sm btn-outline rightdiv mr-2">
                <option value="">Select Month Duration</option>
                <option value="3 months">3 Months</option>
                <option value="6 months">6 Months</option>
    </select>
            @permission('edit.company.assign.user')
                <a href="javascript:void(0)" id="assignuser" class="btn btn-info btn-sm btn-outline rightdiv mr-2">
                    Assign User
                </a>

                
                <a href="javascript:void(0)" class="btn btn-success btn-sm btn-outline rightdiv mr-2 filternewdialaccont"
                    data-toggle="tooltip" data-placement="bottom" title="Unassigned Accounts" data-value="UA" value="UA">UA</a>

                <a href="javascript:void(0)" class="btn btn-success btn-sm btn-outline rightdiv mr-2 filternewdialaccont"
                    data-toggle="tooltip" data-placement="bottom" title="Assigned Accounts" data-value="AA" value="AA">AA</a>
            @endpermission

            <a href="javascript:void(0)" class="btn btn-warning btn-sm btn-outline rightdiv mr-2 filternewdialaccont"
                data-toggle="tooltip" data-placement="bottom" title="Dialed Accounts" data-value="DA" value="DA">DA</a>
            <a href="javascript:void(0)" class="btn btn-warning btn-sm btn-outline rightdiv mr-2 filternewdialaccont"
                data-toggle="tooltip" data-placement="bottom" title="New Accounts" data-value="NA" value="NA">NA</a>
            <a href="javascript:void(0)" class="btn btn-warning btn-sm btn-outline active rightdiv mr-2 filternewdialaccont"
                data-toggle="tooltip" data-placement="bottom" title="All Accounts" data-value="ALL" value="ALL">ALL</a>
           <!--
                <a href="javascript:void(0)" class="btn btn-warning btn-sm btn-outline rightdiv mr-2 filternewdialaccont"
                data-toggle="tooltip" data-placement="bottom" title="6 Months" value="6 Months">6 months</a>
            <a href="javascript:void(0)" class="btn btn-warning btn-sm btn-outline rightdiv mr-2 filternewdialaccont"
                data-toggle="tooltip" data-placement="bottom" title="3 Months" value="3 Months">3 months</a>
    -->


        </div>
    </div>


    <div class="table-wrapper-scroll-y my-custom-scrollbar table-responsive  mt-2">


        <table id="comp-table" class="table table-bordered  mb-0" style="width:100%">
            <thead class="fhead">
                <tr class="firstrow">
                    <th><input type="checkbox" id="checkboxid1"></th>
                    <th>Company Id</th>
                    <th>Company Name</th>
                    <th>Client Name</th>
                    <th>Phone</th>
                    <th>State</th>
                    <th>Country</th>
                    <th>Timezone Type</th>
                    @permission('edit.company.assign.user')
                        <th>User</th>
                        <th>Assign BY</th>
                    @endpermission
                    <th>Disposition</th>
                </tr>
                <tr class="secondrow">
                    <th></th>
                    <th>Company Id</th>
                    <th>Company Name</th>
                    <th>Client Name</th>
                    <th>Phone</th>
                    <th>State</th>
                    <th>Country</th>
                    <th>Timezone Type</th>
                    @permission('edit.company.assign.user')
                        <th>User</th>
                        <th>Assign BY</th>
                    @endpermission
                    <th>Disposition</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>





    </div>
    <!-- company disposition modal -->
    <div class="modal fade right" id="companydispositionmodal" aria-hidden="true">

        <div class="modal-dialog">

            <div class="modal-content bg-light">

                <div class="modal-header">
                    <h6>All Disposition</h6>
                    <label class="btn btn-sm btn-fill btn-info" id="showorderdetail"><b>Order Details</b></label>
                    <label class="btn btn-sm btn-fill btn-info" id="showdispositiondetail"><b>Last Disposition</b></label>

                </div>

                <div class="modal-body">

                    <!-- <input type="hidden" value="" name="leadid" id="leadid">
                                                                                                 <input type="hidden" value="" id="currentPageIndexid"> -->

                    <div class="row">

                        <table>
                            <tr>
                                <td>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" value="Business Closed"
                                                name="optradio"> Business Closed
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" value="Sale" name="optradio"> Sale
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" value="No Answer" name="optradio">
                                            No Answer
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" value="Answering Machine"
                                                name="optradio"> Answering Machine
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" value="Hang Up" name="optradio">
                                            Hang Up
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" value="Disconnected Number"
                                                name="optradio"> Disconnected Number
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" value="Not Interested"
                                                name="optradio"> Not Interested
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" value="Wrong Number"
                                                name="optradio"> Wrong Number
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" value="Number Not In Service"
                                                name="optradio"> Number Not In Service
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" value="Interested" name="optradio">
                                            Interested
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" value="Follow Up" name="optradio">
                                            Follow Up
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" value="Busy Number"
                                                name="optradio"> Busy Number
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" value="Call Back" name="optradio">
                                            Call Back
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" value="Cancel" name="optradio">
                                            Cancel
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" value="Authority Not Available"
                                                name="optradio"> Authority Not Available
                                        </label>
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" value="Do Not Call"
                                                name="optradio"> Do Not Call
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" value="In House" name="optradio">
                                            In House
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" value="Business Sold"
                                                name="optradio"> Business Sold
                                        </label>
                                    </div>
                                </td>
                            </tr>
                        </table>

                        <div id="followupid" class="col-md-5 pl-1 followupvisible">
                            <div class="form-group">
                                <label><b>Followup Date</b> </label>
                                <input id="datetimepicker" class="form-control mt-0" type="text" name="followup_date_time"
                                    autocomplete="off" autofocus>
                            </div>
                        </div>
                        <input type="hidden" name="disposition" id="companycallingnumber" value="">
                        <input type="hidden" name="disposition" id="companydisposition" value="">
                        <input type="hidden" name="companydispositionback" value="" id="companydispositionbackid">
                        <div class="col-md-12 pl-1">
                            <div class="form-group">
                                <label><b>Description</b> </label>
                                <textarea autofocus id="companydescription" tabindex="2" placeholder="Enter new description...."
                                    class="form-control form-control51" required></textarea>
                            </div>
                        </div>

                    </div>
                    <div class="row float-right">
                        <div class="col-md-12 ">
                            <div class="form-group ">
                                <a href="javascript:void(0)" class="btn btn-primary btn-outline  mt-2"
                                    id="submitdisposition" href="#">Submit</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"><b>Order Detail</b></h5>
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="modal-body" id="orderdetail">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
    <!-- lastdisposition detail -->
    <div class="modal fade" id="lastdispositionmodal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="lastdispositiontitle"><b>Last Disposition Detail</b></h5>
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="modal-body" id="lastdispositiondetail">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
    @include(
        'cickclient.clickclientmodal.assignusermodal.content'
    )
    <!-- , , ['SubmitTextButton'=>'Add'] -->
@endsection



@section('script')
    <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.19/pagination/input.js"></script>

    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()

            // $.ajaxSetup({
            //          headers: {
            //              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            //          }
            //  });
            var form = $(this).parents('form:first');
            var _token = form.find('input[name=_token]').val();
            var $rowid = 0;
            var currentPageIndex = 0;

            //New Code added on 11-07-18 for column searching
            $("#comp-table thead.fhead tr.firstrow th").each(function(i) {
                var title = $('#comp-table th').eq($(this).index()).text();
                //alert('hello');
                //alert(title.trim().length);
                var titleclass = title.substring(0, 4);
                if (title.trim().length > 0 && title !== 'Edit') {
                    if (titleclass == "Disp") {
                        $(this).html(
                            '<input data-tip="Type and press <enter> to search" type="text"  name="' +
                            titleclass + '"  placeholder="yyyy-mm-dd" data-index="' + i + '"  class="' +
                            titleclass + '"   />');

                    } else {

                        $(this).html(
                            '<input data-tip="Type and press <enter> to search" type="text"  name="' +
                            titleclass + '"  placeholder=" " data-index="' + i + '"  class="' +
                            titleclass + '"   />');
                    }

                }
            });

            //New Code added on 11-07-18 for column searching
            var table = $('#comp-table').DataTable({
                processing: true,
                serverSide: true,
                async: true,
                scrollCollapse: true,
                serverSide: true,
                stateSave: true,
                stateDuration: -1,
                pagingType: "input",
                bStateSave: true,
                autowidth: false,
                // scrollX: true,
                // scrollY: true,
                // scrollY: ($(window).height() - 245),
                search: {
                    caseInsensitive: true
                },
                lengthMenu: [
                    [50, -1],
                    [50, "100"]
                ],
                "language": {
                    "lengthMenu": 'Display <select class="form-control-sm">' +
                        '<option value="25">25</option>' +
                        '<option value="50">50</option>' +
                        '<option value="100">100</option>' +
                        '</select> Clients'
                },
                //stateDuration: -1,  changes made on  04/08/18

                // changes made on  04/08/18
                ajax: "{{ route('clickclients.testingdata',['id'=>'ALL'])}}",

                columnDefs: [


                ],


                columns: [{
                        data: 'checkbox',
                        name: 'checkbox',
                        class: "checkclass dt-center",
                        orderable: false,
                        searchable: false,
                        "render": function(data, type, full, meta) {
                            var coid = full.company_id;
                            coid = coid.replace(/\D/g, "");
                            data =
                                "<input type='checkbox' name='checkbox1[]' class='checkboxid' value='" +
                                coid + "'>";

                            return data;
                        }
                    },
                    {
                        data: 'company_id',
                        name: 'company_id',
                        class: 'idclass1 dt-body dt-center ',
                        width: '2px',
                        "render": function(data, type, full, meta) {
                            data =
                                `<a href="http://www.click.com/clients/${full.id}/show" class="test" title="${data}" data-toggle="tooltip" target="_blank">${data}</a>`;
                            return data;
                        }
                    },
                    {
                        data: 'client_company',
                        name: 'client_company',
                        class: "dt-center",
                        "render": function(data, type, full, meta) {
                            //return '<span class="test" data-toggle="tooltip" title="' + data + '">' + data + '</span>';
                            var coid = full.company_id;
                            coid = coid.replace(/\D/g, "");
                            return '<span onclick=orderinformation(' + coid +
                                ') class="test" data-toggle="tooltip" title="' + data + '">' +
                                data + '</span>';
                        }
                    },
                    {
                        data: 'cdclient_name',
                        name: 'cdclient_name',
                        class: "dt-center",
                        "render": function(data, type, full, meta) {

                            if (data == " ") {
                                return data = "No Data";
                            } else {
                                var obj = data.split(",");
                                var text1 = "";
                                function onlyUnique(value, index, self) {
                                    return self.indexOf(value) === index;
                                }
                                var unique = obj.filter(onlyUnique);
                                
                                for (i = 0; i < unique.length; i++) {
                                    text1 += '<span>' + unique[i] + '</span><br>';
                                }

                                return text1;
                            }
                        }
                    },


                    {
                        data: 'phone',
                        name: 'phone',
                        class: "dt-center",
                        "render": function(data, type, full, meta) {
                            //return '<span class="test" data-toggle="tooltip" title="' + data + '">' + data + '</span>';
                            var obj = data.split(",");
                            var text1 = "";
                            for (i = 0; i < obj.length; i++) {
                                var res = obj[i].replace(/\D/g, "");
                                var coid = full.company_id;
                                coid = coid.replace(/\D/g, "");
                                text1 += '<span onclick="redirectToPhoneURL(' + res + ',' + coid +
                                    ')">' + obj[i] + '</span><br>';
                            }
                            return text1;
                        }
                    },
                    {
                        data: 'client_state',
                        name: 'client_state',
                        class: "dt-center",
                        searchable: true
                    },
                    {
                        data: 'client_country',
                        name: 'client_country',
                        class: "dt-center",
                        searchable: true
                    },
                    {
                        data: 'timezone_type',
                        name: 'timezone_type',
                        class: "dt-center"
                    },
                    @permission('edit.company.assign.user')
                        {
                            data: 'salseuser',
                            name: 'salseuser',
                            class: "dt-center",
                            "render": function(data, type, full, meta) {
                                //return '<span class="test" data-toggle="tooltip" title="' + data + '">' + data + '</span>';
                                var coid = full.company_id;
                                coid = coid.replace(/\D/g, "");
                                if (data == null) {
                                    data = "No user";
                                    return '<span onclick=assignSingleUser(' + coid +
                                        ') class="test" data-toggle="tooltip" title="' + data +
                                        '">' + data +
                                        '</span>';
                                } else {
                                    return '<span onclick=assignSingleUser(' + coid +
                                        ') class="test" data-toggle="tooltip" title="' + data +
                                        '">' + data +
                                        '</span>';
                                }
                            }
                        }, {
                            data: 'salseassignuser',
                            name: 'salseassignuser',
                            class: "dt-center",
                            "render": function(data, type, full, meta) {
                                if (data == null) {
                                    return "No user"
                                } else {

                                    return data;
                                }
                            }
                        },
                    @endpermission {
                        data: 'lastdispo',
                        name: 'lastdispo',
                        class: "dt-center",
                        "render": function(data, type, full, meta) {

                            if (data == null) {
                                return "-";
                            } else {
                                var obj = data.split(",");
                                var text1 = "";
                                var coid = full.company_id;
                                coid = coid.replace(/\D/g, "");
                                for (i = 0; i < 1; i++) {

                                    obj[i] = obj[i].replace(/&lt;br&gt;/g, '<br/>');
                                    dateformateis = obj[i];
                                    var datefor = dateformateis.split(" ");
                                    var newdate = datefor[i].split("-").reverse().join("-");
                                    var finaldate = newdate + dateformateis.slice(10);
                                    //console.log(finaldate);
                                    text1 =
                                        '<span class="filename "  onclick=lastdispositiondetail(' +
                                        coid + ') data-html="true" data-toggle="tooltip" title="' +
                                        finaldate + '">' + finaldate + '</a></span>';

                                }
                                return text1;
                            }
                        }
                    },

                ],
                pageLength: 25,
                pagination: true,
                responsive: true,
                @role('se')
                    order: [
                        [8, "desc"]
                    ]
                @else
                    order: [
                        [10, "desc"]
                    ]
                @endrole


            });
            var table = $('#comp-table').DataTable();
            $('.dataTables_filter input').unbind().keyup(function(e) {
                var value = $(this).val();
                if (value.length > 3) {
                    //alert(value);
                    table.search(value).draw();
                } else {
                    //optional, reset the search if the phrase 
                    //is less then 3 characters long
                    table.search('').draw();
                }
            });

            // SEARCH FILTER REVISED

            $(table.table().container()).on('keyup', '.fhead tr.firstrow input', function(e) {
                if (e.keyCode == 13) {
                    // table.state.clear();
                    table
                        .column($(this).data('index'))
                        .search(this.value)
                        .draw();
                }
            });
        });
        $('#checkboxid1').on('click', function() {
            // Check/uncheck all checkboxes in the table
            var table = $('#comp-table').DataTable();
            var rows = table.rows({
                'search': 'applied'
            }).nodes();
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });
        $(document).on("click", "#delsession", function() {
            event.preventDefault;
            var table = $('#comp-table').DataTable();
            table.state.clear();


            window.location.reload();
            window.location.href = "{{ route('clients.index') }}";
        });
        $(document).ready(function() {

            $.urlParam = function(name) {
                var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
                if (results == null) {
                    return null;
                }
                return decodeURI(results[1]) || 0;
            }
            var newid1 = $.urlParam('newid');
            console.log(newid1);

            if (newid1 != undefined || newid1 != null) {
                var table = $('#comp-table').DataTable();
                table.search(newid1).draw();
            }
        });

        /**
         *  ajax call for NA, DA, ALL
         */
        $('.filternewdialaccont').on('click', function() {
            var table = $('#comp-table').DataTable();
            $('.filternewdialaccont').removeClass('active');
            $(this).addClass('active');
            //  fetch NA, DA, ALL value
            var id = $(this).text();
            //  fetch month data
            var duration = $('#duration').val();
           // var new_url = "{{ route('clickclients.testingdata', ':id') }}";
         //   new_url = new_url.replace(':id', id);
         
         // if Month , NA, DA, ALL data is not empty
            if((duration!="")&&(id!=""))
            {
                console.log(id+" "+duration);
                table.ajax.url("http://127.0.0.1:8001/clickcompanydatas"+"/"+`${id}`+"/"+`${duration}`+"/").load();
            }
         // if Month data is empty , NA, DA, ALL data is not empty
            if((duration=="")&&(id!=""))
            {
                console.log(id+" "+duration);
                table.ajax.url("http://127.0.0.1:8001/clickcompanydatas"+"/"+`${id}`+"/"+"ALL/").load();
            }
           // table.ajax.url(new_url).load();
        });

        $('#duration').on('change', function(){

            var table = $('#comp-table').DataTable();
            var duration = $('#duration').val();
            let id=$( ".filternewdialaccont" ).filter('.active').attr('data-value');
            console.log(status);
            if(duration!="")
            {
                
                console.log(id+" "+duration);
                //console.log("http://127.0.0.1:8001/clickcompanydatas"+"/"+`${id}`+"/"+`${duration}`+"/");
                table.ajax.url("http://127.0.0.1:8001/clickcompanydatas"+"/"+`${id}`+"/"+`${duration}`+"/").load();
            }
            if(duration=="")
            {
                
                console.log(id+" "+duration);
                //console.log("http://127.0.0.1:8001/clickcompanydatas"+"/"+`${id}`+"/"+"ALL/");
                table.ajax.url("http://127.0.0.1:8001/clickcompanydatas"+"/"+`${id}`+"/"+"ALL/").load();
            }
        });

        //submit button of dissposition
        $(document).on('click', '#submitdisposition', function() {
            document.getElementById("submitdisposition").disabled = true;

            var description = document.getElementById("companydescription").value;
            var companycallingnumber = document.getElementById("companycallingnumber").value;
            var ele = document.getElementsByName('optradio');
            var radiovalue = "";
            for (i = 0; i < ele.length; i++) {
                if (ele[i].checked)
                    radiovalue = ele[i].value;

            }
            // var id=document.getElementById("dispositioncompanyid").value;
            var id = document.getElementById("companydispositionbackid").value;
            var follow_up = document.getElementById("datetimepicker").value;
            if (radiovalue == "Call Back" || radiovalue == "Follow Up") {
                var datedispo = radiovalue;
            }
            if (radiovalue == "Business Closed" || radiovalue == "Hang Up" || radiovalue == "Not Interested" ||
                radiovalue == "Wrong Number" || radiovalue == "Sale" || radiovalue == "Interested" || radiovalue ==
                "Follow Up" || radiovalue == "Call Back" || radiovalue == "Cancel" || radiovalue ==
                "Authority Not Available" || radiovalue == "Do Not Call" || radiovalue == "In House" ||
                radiovalue == "In House" || radiovalue == "Business Sold") {
                var mustdispo = radiovalue;
            }
            if (radiovalue == "") {
                document.getElementById("submitdisposition").disabled = false;
                toastr.error('Please write new disposition!');

            } else if (radiovalue == mustdispo && description == '') {
                document.getElementById("submitdisposition").disabled = false;
                toastr.error('Please write description!');
            } else if (radiovalue == datedispo && follow_up == '') {
                document.getElementById("submitdisposition").disabled = false;
                toastr.error('Please Select date!');
            } else {

                $.ajax({
                    type: "post",
                    url: "{{ route('disposition.companyclickdispositionstore') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "description": description,
                        "status": radiovalue,
                        "id": id,
                        "follow_up": follow_up,
                    },

                    success: function(data) {

                        $("#companydispositionmodal").modal("hide");
                        $('#comp-table').DataTable().ajax.reload(null, false);
                        //table.ajax.reload( null, false );               
                        toastr.success('New Disposition entered successfully!');
                        win3cx.close();

                    },

                });
            }
        });
        $('#showorderdetail').on('click', function() {
            var cid = document.getElementById("companydispositionbackid").value;
            $.ajax({
                type: "post",
                url: "{{ route('clickcompany.orderdetail') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "company_id": cid,
                    'frommodal': "yesy",



                },
                success: function(data) {

                    $("#exampleModalCenter").modal("show");
                    $('#orderdetail').empty();
                    $('#orderdetail').append(data);
                    // $("#companydispositionbackid").val(data);
                    // $('#companyid').val(cid);
                    // $('#companycallingnumber').val(obj);
                    // $( '#modelHeading1' ).html("Disposition");           
                },

            });

        });
        $('#showdispositiondetail').on('click', function() {
            var cid = document.getElementById("companydispositionbackid").value;

            $.ajax({
                type: "post",
                url: "{{ route('clickcompany.dispositiondetail') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "company_id": cid,
                    'frommodal': "yesy",



                },
                success: function(data) {

                    $("#lastdispositionmodal").modal("show");
                    $('#lastdispositiondetail').empty();
                    $('#lastdispositiondetail').append(data);
                    // $("#companydispositionbackid").val(data);
                    // $('#companyid').val(cid);
                    // $('#companycallingnumber').val(obj);
                    // $( '#modelHeading1' ).html("Disposition");           
                },

            });
        });
        //show followup textbox in disposition click on followup radio buttoon 
        $('input:radio[name=optradio]').click(function() {
            var compare = $(this).val();
            if (compare == 'Follow Up' || compare == 'Call Back' || compare == 'Interested') {
                $(' #followupid ').removeClass('followupvisible');
                $('#datetimepicker').focus();
            } else {
                $(' #followupid ').addClass('followupvisible');
                $('#datetimepicker').val('');

            }
        });


        $('#assignuser').on('click', function() {
            var checkboxes = document.getElementsByName('checkbox1[]');
            var vals = "";
            var aIds = [];
            var table = $('#comp-table').DataTable();
            var currentPageIndex = table.page.info().page;

            for (var i = 0, n = checkboxes.length; i < n; i++) {
                if (checkboxes[i].checked) {
                    aIds.push(checkboxes[i].value);
                    // vals += ","+checkboxes[i].value;

                }
            }
            var str = aIds.join(',');

            if (aIds[0] == null) {
                toastr.error("Please select company");
            } else {
                $("#AssignuserModel").modal("show");
                $('#modelHeading').html("Assign User");
                document.getElementById("companyid").value = str;
                document.getElementById("currentPageIndexid").value = currentPageIndex;

            }
        });

        jQuery('#datetimepicker').datetimepicker();

        function orderinformation(cid) {
            $.ajax({
                type: "post",
                url: "{{ route('clickcompany.orderdetail') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "company_id": cid,



                },
                success: function(data) {

                    $("#exampleModalCenter").modal("show");
                    $('#orderdetail').empty();
                    $('#orderdetail').append(data);
                    // $("#companydispositionbackid").val(data);
                    // $('#companyid').val(cid);
                    // $('#companycallingnumber').val(obj);
                    // $( '#modelHeading1' ).html("Disposition");           
                },

            });
        }

        function lastdispositiondetail(companyid) {

            $.ajax({
                type: "post",
                url: "{{ route('clickcompany.dispositiondetail') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "company_id": companyid,
                    'frommodal': "simple",



                },
                success: function(data) {

                    $("#lastdispositionmodal").modal("show");
                    $('#lastdispositiondetail').empty();
                    $('#lastdispositiondetail').append(data);
                    // $("#companydispositionbackid").val(data);
                    // $('#companyid').val(cid);
                    // $('#companycallingnumber').val(obj);
                    // $( '#modelHeading1' ).html("Disposition");           
                },

            });

        }

        function assignSingleUser(companyid) {

            var table = $('#comp-table').DataTable();
            var $rowid = table.row(this).index();
            var currentPageIndex = table.page.info().page;
            var target = $(this);
            var key = companyid;

            document.getElementById("companyid").value = key;
            document.getElementById("currentPageIndexid").value = currentPageIndex;
            $("#AssignuserModel").modal("show");

        }

        function redirectToPhoneURL(obj, cid) {

            swal({
                    text: "Do you want to call !",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        history.pushState(null, null, location.href);
                        window.onpopstate = function() {
                            history.go(1);
                        };
                        $(window).keydown(function(event) {
                            if (event.keyCode == 116) {
                                event.preventDefault();
                                return false;
                            }
                        });
                        $('#companydispositionmodal').modal({
                            backdrop: 'static',
                            keyboard: false
                        });
                        $("#companydispositionmodal").find("input[type=checkbox], input[type=radio]")
                            .prop("checked", "")
                            .end();
                        $("#companydispositionmodal").find("textarea")
                            .val('');
                        $(' #followupid ').addClass('followupvisible');
                        $('#companyid').val('');
                        $('#companycallingnumber').val('');
                        $('#datetimepicker').val('');
                        document.getElementById("submitdisposition").disabled = false;
                        $.ajax({
                            type: "post",
                            url: "{{ route('clickcompanydisposition.predispositionentryclickcompany') }}",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "company_id": cid,
                                "companycallingnumber": obj,


                            },
                            success: function(data) {

                                $("#companydispositionmodal").modal("show");
                                $("#companydispositionbackid").val(data);
                                $('#companyid').val(cid);
                                $('#companycallingnumber').val(obj);
                                $('#modelHeading1').html("Disposition");
                            },

                        });

                        if ($('#worktypeid').val() == 'In side') {

                            win3cx = window.open("https://157.245.98.226/webclient/#/call?phone=" + obj + "", '_blank');
                        } else {

                            win3cx = window.open("https://patterns.3cx.in:5001/webclient/#/call?phone=" + obj + "",
                                '_blank');
                        }

                    } else {}
                });
        }
    </script>
    @include('cickclient.clickclientmodal.assignusermodal.script')
@endsection
