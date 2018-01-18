<?php

/**
* Gimpa : gnu image manipulate Apache
* Author: gnutec
* AuthorLink: http://gnutec.ir
*/

function gnt_png2jpg($input, $output, $quallity = "") {
    $input_file = $input;
    $output_file = $output;

    $input = imagecreatefrompng($input_file);
    list($width, $height) = getimagesize($input_file);
    $constant_width = 400;
    $output = imagecreatetruecolor($constant_width, $height);
    $white = imagecolorallocate($output,  255, 255, 255);
    imagefilledrectangle($output, 0, 0, $constant_width, $height, $white);
    $dst_x = ($constant_width-$width)/2;
    $dst_y = 0;
    $src_x = 0;
    $src_y = 0;
    imagecopy($output, $input, $dst_x, $dst_y, $src_x, $src_y, $width, $height);
    if(!empty($quallity)){
        $result = imagejpeg($output, $output_file,$quallity);
    }else{
        $result = imagejpeg($output, $output_file);
    }
    
    if($result){
        echo "<span style=\"color: greenyellow;\">output OK</span><br>";
    }else{
        echo "<span class=\"color:red;\">output ERROR</span><br>";
    }
}

function gnt_jpg2png() {
    echo "<span class=\"color:red;\">input type is already image/jpg</span><br>";
}

ini_set('memory_limit', '-1');
$i = 1;
$inputGallery_array = glob("inputGallery/*");
foreach ($inputGallery_array as $filename) {
    $sitename = str_replace("inputGallery/", "", $filename);
    $output = "outputGallery/{$sitename}";
    $sitename = str_replace(".jpg", "", $sitename);
    $sitename = str_replace(".png", "", $sitename);
    if (preg_match("/\.(png)$/", $filename)) {
        $output = "outputGallery/{$sitename}.jpg";
        // $quallity = 70; #set quallity
        // gnt_png2jpg($filename,$output,$quallity);
        gnt_png2jpg($filename,$output);
    } else {
        gnt_jpg2png();
    }
    $i++;
}