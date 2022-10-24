<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    
    
    <title>Pelanggan</title>
</head>
<style>
body {font-family: Arial;}

/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}

#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}

body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;
}

input[type=number] {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;
}

input[type=submit] {
  background-color: #04AA6D;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}

</style>
<body>
    <h1>Data Transaksi Avana</h1>


    <div class="tab">
        <button class="tablinks" onclick="openCity(event, 'customers')">Customers</button>
        <button class="tablinks" onclick="openCity(event, 'orders')">Orders</button>
        <button class="tablinks" onclick="openCity(event, 'payment')">Payment</button>
    </div>

   

    

<div id="customers" class="tabcontent">
  <h3>Customers</h3>
  
  @csrf
    <form action="{{URL::to('customer')}}" method="post">
        <input type="text" name="name" placeholder="nama">
        <input type="text" name="email" placeholder="email">
        <input type="text" name="phone_number" placeholder="phone number">
        <input type="submit" value="simpan">
    </form>
    <hr/>
    <table border="1">
        <tr>
            <th>Nama Pelanggan</th>
            <th>Email</th>
            <th>Telepon</th>
            <th>action</th>
        </tr>
        @forelse($customers as $pelanggan)
            <tr>
                <td>{{ $pelanggan['name'] }} </td>
                <td>{{ $pelanggan['email'] }} </td>
                <td>{{ $pelanggan['phone_number'] }} </td>
                <td>
                    <input type="button" value="edit">
                    <input type="button" value="delete">
                </td>
            </tr>
        @empty

        @endforelse
    </table>


</div>

<div id="orders" class="tabcontent">
  <h3>Orders</h3>
  
     @csrf
    <form action="{{URL::to('Order')}}" method="post">
        <label for="l13">Orders ID (Otomatis)</label>
        <input type="text" name="order_id" placeholder="order_id" readonly>

        <label for="l13">Pilih Pelanggan</label>
        <select  id="pelanggan" name="pelanggan">
        @forelse($customers as $cus)
            <option value="{{ $cus->id }}" >{{ $cus->name }}</option>
            @empty
                <option value="-">Belum ada data customers</option>
        @endforelse
        </select>


        <label for="l13">Pilih Barang</label>
        <select  id="barang" name="barang">
            <option value="1">Buku</option>
            <option value="2">Pensil</option>
            <option value="3">Penghapus</option>
            <option value="4">Papan Tulis</option>
            <option value="5">Spidol</option>
        </select>


        <label for="l13">Tanggal Pesan</label>
        <input type="text" id="datepicker">


        <label for="l13">Jumlah Barang</label>
        <input type="number" name="jumlah_barang" placeholder="Jumlah barang">
        
        <label for="l13">Harga</label>
        <input type="number" name="harga" placeholder="Harga">

        <label for="l13">Discount</label>
        <input type="number" name="discount" placeholder="discount">


        <label for="l13">Total</label>
        <input type="text" name="total" placeholder="Total" readonly>

        <input type="submit" value="order">
    </form>



</div>

<div id="payment" class="tabcontent">
  <h3>Payment</h3>
    @csrf
    <form action="{{URL::to('Payment')}}" method="post">
        
    </form>

  
</div>

<hr/>
    <h3>Detail Informasi Transaksi</h3>
    <table id="customers">
        <tr>
            <th>Order No</th>
            <th>Order Date</th>
            <th>Customer</th>
            <th>Amount</th>
            <th>Amount Due</th>
            <th>Status</th>
        </tr>
        @forelse($transaksi as $trx)
            <tr>
                
            </tr>
        @empty
            <tr>
                <td></td>    
                <td></td>    
                <td></td>    
                <td></td>    
                <td></td>    
                <td></td>    
            </tr>
        @endforelse
    </table>

<script>
$( function() {
    $( "#datepicker" ).datepicker();
  } );

function openCity(evt, menuname) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(menuname).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>
</body>
</html>