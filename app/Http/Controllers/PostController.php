<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Ambil semua data
        $posts = DB::select('select * from posts');
        return view('index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posts = DB::select('select * from posts where id=?', [$id]);
        return view('edit', ['posts' => $posts]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $posts = DB::delete('delete from posts where id=?', [$id]);
        $res = redirect('posts')->with('success','Berhasil menghapus data');
        return $res;
    }
}
