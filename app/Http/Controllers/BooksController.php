<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\Book;

use Illuminate\Support\Facades\Session;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;

use App\BorrowLog;
use Illuminate\Support\Facades\Auth;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {
            $books = Book::with('author');
            return Datatables::of($books)
            ->addColumn('action', function($book){
                return view('datatable._action', [
                    'model' => $book,
                    'form_url' => route('admin.books.destroy', $book->id),
                    'edit_url' => route('admin.books.edit', $book->id),
                    'confirm_message' => 'Yakin mau menghapus ' . $book->title . '?'
                    ]);
            })->make(true);
        }
        $html = $htmlBuilder
        ->addColumn(['data' => 'title', 'name'=>'title', 'title'=>'Judul'])
        ->addColumn(['data' => 'amount', 'name'=>'amount', 'title'=>'Jumlah'])
        ->addColumn(['data' => 'author.name', 'name'=>'author.name', 'title'=>'Penulis'])
        ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false]);
        return view('books.index')->with(compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    public function store(StoreBookRequest $request)
    {
        //
        // $this->validate($request, ['title' => 'required|unique:books,title',
        //     'author_id' => 'required|exists:authors,id',
        //     'amount' => 'required|numeric',
        //     'cover' => 'image|max:2048'
        //     ]);
        $book = Book::create($request->except('cover'));
// isi field cover jika ada cover yang diupload
        if ($request->hasFile('cover')) {
// Mengambil file yang diupload
            $uploaded_cover = $request->file('cover');
// mengambil extension file
            $extension = $uploaded_cover->getClientOriginalExtension();
// membuat nama file random berikut extension
            $filename = md5(time()) . '.' . $extension;
// menyimpan cover ke folder public/img
            $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img';
            $uploaded_cover->move($destinationPath, $filename);
// mengisi field cover di book dengan filename yang baru dibuat
            $book->cover = $filename;
            $book->save();
        }
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan $book->title"
            ]);
        return redirect()->route('admin.books.index');
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
        //
        $book = Book::find($id);
        return view('books.edit')->with(compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    public function update(UpdateBookRequest $request, $id)
    {
        //
        // $this->validate($request, [
        //     'title' => 'required|unique:books,title,' . $id,
        //     'author_id' => 'required|exists:authors,id',
        //     'amount' => 'required|numeric',
        //     'cover' => 'image|max:2048'
        //     ]);
        $book = Book::find($id);
        $book->update($request->all());
        if ($request->hasFile('cover')) {
// menambil cover yang diupload berikut ekstensinya
            $filename = null;
            $uploaded_cover = $request->file('cover');
            $extension = $uploaded_cover->getClientOriginalExtension();
// membuat nama file random dengan extension
            $filename = md5(time()) . '.' . $extension;
            $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img';
// memindahkan file ke folder public/img
            $uploaded_cover->move($destinationPath, $filename);
// hapus cover lama, jika ada
            self::deleteCover($book);
//             if ($book->cover) {
//                 $old_cover = $book->cover;
//                 $filepath = public_path() . DIRECTORY_SEPARATOR . 'img'
//                 . DIRECTORY_SEPARATOR . $book->cover;
//                 try {
//                     \File::delete($filepath);
//                 } catch (FileNotFoundException $e) {
// // File sudah dihapus/tidak ada
//                 }
//             }
// ganti field cover dengan cover yang baru
            $book->cover = $filename;
            $book->save();
        }
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan $book->title"
            ]);
        return redirect()->route('admin.books.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $book = Book::find($id);
// hapus cover lama, jika ada
        self::deleteCover($book);
//         if ($book->cover) {
//             $old_cover = $book->cover;
//             $filepath = public_path() . DIRECTORY_SEPARATOR . 'img'
//             . DIRECTORY_SEPARATOR . $book->cover;
//             try {
//                 File::delete($filepath);
//             } catch (FileNotFoundException $e) {
// // File sudah dihapus/tidak ada
//             }
//         }
        $book->delete();
        Session::flash("flash_notification", ["level"=>"success",
            "message"=>"Buku berhasil dihapus"
            ]);
        return redirect()->route('admin.books.index');
    }

    public function deleteCover(Book $book)
    {
        # code...
        // hapus cover lama, jika ada
        if ($book->cover) {
            $old_cover = $book->cover;
            $filepath = public_path() . DIRECTORY_SEPARATOR . 'img'
            . DIRECTORY_SEPARATOR . $book->cover;
            try {
                \File::delete($filepath);
            } catch (FileNotFoundException $e) {
                    // File sudah dihapus/tidak ada
            }
        }
    }

    public function borrow($id)
    {
        try {
            $book = Book::findOrFail($id);
            BorrowLog::create([
                'user_id' => Auth::user()->id,
                'book_id' => $id
                ]);
            Session::flash("flash_notification", [
                "level"=>"success",
                "message"=>"Berhasil meminjam $book->title"
                ]);
        } catch (ModelNotFoundException $e) {
            Session::flash("flash_notification", [
                "level"=>"danger",
                "message"=>"Buku tidak ditemukan."
                ]);
        }
        return redirect('/');
    }
}
