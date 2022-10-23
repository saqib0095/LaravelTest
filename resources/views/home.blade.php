@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="form-group" id="regions_webForm">
                <label>Region</label>
                <input type="text" class="form-control" id="Region-input">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" id="Business_name_webForm">
                <label>Business Name</label>
                <input type="text" class="form-control" id="business-input">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" id="Business_type_webForm">
                <label>Business Type</label>
                <input type="text" class="form-control" id="business-type-input">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" id="country_webForm">
                <label>Country</label>
                <input type="text" class="form-control" id="country-input">
            </div>
        </div>
        <div class="col-md-6 mt-5 justify-content-left">
            <button type="submit" class="btn btn-primary" id="form-submit">submit</button>
            <button type="button" class="btn btn-success" id="sort">Sort Alphatebically</button>
        </div>
    </div>
    <br>
    <div id="ajaxResults"></div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script>
    function sortTable() {
        var table, rows, switching, i, x, y, shouldSwitch;
        table = document.getElementById("myTable");
        switching = true;
        /*Make a loop that will continue until
        no switching has been done:*/
        while (switching) {
            //start by saying: no switching is done:
            switching = false;
            rows = table.rows;
            /*Loop through all table rows (except the
            first, which contains table headers):*/
            for (i = 1; i < (rows.length - 1); i++) {
            //start by saying there should be no switching:
            shouldSwitch = false;
            /*Get the two elements you want to compare,
            one from current row and one from the next:*/
            x = rows[i].getElementsByTagName("TD")[0];
            y = rows[i + 1].getElementsByTagName("TD")[0];
            //check if the two rows should switch place:
            if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                //if so, mark as a switch and break the loop:
                shouldSwitch = true;
                break;
            }
            }
            if (shouldSwitch) {
            /*If a switch has been marked, make the switch
            and mark that a switch has been done:*/
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            }
        }
    }
    $( document ).ready(function() {
        $('#sort').click(function (e) {
            sortTable();
        });
        $('#form-submit').on('click',function(){
            var region = $('#Region-input').val();
            var businessName = $('#business-input').val();
            var businessType = $('#business-type-input').val();
            var country = $('#country-input').val();
            $.ajax({
                url:'{{ route('search') }}',
                type:'GET',
                data:{
                    'region':region,
                    'businessName': businessName,
                    'businessType': businessType,
                    'country': country
                    },
                success:function (data) {
                    $('#Region-input').val(region);
                    $('#business-input').val(businessName);
                    $('#business-type-input').val(businessType);
                    $('#country-input').val(country);
                    let myTable = '<table class="table table-bordered" id="myTable">';
                    myTable += '<thead class="table-dark">';
                    myTable += '<tr>';
                    myTable += '<th scope="col">Name</th>'
                    myTable += '<th scope="col">Rating</th>'
                    myTable += '<th scope="col">Last Inspection</th>'
                    myTable += '</tr>';

                    myTable += '</thead>';
                    $.each(data.tableData, function (i, item) {
                                    myTable += '<tr>';
                                    myTable += '<td>' + item.name + '</td>';
                                    myTable += '<td>' + item.Rating + '</td>';
                                    myTable += '<td>' + item.Last_inspection + '</td>';
                                    myTable += '</tr>';
                                });
                    myTable += '</table>';

                    $('#ajaxResults').html(myTable);
                }
            })
        });
    });
</script>