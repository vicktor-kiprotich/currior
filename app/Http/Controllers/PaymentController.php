<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helpers\TransactionHelper;

use App\Payment;
use App\Events\ApproveMission;
use App\Events\CreateMission;
use App\Http\Helpers\MissionStatusManagerHelper;
use App\Shipment;
use App\ShipmentSetting;
use App\BusinessSetting;
use App\Mission;
use App\Events\ShipmentAction;
use App\Events\AssignMission;
use App\Http\Helpers\StatusManagerHelper;
use App\Transaction;
use App\Http\Helpers\SmsHelper;
use Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Events\MissionAction;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{

    public function darajaCallback(Request $request, $code)
    {


        $ch = curl_init('https://webhook.site/bd061572-a3b0-425b-b1de-e413d24de6ea');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);
        return 'djd';
        $payment = Payment::where('txn_code', 'like', $code);
        $content = json_decode($request->getContent());

        if ($content->Body->stkCallback->ResultCode == 0) {
            $payment->update(['status' => 1]);
        }

        return true;
    }

    protected function notifyClient($data)
    {

        $shipment = Shipment::query()->where('mission_id', $data['id'])->first();
        $clientName = is_object($shipment->client) ? $shipment->client->name : $shipment->client_id;

        $message = "Dear {$clientName},
            
Your shipment with tracking ID {$shipment->code} has arrived successfully! 

Thank you,
EXPRESSLINE
Hotline 0729220777";

        SmsHelper::send($shipment->client_phone, $message);

        return $message;
    }


    public function confirmPayment(Request $request, $code)
    {

        $shipment = Shipment::query()->where('code', 'like', $code)->first();
        $payment = Payment::query()->where('shipment_id', $shipment->id)->first();

        if ($payment->status > 0) {
            $transactionIsPresent =  Transaction::where('shipment_id', $shipment->id)->first();
            if (!$transactionIsPresent) {
                Transaction::query()->create([
                    'value' => $payment->amount,
                    'transaction_owner' => $shipment->client_id,
                    'captain' => $shipment->mission_id,
                    'client_id' => $shipment->client_id,
                    'mission_id' => $shipment->mission_id,
                    'shipment_id' => $shipment->id,
                    'branch_id' => $shipment->branch_id
                ]);

                flash('payment complete')->success();
            }

            if (!$shipment->mission_id) {
                return $this->bypassPages($shipment);
            } else {
                if ($shipment->payment_type === Shipment::POSTPAID) {
                    $this->completePostpaidMission($request, Mission::DONE_STATUS);
                    flash('Mission complete.')->success();
                    return redirect()->route('admin.missions.recived.index', ['status' => '5']);
                }

                return redirect()->route('admin.missions.recived.index', ['status' => '5']);
            }
        } else {
            flash('Transaction not found.')->error();
            return view('backend.payments.view', compact('payment', 'shipment'));
        }
    }

    private function bypassPages($shipment)
    {

        $bypassCreatePickupMissionRequestData = [
            'checked_ids' =>  [
                0 => $shipment->id
            ],
            'Mission' => [
                'to_branch_id' => $shipment->branch_id,
                'address' => $shipment->reciver_address,
            ]
        ];


        $mission = $this->createPickupMission($bypassCreatePickupMissionRequestData, 2, $shipment);


        return redirect()->route('admin.missions.recived.index', ['status' => '5']);
    }

    private function approveAndAssignMission($request, $to)
    {
        try {
            DB::beginTransaction();
            $params = array();
            $params['due_data'] = $request['Mission']['due_date'];
            $action = new MissionStatusManagerHelper();

            $response = $action->change_mission_status($request['checked_ids'], $to, $request['Mission']['captain_id'], $params);



            event(new AssignMission($request['Mission']['captain_id'], $request['checked_ids']));
            event(new ApproveMission($request['checked_ids']));
            DB::commit();



            return back();
        } catch (\Exception $e) {
            DB::rollback();
            print_r($e->getMessage());
            exit;

            flash(translate('Error'))->error();
            return back();
        }
    }

    private function createPickupMission($request, $type, $shipment)
    {

        try {

            $auth_user = Auth::user();
            $userCaptain = \App\UserCaptain::where('user_id', $auth_user->id)->first();

            $model = Mission::create([
                'status_id' => Mission::RECIVED_STATUS,
                'captain_id' =>  $userCaptain->captain_id,
                'type' => Mission::PICKUP_TYPE,
                'to_branch_id' => $request['Mission']['to_branch_id'],
                'address' => $request['Mission']['address'],
                'amount' => (int) $shipment->insurance + (int)$shipment->shipping_cost + (int)$shipment->tax,
            ]);

            $code = '';
            for (
                $n = 0;
                $n < ShipmentSetting::getVal('mission_code_count');
                $n++
            ) {
                $code .= '0';
            }
            $code   =   substr($code, 0, -strlen($model->id));

            $model->update(['code' => ShipmentSetting::getVal('mission_prefix') . $code . $model->id,]);


            \App\ShipmentMission::create([
                'mission_id' => $model->id,
                'shipment_id' => $shipment->id,
            ]);
            $shipment = Shipment::where('id', $shipment->id)->update([
                'mission_id' => $model->id
            ]);

            event(new CreateMission($model));
            DB::commit();

            flash(translate('Mission created successfully'))->success();

            return $model;
        } catch (\Exception $e) {
            DB::rollback();
            print_r($e->getMessage());
            exit;

            flash(translate('Error'))->error();
            return back();
        }
    }

    public function checkout($id)
    {

        $payment = Payment::query()->where('shipment_id', $id)->firstOrFail();
        $shipment = Shipment::query()->where('id', $id)->firstOrFail();
        $mpesaPayment = \App\BusinessSetting::where("key", "payment_gateway")->where("name", 'like', "%pesa%")->first();

        if ($payment->status == Payment::COMPLETED) {
            return view('backend.payments.view', compact('payment', 'shipment'));
        } else if ($shipment->payment_type == Shipment::PREPAID && $mpesaPayment->id == $shipment->payment_method_id) {
            $mpesa = new \App\Http\Helpers\MpesaHelper();
            $mpesa->stkPush($shipment->client_phone, $payment->amount, $shipment->code, $payment->txn_code);
            return view('backend.payments.view', compact('payment', 'shipment'));
        } else {
            if (!$shipment->mission_id) {
                return $this->bypassPages($shipment);
            } else {
                return redirect()->route('admin.missions.recived.index', ['status' => '5']);
            }
        }

        if (!$shipment) {
            abort(404);
        }
    }

    public function checkoutPostpaid($id)
    {
        $payment = Payment::query()->where('shipment_id', $id)->firstOrFail();
        $shipment = Shipment::query()->where('id', $id)->firstOrFail();
        $mission =  Mission::where('id', $shipment->mission_id)->first();

        if ($payment->status == Payment::PENDING) {
            $mpesa = new \App\Http\Helpers\MpesaHelper();
            $mpesa->stkPush($shipment->reciver_phone, $payment->amount, $shipment->code, $payment->txn_code);
            return view('backend.payments.view-postpaid', compact('payment', 'shipment', 'mission'));
        }
    }

    private function completePostpaidMission(Request $request, $to, $fromApi = false)
    {
        $mission = Mission::where('id', $request->checked_ids[0])->first();

        $shipment = Shipment::where('mission_id', $mission->id)->first();

        $params = array();

        $this->notifyClient($mission);
        if (isset($request->amount) && (in_array(Auth::user()->user_type, ['admin', 'branch']) || in_array('1210', json_decode(Auth::user()->staff->role->permissions ?? '[]')))) {
            $params['amount'] = $request->amount;
        }

        if (isset($request->signaturePadImg)) {
            if ($request->signaturePadImg == null || $request->signaturePadImg == ' ') {
                if ($fromApi)
                    return 'Please Confirm The Signature';
                flash(translate('Please Confirm The Signature'))->error();
                return back();
            }
            $params['seg_img'] = $request->signaturePadImg;
        }
        if (isset($request->otp)) {
            if ($request->otp_confirm == null || $request->otp_confirm == ' ') {
                if ($fromApi)
                    return 'Please enter OTP of mission';
                flash(translate('Please enter OTP of mission'))->error();
                return back();
            } elseif ($mission->otp != $request->otp_confirm) {
                if ($fromApi)
                    return 'Please enter correct OTP';
                flash(translate('Please enter correct OTP'))->error();
                return back();
            }
            $params['otp'] = $request->otp;
        }

        if (in_array($mission->type, [Mission::getType(Mission::PICKUP_TYPE), Mission::getType(Mission::DELIVERY_TYPE)])) {
            $cash = BusinessSetting::where('type', 'cash_payment')->get()->first();
            $payment_method_id = $cash->id;
            if ($mission->type == Mission::getType(Mission::PICKUP_TYPE)) {
                $payment_type = Shipment::PREPAID;
                $mission = Mission::where('id', $request->checked_ids[0])->where('type', Mission::PICKUP_TYPE)
                    ->with('shipment_mission')->get()->first();
                $shipment_ids = $mission->shipment_mission->pluck('shipment_id');
            } elseif ($mission->type == Mission::getType(Mission::DELIVERY_TYPE)) {
                $payment_type = Shipment::POSTPAID;
                $mission = Mission::where('id', $request->checked_ids[0])->where('type', Mission::DELIVERY_TYPE)
                    ->with('shipment_mission')->get()->first();
                $shipment_ids = $mission->shipment_mission->pluck('shipment_id');
            }
            $shipments = Shipment::whereIn('id', $shipment_ids)->where('payment_method_id', $payment_method_id)->where('payment_type', $payment_type)->get();
            foreach ($shipments as $shipment) {
                $payment = new Payment();
                $payment->shipment_id = $shipment->id;
                $payment->seller_id = $shipment->client_id;
                $payment->amount = $shipment->tax + $shipment->shipping_cost + $shipment->insurance;
                $payment->payment_method = $shipment->pay->type;
                $payment->payment_date = Carbon::now()->toDateTimeString();;
                $payment->save();

                $shipment->paid = 1;
                $shipment->save();
            }
        }


        if ($to == Mission::RECIVED_STATUS) {
            $params['amount'] = $request->amount;
        }

        $action = new MissionStatusManagerHelper();
        $response = $action->change_mission_status($request->checked_ids, $to, null, $params);

        if ($response['success']) {
            event(new MissionAction($to, $request->checked_ids));
            if ($fromApi)
                return 'success';
            // flash(translate('Status Changed Successfully!'))->success();
            return true;
        }
        if ($response['error_msg']) {
            if ($fromApi)
                return 'Somthing Wrong!';
            flash(translate('Somthing Wrong!'))->error();
            return true;
        }
    }
}
