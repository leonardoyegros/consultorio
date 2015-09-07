<?php
	$config['System']['name'] = 'SISO';

	$config['System']['address'] = 'http://localhost/leo/siso13/siso1.3';	

	$config['System']['version'] = 736;

	//$config['System']['title'] = $config['System']['name'] . " rev. " . $config['System']['version'];
	$config['System']['title'] = $config['System']['name'];
	
	// $config['System']['Email']['address'] = $config['System']['name'] . ' <support@siso.com>';
	// $config['System']['Email']['smtpOptions'] = array(
	// 	'port'		=>'465',
	// 	'timeout'	=>'30',
	// 	'host'		=> 'ssl://smtp.gmail.com',
	// 	'username' 	=> 'tims@tivahq.com',
	// 	'password' 	=> 'p1ngu1n0'
	// );
	
	$config['System']['Contact']['types'] = array(
		'person' => __('Contact.type: person', true),
		'entity' => __('Contact.type: entity', true),
	);
	
	$config['System']['document_types'] = array(
		'ci' => __('CI', true),
		'ruc' => __('RUC', true),
		'dip' => __('Diplomatic Passport', true),
		'passport' => __('Passport', true),
		'cuit' => __('CUIT', true),
		'foreign_provider' => __('Foreign Provider', true),
		'foreign_client' => __('Foreign Client', true)
	);
	
	$config['System']['FoundAccounts']['types'] = array(
		'bank' 		=> __('Bank', true),
		'income'	=> __('Income', true)
	);
	
	$config['System']['masks'] = array(
		'datetime'	=> 'Y-m-d H:i:s',
		'date'		=> 'd-m-Y',
		'legaldate'	=> 'd/m/Y',
		'currency'	=> 's n' /* s=symbol, n=number */
	);
	
	$config['System']['paymentTerms'] = array(
		'cash' => __('pm:Cash', true),
		'credit' => __('Credit', true)
	);
	
	$config['System']['formats']['currency'] = array(
		'decimals'			 	=> 0,
		'decimals_separator'	=> ',',
		'thousand_separator'	=> '.'	
	);
	
	$config['System']['Stock']['StatusList'] = array(
		'pending'				=> __('Pending', true),
		'received'				=> __('Received', true)
	);
	
	$config['System']['UM'] = array(
		'x1' => __('Units', true),
		'x12' => __('Dozens', true),
		'C/N' => __("As required", true),
		__('Length', true) => array(
			'cm' => __('Centimeters', true),
			'mt' => __('Meters', true),
			'ft' => __('Feet', true)
		),
		__('Mass', true) => array(
			'gr' => __('Grams', true),
			'kg' => __('Kilograms', true),
			'tn' => __('Tons', true),
		),
		__('Volume', true) => array(
			'cm3' => __('Cubic Centimeters', true),
			'm3' => __('Cubic Meters', true),
			'lt' => __('Liters', true)
		),
		__('Area', true) => array(
			'cm2' => __('Square Centimeters', true),
			'm2' => __('Square Meters', true),
		)
	);
	$config['System']['UMList'] = array();
	foreach ($config['System']['UM'] as $k => $um) {
		if (is_array($um)) {
			foreach ($um as $k2 => $u) {
				$config['System']['UMList'][$k2] = $u;
			}
		}
		else {
			$config['System']['UMList'][$k] = $um;
		}
	}
	
	$config['System']['Departments'] = array(
		'administration'	=> __('Administration', true),
		'legal'				=> __('Legal', true)
	);
	
	$config['System']['FundTransferTypes'] = array(
		'swift' 	=> __("Swift", true),
		'deposit'	=> __("Deposit", true),
		'extraction'	=> __("Extraction", true)
	);
	
	$config['System']['costingMethods'] = array(
		'pp' => __("cm:pp", true),
		'rep' => __("cm:rep", true)
	);
	
	$config['System']['saleChannels'] = array(
		'system' => __("System", true),
		'ecommerce' => __("E-Commerce", true)
	);
	
	$config['System']['collectionStatuses'] = array(
		'active' => __("Active", true),
		'risk_process' => __("Risk Process", true),
		'legal' => __("Legal", true),
		'uncollectable' => __("Uncollectable", true),
		'exchange' => __("Exchange", true)
	);
	
	$config['System']['maritalStatuses'] = array(
		'single' => __("Single", true),
		'married' => __("Married", true),
		'divorced' => __("Divorced", true),
		'widow' => __("Widower", true)
	);
	
	$config['System']['uploads'] = array(
		'private' => WWW_ROOT.'../upload/',
		'public' => WWW_ROOT.'upload/',
		'tmp' => WWW_ROOT.'../tmp/upload/'
	);
	
	$config['System']['purchasesDocs'] = array(
		'invoice' => __('Invoice', true),
		'receipt' => __('Receipt', true),
		'bos' => __('Bill of Sale', true),
		'auto_invoice' => __('Auto Invoice', true),
		'delivery_note' => __('Delivery Note', true)
		// 'bos'	  => 'Boleta de Venta',
		// 'withholding' => 'Boleta de Retención'
	);
	
	$config['System']['salesDocs'] = array(
		'invoice' => __('Invoice', true),
		'receipt' => __('Receipt', true),
		'billofsale' => __('Bill of Sale', true)
		// 'delivery_note' => __('Delivery Note', true)
	);
	
	$config['System']['maritals'] = array(
		'single' => __('MS:Single', true),
		'married' => __('Married', true),
		'divorced' => __('Divorced', true),
		'widowed' => __("Widowed", true)
	);
	
	$config['System']['dows'] = array(
		1 => __('Monday', true),
		2 => __('Tuesday', true), 
		3 => __('Wednesday', true),
		4 => __('Thursday', true), 
		5 => __('Friday', true), 
		6 => __('Saturday', true), 
		7 => __('Sunday', true)
	);
	
	$config['System']['Auth']['nonce'] = '708a65c007259f302db570f607cfa897';
	
	$config['System']['billingMethods'] = array(
		'printed form' => __('Pre-Printed Form', true),
		'auto print' => __('Auto Print', true),
		'fiscal controller' => __('Fiscal Controller', true),
		'digital invoice' => __('Digital Invoice', true)
	);
	
	// $config['System']['extensionsModes'] = array(
	// 	'webphone' => __('BIMS Talk', true),
	// 	'other' => __('Other Phones', true)
	// );
	
	// $config['System']['quantityDecimals'] = 2;
	
	// $config['System']['financingMethods'] = array(
	// 	'fixed' => 'Cuotas Fijas'
	// );
?>
	


	