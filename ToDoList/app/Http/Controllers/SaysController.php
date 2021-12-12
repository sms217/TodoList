<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Say;
use App\Models\ToDoList;

class SaysController extends Controller
{
    public function index(){
        $says = Say::select('id','says','sayer')->get();
        $count = Say::count();
        $rand = rand(5, $count+4);
        $lists='';
        if(auth()->user()){
            $userId=auth()->user()->id;
            $lists = ToDoList::where('user_id',$userId)->get();
        }
        // dd($lists->todo);
        return view('main',compact('says','rand','lists'));
    }
    public function regiView(){
        $says = Say::select('id','says','sayer')->get();
        $count = Say::count();
        $rand = rand(5, $count+4);
        $lists = ToDoList::all();
        return view('regiView',compact('says','rand','lists'));
    }
}