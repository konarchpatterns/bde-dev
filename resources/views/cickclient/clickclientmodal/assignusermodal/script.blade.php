<script type="text/javascript">
    $(function() {
        var table1 = $('#userrecord').DataTable({
            processing: true,
            serverSide: true,
            async: true,
            destroy: true,
            responsive: true,
            paging: true,
            columnDefs: [{
                className: "dt-center",
                targets: "_all"
            }, ],
            "language": {
                "lengthMenu": 'Display <select class="form-control-sm">' +
                    '<option value="10">10</option>' +
                    '<option value="20">20</option>' +
                    '<option value="30">30</option>' +
                    '<option value="40">40</option>' +
                    '<option value="50">50</option>' +
                    '<option value="-1">All</option>' +
                    '</select> records'
            },
            ajax: "{{ route('showuser.list') }}",
            columns: [{
                    data: 'id',
                    name: 'id',
                    class: 'foo dt-center'
                },
                {
                    data: 'name',
                    name: 'name',
                    class: "selectuser dt-center"
                },
                {
                    data: 'email',
                    name: 'email'
                },

            ],

        });
    });
    $(document).on('click', '.selectuser', function() {
        var list = $(this).text();
        swal({
                title: "Are you sure! You want to assign contact to " + list + " !",
                // text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {

                    var table = $('#comp-table').DataTable();
                    var table2 = $('#userrecord').DataTable();
                    var userid = $(this).closest('tr').find('td.foo').text();
                    var companyid = document.getElementById('companyid').value;
                    $.ajax({
                        type: "post",
                        url: "{{ route('clickclient.assignuserfromtable') }}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "companyid": companyid,
                            "userid": userid,

                        },

                        success: function(data) {

                            table.ajax.reload(null, false);
                            $("#AssignuserModel").modal("hide");
                            toastr.success("Assigned user succesfully");
                        },

                    });
                } else {

                    // $( "#AssignuserModel" ).modal("hide");
                }

            });
    });
    //unassign user
    $(document).on('click', '#unassignuser', function() {
        var list = $(this).text();
        swal({
                title: "Are you sure! You want to unassign company!",
                // text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {

                    var table = $('#comp-table').DataTable();
                    var table2 = $('#userrecord').DataTable();
                    var userid = 6;
                    var companyid = document.getElementById('companyid').value;
                    $.ajax({
                        type: "post",
                        url: "{{ route('clickclient.assignuserfromtable') }}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "companyid": companyid,
                            "userid": userid,

                        },

                        success: function(data) {

                            table.ajax.reload(null, false);
                            $("#AssignuserModel").modal("hide");
                            toastr.success("Unassigned user succesfully");
                        },

                    });
                } else {

                    // $( "#AssignuserModel" ).modal("hide");
                }

            });
    });
    //open user assign modal
    $(document).on('click', '#closeuser', function() {
        $("#AssignuserModel").modal("hide");
    });
</script>
