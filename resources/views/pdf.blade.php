<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
  </head>
  <body>
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
    <div>
      <!--<div style="display: inline-block;width: 30%"><img src="foto.JPG" alt="foto" style="width: 100%" /></div>-->
      <div style="display: inline-block;">
        <label style="display: block;"><strong>Sello:</strong></label>
        <label style="display: block;">{{$dataPDF['sello']['0']}}</label>
        <label style="display: block;"><strong>Certificado:</strong></label>
        <label style="display: block;">{{$dataPDF['certificado']['0']}}</label>
        <label style="display: block;"><strong>No de Serie del Certificado: </strong>{{$dataPDF['noCertificado']['0']}}</label>
        <label style="display: block;"><strong>Fecha y hora de certificación: </strong>{{$dataPDF['FechaYhora']['0']}}</label>
      </div>
    </div>
  </body>
</html>