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
				    <h3 class="panel-success">Global Books Search</h3>
				  </div>
				  <div class="panel-body" id="items">
                        <form id="search-form" class="searchForm" action="{{ secure_url('search') }}" method="GET">
                            {{ csrf_field() }}
                            <div class='titleOption'>
                                <div class="title"><input type="radio" name="book" value="title"><label>Title</label></div>
                                <div class="title"><input type="text" id="title" name="title" placeholder="Enter Title"></div>
                            </div>
                            <div class="inputSearch">
                                <div class="title"><input type="radio" name="book" value="isbn"><label>ISBN</label></div>
                                <div class="title"><input type="text" id ="isbn" name="isbn" placeholder="Enter ISBN"></div>
                            </div>
                            <div class="searchBtn">
                                <input type="button" class="btn btn-default" id="search_button" value="Search">
                            </div>
                        </form>
                  </div>
</div>
                </div>
</div>
@if($items_array)
                <div class="row">
            <div class="col-lg-offset-3 col-lg-6">
				<div class="panel panel-default">
				  <div class="panel-body" id="items">
                    
				    @if(count($items_array)>0)
                        <ul class="list-group">
                        <?php 
                            //  echo "<pre>";print_r($items_array);
                            //  foreach($items_array as $i => $item_val){
                            //  echo $item_val['link'];
                            //  }
                        ?>
                        <table id="myTable" class="display">
                            <thead><strong>Showing results for: '{{$search}}'</strong>
                                <tr>
                                    <th>Book</th>
                                    <th>Title</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($items_array as $ikey => $item)
                                    <tr>
                                        <td><img src="{{$item['image']}}"></td>
                                        <td><a href="{{$item['link']}}" target="_blank">{{$item['title']}}</a></td>
                                        <td>
                                        @if($item['status'] == 0)
                                        <input type="hidden" class="title" value= "{{$item['title']}}"><input type="hidden" class="image_url" value= "{{$item['image']}}"><input type="hidden" class="link_url" value= "{{$item['link']}}"><button class="add btn btn-success">Add to List</button>
                                        @else
                                        <button class="btn btn-success" disabled="disabled">Added to List</button>
                                        @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>Search result is empty.</p>
                    @endif  
				  </div>
				</div>
            </div>
                            </div>
                            </div>
                            @endif
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
            $('#myTable').DataTable({
                "aLengthMenu": [[5, 10, 15, 25, 50, 100 , -1], [5, 10, 15, 25, 50, 100, "All"]],
                "iDisplayLength" : 5,
                searching: false
            }); 
            $('#myTable tbody').on('click', '.add', function () {
            $(this).text('Added to List').attr("disabled", "disabled");
            var text = $(this).closest('td').find('.title').val();
            var img = $(this).closest('td').find('.image_url').val();
            var link = $(this).closest('td').find('.link_url').val();
                        $.post('create', {'text': text,'img': img,'link': link,'_token':$('input[name=_token]').val()}, function(data) {
                    $('#items').load(location.href + ' #items');
                });
            });    
         $("#search_button").attr('disabled','disabled');
         $("#title").hide(); $("#isbn").hide();
            $("input[name='book']").click(function(){
                $("#search_button").removeAttr('disabled');
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
