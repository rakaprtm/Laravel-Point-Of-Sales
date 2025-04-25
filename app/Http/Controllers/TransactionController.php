<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use Carbon\Carbon;
use App\Models\Orders;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;


class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $title = "Orders";
    $datas = Orders::query();

    if ($request->has('filter') && $request->filter !== null) {
        $date = $request->date ? Carbon::parse($request->date) : Carbon::today();

        switch ($request->filter) {
            case 'daily':
                $datas->whereDate('order_date', $date);
                break;
            case 'weekly':
                $startOfWeek = $date->copy()->startOfWeek();
                $endOfWeek = $date->copy()->endOfWeek();
                $datas->whereBetween('order_date', [$startOfWeek, $endOfWeek]);
                break;
            case 'monthly':
                $datas->whereMonth('order_date', $date->month)
                      ->whereYear('order_date', $date->year);
                break;
        }
    }

    $datas = $datas->orderBy('id', 'desc')->get();

    return view('pos.index', compact('title', 'datas'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::orderBy('id', 'desc')->get();
        return view('pos.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
//    public function store(Request $request)
// {
//     // Generate kode order otomatis
//     $qOrderCode = Orders::max('id');
//     $qOrderCode++;
//     $orderCode = "ORD" . date("dmy") . sprintf("%03d", $qOrderCode);

//     // Simpan data order
//     $orderData = [
//         'order_code' => $orderCode,
//         'order_date' => date("Y-m-d"),
//         'order_amount' => $request->grandtotal,
//         'order_change' => 1,
//         'order_status' => 1,
//     ];

//     $order = Orders::create($orderData);

//     // Simpan detail order (beberapa produk sekaligus)
//     foreach ($request->qty as $key => $value) {
//         OrderDetails::create([
//             'order_id' => $order->id,
//             'product_id' => $request->product_id[$key],
//             'qty' => $request->qty[$key],
//             'order_price' => $request->order_price[$key],
//             'order_subtotal' => $request->order_subtotal[$key],
//         ]);
//     }

//     // Redirect kembali ke halaman order dengan pesan sukses
//     return redirect()->route('pos.index')->with('success', 'Transaction saved successfully');

// }
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
        return redirect('/pos-sale');
    }

    private function generateOrderCode($orderId)
    {
        $prefix = 'POS';
        $date = now()->format('Ymd');

        return "{$prefix}-{$date}-" . str_pad($orderId, 6, '0', STR_PAD_LEFT);
    }


    public function show(string $id)
    {
        $order = Orders::findOrFail($id);
        $orderDetails = orderDetails::with('product')->where('order_id', $id)->get();
        $title = "Order Details Of " . $order->order_code;
        return view('pos.show', compact('order', 'orderDetails', 'title'));
    }

   public function edit($id)
    {
        $edit = Products::find($id);
        $categories = Categories::orderBy('id', 'desc')->get();
        return view('products.edit', compact('edit', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $product = Products::find($id);

    $product->category_id = $request->category_id;
    $product->product_name = $request->product_name;
    $product->product_price = $request->product_price;
    $product->product_description = $request->product_description;
    $product->is_active = $request->is_active;


    if ($request->hasFile('product_photo')) {
        if ($product->product_photo) {
            File::delete(public_path('storage/' . $product->product_photo));
        }

        $photo = $request->file('product_photo')->store('products', 'public');
        $product->product_photo = $photo;
    }

    $product->save();
    Alert::image('Product Updated!','Product update was successful!',
    asset('storage/products/download.jpg'),'500px','250px','Product Success Image');


    return redirect()->route('products.index');

    }

    public function destroy(string $id)
    {
        $product = Products::find($id);
        File::delete(public_path('storage/' . $product->product_photo));
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }

    public function getProduct($category_id)
    {
        $products = Products::where('category_id', $category_id)->get();
        $response = ['status' => 'success', 'message' => 'Fetch Product Success', 'data' => $products];
        return response()->json($response, 200);
    }

    public function print($id)
    {
    $order = Orders::findOrFail($id);
    $orderDetails = OrderDetails::with('product')->where('order_id', $id)->get();
    return view('pos.print-srtuk', compact('order', 'orderDetails'));
    }



}
