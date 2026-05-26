# Toko Elektronik

Aplikasi web toko elektronik berbasis Laravel.
Digunakan untuk jual beli produk elektronik secara online.
Aplikasi ini memiliki dua peran yaitu User dan Admin.

---

## Screenshot Halaman user

### 1. Login User
Halaman ini digunakan user untuk masuk ke sistem menggunakan email dan 
password yang sudah terdaftar.

![Login User](screenshots/login-user.png)

### 2. Register
Halaman ini digunakan untuk membuat akun baru sebelum user dapat
login ke dalam sistem.

![Register](screenshots/register.png)

### 3. Halaman Shop
Halaman ini menampilkan semua produk elektronik yang tersedia 
di toko lengkap dengan gambar, nama produk, dan harga.

![Shop](screenshots/shop.png)

### 4. Detail Produk
Halaman ini menampilkan informasi lengkap dari produk yang dipilih
seperti deskripsi, harga, dan gambar produk.

![Detail Produk](screenshots/detail-produk.png)

### 5. Cart
Halaman ini digunakan untuk menampilkan produk yang sudah ditambahkan
ke keranjang sebelum melakukan checkout.

![Cart](screenshots/cart.png)

### 6. Checkout
Halaman ini digunakan untuk menyelesaikan proses pembelian dengan mengisi data pemesanan dan konfirmasi transaksi.

![Checkout](screenshots/checkout.png)

### 7. Riwayat Pesanan
Halaman ini menampilkan semua riwayat pesanan yang pernah dilakukan oleh
user beserta statusnya.

![Riwayat Pesanan](screenshots/riwayat-pesanan.png)

## Screenshot Halaman Admin

### 8. Login Admin
Halaman ini digunakan admin untuk masuk ke dashboard admin.

![Login Admin](screenshots/login-admin.png)

### 9. Dashboard Admin
Halaman utama admin yang menampilkan ringkasan data seperti jumlah produk,
kategori, dan pesanan.

![Dashboard](screenshots/dashboard.png)

### 10. Kategori Admin
Halaman ini digunakan admin untuk mengelola kategori produk seperti
menambah, mengedit, dan menghapus kategori.

![Kategori](screenshots/kategori.png)

### 11. Kelola Produk Admin
Halaman ini digunakan admin untuk mengelola data produk seperti
menambah, menguba, dan menghapus produk.

![Produk](screenshots/produk.png)

### 12. Semua Pesanan Admin
Halaman ini menampilkan seluruh pesenan yang masuk dari user dan digunakan
admin untuk memantau transaksi.

![Semua Pesanan](screenshots/semua-pesanan.png)

---

## Screenshot Database

### Tabel Users
Menyimpan data akun user dan admin.
![Tabel Users](screenshots/db-users.png)

### Tabel Products
menyimpan data produk elektronik yang dijual di sistem.
![Tabel Products](screenshots/db-products.png)

### Tabel Categories
menyimpan data kategori produk.
![Tabel Categories](screenshots/db-categories.png)

### Tabel Orders
menyimpan data transaksi atau pesenan dari user.
![Tabel Orders](screenshots/db-orders.png)

### Tabel Order Items
menyimpan detail produk dalam setiap transaksi pesanan.
![Tabel Order Items](screenshots/db-order-items.png)

### Tabel Carts
menyimpan data produk yang ada di keranjang user sebelum checkout.
![Tabel Carts](screenshots/db-carts.png)