## Membuat Fitur Tambah Data

1. Di controller `PostController` kita ubah fungsi `create` dengan mengubah kode menjadi seperti ini :
```
public function create() {
    return view('create');
}
```
Kode di atas akan memanggil view `create`.

2. Buat file `create` di folder views dan tambahkan kode berikut :
```
@extends('layout');

@section('content')
    .
    .
    form tambah data di sini
    .
    .
@endsection
```
3. Untuk menyimpan data kita gunakan fungsi `store` di controller `PostController` :
```
public function store(Request $request) {
    $name = $request->get('name');
    $detail = $request->get('detail');
    $author = $request->get('author');

    $posts = DB::insert('insert into posts(name, detail, author) value(?,?,?)', [$name, $detail, $author]);
    if($posts){
        $res = redirect('posts')->with('success', 'Data berhasil disimpan');
    } else {
        $res = redirect('posts/create')->with('danger', 'Input data gagal, silahkan coba lagi');
    }

    return $res;
}
```
