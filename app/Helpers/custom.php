<?php

namespace App\Helpers;

class Custom
{
    public static  function validaRut($rutCompleto) {
	if ( !preg_match("/^[0-9]+-[0-9kK]{1}/",$rutCompleto)) return false;
		$rut = explode('-', $rutCompleto);
		return strtolower($rut[1]) == Custom::dv($rut[0]);
	}
    public static  function dv($T) {
		$M=0;$S=1;
		for(;$T;$T=floor($T/10))
			$S=($S+$T%10*(9-$M++%6))%11;
		return $S?$S-1:'k';
	}
}
