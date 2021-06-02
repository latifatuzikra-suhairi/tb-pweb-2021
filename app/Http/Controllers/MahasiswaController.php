<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Mahasiswa;
use App\Models\User;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $mahasiswa = Mahasiswa::paginate(10);
        return view('admin.mahasiswa.index', ['data_mahasiswa' => $mahasiswa], ['data_mahasiswa' => DB::table('mahasiswa')->paginate(15)]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'nama' => 'required',
            'nim' => 'required',
            'email' => 'required',
        ], [
            'nama.required' => 'Nama tidak boleh kosong',
            'nim.required' => 'NIM tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
        ]);

        $user = new User;
        $user->role = 'mahasiswa';
        $user->username = $request->nim;
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->password = bcrypt('1234');
        $user->remember_token = str_random(60);
        $user->save();

        $request->request->add(['user_id' => $user->id]);
        Mahasiswa::create($request->all());
        return redirect('/mahasiswa')->with('status', 'Data Mahasiswa Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($mahasiswa_id)
    {
        //
    }

    // public function push($mahasiswa_id)
    // {
    //     dd($mahasiswa_id);
    //     $mahasiswa = DB::table('pertemuan')
    //                                ->get();

    //     return view('admin.mahasiswa.index', compact($mahasiswa));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($mahasiswa_id)
    {
        $data_mahasiswa = Mahasiswa::find($mahasiswa_id);
        return view('admin.mahasiswa.edit', compact('data_mahasiswa'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $mahasiswa_id)
    {

        $request->validate([
            'nama' => 'required',
            'nim' => 'required',
            'email' => 'required',
            'tipe' => 'required',
            'password' => 'required',
        ], [
            'nama.required' => 'Nama tidak boleh kosong',
            'nim.required' => 'NIM tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'tipe.required' => 'Tipe tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
        ]);

        if($request->isMethod('post')){
            $data_mahasiswa = $request->all();  

            Mahasiswa::where(['mahasiswa_id'=> $mahasiswa_id])->update(['nama'=>$data_mahasiswa['nama'], 'nim'=>$data_mahasiswa['nim'], 'email'=>$data_mahasiswa['email'], 'tipe'=>$data_mahasiswa['tipe'], 'password'=>$data_mahasiswa['password']]);
            return redirect('/mahasiswa')->with('status', 'Data Mahasiswa Berhasil Diubah');

        }
    }

    // public function edit(Request $request, $mahasiswa_id)
    // {
        
    // }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($mahasiswa_id)
    {
        // Mahasiswa::destroy($mahasiswa->mahasiswa_id);
        $mahasiswa = Mahasiswa::find($mahasiswa_id);
        $mahasiswa->delete();
        return redirect('/mahasiswa')->with('status', 'Data Mahasiswa Berhasil Dihapus');

    }

}
