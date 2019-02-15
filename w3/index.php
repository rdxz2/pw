<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>w2</title>
    <link rel="stylesheet" href="bs4.css"/>
    <link rel="stylesheet" href="dt.css"/>
    <script src="jq.js"></script>
    <script src="bs4.js"></script>
    <script src="dt.js"></script>
    <script src="fa.min.js"></script>
</head>
<body>
    <style>
        td.details-control {
            cursor: pointer;
        }
    </style>

    <!-- TOPNAV -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-3">
        <div class="container-fluid">
            <div class="navbar-brand">
                <h4>[IF635 Web Programming]</h4>
            </div>
            <ul class="navbar-nav">
                <li class="nav-item navbar-right active">
                    <a href="" class="nav-link">Employees</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- CONTENT -->
    <div class="container">
        <table id="tb" class="table table-striped table-bordered w-100">
            <thead>
                <td></td>
                <td>ID</td>
                <td>Code</td>
                <td>Name</td>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function(){
            var tb = $("#tb").DataTable({
                ajax: {
                    url: "gdata.php",
                    type: "get",
                    dataType: "json",
                    dataSrc: ""
                },
                columns: [
                    {
                        className: "details-control text-center",
                        orderable: false,
                        data: null,
                        defaultContent: "<i class='fas fa-plus-circle text-primary'></i>"
                    }, 
                    {data: "WarehouseID"}, 
                    {data: "WarehouseCode"},
                    {data: "WarehouseName"}
                ],
                order: [[1, "asc"]]
            });

            //BUTTON (+)/(-) ONCLICK EVENT HANDLER
            $('#tb tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = tb.row(tr);
        
                if (row.child.isShown() ) {
                    row.child.hide();
                    tr.removeClass('shown');
                    tr.find('svg').attr('data-icon', 'plus-circle');
                }
                else {
                    row.child( format(row.data()) ).show();
                    tr.addClass('shown');
                    tr.find('svg').attr('data-icon', 'minus-circle');
                }
            });
        })
        
        //FORMATTING DETAIL
        function format (d) {
            let fl = d.Active_Flag == 1 ? "Active" : "Inactive";
            return "<div class='ml-5'>" +
                "<div class='form-row'>Details for&nbsp;<u><i>" + d.WarehouseName + "</i></u></div><hr class='my-1'>" +
                "<div class='form-row'>" +
                "<div class='col-2'><b>- Address</b></div><div class='col-auto'>: " + d.WarehouseAddress + "</div>" +
                "</div>" +
                "<div class='form-row'>" +
                "<div class='col-2'><b>- Flag</b></div><div class='col-auto'>: " + fl + "</div>" +
                "</div></div>";
        }
    </script>
</body>
</html>