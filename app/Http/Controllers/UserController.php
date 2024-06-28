<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    public function index()
    {
        return view('welcome');
    } 

    public function getData()
    {
        $users = User::leftJoin('departments', 'users.fk_department', '=', 'departments.id')
        ->leftJoin('designations', 'users.fk_designation', '=', 'designations.id')
        ->select('users.*', 'departments.name as department_name', 'designations.name as designation_title')
        ->get();
        return response()->json($users);
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $users = User::leftJoin('departments', 'users.fk_department', '=', 'departments.id')
                     ->leftJoin('designations', 'users.fk_designation', '=', 'designations.id')
                     ->select('users.*', 'departments.name as department_name', 'designations.name as designation_title')
                     ->where(function ($query) use ($search) {
                         $query->where('users.name', 'like', "%$search%")
                               ->orWhere('departments.name', 'like', "%$search%")
                               ->orWhere('designations.name', 'like', "%$search%");
                     })
                     ->get();

        return response()->json($users);
    }
   
}