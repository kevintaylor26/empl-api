<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\StripeClient;

class PaymentsController extends CustomBaseController
{
    //
    public function payout()
    {
        Stripe::setApiKey(config('app.STRIPE_SECRET'));
        $user = $this->getUser();

        $stripe = new StripeClient(config('app.STRIPE_SECRET'));
        $order = $this->Stripe_getUrl();

        return redirect($stripe->checkout->sessions->retrieve($order->id, [])->url);
    }

    function Stripe_getUrl()
    {
        $client = new StripeClient(config('app.STRIPE_SECRET'));
        // Create array with all the products
        $items = [[
            'price_data' => [
                'currency' => 'USD',
                'product_data' => [
                    'name' => 'Access All Marketing Data',
                    'description' => 'AAAAAAAAAAA',
                ],
                'unit_amount' => 200 * 100,
            ],
            'quantity' => 1,
        ]];
        try{
            $order = $client->checkout->sessions->create([
                'line_items' => $items,
                'mode' => 'payment',
                'payment_intent_data' => [
                    'description' => 'This is test stripe mode'
                ],
                'success_url' => route('payments.paySuccess'),
                'cancel_url' => route('home'),
                'customer_email' => auth()->user()->email,
                'metadata' => [
                    'user_id' => auth()->user()->id,
                    'order_id' => strtoupper('D' . uniqid() . rand(1000, 9999)),
                ],
            ]);
            return $order;
        }catch(Exception $e){
            return redirect('home');
        }

    }

    function payment_hook($request)
    {
        $payload = $request->getContent();
        $sig_header = $request->header('stripe-signature');
        $endpoint_secret = config('app.STRIPE_KEY');
        $event = null;

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload,
                $sig_header,
                $endpoint_secret
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            http_response_code(400);
            exit;
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            http_response_code(400);
            exit;
        }
        if ($event->type == 'checkout.session.completed') {
            logger(json_encode($event->data));
            $order = $event->data->object;
            $order_id = $order->metadata->order_id;
            $user_id = $order->metadata->user_id;
            if($user_id) {
                $user = User::where('id', $user_id)->first();
                if($user) {
                    $user->is_paid = 1;
                    $user->last_paid_at = now();
                    $user->save();
                }
            }
        }
    }

    function paySuccess()
    {
        $user = $this->getUser();
        if($user) {
            $user->is_paid = 1;
            $user->last_paid_at = now();
            $user->save();
        }
        return redirect('/home');
    }

}
