<?php

namespace App\Helpers;

use Config;

class Cdn
{
    protected $cdns = array();

    public function asset($asset)
    {
        $cdns = Config::get('cdn');

        $assetName = basename($asset);
        $assetName = explode("?", $assetName);
        $assetName = $assetName[0];

        foreach ($cdns as $types) {
            if (preg_match('/^.*\.(' . $types['files'] . ')$/i', $assetName)) {
                return $this->cdnPath($types['host'], $asset);
            }
        }

        return asset($asset);
    }

    public function image($image, $size)
    {
        return $this->asset(sprintf('/image/article/%d/%d/%s.png', $image->article_id, $image->id, $size));
    }

    private function cdnPath($cdn, $asset)
    {
        if (empty($cdn)) {
            return asset($asset);
        }

        return "//" . rtrim($cdn, "/") . "/" . ltrim($asset, "/");
    }
}