<div style="float: left; width: 30%;height: 300px">
    <br>
    Largo de Infias, nº3<br>
    S.Vicente 4710-303 Braga<br>
    <b>T:</b> 925 764 739<br>
    <b>E:</b> geral@mysanus.pt<br>
</div>
<!-- map of location-->
<div id="loc" style="margin-top: 10px;float: left;width: 70%;position: relative;height: 300px; margin-bottom: 100px;">
    
    <?php Yii::import('ext.EGMap.*');
        $gMap = new EGMap();
        $gMap->setWidth('100%');
        $gMap->setHeight(300);
        $gMap->zoom = 16;

        $sample_address = 'Largo de Infias, nº3 S.Vicente 4710-303 Braga';

        // Create geocoded address
        $geocoded_address = new EGMapGeocodedAddress($sample_address);
        $geocoded_address->geocode($gMap->getGMapClient());

        // Center the map on geocoded address
        $gMap->setCenter($geocoded_address->getLat(), $geocoded_address->getLng());

        // Add marker on geocoded address
        $gMap->addMarker(
             new EGMapMarker($geocoded_address->getLat(), $geocoded_address->getLng())
        );

        $gMap->renderMap(); ?>
    
</div>
