<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;   
use Illuminate\Http\Request;

class rescontrol extends Controller
{
    public function show()

    {
        if (!session()->has('user_id')) {
            return redirect('/');
        }

        $ok = DB::table('resisters')->get();
        return view('alluser', compact('ok'));
    }
    public function view($id){
        $ok=DB::table('resisters')->where('id',$id)->get();
        return view('view', compact('ok'));
    }
    public function adduser(Request $request){
        $request->validate([
            'username' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => ['required',
                        'email',
                        'unique:resisters,email',
                        'regex:/^[A-Za-z0-9._%+-]+@(impactguru\.org|gmail\.com|impact\.ac\.in|impactguru\.com)$/'
                    ],

            'dob' => 'required|date|before_or_equal:'. now()->subYears(18)->toDateString(),
            'mobile' => 'required|regex:/^[6-9][0-9]{9}$/|unique:resisters,mobile',
            'password' => ['required','min:8','regex:/[0-9]/','regex:/[@$!%*#?&]/',      
                            'regex:/[A-Z]/', 'regex:/[a-z]/'],
            'adhar' => 'nullable|regex:/^\d{12}$/|unique:resisters,adhar',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $filename = null;
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $file = $request->file('image');
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\-\_\.]/', '_', $file->getClientOriginalName());
            $file->move(public_path('images'), $filename);
        }

        $ok=DB::table('resisters')->insert([
            'name'=>$request->username,
            'surname'=>$request->surname,
            'mobile'=>$request->mobile,
            'DOB'=>$request->dob,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'status'=>1,
            'image' => $filename,
            'adhar' => $request->adhar,
            'country_code' => $request->country_code ?? '+91',
        ]);

        if($ok) {
            return redirect('/home')->with('success', 'User added successfully!');
        }

        return redirect()->back()->withInput()->with('alert', 'Failed to add user. Please try again.');
    }
    public function updateuser($id){
        $ok=DB::table('resisters')->find($id);
        return view('updateuser', compact('ok'));

    }
    public function updateuserpost(Request $request, $id){
         $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => [
    'required',
    'email',
    'unique:resisters,email,' . $id,
    'regex:/^[A-Za-z0-9._%+-]+@(impactguru\.org|gmail\.com|impact\.ac\.in|impactguru\.com)$/'
],
            'dob' => 'required|date|before_or_equal:'. now()->subYears(18)->toDateString(),
            'mobile' => 'required|regex:/^[6-9][0-9]{9}$/',           
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',           
            'adhar' => 'nullable|regex:/^\d{12}$/',
        ]);

        
        $filename = null;
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $file = $request->file('image');
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\-\_\.]/', '_', $file->getClientOriginalName());
            $file->move(public_path('images'), $filename);
        }


        $data = [
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'DOB' => $request->dob,
            'status' => 1,
            'adhar' => $request->adhar,
            'country_code' => $request->country_code ?? '+91',
        ];

        // only overwrite `image` when a new file was uploaded
        if ($filename) {
            // remove old file to avoid orphans
            $old = DB::table('resisters')->where('id', $id)->value('image');
            if ($old && file_exists(public_path('images/' . $old))) {
                @unlink(public_path('images/' . $old));
            }

            $data['image'] = $filename;
        }


     

        // If password provided, hash and update it
        if($request->filled('password')){
            $data['password'] = Hash::make($request->password);
        }

        DB::table('resisters')->where('id', $id)->update($data);

        return redirect('/home')->with('success', 'User updated successfully');
    }
    public function deleteuser($id){

        $ok=DB::table('resisters')->where('id',$id)->update(['status'=>0]);
        return redirect('/home');
   
    }
    public function deleteall(){
        DB::table('resisters')->truncate();
        return redirect('/home');
   
    }
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check if user exists in resisters table
        $user = DB::table('resisters')
            ->where('email', $request->email)
            ->where('status', 1)
            ->first();

        if($user && Hash::check($request->password, $user->password)) {
            $request->session()->regenerate();
            session(['user_id' => $user->id, 'user_email' => $user->email, 'user_name' => $user->name]);
            return redirect('/home');
        }
        
        return redirect()->back()->with('alert', 'Invalid email or password');
    }
    public function logout(){
        session()->flush();
        return redirect('/');
    }
}
