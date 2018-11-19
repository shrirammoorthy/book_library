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
                        <ul class="list-group">
                            @foreach($items as $item)
                                <li class="list-group-item ourItem">
                                <a href="{{$item->book_url}}" target="_blank"><img src="{{$item->book_image}}">{{$item->title}}</a>
                                </li>
                            @endforeach
                        </ul>
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
</body>
</html>
