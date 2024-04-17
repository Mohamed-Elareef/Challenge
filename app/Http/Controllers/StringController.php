<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StringController extends Controller
{
    public function checkString(Request $request)
    {
        $string = $request->input('string');
        $isValid = $this->isValidString($string);
        
        return response()->json(['isValid' => $isValid]);
    }

    public function isValidString($str)
    {
        $stack = [];
        $matching = [
            ')' => '(',
            '}' => '{',
            ']' => '[',
        ];
    
        foreach (str_split($str) as $char) {
            if (in_array($char, array_keys($matching))) {
                $top = array_pop($stack);
                if ($top !== $matching[$char]) {
                    return false;
                }
            } else {
                array_push($stack, $char);
            }
        }
    
        return empty($stack);
    }
    
 

}
