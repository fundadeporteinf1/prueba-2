<html>	
  <head><title>Varios Marcadores - Futbol</title></head>
  <center><h1>Futbol - Fundadeporte</h1></center>
  
   <center><form method="post" action="">
    <input type="submit" name="boton_1" id="boton_1" value="Volver" dir="index.php" />
    
</form> </center>
  
  <body>
  	 	
  	
  <div id="mapdiv"></div>
  <script src="http://www.openlayers.org/api/OpenLayers.js"></script>
  <script src="js/JQuery/jquery-1.9.1.js"></script>
    <script src="js/magnific-popup.js"></script>
  <script>
  
  $(document).ready(function(){
    
    $("input[type=submit]").click(function() {
        var accion = $(this).attr('dir');
        $('form').attr('action', accion);
        $('form').submit();
    });
    
});
  //agregado 18-06-2014 para mostrar mapas por separado
 
  
  
  
  //modificacion 1
  //creando mapa
  
   map = new OpenLayers.Map("mapdiv");
   
    map.addLayer(new OpenLayers.Layer.OSM());
    
    epsg4326 =  new OpenLayers.Projection("EPSG:4326"); //WGS 1984 projection
    projectTo = map.getProjectionObject(); //The map projection (Spherical Mercator)
   
    //centrando mapa
    var lonLat = new OpenLayers.LonLat( -68.01105000, 10.235770 ).transform(epsg4326, projectTo);
          
    
    var zoom=14;
    map.setCenter (lonLat, zoom);

    //creando capa de vectores
    var vectorLayer = new OpenLayers.Layer.Vector("Overlay");
    
    // Define markers as "features" of the vector layer:
    // modificacion 2
    // Creación de puntos georeferenciados utilzando la funcion de creacion de vectores asignados a la capa de vectores
  var feature = new OpenLayers.Feature.Vector(
            new OpenLayers.Geometry.Point( -68.01163, 10.22340  ).transform(epsg4326, projectTo),
            {description:"<br>Aqui esta el Polideportivo Misael Delgado: <a  class='simple-ajax-popup' href='misael.php'>Detalles</a>"} ,
            {externalGraphic: 'img/marker-gold.png', graphicHeight: 30, graphicWidth: 25, graphicXOffset:-12, graphicYOffset:-25  }
        );    
    vectorLayer.addFeatures(feature);
   
    map.addLayer(vectorLayer);
 
    
    //Add a selector control to the vectorLayer with popup functions
    var controls = {
      selector: new OpenLayers.Control.SelectFeature(vectorLayer, { onSelect: createPopup, onUnselect: destroyPopup })
    };

    //inactiva
    function createPopup(feature) {
      feature.popup = new OpenLayers.Popup.FramedCloud("pop",
          feature.geometry.getBounds().getCenterLonLat(),
          null,
          '<div class="markerContent">'+feature.attributes.description+'</div>',
          null,
          true,
          function() { controls['selector'].unselectAll(); }
      );
      //feature.popup.closeOnMove = true;
      map.addPopup(feature.popup);
    }

    function destroyPopup(feature) {
      feature.popup.destroy();
      feature.popup = null;
    }
    
    map.addControl(controls['selector']);
    controls['selector'].activate();
      
  </script>
  
  <!--agregado 18-06-2014 para mostrar mapa por separad0-->
 
 
 <!--agregado 18-06-2014 para mostrar mapa por separad0-->
  <!--<div id="explanation">Popup bubbles appearing when you click a marker. The marker content is set within a feature attribute</div>-->
</body>
</html>