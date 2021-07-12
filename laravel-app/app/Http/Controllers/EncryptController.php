<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;

class EncryptController extends Controller
{
    /**
     * Encrypt a text string
     *
     * @return Response
     */
    public function encrypt($text)
    {
        $encryptedText = Crypt::encryptString($text);
        //$decryptedText = Crypt::decryptString($encryptedText);

        $result = array(
            "api_http" => 200,
            "text" => $text,
            "encrypted" => $encryptedText,
        );

        return response()->json( $result, $result['api_http'] );
    }
}
