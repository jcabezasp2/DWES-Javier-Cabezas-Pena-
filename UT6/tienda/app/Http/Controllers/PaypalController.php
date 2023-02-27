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
       $invoice = Invoice::create([
            'user_id' => auth()->user()->id,
            'price' => \Cart::getTotal(),
            'paid' => false,
        ]);


        $data = [];

        //Añadimos los productos al carrito
        foreach (\Cart::getContent() as $item) {
            $data['items'][] = [
                'name' => $item->name,
                'price' => $item->price,
                'desc' => $item->description,
                'qty' => $item->quantity
            ];
        }

        $data['invoice_id'] = strval($invoice->id);
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

            $data['invoice_id'] = $response['INVNUM'];
            $data['invoice_description'] = "Compra de productos en la tienda";
            $data['return_url'] = route('payment.success'); //si se hace bien el pago
            $data['cancel_url'] = route('payment.cancel'); // si se cancela el pago
            $data['total'] = \Cart::getTotal();

            $payment_status = $paypalModule->doExpressCheckoutPayment($data, $response['TOKEN'], $response['PAYERID']);
            $invoice = Invoice::find($response['INVNUM']);
            $invoice->paid = true;
            $invoice->save();
            \cart::clear();
            return redirect()->route('cart.list')->with('success', 'Pago realizado correctamente');
        }

        dd('Error occured!');

    }
}
