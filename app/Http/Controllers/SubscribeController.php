<?php

namespace App\Http\Controllers;

use App\Models\Subscribe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Carbon;

class SubscribeController extends Controller
{
    public function test() {
        return view("subscribe");
    }

    // Create New Subscribe
    public function createSubscribe(Request $request) {
        $validator = Validator::make($request->post(), [
            'msisdn'       => ['required', 'integer', 'regex:/^[0-9]/'],
            'shortcode'    => ['required', 'string', Rule::in(['1111', '2222', '3333', '4444', '5555'])],
            'keyword'      => ['required', 'string', Rule::in(['AA', 'BB', 'CC', 'DD'])],
            'status'       => ['required', 'string', Rule::in(['active', 'inactive'])],
            'service'      => ['required', 'string'],
            'charge_price' => ['required', 'numeric', 'min:0'],
        ]);

        $data = $validator->validated();

        $subscribe = Subscribe::create([
            'msisdn'           => $data['msisdn'],
            'shortcode'        => $data['shortcode'],
            'keyword'          => $data['keyword'],
            'status'           => $data['status'],
            'service'          => $data['service'],
            'charge_price'     => $data['charge_price'],
            'unsubscribe_time' => ($data['status'] == "inactive" ? Carbon::now() : null ),
            'subscribe_time'   => ($data['status'] == "inactive" ? null : Carbon::now()),
        ]);

        return $subscribe;
    }

    // Get Subscribe List
    public function getSubscribes() {
        $subscribe = Subscribe::all();

        return $subscribe;
    }

    // Get Subscribe by ID
    public function getSubscribeById($id) {
        $subscribe = Subscribe::where('id', $id)->first();

        return $subscribe;
    }

    // Update Subscribe
    public function updateSubscribe(Request $request, $id) {

        $validator = Validator::make($request->post(), [
            'status'       => ['required', 'string', Rule::in(['active', 'inactive'])],
            'service'      => ['required', 'string'],
            'charge_price' => ['required', 'numeric', 'min:0'],
        ]);

        $data = $validator->validated();

        $subscribe = Subscribe::where('id', $id)->first();
        $subscribe->update([
            'status'       => $data['status'],
            'service'      => $data['service'],
            'charge_price' => $data['charge_price'],
        ]);

        if ($data['status'] == "inactive") {
            $subscribe->update(['unsubscribe_time' => Carbon::now()]);
        }
        else {
            $subscribe->update(['subscribe_time' => Carbon::now()]);
        }


        return $subscribe;
    }

    // Mass Update Subscribe
    public function updateMassSubscribe(Request $request) {

        for($i = 0; $i < count($request->post()); $i++) {
            $validator = Validator::make($request->post()[$i], [
                'status'       => ['required', 'string', Rule::in(['active', 'inactive'])],
                'service'      => ['required', 'string'],
                'charge_price' => ['required', 'numeric', 'min:0'],
            ]);

            $data = $validator->validated();
            $id = $request->post()[$i]['id'];

            $subscribe = Subscribe::where('id', $id)->first();
            $subscribe->update([
                'status'       => $data['status'],
                'service'      => $data['service'],
                'charge_price' => $data['charge_price'],
            ]);

            if ($data['status'] == "inactive") {
                $subscribe->update(['unsubscribe_time' => Carbon::now()]);
            }
            else {
                $subscribe->update(['subscribe_time' => Carbon::now()]);
            }
        }
        return;
    }
}
