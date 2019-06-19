<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
use URL;
use Session;
use Redirect;
use Illuminate\Support\Facades\Input;
use App\Book;

/** All Paypal Details class **/
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

class PaymentController extends Controller
{
    private $_api_context;

    //
    public function __construct()
    {
        /** setup PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    // public function paypalForm(Request $request)
    // {
    //     $pay = [$request->paylist['id_car'], $request->paylist['price']];
    //     //dd($pay);
    //     return view('paypal', ['pay' => $pay]);
    // }

    public function paypalPay(Request $request)
    {
        \Session::put('id_car',$request->booking);
        //dd($request);
        //$price = $request->price/35;
        //dd(round($request->price/35,2));
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item_1 = new Item();
        
        //$item_1->setName($request->id_car)
        $item_1->setName($request->name)
        /** item name **/
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setTax((round($request->price/35,2)*4)/100)
            ->setPrice(round($request->price/35,2));
        /** unit price **/
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal(round($request->price/35,2));
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('For rent');
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(action('PaymentController@getpaypalStatus'))
        /** Specify return URL **/
            ->setCancelUrl(action('PaymentController@getpaypalStatus'));
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
            //dd($payment);
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::flash('error', 'Connection timeout');
                // $result = app('App\Http\Controllers\BookController')->deleteBook($request);
                // if ($result == true) {
                //     return redirect()->action('CarController@carshowform');
                // }
                return redirect()->action('BookController@checkcart',['id',$request->booking]);
                // return Redirect::route('addmoney.paywithpaypal');
                /** echo "Exception: " . $ex->getMessage() . PHP_EOL; **/
                /** $err_data = json_decode($ex->getData(), true); **/
                /** exit; **/
            } else {
                \Session::flash('error', 'Some error occur, sorry for inconvenient');
                // $result = app('App\Http\Controllers\BookController')->deleteBook($request);
                // if ($result == true) {
                //     return redirect()->action('CarController@carshowform');
                // }
                return redirect()->action('BookController@checkcart',['id',$request->booking]);
               // return redirect()->action('CarController@carshowform');
                //return Redirect::route('addmoney.paywithpaypal');
                /** die('Some error occur, sorry for inconvenient'); **/
            }

        }
        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());
        Session::put('booking', $request->booking);
        if (isset($redirect_url)) {
            /** redirect to paypal **/
            return Redirect::away($redirect_url);
        }
        \Session::flash('error', 'Unknown error occurred');
        // $result = app('App\Http\Controllers\BookController')->deleteBook($request);
        // if ($result == true) {
        //     return redirect()->action('CarController@carshowform');
        // }
        // return redirect()->action('CarController@carshowform');
        return redirect()->action('BookController@checkcart',['id',$request->booking]);
    }

    public function getpaypalStatus(Request $request)
    {
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');
        $booking = Session::get('booking');
        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            \Session::flash('error', 'Payment failed');
            //$result = app('App\Http\Controllers\BookController')->deleteBook($request);
            return redirect()->action('BookController@checkcart',[\Session::get('id_car')]);
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
        if ($result->getState() == 'approved') {
            $price = $result->transactions[0]->amount->total;
            return redirect()->action('BookController@updateBook',['booking'=>$booking,'payment_id'=>$payment_id,'bank'=>'paypal','price'=>$price]);
        }
        \Session::flash('error', 'Payment failed');
        //$result = app('App\Http\Controllers\BookController')->deleteBook($request);
        // if ($result == true) {
        //     return redirect()->action('BookController@checkcart',['id',\Session::get('id_car')]);
        // }
        return redirect()->action('BookController@checkcart',[\Session::get('id_car')]);
    }

    public function howtopayment()
    {
        return view('howtoPayment');
    }
        //--------------- check code book ------------------
        public function checkCodeBook(Request $request)
        {
            //dd($request);
            $code = trim($request->code);
            $user = Book::where('code','=',$code)->where('status','=',0)->get();
            return  $user;
        }

}
