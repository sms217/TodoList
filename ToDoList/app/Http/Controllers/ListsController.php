<?php

namespace App\Http\Controllers;

use App\Models\ToDoList;
use App\Models\User;
use App\Models\Say;
use Illuminate\Http\Request;

use function PHPSTORM_META\type;

class ListsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $says = Say::select('id', 'says', 'sayer')->get();
        $count = Say::count();
        // dd($count);
        $rand = rand(1, $count);
        $lists = '';
        $dones='';
        if(auth()->user()){
            $userId = auth()->user()->id;   
            $dones = ToDoList::where('user_id',$userId)->where('done',1)->get();
            $lists = ToDoList::where('user_id', $userId)->get();
        }
        // dd($lists)
        $list=ToDoList::all();
        $sameUserId=array();
        $sameUserName=array();
        // dd(gettype($sameUserName));
        $target=array();
        $test=array();
        $check=null;
  if($lists!=''){
      if($lists->count()!=0){
          for($i=0; $i < $lists->count(); $i++){
                $target[$i]=$lists[$i]->todo;
                $target=array_unique($target);
                // dd($list);
                for($j=0; $j < $list->count(); $j++){
                    if($list[$j]->todo==$target[$i]){
                        $sameUserId[$j]=$list[$j]->user_id;
                        $sameUserName[$j]=User::find($sameUserId[$j])->name;
                        if($sameUserId[$j]==$userId){
                            unset($sameUserId[$j]);                       
                            $check=$j;
                            // if($j==$check){
                                if($sameUserName[$j]==User::find($userId)->name){
                                    unset($sameUserName[$j]);
                                }
                            // }
                        }
                        // dd($check);
                    }
                }
            };
        }
    }
        // dd($target);
        $sameUserId=array_unique($sameUserId);
        $sameUserName=array_unique($sameUserName);
        // dd($sameUserName);
        // dd($list[3]->todo);
        // dd($sameUserName);
        // dd($sameUserId[0]."+".$userId);
        // if($sameUserId!=$userId)
        // $sameUserId=ToDoList::where('todo',),->get();
        return view('main', compact('says', 'rand', 'lists','dones','sameUserId','sameUserName'));
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
        $this->validate($request, (['todo'=>'required|min:2']));
        $input = [
            'user_id' => auth()->user()->id,
            'todo' => $request->todo
        ];
        // dd($input);
        ToDoList::create($input);
        $lists = ToDoList::all();
        $says = Say::all();
        $rand = random_int(1, Say::all()->count());
        // $lists->create 
        return redirect()->route('main', ['says' => $says, 'rand' => $rand, 'lists' => $lists]);
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TodoList $li)
    {

        $li->done = true;
        // dd($list->done);
        $li->update();
        // dd($list);
        $says = Say::select('id', 'says', 'sayer')->get();
        $count = Say::count(); 
        $rand = rand(1, $count);
        $dones='';
        if(auth()->user()){
            $userId = auth()->user()->id;   
            $dones = ToDoList::where('user_id',$userId)->where('done',1)->get();
            // dd($dones);
            $lists = ToDoList::where('user_id', $userId)->get();
        }
        $list=ToDoList::all();
        $sameUserId=array();
        $sameUserName=array();
        $check=null;
        $target=array();
        if($lists->count()!=0){
            for($i=0; $i < $lists->count(); $i++){
                $target[$i]=$lists[$i]->todo;
                // dd($list);
                for($j=0; $j < $list->count(); $j++){
    
                    if($list[$j]->todo==$target[$i]){
                        $sameUserId[$j]=$list[$j]->user_id;
                        if($sameUserId[$j]==$userId){
                            unset($sameUserId[$j]);
                            // dd($sameUserId);
                            // dd($sameUserId);
                            $check=$j;
                        }
                        if($j!=$check){
                            $sameUserName[$j]=User::find($sameUserId[$j])->name;
                            if($sameUserName[$j]==User::find($userId)->name){
                                unset($sameUserName[$j]);
                            }
                        }
                    }
                }
            };
        }
        $sameUserId=array_unique($sameUserId);
        $sameUserName=array_unique($sameUserName);
        

        // dd($lists->todo);
        return view('main', compact('says', 'rand', 'lists','dones','sameUserId','sameUserName'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $li=ToDoList::find($id);
        // dd($list);
        $li->delete();
        // dd($list);
        $says = Say::select('id', 'says', 'sayer')->get();
        $count = Say::count();$dones='';
        // dd($dones);+
        if(ToDoList::where('done',1)->get())
        $dones='';
        if(auth()->user()){
            $userId = auth()->user()->id;   
            $dones = ToDoList::where('user_id',$userId)->where('done',1)->get();
            // dd($dones);
            $lists = ToDoList::where('user_id', $userId)->get();
        }
        $rand = rand(1, $count);
        $list=ToDoList::all();
        $sameUserId=array();
        $sameUserName=array();
        $target=array();
        $check=null;
        if($lists->count()!=0){
            for($i=0; $i < $lists->count(); $i++){
                $target[$i]=$lists[$i]->todo;
                // dd($list);
                for($j=0; $j < $list->count(); $j++){
                    if($list[$j]->todo==$target[$i]){
                        $sameUserId[$j]=$list[$j]->user_id;
                        if($sameUserId[$j]==$userId){
                            unset($sameUserId[$j]);
                            // dd($sameUserId);
                            // dd($sameUserId);
                            $check=$j;
                        }
                        if($j!=$check){
                            $sameUserName[$j]=User::find($sameUserId[$j])->name;
                            if($sameUserName[$j]==User::find($userId)->name){
                                unset($sameUserName[$j]);
                            }
                        }
                    }
                }
            };
        }
        $sameUserId=array_unique($sameUserId);
        $sameUserName=array_unique($sameUserName);

        // dd($lists->todo);
        return view('main', compact('says', 'rand', 'lists','dones','sameUserId','sameUserName'));
    }

    public function updateTodo(Request $request, TodoList $li)
    {
        $li->todo = $request->todo;
        // dd($li->done);
        // dd($request);
        $li->update();
        // dd($list);
        $says = Say::select('id', 'says', 'sayer')->get();
        $count = Say::count();
        $rand = rand(1, $count);
        $dones='';
        if(auth()->user()){
            $userId = auth()->user()->id;   
            $dones = ToDoList::where('user_id',$userId)->where('done',1)->get();
            // dd($dones);
            $lists = ToDoList::where('user_id', $userId)->get();
        }
        $list=ToDoList::all();
        $sameUserId=array();
        $sameUserName=array();
        $target=array();
        $check=null;
        if($lists->count()!=0){
            for($i=0; $i < $lists->count(); $i++){
                $target[$i]=$lists[$i]->todo;
                $target=array_unique($target);
                // dd($list);
                for($j=0; $j < $list->count(); $j++){
                    if($list[$j]->todo==$target[$i]){
                        $sameUserId[$j]=$list[$j]->user_id;
                        if($sameUserId[$j]==$userId){
                            unset($sameUserId[$j]);
                            // dd($sameUserId);
                            // dd($sameUserId);
                            $check=$j;
                        }
                        if($j!=$check){
                            $sameUserName[$j]=User::find($sameUserId[$j])->name;
                            if($sameUserName[$j]==User::find($userId)->name){
                                unset($sameUserName[$j]);
                            }
                        }
                    }
                }
            };
        }
        $sameUserId=array_unique($sameUserId);
        $sameUserName=array_unique($sameUserName);

        // dd($lists->todo);
        return redirect()->route('main');
    }
    public function profile($userName){
        $userId=User::where('name',$userName)->get('id');
        $userId=$userId[0]->id;
        $list = ToDoList::where('user_id',$userId)->get();
        $name=User::find($userId)->name;
        return view('profile',compact('list','name'));
    }
}