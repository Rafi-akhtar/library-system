<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = User::all();
        return view("member.index", compact("members"));
    }
}
