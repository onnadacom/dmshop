<?
if (!defined("_DMSHOP_")) exit;

// Filename: ColorCompare.php
// Copyright (C) 2011 Chris Gosling
// Licence: GNU Lesser General Public License, http://www.gnu.org/copyleft/lesser.html

class ColorCompare
{

    // max width and height for testing and resampling
    static private $resize_dim = 512;

    // define colour swatches
    static public $swatches = array(
        "WHITE" => "FFFFFF",
        "CREAM" => "F2EAC6",
        "YELLOW" => "F8E275",
        "ORANGE" => "FA9A4D",
        "PEACH" => "F9A986",
        "PINK" => "FAACA8",
        "MANGENTA" => "FC6D99",
        "RED" => "FF0000",
        "BURGANDY" => "AC2424",
        "PURPLE" => "A746B1",
        "LAVENDER" => "C791F1",
        "LIGHT_BLUE" => "A4A6FD",
        "DARK_BLUE" => "1D329D",
        "TURQUIOSE" => "2CCACD",
        "AQUA" => "9CD8F4",
        "DARK_GREEN" => "62854F",
        "LIGHT_GREEN" => "A9CB6C",
        "TAN" => "CAB775",
        "BROWN" => "815B10",
        "GRAY" => "777777",
        "BLACK" => "000000"
    );

    // this will be the swatch index for each color
    // eg: $swatch_index[0] = "WHITE" and so on
    static private $swatch_index;

    // this image contains the palette the test image will be compared to
    static private $comp_palette = false;

    // percentage that colour needs to reach of total
    // pixels for colour to be considered significant
    static public $threshold_filter = 5;

    // ------------------------------------------------------
    // ACCEPTS: max number of colours to return
    //                     filename of image
    //                    comparison method id
    //                        1 = resize method
    // RETURNS: array (up to max_colors) containing indexed with the color
    //                        name and
    //                    the value will be the pixel count in order of highest to
    //                        lowest pixels
    //                    eg: "TAN" => 1000, "PINK" => 800, "MAGENTA" => 600
    //                    or false if failed
    static public function compare($max_colors, $filename)
    {

        $tally = array();

        // size image to something managable (256 x 256)
        $image_data = getimagesize($filename);

        // if small image then use its current size
        if ($image_data[0] < self::$resize_dim && $image_data[1] < self::$resize_dim) {

            $image = self::createImage($filename, $image_data[2]);
            $width = $image_data[0];
            $height = $image_data[1];

        } else {
        // resize the image

            $res = self::createResizedImage($filename, $image_data[0], $image_data[1], $image_data[2]);

            if ($res == false) {

                //print "[failed on resize]";
                return false;

            } else {

                $image = $res[0];
                $width = $res[1];
                $height = $res[2];

            }

        }

        // create the comparison palette
        self::createComparisonPalette();

        // loop through x axis
        for ($x = 0; $x < $width; $x++) {

            // loop through y axis
            for ($y = 0; $y < $height; $y++) {

                // compare to find colest match and tally
                list($red, $green, $blue) = self::getRGBFromPixel($image, $x, $y);
                $index = imagecolorclosest(self::$comp_palette, $red, $green, $blue);
                $tally[$index] = $tally[$index] + 1;

            }

        }

        // sort the tally results
        arsort($tally);
        $ret_array = array();
        $i = 0;
        $threshold = ($width * $height) * (self::$threshold_filter / 100);

        // build the return array of the top results
        foreach($tally as $index => $count) {

            // make sure the count is high enough to be considered significant
            if ($count >= $threshold) {

                $ret_array[self::$swatch_index[$index]] = $count;
                $i++;

            } else {

                break;

            }

            if ($i >= $max_colors) {

                break;

            }

        }

        return $ret_array;

    }

    // --------------------------------------------------------
    // ACCEPTS: image resource
    //                    x/y coordinate
    // RETURNS: array contain red, green, blue value of pixel
    static private function getRGBFromPixel($image, $x, $y)
    {

        $rgb = imagecolorat($image, $x, $y);
        $red = ($rgb >> 16) & 0xFF;
        $green = ($rgb >> 8) & 0xFF;
        $blue = $rgb & 0xFF;
        return array ($red, $green, $blue);

    }

