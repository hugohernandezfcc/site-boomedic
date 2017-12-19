@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content_header')

    <h1>Mis consultas</h1>

@stop

@section('content')
  <center>
    <div style="width: 90%">
      <table id="example" class="display" cellspacing="0" width="100%">
          <thead>
              <tr>
                  <th style="border-style: none;">Detalles</th>
                  <th style="border-style: none;">Médico</th>
                  <th style="border-style: none;">Tarifa</th>
                  <th style="border-style: none;">Consultorio</th>
                  <th style="border-style: none;">Ciudad</th>
                  <th style="border-style: none;">Método de pago</th>
              </tr>
          </thead>
          <tfoot>
              <tr>
                  <th style="border-style: none;">Detalles</th>
                  <th style="border-style: none;">Médico</th>
                  <th style="border-style: none;">Tarifa</th>
                  <th style="border-style: none;">Consultorio</th>
                  <th style="border-style: none;">Ciudad</th>
                  <th style="border-style: none;">Método de pago</th>
              </tr>
          </tfoot>
          <tbody >
            @foreach ($transaction as $key => $trans)
              <tr>
                  <td>Detalles</td>
                  <td>Alejandro Rivera</td>
                  <td>{{$trans->amount}}</td>
                  <td>Boomedic</td>
                  <td>CDMX</td>
                  <td>PayPal</td>
              </tr>
            @endforeach
          </tbody>
      </table>
    </div>
  </center>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <style type="text/css">
      .th{border-style: none;}
  </style>
@stop

@section('js')
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js">
  
    <script>
    $(document).ready(function() {
    $('#example').DataTable( {
        "ordering": false,
        "info":     false
    } );
  } );
</script>
@stop