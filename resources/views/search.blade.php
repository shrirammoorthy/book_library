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
				    <h3 class="panel-success">Global Books Search</h3>
				  </div>
				  <div class="panel-body" id="items">
                            <form id="search-form" action="{{ secure_url('book_search') }}" method="POST">
                                {{ csrf_field() }}
                                <input type="radio" name="book" value="title">Title<br>
                                <input type="radio" name="book" value="isbn">ISBN<br>
                                <input type="text" id="title" name="title" placeholder="Enter title of the book.">
                                <input type="text" id ="isbn" name="isbn" placeholder="Enter ISBN of the book."><br />
                                <input type="button" class="btn btn-default" id="search_button" value="Search">
                            </form>
				  </div>
				</div>
			</div>
    {{ csrf_field() }}
    {{-- script jquery --}}
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
    {{-- script bootstrap --}}
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>    
    {{-- My script --}}

        <script>
         $(document).ready(function(){
         $("#title").hide(); $("#isbn").hide();
            $("input[name='book']").click(function(){
                var clicked = $(this).val();
                if(clicked == 'title') 
                {
                    $("#title").show();
                     $("#isbn").val('').hide();
                     $("#isbn").attr("disabled", "disabled"); 
                     $("#title").removeAttr("disabled"); 
                }
                else {
                    $("#title").val('').hide();
                     $("#isbn").show();
                     $("#title").attr("disabled", "disabled"); 
                     $("#isbn").removeAttr("disabled"); 
                } 
            });
            $("#search_button").click(function(e){
                var radioValue = $("input[name='book']:checked").val();
                if(radioValue == 'title' && $("#title").val() == '')
                    {
                        e.preventDefault();
                        alert("Enter a title.");
                    }
                else if(radioValue == 'isbn' && $("#isbn").val() == '')
                    {
                        e.preventDefault();
                        alert("Enter an isbn number.");
                    
                    }
                else
                    {
                        $("#search-form").submit();
                    }
            });
        });
    </script>
</body>
</html>
