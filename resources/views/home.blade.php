<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>User List</title>
  </head>
  <body style="padding : 2vw";>

    <h2>User Id List</h2>

    @php
        // $count = 100;
        $count = count($collection);
        // echo($count);
    @endphp

    <div style="padding: 2vw">
        {{-- <button href="{{ url('insert') }}" type="button" class="btn btn-primary">Click Here to Store API Data</button> --}}
        <a href="{{ route('getHuaweiData') }}" type="button" class="btn btn-primary">Insert Here to Store API Data</a>
    </div>

    <table class="table table-striped">
        {{-- <tr>
            <td>USER ID 1</td>
            <td>ID</td>
            <td>Title</td>
            <td>Body</td>
        </tr> --}}
        @for ($i = 0; $i < $count; $i++)
            @if ($i < $count-1)
                @if ($collection[$i]['userId']==1 && $collection[$i]['id']==1)
                    <tr>
                        <td>USER ID {{$collection[$i]['userId']}}</td>
                        <td>ID</td>
                        <td>Title</td>
                        <td>Body</td>
                    </tr>
                    <tr>
                        {{-- <td>{{$collection[$i]['userId']}}</td> --}}
                        <td></td>
                        <td>{{$collection[$i]['id']}}</td>
                        <td>{{$collection[$i]['title']}}</td>
                        <td>{{$collection[$i]['body']}}</td>
                    </tr>
                @elseif ($collection[$i]['userId'] != $collection[$i+1]['userId'])
                    {{-- @php
                        echo("beda -> userId ".$collection[$i]['userId']);
                    @endphp --}}
                        <tr>
                            {{-- <td>{{$collection[$i]['userId']}}</td> --}}
                            <td></td>
                            <td>{{$collection[$i]['id']}}</td>
                            <td>{{$collection[$i]['title']}}</td>
                            <td>{{$collection[$i]['body']}}</td>
                        </tr>
                        <tr>
                            <td>USER ID {{$collection[$i]['userId']+1}}</td>
                            <td>ID</td>
                            <td>Title</td>
                            <td>Body</td>
                        </tr>
                @else
                    <tr>
                        {{-- <td>{{$collection[$i]['userId']}}</td> --}}
                        <td></td>
                        <td>{{$collection[$i]['id']}}</td>
                        <td>{{$collection[$i]['title']}}</td>
                        <td>{{$collection[$i]['body']}}</td>
                    </tr>
                @endif
            @endif
            @if ($i == $count-1)
                <tr>
                    {{-- <td>{{$collection[$i]['userId']}}</td> --}}
                    <td></td>
                    <td>{{$collection[$i]['id']}}</td>
                    <td>{{$collection[$i]['title']}}</td>
                    <td>{{$collection[$i]['body']}}</td>
                </tr>
            @endif
        @endfor
    </table>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  </body>
</html>
