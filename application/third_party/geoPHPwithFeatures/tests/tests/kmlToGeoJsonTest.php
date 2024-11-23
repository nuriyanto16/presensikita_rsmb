<?php
require_once('../geoPHP.inc');
class KmlToGeoJsonTest extends PHPUnit_Framework_TestCase {

  function testThirdDimensionIsZeroInsteadOfNull() {
    $geometry = geoPHP::load(file_get_contents('./input/cdata.kml'), 'kml');

    $results = $geometry->out('json', $returnArray = true);

    $this->assertNotSame(null, $results['features'][0]['geometry']['coordinates'][2], 'value can NOT be null per the GeoJson spec');
    $this->assertSame(0, $results['features'][0]['geometry']['coordinates'][2], 'set this to a zero value');
  }
}
