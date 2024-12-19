<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentGatewayRequest;
use App\Models\PaymentGateway;
use App\Repositories\PaymentGatewayRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class PaymentGatewayController extends Controller
{
    /**
     * Show payment gateway
     */
    public function index()
    {
        $paymentGateways = PaymentGatewayRepository::getAll()->whereNull('deleted_at');

        return view('admin.payment-gateway.index', compact('paymentGateways'));
    }

    /**
     * Update payment gateway
     */

    public function update(PaymentGatewayRequest $request, PaymentGateway $paymentGateway)
    {
        try {
            PaymentGatewayRepository::updateByRequest($request, $paymentGateway);

    
            // Extract request data
            $inputs = $request->all();
    
            $title = $inputs['title'] ?? null;
    
            if ($title === 'Chapa') {
                $config = $inputs['config'] ?? [];
                $chapaKeys = [
                    'secret_key' => 'CHAPA_SECRET_KEY',
                    'public_key' => 'CHAPA_PUBLIC_KEY',
                    'webhook_secret' => 'CHAPA_WEBHOOK_SECRET',
                ];
    
                foreach ($chapaKeys as $key => $envKey) {
                    if (isset($config[$key])) {
                        $this->setChapaEnvironmentValue($envKey, $config[$key]);
                    } else {
                        Log::warning("Missing config key: {$key}");
                    }
                }
            }
    
            return back()->withSuccess(__('Payment Gateway Updated Successfully'));
        } catch (\Exception $e) {
            Log::error('Error in update method:', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return back()->withErrors(__('An error occurred. Please check logs.'));
        }
    }

    function setChapaEnvironmentValue($key, $value)
{
    $path = base_path('.env');
    $content = file_get_contents($path);

    if (strpos($content, $key) !== false) {
        // Update the existing environment variable
        $content = preg_replace('/^' . preg_quote($key, '/') . '=.*/m', $key . '=' . $value, $content);
    } else {
        // Append the new environment variable
        $content .= PHP_EOL . $key . '=' . $value;
    }

    file_put_contents($path, $content);
}
    
    /**
     * Toggle payment gateway status
     */
    public function toggle(PaymentGateway $paymentGateway)
    {

        $paymentGateway->update([
            'is_active' => ! $paymentGateway->is_active,
        ]);

        return back()->withSuccess(__('Status Updated Successfully'));
    }
}
