<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
  </head>
  <body style="">
    <!--<div style="height: 40px;right: -2em;left: -2em; top: -2.5em; position: fixed;">
      <img src="img/footer.png" style="width: 100%;height: 100%" />
    </div>-->
    <div style="text-align: right;">
      <label>Fecha de Factura: {{$dataPDF['fecha']}}</label>
    </div>
    <div>
      <h3><strong>Emisor</strong></h3>
      <div style="display: inline-block;">
        <label style="display: block;">Nombre:</label>
        <label style="display: block;">RFC:</label>
        <label style="display: block;">Regimen Fiscal:</label>
      </div>
      <div style="display: inline-block; margin-left: 2em">
        <label style="display: block;">{{$dataPDF['data']->nombreEmisor}}</label>
        <label style="display: block;">{{$dataPDF['data']->rfcEmisor}}</label>
        <label style="display: block;">{{$dataPDF['data']->regimenFiscal}}</label>
      </div>
  </div>
    <div>
      <h3><strong>Receptor</strong></h3>
      <div style="display: inline-block;">
        <label style="display: block;">Nombre:</label>
        <label style="display: block;">RFC:</label>
      </div>
      <div style="display: inline-block; margin-left: 2em">
        <label style="display: block;">{{$dataPDF['receptor']->company_legalName}}</label>
        <label style="display: block;">{{$dataPDF['receptor']->rfc}}</label>
      </div>
    </div>
    <div style="width: 100%">
      <h3><strong>Concepto</strong></h1>
      <table style="width: 100%; text-align: center;">
        <thead>
          <tr>
            <th>Cantidad</th>
            <th>Clave de Producto de Servicio</th>
            <th>Descripción</th>
            <th>Precio Unitario</th>
            <th>Importe</th>
          </tr>
        </thead>
        <tbody >
            <tr>
              <td>{{$dataPDF['data']->conceptos[0]['cantidad']}}</td>
              <td>{{$dataPDF['data']->conceptos[0]['claveProdServ']}}</td>
              <td>{{$dataPDF['data']->conceptos[0]['descripcion']}}</td>
              <td>{{$dataPDF['data']->conceptos[0]['valorUnitario']}}</td>
              <td>{{$dataPDF['data']->conceptos[0]['importe']}}</td>
            </tr>
        </tbody>
      </table>
    </div>
    <br>
    <div style="text-align: right;margin-right: 6em">
      <div style="display: inline-block;margin-right: 2em">
        <label style="display: block;">Subtotal:</label>
        <label style="display: block;">Total:</label>
      </div>
      <div style="display: inline-block; margin-right: 2em">
        <label style="display: block;">{{$dataPDF['data']->subtotal}}</label>
        <label style="display: block;">{{$dataPDF['data']->total}}</label>
      </div>
    </div>
    <br>
    <div>
      <div style="width: 20%;display: inline-block;"><img src="data:image/png;base64,{{$dataPDF['img']}}" style="width: 100%" /></div>
      <div style="display: inline-block;word-wrap: break-word;width: 70%">
        <label style="display: block;"><strong>Sello CFD:</strong></label>
        <label style="display: block;word-wrap: break-word;font-size: 10px;">{{$dataPDF['selloCFD']}}</label>
        <br>
        <label style="display: block;"><strong>Sello SAT:</strong></label>
        <label style="display: block;word-wrap: break-word;font-size: 10px;">{{$dataPDF['selloSAT']}}</label>
        <br
        <label style="display: block;"><strong>No de Serie del Certificado SAT: </strong><span style="font-size: 10px">{{$dataPDF['noCertificado']}}</span></label>
        <br>
        <label style="display: block;"><strong>Fecha y hora de certificación: </strong><span style="font-size: 10px">{{$dataPDF['FechaYhora']}}</span></label>
      </div>
    </div>
    <div style="height: 50px;right: -2.7em;left: -2.7em; bottom: -2.7em; position: fixed;">
      <img src="img/footer.png" style="width: 100%;height: 100%" />
    </div>
  </body>
</html>