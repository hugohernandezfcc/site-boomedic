<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
  </head>
  <body>
    <div style="text-align: right;">
      <label>Fecha de Factura: </label>
    </div>
    <div>
      <h3><strong>Emisor</strong></h1>
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
      <h3><strong>Receptor</strong></h1>
      <div style="display: inline-block;">
        <label style="display: block;">Nombre:</label>
        <label style="display: block;">RFC:</label>
      </div>
      <div style="display: inline-block; margin-left: 2em">
        <label style="display: block;"></label>
        <label style="display: block;"></label>
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
              <td>1</td>
              <td>01010101</td>
              <td>Aurriculares USB Logitech</td>
              <td>500.00</td>
              <td>500.00</td>
            </tr>
        </tbody>
      </table>
    </div>
    <div>
      <!--<div style="display: inline-block;width: 30%"><img src="foto.JPG" alt="foto" style="width: 100%" /></div>-->
      <div style="display: inline-block;">
        <label style="display: block;"><strong>Sello:</strong></label>
        <label style="display: block;"></label>
        <label style="display: block;"><strong>Certificado:</strong></label>
        <label style="display: block;"></label>
        <label style="display: block;">No de Serie del Certificado:</label>
        <label style="display: block;">Fecha y hora de certificación: </label>
      </div>
    </div>
  </body>
</html>