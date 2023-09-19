<?php

declare(strict_types=1);

namespace App\Traits;

use App\Support\Cmi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

trait CmiGateway
{
    public function requestPayment(Cmi $cmiClient, array $params = [])
    {
        try {
            $cmiClient->guardAgainstInvalidRequest();
            $payData = $cmiClient->getCmiData($params);
            $hash = $cmiClient->getHash($params);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return redirect($cmiClient->getShopUrl())->withErrors(['payment' => __('Une erreur est survenue au niveau de la requête, veuillez réessayer ultérieurement.')]);
        }

        return view('request-payment', ['cmiClient' => $cmiClient, 'payData' => $payData, 'hash' => $hash]);
    }

    public function callback(Request $request)
    {
        $postData = $request->all();

        if ($postData !== []) {
            $cmiClient = new Cmi();

            if ($cmiClient->validateHash($postData, $postData['HASH']) && $_POST['ProcReturnCode'] == '00') {
                $response = 'ACTION=POSTAUTH';
            } else {
                $response = 'FAILURE';
            }
        } else {
            $response = 'No Data POST';
        }

        return view('callback', ['response' => $response]);
    }
}
