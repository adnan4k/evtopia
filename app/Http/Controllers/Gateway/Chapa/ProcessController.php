<?php

namespace App\Http\Controllers\Gateway\Stripe;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Chapa\Chapa\Facades\Chapa;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class ProcessController extends Controller
{
    /**
     * Process to stripe
     *
     * @return string
     */

    public static function process($paymentGateway, Payment $payment)
    {
        $config = json_decode($paymentGateway->config);

        Stripe::setApiKey($config->secret_key);

       
        $reference = Chapa::generateReference();
        
 
        // Enter the details of the payment
        $data = [
            
            'amount' => 100,
            'email' => 'hi@negade.com',
            'tx_ref' => $reference,
            'currency' => "ETB",
            'callback_url' => route('callback',[$reference]),
            'first_name' => "Israel",
            'last_name' => "Goytom",
            "customization" => [
                "title" => 'Chapa Laravel Test',
                "description" => "I amma testing this"
            ]
        ];
        
 
        $payment = Chapa::initializePayment($data);


        if ($payment['status'] !== 'success') {
            // notify something went wrong
            return;
        }
 
        return redirect($payment['data']['checkout_url']);
    }
}
