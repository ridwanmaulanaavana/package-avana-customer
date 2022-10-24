<?php

namespace Ridwan\Customer\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ridwan\Customer\Models\Customers;
use Ridwan\Customer\Models\OrderDetail;
use Ridwan\Customer\Models\Orders;
use Ridwan\Customer\Models\Payments;

//use Ridwan\Facades\AvanaCustomer as Avana;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index(){
        $customers = Customers::all();
        $transaksi = array();
        return view("customer::customer")
        ->with(compact('customers'))
        ->with(compact('transaksi'));
    }    

    public function CustomerInsert(Request $request){
        Customers::create($request->all());
        return redirect(route('customer'));
    }

    public function GetCustomerById(Request $request){
        $result = array();
        $CekValue = Customers::where(['id'=>$request->id])->count();
        if($CekValue >= 1){
            $customers = Customers::select('id','name','email','phone_number')->where(['id'=>$request->id])->get();
            $result['customers'] = $customers;
            $result['rc'] = "00";
            $result['desc'] = "Customer berdasarkan id".$request->id.' Berhasil diambil';
        }else{
            $result['rc'] = "05";
            $result['desc'] = "Customer ID ditemukan";
        }
        echo json_encode($result);
    }

    public function GetCustomerByField(Request $request){
        $DataCustomers = Customers::Where('name', 'like', '%' .$request->field. '%')
        ->orWhere('email', 'like', '%' .$request->field. '%')
        ->orWhere('phone_number', 'like', '%' .$request->field. '%')->get();

        $result['customers'] =  $DataCustomers;
        $result['rc'] = "00";
        $result['desc'] = "Customer berdasarkan id".$request->id.' Berhasil diambil';
        echo json_encode($result);
    }


    public function CustomersInsertApi(Request $request){
        $result = array();
        $CekValue = Customers::where(['email'=>$request->email])->orWhere(['phone_number'=>$request->phone_number])->count();
        if($CekValue == 0){
            $insertCustomers                    = new Customers();
            $insertCustomers->name              = $request->name;
            $insertCustomers->email             = $request->email;
            $insertCustomers->phone_number      = $request->phone_number;
            $insertCustomers->save();
            $result['rc'] = "00";
            $result['desc'] = "insert customer berhasil";
        }else{
            $result['rc'] = "05";
            $result['desc'] = "Email Sudah terdaftar silahkan diganti";
        }
        echo json_encode($result);
    }

    public function CustomersUpdateApi(Request $request){
        $result = array();
        $CekValue = Customers::where(['id'=>$request->id])->count();
        if($CekValue >= 1){
            Customers::where('id', $request->id)
            ->update(['name' => $request->name,'email'=>$request->email,'phone_number'=>$request->phone_number]);
            $result['rc'] = "00";
            $result['desc'] = "update customer berhasil";
        }else{
            $result['rc'] = "05";
            $result['desc'] = "ID Customer tidak ditemukan";
        }
        echo json_encode($result);
    }

    public function CustomersDeleteApi(Request $request){
        $result = array();
        $CekValue = Customers::where(['id'=>$request->id])->count();
        if($CekValue >= 1){
            $deleted = Customers::where(['id'=>$request->id])->delete();
            $result['rc'] = "00";
            $result['desc'] = "delete customer berhasil";
        }else{
            $result['rc'] = "05";
            $result['desc'] = "delete customer Gagal, ID tidak ditemukan";
        }
        echo json_encode($result);
    }

    public function GetCustomersApi(){
        return $customers = Customers::select('name','email','phone_number')->get();
    }

    public function GetOrdersID(){
        $CekValue = Orders::select('order_id')->count();
        if($CekValue == 0){
           return  $valueOrdersId = $this->cekLengthStringAddZero(1);
        }else{
            $GetValue = Orders::select('order_id')->orderBy('order_id','desc')->first();
            $nilaiFirst = $this->removeZeroInPrefix($GetValue->order_id) + 1;
            $valueOrdersId = $this->cekLengthStringAddZero($nilaiFirst);
        }
        return $valueOrdersId;
    }

    public function cekLengthStringAddZero($num){
        $result = "";
        $lengthAwal = strlen($num);
        $length = 6 - $lengthAwal;
        for($i=1;$i<=$length;$i++){
            $result .="0";
        }
        $result = $result.''.$num;
        return $result;
    }

    public function removeZeroInPrefix($orderNum){
        $var = ltrim($orderNum, '0');
        return $var;
    }

    public function Orders(Request $request){
        $order_id = $request->order_id;
        $CekValue = Orders::where(['order_id'=>$order_id])->count();
        if($CekValue == 0){
            $insertOrders = new Orders();
            $insertOrders->order_id = $order_id;
            $insertOrders->order_date = $request->order_date;
            $insertOrders->customer_id = $request->customer_id;
            $insertOrders->sub_total = $request->sub_total;
            $insertOrders->discount = $request->discount;
            $insertOrders->save();

            $insertOrderDetail = new OrderDetail();
            $insertOrderDetail->order_id    = $order_id;
            $insertOrderDetail->item_id     = $request->item_id;
            $insertOrderDetail->qty         = $request->qty;
            $insertOrderDetail->price       = $request->price;
            $insertOrderDetail->discount    = $request->discount;
            $insertOrderDetail->total       = $request->total;
            $insertOrderDetail->save();

            $insertPayments = new Payments();
            $insertPayments->order_id = $order_id;
            $insertPayments->status = "1";
            $insertPayments->save();

            $result['rc'] = "00";
            $result['desc'] = "Insert Order berhasil";

        }else{
            $result['rc'] = "05";
            $result['desc'] = "Order ID sudah terdaftar didalam DB, silahkan mengganti Order id";
        }
        echo json_encode($result);
    }

    public function ShowOrdersByOrderId(Request $request){
        $order_id = $request->order_id;
        $CekValue = Orders::where(['order_id'=>$order_id])->count();
        if($CekValue >= 1){  

            $dataOrder =Orders::join('order_details', 'orders.order_id', '=', 'order_details.order_id')
            ->where(['orders.order_id'=>$order_id])
            ->get();

            $result['dataOrder']    = $dataOrder;
            $result['rc']           = "00";
            $result['desc']         = "Insert Order berhasil";
        }else{
            $result['rc'] = "05";
            $result['desc'] = "Order ID tidak ditemukan di database";
        }
        echo json_encode($result);
    }


    public function UpdateOrders(Request $request){
        $order_id = $request->order_id;
        $CekValue = Orders::where(['order_id'=>$order_id])->count();
        if($CekValue >= 1){  

            Orders::where('order_id', $order_id)
            ->update(['order_date' => $request->order_date,
            'customer_id'=>$request->customer_id,
            'sub_total'=>$request->sub_total,
            'discount'=>$request->discount]);

            OrderDetail::where('order_id', $order_id)
            ->update(['item_id' => $request->item_id,
            'qty'=>$request->qty,
            'price'=>$request->price,
            'discount'=>$request->discount,
            'total'=>$request->total]);
            $result['rc']           = "00";
            $result['desc']         = "Update Order berhasil";
        }else{
            $result['rc'] = "05";
            $result['desc'] = "Order ID sudah terdaftar didalam DB, silahkan mengganti Order id";
        }
        echo json_encode($result);
    }

    public function deleteOrders(Request $request){
        $order_id = $request->order_id;
        $CekValue = Orders::where(['order_id'=>$order_id])->count();
        if($CekValue >= 1){  
            $deleted = Orders::where(['order_id'=>$order_id])->delete();
            $deleted = OrderDetail::where(['order_id'=>$order_id])->delete();
            $deleted = Payments::where(['order_id'=>$order_id])->delete();
            $result['rc'] = "00";
            $result['desc'] = "Delete Order berhasil";
        }else{
            $result['rc'] = "05";
            $result['desc'] = "Order ID tidak ditemukan di database";
        }
        echo json_encode($result);
    }

    public function Payment(Request $request){
        $order_id = $request->order_id;
        $CekValue = Orders::where(['order_id'=>$order_id])->count();
        if($CekValue >= 1){  
            Payments::where('order_id', $order_id)
            ->update(['amount_paid' => $request->amount_paid,'payment_date'=>$request->payment_date,'status'=>'2']);
            $result['rc'] = "00";
            $result['desc'] = "Update Payemnt berhasil";
        }else{
            $result['rc'] = "05";
            $result['desc'] = "Order ID tidak ditemukan di database";
        }
        echo json_encode($result);
    }

    public function UpdateStatusPayment(Request $request){
        $order_id = $request->order_id;
        $CekValue = Orders::where(['order_id'=>$order_id])->count();
        if($CekValue >= 1){  
            Payments::where('order_id', $order_id)
            ->update(['status'=>$request->status]);
            $result['rc'] = "00";
            $result['desc'] = "Update Status Payemnt berhasil";
        }else{
            $result['rc'] = "05";
            $result['desc'] = "Order ID tidak ditemukan di database";
        }
        echo json_encode($result);
    }

    public function GetAllTransaction(){
        $data = array();
        $dataOrders = Orders::select('order_id','order_date','customer_id')->get();
        $i = 1;
        foreach($dataOrders as $val){
            $data[$i]['orders_no'] = $val->order_id;
            $data[$i]['order_date'] = $val->order_date;
            $customerName = Customers::select('name')->where(['id'=>$val->customer_id])->first();
            $data[$i]['customer'] = $customerName->name;
            $amount = OrderDetail::select('price','total')->where(['order_id'=>$val->order_id])->first();
            $data[$i]['amount'] = $amount->price;
            $data[$i]['amount_due'] = $amount->total;
            $statPayments = Payments::select('status')->where(['order_id'=>$val->order_id])->first();
            $data[$i]['amount_due'] = $this->statusPay($statPayments->status);
            $i++;
        }
        return $data;
    }

    public function statusPay($par){
        $status = "";
        switch($par){
            case "1":
                $status = "Outstanding";
            break;
            case "2":
                $status = "Paid";
            break;
        }
        return $status;
    }

    public function GetTransactionByQuery(){
        return $data =  DB::select("SELECT orders.order_id, orders.order_date, customers.name, orders.sub_total AS amount, 
        order_details.total AS amount_due, 
        CASE payments.status 
        WHEN 1 THEN 'Outstanding'
        ELSE 'Paid' END AS STATUS
        FROM orders
        INNER JOIN customers ON orders.customer_id=customers.id
        INNER JOIN order_details ON orders.order_id=order_details.order_id
        INNER JOIN payments ON orders.order_id=payments.order_id
        ORDER BY orders.order_id DESC;");
    }

    public function CreateDataDummyOrders(){
        $user = "avana_";
        
        for($i=1;$i<=100;$i++){
            
        }


    }

}
