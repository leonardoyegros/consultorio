<?php
/* /app/views/helpers/link.php */

class FormatHelper extends AppHelper {
    function number($number, $type, $options) {

    	$symbol = !empty($options['symbol']) ? $options['symbol'] : '';
    	$decimals = !empty($options['decimals']) ? $options['decimals'] : 0;

    	switch ($type) {
    		default:
    			$n = number_format($number, $decimals, '.',',');
    			break;
    		
    		case 'money':
    			$n = $symbol." ".number_format($number, $decimals, '.',',');
    			break;
    	}

    	return $n;


    }


    function array2js($array){
        foreach ($array as $key => $value) {
            $aux[] =  '{ label:' . '"' . $value['label'].'", y:'.$value['y']." }";
        }
        return $result = implode(',', $aux);
    }
}

?>