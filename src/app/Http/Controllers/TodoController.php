<?php

namespace App\Http\Controllers;
use App\Models\Todo;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;


class TodoController extends Controller
{
    public function index(){
        //$todos = Todo::all();                   /* todosテーブルを全て取得 */
        $todos = Todo::with('category')->get();
        $categories = Category::all();
        //return view('index', compact('todos')); /* compact関数は、viewに変数を送信 $todos をviews側に送る*/
        return view('index', compact('todos', 'categories'));
    }

    public function store(TodoRequest $request){
        $todo = $request->only(['category_id', 'content']);    /* リクエストを受け取る */
        Todo::create($todo);                    /* データの保存 */
        return redirect('/')->with('message', 'Todoを作成しました');    /* リダイレクト */
    }

    public function update(TodoRequest $request){
        $todo = $request->only(['content']);    /* リクエストを受け取る */
        Todo::find($request->id)->update($todo);/* データの保存 */
        return redirect('/')->with('message', 'Todoを更新しました');    /* リダイレクト */
    }

    public function destroy(Request $request){
        Todo::find($request->id)->delete();
        return redirect('/')->with('message', 'Todoを削除しました');    /* リダイレクト */
    }
    public function search(Request $request)
    {
        $todos = Todo::with('category')->CategorySearch($request->category_id)->KeywordSearch($request->keyword)->get();
        $categories = Category::all();

        return view('index', compact('todos', 'categories'));
    }

}
