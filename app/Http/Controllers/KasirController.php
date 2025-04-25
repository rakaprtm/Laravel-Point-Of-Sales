<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Orders;
use App\Models\OrderDetails;
use RealRashid\SweetAlert\Facades\Alert;

class KasirController extends Controller
{
    public function index()
    {
        $data['Products'] = Products::orderBy('id', 'desc')->get()->map(function($res) {
            return [
                "id" => $res->id,
                "name" => $res->product_name,
                "price" => (int)$res->product_price,
                "image" => asset('storage/' . $res->product_photo),
                "option" => null,
            ];
        });

    return view('kasir.index', $data);
    }

    public function store(Request $request)
    {
        // return $request->all();
        $request->validate([
            'cart' => 'required',
            'cash' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'change' => 'required|numeric|min:0',
        ]);

        $data = json_decode($request->cart, true);


        $latestIdOrder = Orders::max('id') + 1;
        $order = Orders::create([
            'order_code' => $this->generateOrderCode($latestIdOrder),
            'order_date' => now(),
            'order_amount' => $request->total,
            'order_change' =>  $request->change,
            'order_status' =>  1,
            'customer_name' => "John Doe",
        ]);

        foreach ($data as $item) {
            OrderDetails::create([
                'order_id' => $order->id,
                'product_id' => $item['productId'],
                'qty' => $item['qty'],
                'order_price' => $item['price'],
                'order_subtotal' => $item['qty'] * $item['price'],
            ]);
        }
        // return $request;

        Alert::success('Success', 'Transaction successfully');
        return redirect('/kasir');
    }

    private function generateOrderCode($orderId)
    {
        $prefix = 'POS';
        $date = now()->format('Ymd');

        return "{$prefix}-{$date}-" . str_pad($orderId, 6, '0', STR_PAD_LEFT);
    }
}
