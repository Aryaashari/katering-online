<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Midtrans\Snap;
use Ramsey\Uuid\Uuid;

class PembayaranController extends Controller
{

    private function createToken(Pesanan $pesanan): string {

        try {
            DB::beginTransaction();
            $id = Uuid::uuid4()->toString();
            
            $params = [
                "transaction_details" => [
                    "order_id" => $id,
                    "gross_amount" => $pesanan->total_harga
                ],
                "customer_details" => [
                    "first_name" => $pesanan->pengguna->name,
                    "email" => $pesanan->pengguna->email,
                    "phone" => $pesanan->pengguna->telp
                ],
                "callbacks" => [
                    "finish" => url("/pesan/detail/{$pesanan->id}"),
                ]
            ];

            // Get Snap Payment Page URL
            $snapToken = Snap::getSnapToken($params);

            Pembayaran::create([
                'id' => $id,
                'pesanan_id' => $pesanan->id,
                'token' => $snapToken,
                'gross_amount' => $pesanan->total_harga,
                'status' => 'new'
            ]);

            DB::commit();
            return $snapToken;
        } catch(\Exception $e) {
            DB::rollBack();
            throw $e;
        }

    }
    
    public function bayar(Request $request) {

        $pesanan = Pesanan::with('pengguna')->find($request->pesanan_id);
        /* 
            {
                "message":"",
                "data":[]
            }
        */

        if ($pesanan == null) {
            return response()->json([
                "data" => null
            ], 404);
        } 

        $pembayaran = Pembayaran::select('token')->where("pesanan_id", $request->pesanan_id)->first();

        if ($pembayaran != null) {
            return response()->json([
                "data" => ["token" => $pembayaran->token]
            ]);
        }

        $token = $this->createToken($pesanan);

        return response()->json([
            "data" => ["token" => $token]
        ]);


    }


    public function handleNotification(Request $request)
    {

        $orderId = $request->order_id;
        $statusCode = $request->status_code;
        $grossAmount = $request->gross_amount;
        $signatureKey = $request->signature_key;
        $signature = hash('sha512', $orderId.$statusCode.$grossAmount.env("MIDTRANS_SERVER_KEY"));

        if ($signature != $signatureKey) {
            return response()->json([
                "message" => "invalid signature"
            ], 401);
        }

        
        $pembayaran = Pembayaran::with('pesanan')->find($orderId);

        if (!$pembayaran) {
            return response()->json([
                "message" => "invalid order"
            ], 400);
        }
        
        $pembayaran->status = $request->transaction_status;
        $pembayaran->save();

        if ($request->transaction_status == 'settlement') {
            $pembayaran->pesanan->status_order = 'PAID';
            $pembayaran->pesanan->save();
        } else if ($request->transaction_status == 'pending') {
            $pembayaran->pesanan->status_order = 'PENDING';
            $pembayaran->pesanan->save();
        } else {
            $pembayaran->pesanan->status_order = 'FAILED';
            $pembayaran->pesanan->save();
        }

        // if ($request->transaction_status == 'settlement') {
        //     Mail::to($transaction->order->user->email)->send(new OrderConfirmationMail($transaction->order->user->nama));
        //     Mail::to('carikoskutelyu@gmail.com')->send(new AdminOrderConfirmationMail($transaction->id));

        // }

        return response()->json(["message" => "success"], 200);
    }

}
