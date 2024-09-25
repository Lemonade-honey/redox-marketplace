<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function callbackPayment(Request $request, \App\Services\Interfaces\PaymentService $paymentService)
    {
        $datas = $paymentService->mappingValidateCallback($request);

        if (is_bool($datas)) {
            return abort(422, "data is not valid");
        }

        $payment = \App\Models\Payment::with("order")->where([
            "link_id" => $datas['bill_link_id'],
            "status" => "NOT_CONFIRMED"
        ])->first();

        if ($payment) {
            $payment->status = $datas['status'];
            if ($datas['status'] == "SUCCESSFUL") {
                $payment->order->status = "PROCESS";
                $payment->order->save();
            }
            $payment->save();

            logInfo("payment order " . $payment->order->id . " set to " . $datas['status']);
        }

        return abort(404, "data not found");
    }
}
