<?php

namespace App\Helpers;

use Config;

class Cdn
{
    protected $cdns = array();

    public function url($asset, $type = '')
    {
        $cdns = Config::get('cdn');

        $assetName = basename($asset);
        $assetName = explode("?", $assetName);
        $assetName = $assetName[0];

        if (!empty($type) && !empty($cdns[$type])) {
            return $this->cdnPath($cdns[$type]['host'], $asset);
        }

        foreach ($cdns as $types) {
            if (preg_match('/^.*\.(' . $types['files'] . ')$/i', $assetName)) {
                return $this->cdnPath($types['host'], $asset);
            }
        }

        return asset($asset);
    }

    private function cdnPath($cdn, $asset) 
    {
        if (empty($cdn)) {
            return asset($asset);
        }

        return "//" . rtrim($cdn, "/") . "/" . ltrim($asset, "/");
    }
}