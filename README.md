# avana-customer-package

## Installing  ridwanmaulanaavana/customer

- ini adalah API untuk mengelola customer avana adapun beberapa method yang dapat digunakan yaitu :
- customer dengan method get --> untuk menampikan gui sederhana yang menampilkan data user
- customer dengan method post  --> untuk insert data customer melalui gui
- GetCustomerById dengan method post -> untuk mengambil data customer berdasarkan id
- GetCustomerByField dengan method post -> untuk mengambil data berdasarkan like 'name' / 'email' / phone number
- GetOrdersID dengan method get --> untuk memperoleh hasil orders id
- GetCustomersApi dengan method get --> untuk memperoleh keseluruhan customers melalui api
- CustomersInsertApi dengan method post --> untuk insert customer via API
- CustomersUpdatetApi dengan method post --> untuk Update customer via API
- CustomersDeleteApi dengan method post --> untuk Delete customer via API
- Orders dengan method post --> untuk membuat orders atau permintaan pembelian
- ShowOrdersByOrderId dengan method post --> untuk meminta data orders berdasarkan id
- UpdateOrders dengan method post --> untuk update orders atau permintaan pembelian
- deleteOrders dengan method post --> untuk delete orders atau permintaan pembelian
- Payment dengan method post --> untuk memasukan data payment orders 
- ShowPayment dengan method post --> menampilkan data yg sudah dipay
- UpdateStatusPayment dengan method post --> Mengubah status payment outstanding atau paid
- GetAllTransaction dengan method get --> untuk memperoleh seluruh data transaksi by array multi
- GetTransactionByQuery dengan method get --> untuk memperoleh seluruh data transaksi by query
- CreateDataDummyOrders dengan method get --> untuk membuat data dummy
- sendEmail dengan method get --> mengirimkan email setelah semua proses transaksi selesai

The recommended way to install ridwanmaulanaavana is through
[Composer](https://getcomposer.org/).

```bash
composer require ridwanmaulanaavana/customer
```