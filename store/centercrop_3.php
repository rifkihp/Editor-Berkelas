<?php
    $video_id = $_GET["id"]; //"Cj2QOZq-d48";
    
    function fetch_highest_res ($videoid) {
        $resolutions = array('maxresdefault', 'hqdefault', 'mqdefault');     
        foreach($resolutions as $res) {
            $imgUrl = "http://i.ytimg.com/vi/$videoid/$res.jpg";
            if(@getimagesize(($imgUrl))) 
                return $imgUrl;
        }
    }

    
    $url = fetch_highest_res($video_id);
    header("content-type: image/jpg");
    $image = imagecreatefromjpeg($url);
    
    imagejpeg($image);