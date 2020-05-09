<?php

namespace App\Http\Controllers;

use App\Book;
use App\Http\Resources\BookResource;
use App\Mail\BookMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class BooksController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return BookResource::collection(Auth::user()->books);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        DB::beginTransaction();
        $book = Auth::user()->books()->create($request->all());
        $user = $book->user;
        if(!$book){
            DB::rollback();
        }else{

            DB::commit();
            Mail::to($user->email)->queue(new BookMail($user,$book->name,'you saved a new book!','Saved a new Book'));
        }
        return response('Created',Response::HTTP_CREATED);

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $id = $book->id;
        $user = $book->user;
        $book_name = $book->name;
        DB::beginTransaction();
        $book->delete();
        if(Book::find($id)){
            DB::rollBack();
        }else{
            DB::commit();
            Mail::to($user->email)->queue(new BookMail($user,$book_name,'you temporarily deleted a book!','Temporarily Deleted!'));

        }
        return response('Deleted Temporarily',Response::HTTP_OK);
    }

    public function destroyPermanently(Book $book)
    {
        $id = $book->id;
        $user = $book->user;
        $book_name = $book->name;
        DB::beginTransaction();
        $book->forceDelete();
        if(Book::withTrashed()->find($id)){
            DB::rollBack();
        }else{
            DB::commit();
            Mail::to($user->email)->queue(new BookMail($user,$book_name,'you permanently deleted a book!','permanently Deleted!'));
        }
        return response('Deleted Permanently',Response::HTTP_OK);
    }

    public function restore($id){
        $book = Book::withTrashed()->find($id);
        $user = $book->user;
        $book_name = $book->name;
        DB::beginTransaction();
        $book->restore();
        if(!Book::find($id)){
            DB::rollBack();
        }else{
            DB::commit();
            Mail::to($user->email)->queue(new BookMail($user,$book_name,'you restore a book!','Restored!'));
        }
        return response('Deleted Permanently',Response::HTTP_OK);
    }
}
