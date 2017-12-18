@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content_header')

  <center>
    <h1>Mis consultas</h1>
  </center>

    
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
              <tr>
                  <td>Detalles</td>
                  <td>Alejandro Rivera</td>
                  <td>$5,000</td>
                  <td>Boomedic</td>
                  <td>CDMX</td>
                  <td>PayPal</td>
              </tr>
              <tr>
                  <td>Detalles1</td>
                  <td>Alejandro Rivera1</td>
                  <td>$5,0001</td>
                  <td>Boomedic1</td>
                  <td>CDMX1</td>
                  <td>PayPal1</td>
              </tr>
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