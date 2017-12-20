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
            @if(count($transaction)>0)
            @foreach ($transaction as $key => $trans)
              <tr>
                  <td>
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default" onclick="datosmodal({{$trans->amount}})">
                      Detalles
                    </button>
                  </td>
                  <td>Alejandro Rivera</td>
                  <td>{{$trans->amount}}</td>
                  <td>Boomedic</td>
                  <td>CDMX</td>
                  <td>PayPal</td>
              </tr>
            @endforeach
            @endif
          </tbody>
      </table>
    </div>
  </center>


  <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Detalles de consulta</h4>
              </div>
              <div class="modal-body">
                <center>
                  <img src="https://maps.googleapis.com/maps/api/staticmap?maptype=roadmap&center=43.2686751,-2.9340005&zoom=16&size=600x300&markers=color:black|43.2686751,-2.9340005" style="width: 80%;" />
                </center>
                <br>
                <div class="padre">
                  <div >
                    <label>Monto : </label>
                    <p class="clasificacion">
                      <label id="idlabelMonto"></label>
                    </p>
                    <label id="">Calificación:  </label>
                    <form>
                      <p class="clasificacion">

                        <input id="radio1" type="radio" name="estrellas" value="5"><!--
                        --><label class="labelEstrellas" for="radio1">★</label><!--
                        --><input id="radio2" type="radio" name="estrellas" value="4"><!--
                        --><label class="labelEstrellas" for="radio2">★</label><!--
                        --><input id="radio3" type="radio" name="estrellas" value="3"><!--
                        --><label class="labelEstrellas" for="radio3">★</label><!--
                        --><input id="radio4" type="radio" name="estrellas" value="2"><!--
                        --><label class="labelEstrellas" for="radio4">★</label><!--
                        --><input id="radio5" type="radio" name="estrellas" value="1"><!--
                        --><label class="labelEstrellas" for="radio5">★</label>

                      </p>
                    </form>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-secondary">Save changes</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <style type="text/css">
      .th{border-style: none;}
      input[type = "radio"]{ display:none;}
      .labelEstrellas:hover{color:orange;}
      .labelEstrellas:hover ~ label{color:orange;}
      input[type = "radio"]:checked ~ .labelEstrellas{color:orange;}
      .clasificacion{
        direction: rtl;/* right to left */
        unicode-bidi: bidi-override;/* bidi de bidireccional */
      }
      .padre{
        border: 1px;
        display: inline-block;
        width: auto;
        margin: auto;
        padding: 20px, 20px;
        text-align: justify;
      }
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

    function datosmodal(valor) {
      document.getElementById("idlabelMonto").innerHTML=valor;
    }
  </script>
@stop