    // -------------------------------------------------------
    // Creates the comparison palette if not already created
    static private function createComparisonPalette()
    {

        if (self::$comp_palette === false) {

            $swatch_index = array();
            self::$comp_palette = imagecreate(16, 16);

            foreach(self::$swatches as $name => $hex) {

                $color = self::hexToRGB($hex);
                $index = imagecolorallocate(self::$comp_palette, $color['red'], $color['green'], $color['blue']);
                self::$swatch_index[$index] = $name;

            }

        }

    }

    // ------------------------------------------------------
    // ACCEPTS: hex color value without the # (eg: FF0000)
    // RETURNS: associative array with values for ref, green and blue
    static private function hexToRGB($hexStr)
    {

        $colorVal = hexdec($hexStr);
        $rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
        $rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
        $rgbArray['blue'] = 0xFF & $colorVal;
        return $rgbArray;

    }

    // ------------------------------------------------------
    // ACCEPTS: filename of input image,
    //                    original width and height of image
    //                    type of image
    // RETURNS: resized image or false if failed
    static private function createResizedImage($filename, $width, $height, $type)
    {

        // create image from file
        $image = self::createImage($filename, $type);

        if (!$image) {

            return false;

        }

        //calculate dimensions based on smallest size
        $new_width = $width < self::$resize_dim ? $width : self::$resize_dim;
        $new_height = $height < self::$resize_dim ? $height : self::$resize_dim;

        // create resampled image
        $new_image = imagecreatetruecolor($new_width, $new_height);

        if ($new_image === false) {

            return false;

        }

        if (imagecopyresampled($new_image, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height)) {

            return array($new_image, $new_width, $new_height);

        } else {

            return false;

        }

    }

    // ---------------------------------------------------
    // Creates an image object for the supplied image file and type
    // ACCEPTS: the filename of the image and the image type
    // RETURNS: image object
    static private function createImage($filename, $image_type)
    {

        // determine image type
        switch ($image_type)
        {
            case IMAGETYPE_GIF:
                $image = imagecreatefromgif($filename);
                break;
            case IMAGETYPE_JPEG:
                $image = imagecreatefromjpeg($filename);
                break;
            case IMAGETYPE_PNG:
                $image = imagecreatefrompng($filename);
                break;
            default:
                return false;
        }

        return $image;

    }

}

function color_column($name)
{

    if (!$name) {
        return false;
    }

    if ($name == 'WHITE') {
        $column = "color1";
    }
    else if ($name == 'CREAM') {
        $column = "color2";
    }
    else if ($name == 'YELLOW') {
        $column = "color3";
    }
    else if ($name == 'ORANGE') {
        $column = "color4";
    }
    else if ($name == 'PEACH') {
        $column = "color5";
    }
    else if ($name == 'PINK') {
        $column = "color6";
    }
    else if ($name == 'MANGENTA') {
        $column = "color7";
    }
    else if ($name == 'RED') {
        $column = "color8";
    }
    else if ($name == 'BURGANDY') {
        $column = "color9";
    }
    else if ($name == 'PURPLE') {
        $column = "color10";
    }
    else if ($name == 'LAVENDER') {
        $column = "color11";
    }
    else if ($name == 'LIGHT_BLUE') {
        $column = "color12";
    }
    else if ($name == 'DARK_BLUE') {
        $column = "color13";
    }
    else if ($name == 'TURQUIOSE') {
        $column = "color14";
    }
    else if ($name == 'AQUA') {
        $column = "color15";
    }
    else if ($name == 'DARK_GREEN') {
        $column = "color16";
    }
    else if ($name == 'LIGHT_GREEN') {
        $column = "color17";
    }
    else if ($name == 'TAN') {
        $column = "color18";
    }
    else if ($name == 'BROWN') {
        $column = "color19";
    }
    else if ($name == 'GRAY') {
        $column = "color20";
    }
    else if ($name == 'BLACK') {
        $column = "color21";
    } else {
        return false;
    }

    return $column;

}
?>