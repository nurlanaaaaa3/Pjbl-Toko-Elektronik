# Toko Elektronik

# Fitur Website Toko Elektronik
Website Toko Elektronik berbasis Laravel ini memiliki berbagai fitur yang membantu proses penjualan produk elektronik secara online. Sistem dibuat agar memudahkan user dalam melakukan pembeli produk dan memudahkan admin dalam mengelola data toko.


# Kelebihan Website
Website Toko Elektronik berbasis Laravel ini memiliki beberapa kelebihan, yaitu memudahkan user dalam membeli produk secara online tanpa harus datang ke toko, proses transaksi menjadi lebih cepat dan praktis, serta data tersimpan otomatis di database sehingga lebih aman dan terorganisir. Selain itu, admin juga lebih mudah dalam mengelola produk, kategori, dan pesanan melalui dashboard. Website ini juga sudah responsive sehingga bisa diakses di berbagai perangkat, serta menggunakan Laravel yang membuat sistem lebih rapi, aman, dan mudah dikembangkan kembali di masa depan.


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

# Kesimpulan
Website Toko Elektronik berbasis Laravel ini dibuat untuk mempermudah proses penjualan produk elektronik secara online agar lebih cepat, praktis, dan efisien. Dengan adanya sistem ini, user dapat dengan mudah melihat produk, mencari barang, melihat detail produk, menambahkan ke keranjang, hingga melakukan checkout tanpa harus datang langsung ke toko. Selain itu, user juga dapat melihat riwayat pesanan sehingga setiap transaksi dapat dipantau dengan lebih jelas. Di sisi lain, admin juga sangat terbantu karena seluruh pengelolaan data dilakukan melalui sistem. Admin dapat mengelola produk, kategori, serta memantau semua pesanan user dengan lebih mudah melalui dashboard. Hal ini membuat proses pengelolaan toko menjadi lebih terstruktur dan tidak lagi dilakukan secara manual. Secara keseluruhan, sistem ini memberikan solusi yang lebih modern dalam proses jual beli produk elektronik. Dengan menggunakan Laravel dan database MySQL, website ini menjadi lebih aman, rapi, dan mudah dikembangkan kembali di masa depan jika diperlukan penambahan fitur baru.
