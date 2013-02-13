'thumbnail' => array(
    'value' => function ($item) {
        foreach ($item->medias as $media) {
            return $media->get_public_path_resized(64, 64);
        }
        return false;
    },
),
'thumbnailAlternate' => array(
    'value' => function ($item) {
        return '/static/apps/test/img/64/icon.png';
    }
),
