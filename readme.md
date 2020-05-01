## Get All Data Dengan Laravel

1. Terlebih dahulu setting databse di file `.env` :
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=belajar-laravel-dasar
DB_USERNAME=root
DB_PASSWORD=
```
Sesuaikan dengan pengaturan databasenya.

2. Buat Model `Post` sekaligus migrationnya :
```
php artisan make:model Post -m
```

3. Edit file migration yang baru dibuat (`create_posts_table`) di folder `database/migrations` :
```
public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('detail');
            $table->string('author');
            $table->timestamps();
        });
    }
```
Jalankan migrationnya : `php artisan migrate`

4. Buat controller `PostController` :
`php artisan make:controller PostController --resource`
Kemudian di function index kita buat kode untuk mengambil data dari tabel `posts` :
```
public function index()
    {
        //Ambil semua data
        $posts = DB::select('select * from posts');
        return view('index', ['posts' => $posts]);
    }
```

5. Jangan lupa kita buat routenya :
```
Route::get('/', 'PostController@index');
Route::resource('posts', 'PostController');
```
Dengan `resource` maka laravel akan otomatis memiliki fungsi `index`, `show`, `create`, `store`, `edit`, `update`, dan `destroy` untuk controller yang didefinisikan.

6. Kemudian kita akan buat layout untuk menampilkan semua page yang akan kita buat :
```
<body>
    <div class="container">
        <p><br></p>
        @yield('content')
    </div>
</body>
```
`@yield` ini akan menampilkan setiap page yang dibuat nantinya. sedangkan `@yield('content')` adalah nama section/page yang digunakan untuk menampilkan page-nya.

7. Terakhir kita buat view `index` sebagi tempat menampilkan datanya
```
@extends('layout')
@section('content')
.
.
.
@endsection
```
`@extends('layout')` artinya kita memanggil file view `layout`. Sedangkan `@section('content')` artinya kita membuat tampilan yang ditampilkan melalui view layout yang didefinisikan di `yield`.
