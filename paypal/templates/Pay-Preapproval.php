<?php
// Include required library files.
require_once('../includes/config.php');
require_once('../includes/paypal.class.php');
require_once('../includes/paypal.adaptive.class.php');
$crovallpay = mysql_query("SELECT * FROM crowed_payment WHERE order_status='processing'");	
// Create PayPal object.
$PayPalConfig = array(
					  'Sandbox' => $sandbox,
					  'DeveloperAccountEmail' => $developer_account_email,
					  'ApplicationID' => $application_id,
					  'DeviceID' => $device_id,
					  'IPAddress' => $_SERVER['REMOTE_ADDR'],
					  'APIUsername' => $api_username,
					  'APIPassword' => $api_password,
					  'APISignature' => $api_signature,
					  'APISubject' => $api_subject
					);

$PayPal = new PayPal_Adaptive($PayPalConfig);
while($crovallpayy =  mysql_fetch_array($crovallpay)){
	/*echo '<pre>';
	print_r($crovallpayy);*/
	$cvhb = '';
	$opd = explode(',',$crovallpayy['prod_id']);
	foreach($opd as $pronarg){
		///Email
		$buyeremail  = mysql_fetch_array(mysql_query("SELECT user_email FROM wp_users WHERE ID=".$crovallpayy['user_id']));
	$orproduct_totqty  = mysql_fetch_array(mysql_query("SELECT sum(b.meta_value) as tot_prod_qty FROM wp_woocommerce_order_itemmeta as a, wp_woocommerce_order_itemmeta as b WHERE a.meta_value=".$pronarg." AND a.meta_key='_product_id' AND a.order_item_id=b.order_item_id AND b.meta_key='_qty'"));
			$popqty = $orproduct_totqty['tot_prod_qty'];
	$prostk  = mysql_fetch_array(mysql_query("SELECT meta_value FROM wp_postmeta WHERE meta_key='_stock' AND post_id=".$pronarg));
		if($prostk['meta_value']<=$popqty){
			
		}else{
			$cvhb = 'notyet';
		}
	}
if(isset($cvhb) && ($cvhb!='notyet')){
	mail($buyeremail['user_email'],'dfsd','sdfd');
	mail('nabanita.c@candeotech.net','profit','sdfd');
// Prepare request arrays
$PayRequestFields = array(
						'ActionType' => 'PAY', 								// Required.  Whether the request pays the receiver or whether the request is set up to create a payment request, but not fulfill the payment until the ExecutePayment is called.  Values are:  PAY, CREATE, PAY_PRIMARY
						'CancelURL' => 'http://maestros-ites.com/testserver1/teecircle/paypal/blank.php', 									// Required.  The URL to which the sender's browser is redirected if the sender cancels the approval for the payment after logging in to paypal.com.  1024 char max.
						'CurrencyCode' => 'USD', 								// Required.  3 character currency code.
						'FeesPayer' => '', 									// The payer of the fees.  Values are:  SENDER, PRIMARYRECEIVER, EACHRECEIVER, SECONDARYONLY
						'IPNNotificationURL' => '', 						// The URL to which you want all IPN messages for this payment to be sent.  1024 char max.
						'Memo' => '', 										// A note associated with the payment (text, not HTML).  1000 char max
						'Pin' => '', 										// The sener's personal id number, which was specified when the sender signed up for the preapproval
						'PreapprovalKey' => $crovallpayy['preapprovalkey'], 							// The key associated with a preapproval for this payment.  The preapproval is required if this is a preapproved payment.  
						'ReturnURL' => 'http://maestros-ites.com/testserver1/teecircle/paypal/blank.php', 									// Required.  The URL to which the sener's browser is redirected after approvaing a payment on paypal.com.  1024 char max.
						'ReverseAllParallelPaymentsOnError' => '', 			// Whether to reverse paralel payments if an error occurs with a payment.  Values are:  TRUE, FALSE
						'SenderEmail' => '', 								// Sender's email address.  127 char max.
						'TrackingID' => ''									// Unique ID that you specify to track the payment.  127 char max.
						);
						
$ClientDetailsFields = array(
						'CustomerID' => '', 								// Your ID for the sender  127 char max.
						'CustomerType' => '', 								// Your ID of the type of customer.  127 char max.
						'GeoLocation' => '', 								// Sender's geographic location
						'Model' => '', 										// A sub-identification of the application.  127 char max.
						'PartnerName' => ''									// Your organization's name or ID
						);
						
$FundingTypes = array('ECHECK', 'BALANCE', 'CREDITCARD');

$Receivers = array();
$Receiver = array(
				'Amount' => $crovallpayy['order_amount'], 											// Required.  Amount to be paid to the receiver.
				'Email' => $developer_account_email, 												// Receiver's email address. 127 char max.
				'InvoiceID' => '', 											// The invoice number for the payment.  127 char max.
				'PaymentType' => '', 										// Transaction type.  Values are:  GOODS, SERVICE, PERSONAL, CASHADVANCE, DIGITALGOODS
				'PaymentSubType' => '', 									// The transaction subtype for the payment.
				'Phone' => array('CountryCode' => '', 'PhoneNumber' => '', 'Extension' => ''), // Receiver's phone number.   Numbers only.
				'Primary' => ''												// Whether this receiver is the primary receiver.  Values are boolean:  TRUE, FALSE
				);
array_push($Receivers,$Receiver);

$SenderIdentifierFields = array(
								'UseCredentials' => ''						// If TRUE, use credentials to identify the sender.  Default is false.
								);
								
$AccountIdentifierFields = array(
								'Email' => '', 								// Sender's email address.  127 char max.
								'Phone' => array('CountryCode' => '', 'PhoneNumber' => '', 'Extension' => '')								// Sender's phone number.  Numbers only.
								);
								
$PayPalRequestData = array(
					'PayRequestFields' => $PayRequestFields, 
					'ClientDetailsFields' => $ClientDetailsFields, 
					//'FundingTypes' => $FundingTypes, 
					'Receivers' => $Receivers, 
					'SenderIdentifierFields' => $SenderIdentifierFields, 
					'AccountIdentifierFields' => $AccountIdentifierFields
					);

// Pass data into class for processing with PayPal and load the response array into $PayPalResult
$PayPalResult = $PayPal->Pay($PayPalRequestData);

	// Write the contents of the response array to the screen for demo purposes.
	echo '<pre />';
	print_r($PayPalResult);
	if($PayPalResult['Ack']=='Success'){
			mysql_query("UPDATE crowed_payment SET order_execution_date='".date('Y-m-d H:i:s')."',
												   order_status='completed' WHERE id=".$crovallpayy['id']);
			mysql_query("UPDATE wp_term_relationships SET term_taxonomy_id=10 WHERE object_id =".$crovallpayy['order_id']);
	}
	
	}else{
		$prostkend  = mysql_fetch_array(mysql_query("SELECT meta_value FROM wp_postmeta WHERE meta_key='_campain_valid_to' AND post_id=".$pronarg));
		if($prostkend['meta_value']<time()){
			echo $prostkend['meta_value'].'==='.time().'<br />';
			mail($buyeremail['user_email'],'dfsd','sdfd');
			mail('nabanita.c@candeotech.net','loss','sdfd');
		}
		echo $crovallpayy['id'].' not done<br />';
	}
}
?>