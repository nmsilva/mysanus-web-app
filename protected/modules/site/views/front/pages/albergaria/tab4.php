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
        
        $gMap->setCenter(40.692357,-8.477466);
        
        // Create marker
        $marker = new EGMapMarker(40.692357,-8.477466, array(
                'title' => 'Marker With Custom Image'));
        $gMap->addMarker($marker);

        $gMap->renderMap(); ?>
    
</div>
