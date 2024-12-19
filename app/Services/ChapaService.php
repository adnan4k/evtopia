<?php


namespace App\Services;
use Chapa\Chapa\Facades\Chapa as Chapa;
class ChapaService
{
    public  $gateway ;
    private $successUrl ;
    private $cancelUrl ;
    private $provider ;
    private $currency ;
    protected $reference ;
    public $label;
    public $description;
    protected $secretKey;
    protected $baseUrl;
    public function __construct()
    {
        $this->reference = Chapa::generateReference();
        $this->baseUrl = 'https://api.chapa.co/v1';
    }

    public function initializePayment($total, $request,$payment,$paymentGateway)
    {
        
        try{
        $reference = $this->reference;
        $data = [
            
            'amount' => $total,
            'email' => $request->email,
            'phone_number'=>'+251'.$request->phone,
            'tx_ref' => $reference,
            'currency' => "ETB",
            'callback_url' => route('payment.chapa_callback',[$reference]),
            'return_url' =>route('chapa_payment.success',$reference). '?payment_id='.$payment->id,
            'first_name' => $request->name,
            'last_name' => '',
            "customization" => [
                "title" => 'Evtopia',
                "description" => "I amma testing this"
            ]
        ];

        \Log::info($data);
        \Log::info($reference);

        $payment = Chapa::initializePayment($data);
 
        if ($payment['status'] != 'success') {
            return [
                'success' => false,
                'message'=>$payment['message']
            ];
        }

        else{
            return ['payment'=>$payment,'reference'=>$reference];
        }
        
        } catch (\Exception $ex) {
            return $data['message'] = $ex->getMessage();
        }
    }

    public function chapaCallback($reference)
    {
        
        $data = Chapa::verifyTransaction($reference);
 
        //if payment is successful
        if ($data['status'] ==  'success') {
         return $data;
        }
 
        else{
            //oopsie something ain't right.
            return $data;
        }
 
 
    }

 
}
