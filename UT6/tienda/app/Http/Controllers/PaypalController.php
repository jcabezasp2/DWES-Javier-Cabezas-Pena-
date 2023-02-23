<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Invoice;

//Añadimos la dependencia
use Srmklive\PayPal\Services\ExpressCheckout;

class PaypalController extends Controller
{

    //Esta función nos llevará a la página de paypal, donde el usuario terminará o cancelará el pago
    public function payment()
    {
        $data = [];
        $sql = "INSERT INTO invoices (user_id, total, status) VALUES (1, 100, 'pending')";
        $data['items'] = \Cart::getContent();

        $data['invoice_id'] = 5;
        $data['invoice_description'] = "Compra de productos en la tienda";
        $data['return_url'] = route('payment.success'); //si se hace bien el pago
        $data['cancel_url'] = route('payment.cancel'); // si se cancela el pago
        $data['total'] = \Cart::getTotal();

        $provider = new ExpressCheckout;
        $response = $provider->setExpressCheckout($data);
        $response = $provider->setExpressCheckout($data, true);


        return redirect($response['paypal_link']);

    }

    public function cancelPayment()
    {
        return redirect()->route('cart.list')->with('success', 'Pago Cancelado');
    }


    public function successPayment(Request $request)
    {
        $paypalModule = new ExpressCheckout;
        $response = $paypalModule->getExpressCheckoutDetails($request->token);

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {

            $data = [];
            $data['items'] = \Cart::getContent();

            $data['invoice_id'] = 5;
            $data['invoice_description'] = "Compra de productos en la tienda";
            $data['return_url'] = route('payment.success'); //si se hace bien el pago
            $data['cancel_url'] = route('payment.cancel'); // si se cancela el pago
            $data['total'] = \Cart::getTotal();

            $payment_status = $paypalModule->doExpressCheckoutPayment($data, $response['TOKEN'], $response['PAYERID']);
            return redirect()->route('cart.list')->with('success', 'Pago reailzado correctamente');
        }

        dd('Error occured!');

    }
}
