<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel - Book Store Application</title>
    {{-- CSS --}}
    <link href="{{ secure_asset('css/jquery-ui.css') }}" rel="stylesheet">
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />-->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    {{-- Font awesome --}}
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="{{ secure_asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
    @include('header')
    <br>
    <div class="container">
        <div class="row">
            <div class="col-lg-offset-3 col-lg-6">
				<div class="panel panel-default">
				  <div class="panel-heading">
				    <h3 class="panel-success">Book List</h3>
                    <a href="/users">Back to Users List</a>
				  </div>
				  <div class="panel-body" id="items">
				    @if(count($items)>0)
                    <table id="userList" class="display">
                        <thead>
                            <tr>
                                <th>Book</th>
                                <th>Title</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            <tr>
                            <td><img src="{{$item->book_image}}"></td>
                            <td><a href="{{$item->book_url}}" target="_blank">{{$item->title}}</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @else
                        <p>Book list is empty.</p>
                    @endif  
				  </div>
				</div>
			</div>
    {{ csrf_field() }}
    {{-- script jquery --}}
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
    {{-- script bootstrap --}}
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>   
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>   
    <script>
        $(document).ready(function(){
            $('#userList').DataTable({
                "aLengthMenu": [[5, 10, 15, 25, 50, 100 , -1], [5, 10, 15, 25, 50, 100, "All"]],
                "iDisplayLength" : 5,
                searching: false
            }); 
        });
    </script>
</body>
</html>
