<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Captcha;

class CaptchaController extends Controller
{
    public function refreshCaptcha()
    {
	return captcha_src();
       // return response()->json(['captcha'=> captcha_img()]);
    }
}
