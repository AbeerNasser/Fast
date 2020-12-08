<?php

namespace App\Http\Controllers\ControlPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\User;
use DB;


class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::get();
        return view('pages/users', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $users = User::get('role');
        $type = DB::select( DB::raw("SHOW COLUMNS FROM users WHERE Field = 'role'") )[0]->Type;
        preg_match("/^enum\(\'(.*)\'\)$/", $type, $matches);
        $enum = explode("','", $matches[1]);
        return view('pages/addNewUser', ['roles' => $enum]);
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data =$request->all();
        $request->validate([
            'name'=>'required',
            'role'=>'required',
            'email'=>'required|email',
            'password'=>'required|confirmed',
        ]);
        
        if($request->role=='مدير دعم فني'){
            $data['is_admin']=0;
        }elseif($request->role=='مدير عام النظام'){
             $data['is_admin']=1;
        }else{
             $data['is_admin']=2;
        }
        $data['password']=bcrypt($request->password);
        $user = User::create($data);

        return redirect('admin/users')->with('succeess','inserted');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $user = User::find($id);
        return view('pages/user', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $type = DB::select( DB::raw("SHOW COLUMNS FROM users WHERE Field = 'role'") )[0]->Type;
        preg_match("/^enum\(\'(.*)\'\)$/", $type, $matches);
        $enum = explode("','", $matches[1]);

        $user = User::find($id);
        return view('pages/addNewUser', ['user' => $user,'roles'=>$enum]);
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
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|confirmed',
        ]);
    
        $data=$request->except(['_token','_method','password_confirmation']);
        
        if($request->role=='مدير انشاء تسعيرات'){
            $data['is_admin']=2;
        }elseif($request->role=='مدير عام النظام'){
            $data['is_admin']=1;
        }else{
            $data['is_admin']=0;
        }
        $data['password']=bcrypt($request->password);
        $user = User::where('id', '=', $id)->update($data);

        return redirect('admin/users')->with('succeess','updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('id', '=', $id)->delete();
        
        return redirect('admin/users')->with('succeess','deleted');
    }
    public function activeUser($id)
    {
        $user = User::findOrFail($id);
        if($user->status == 0)
            User::where('id',$id)->update(['status'=>1]);
        else
            User::where('id',$id)->update(['status'=>0]);

        return redirect('admin/users');
    }
}
