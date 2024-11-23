<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created MST.
 */
class Geo_php
{
    public function __construct()
    {
        include_once APPPATH . '/third_party/geoPHPwithFeatures/geoPHP.inc';
    }

    public function load_geom($raw_geom, $format)
    {
        return geoPHP::load($raw_geom, $format);
    }
}
