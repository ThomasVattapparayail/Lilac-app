<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <title>LILAC APP</title>

    </head>
    <body class="antialiased">
    <div class="container">
        <h2>Search</h2>
        <div class="form-group">
            <input type="text" id="search" class="form-control" placeholder="Search by Name, Department, or Designation">
        </div>

        <table class="table table-striped" id="users-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Designation</th>
                   
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function loadUsersData() {
                $.ajax({
                    url: "{{ route('users.data') }}", 
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        populateUsersTable(data);
                    }
                });
            }

            function populateUsersTable(users) {
                var tableBody = $('#users-table tbody');
                tableBody.empty();
                $.each(users, function(index, user) {
                    var row = '<tr>' +
                                '<td>' + user.name + '</td>' +
                                '<td>' + user.department_name + '</td>' +
                                '<td>' + user.designation_title + '</td>' +
                                
                              '</tr>';
                    tableBody.append(row);
                });
            }

            loadUsersData();

            $('#search').keypress(function(event) {
                if (event.keyCode === 13) {
                    event.preventDefault(); 
                    var searchText = $('#search').val().toLowerCase();
                    $.ajax({
                        url: "{{ route('users.search') }}", 
                        method: 'GET',
                        data: { search: searchText },
                        dataType: 'json',
                        success: function(data) {
                            populateUsersTable(data);
                        }
                    });
                }
            });
        });
    </script>
    </body>
</html>
