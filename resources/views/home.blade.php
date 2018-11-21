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
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    {{-- Font awesome --}}
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
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
				    <h3 class="panel-success">My Book List</h3>
				  </div>
				  <div class="panel-body" id="items">
				    @if(count($items)>0)
                        <table id="listtab" class="display">
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
                                      <td><input type="hidden" class="itemId" value="{{$item->id}}"><img src="{{$item->book_image}}"></td>
                                      <td><a href="{{$item->book_url}}" target="_blank">{{$item->title}}</a></td>
                                      <td><button class="remove-book btn btn-danger">Remove</button></td>
                                    </tr>
                            @endforeach
                            </tbody>
                            </table>
                    @else
                    <table>
                        <tbody>
                        <tr><td>Book list is empty.</td></tr>
                        <td><a class="btn btn-link" href="{{ secure_url('search') }}">Add Books</a></td>
                            </tr>
                            </tbody>
                            </table>
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
    {{-- My script --}}
    <script>
        $(document).ready(function(){
            $('#listtab').DataTable({
                "aLengthMenu": [[5, 10, 15, 25, 50, 100 , -1], [5, 10, 15, 25, 50, 100, "All"]],
                "iDisplayLength" : 5,
                searching: false
            }); 
            $('.remove-book').click(function(){
                var x = confirm("Are you sure you want to delete?");
                if(x) {
                    var id = $(this).closest('tr').find('.itemId').val();
                    $.post('delete', {'id': id,'_token':$('input[name=_token]').val()}, function(data) {
                        $('#items').load(location.href + ' #items');
                        window.location.reload();
                    });
                }        
            });         
        });
    </script>
</body>
</html>
