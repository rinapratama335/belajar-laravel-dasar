## Membuat Fitur Edit Data Dan Delete Data

1. Pertama kita buat fungsi edit terlebih dahulu, edit kode fungsi `edit` di controller `PostController` menjadi seperti ini :
```
public function edit($id) {
    $posts = DB::select('select * from posts where id=?', [$id]);
    return view('edit', ['posts' => $posts]);
}
```

2. Kemudian kita buat file view `edit.blade.php`. Isinya sebenarnya sama dengan tampilan tambah data, hanya terdapat sedikit perbedaan di formnya :
```
@foreach($posts as $post)
    <form action="{{ action('PostController@update', $post->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Nama</label>
            <input type="text" class="form-control" name="name" value={{ $post->name }}>
        </div>
        <div class="form-group">
            <label>Detail</label>
            <textarea name="detail" class="form-control">{{ $post->detail }}</textarea>
        </div>
        <div class="form-group">
            <label>Author</label>
            <input type="text" class="form-control" name="author" value={{ $post->author }}>
        </div>
        <button class="btn btn-primary">Submit <i class="fas fa-send"></i></button>
        <a href="{{ action('PostController@index') }}" class="btn btn-warning">Back</a>
    </form>
@endforeach
```
JANGAN LUPA tambahkan `@method('PUT')` supaya laravel mengenali bahwa form ini adalah edit data.

3. Lalu di method `update` controller `PostController` kita buat untuk update data :
```
public function update(Request $request, $id)
    {
        $name = $request->get('name');
        $detail = $request->get('detail');
        $author = $request->get('author');

        $posts = DB::update('update posts set name=?, detail=?, author=? where id=?', [$name, $detail, $author, $id]);
        if($posts){
            $res = redirect('posts')->with('success', 'Data berhasil diubah');
        } else {
            $res = redirect('posts/edit/'.$id)->with('danger', 'Perubahan data gagal, silahkan coba lagi');
        }

        return $res;
    }
```

4. Selanjutnya kita buat untuk hapus data, pertama kita tambahkan kode berikut :
```
<form......>
    @method('DELETE')
    @csrf
    .
    .
    .
</form>
```

5. Di controller `PostController` method `destroy` kita buat kode untuk hapus data :
```
public function destroy($id) {
    $posts = DB::delete('delete from posts where id=?', [$id]);
    $res = redirect('posts')->with('success','Berhasil menghapus data');
    return $res;
}
```
