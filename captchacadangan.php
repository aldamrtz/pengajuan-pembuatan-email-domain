<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CaptchaController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function generateCaptcha() {
        // Set header untuk gambar
        header("Content-type: image/png");

        // Membuat gambar
        $width = 120;
        $height = 40;
        $image = imagecreatetruecolor($width, $height);
        $background_color = imagecolorallocate($image, 255, 255, 255);
        $text_color = imagecolorallocate($image, 0, 0, 0);
        $line_color = imagecolorallocate($image, 64, 64, 64);
        $dot_color = imagecolorallocate($image, 200, 200, 200);
        
        imagefilledrectangle($image, 0, 0, $width, $height, $background_color);

        // Menambahkan garis acak
        for($i = 0; $i < 5; $i++) {
            imageline($image, rand()%$width, rand()%$height, rand()%$width, rand()%$height, $line_color);
        }

        // Menambahkan bintik-bintik acak
        for($i = 0; $i < 100; $i++) {
            imagesetpixel($image, rand()%$width, rand()%$height, $dot_color);
        }

        // Menambahkan teks captcha
        $captcha_text = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 6);
        $this->session->set_userdata('captcha', $captcha_text);

        // Menghitung ukuran teks
        $font_size = 20;
        $font_path = './assets/fonts/Poppins-Medium.ttf';
        
        $text_box = imagettfbbox($font_size, 0, $font_path, $captcha_text);
        $text_width = $text_box[2] - $text_box[0];
        $text_height = $text_box[1] - $text_box[7];

        // Posisi teks di tengah gambar
        $x = ($width - $text_width) / 2;
        $y = ($height - $text_height) / 2 + $text_height;

        imagettftext($image, $font_size, 0, $x, $y, $text_color, $font_path, $captcha_text);

        // Output gambar
        imagepng($image);
        imagedestroy($image);
    }
}
?>
