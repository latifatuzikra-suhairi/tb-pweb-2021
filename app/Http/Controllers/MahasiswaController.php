<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Mahasiswa;
use App\Models\Kelas;
use App\Models\Pertemuan;
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
        // $mahasiswa = Mahasiswa::paginate(10);
        // return view('admin.mahasiswa.index', ['data_mahasiswa' => $mahasiswa], ['data_mahasiswa' => DB::table('mahasiswa')->paginate(15)]);

        $data_mahasiswa = DB::table('mahasiswa')
                    -> join ('users',  'users.id', '=', 'mahasiswa.id')
                    ->select('mahasiswa.nama', 'mahasiswa.email', 'users.password', 'mahasiswa.nim', 'mahasiswa.id')
                    ->paginate(10);
        return view('admin.mahasiswa.index', ['data_mahasiswa' => $data_mahasiswa]);
    }

    public function jumlah()
    {
        $jumlahMahasiswa = Mahasiswa::all();
        $jumlahKelas = Kelas::all();
        //$jumlahPertemuan = Pertemuan::all();
        

        return view('admin.dashboard', 
        ['jumlahMahasiswa' => $jumlahMahasiswa],  
        ['jumlahKelas' => $jumlahKelas],
        // ['jumlahpertemuan' => $jumlahPertemuan],
        
        );
        //$jumlahMahasiswa = DB::table('mahasiswa')->count();
    
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
            'nim' => 'required|size:10|unique:users,username',
            'email' => 'required|unique:users,email',
        ], [
            'nama.required' => 'Nama tidak boleh kosong',
            'nim.required' => 'NIM tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
        ]);

        $user = new User();
        $user->role = 'mahasiswa';
        $user->username = $request->nim;
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->password = bcrypt(request('nim'));
        $user->remember_token = str_random(60);
        $user->save();

        $mahasiswa = new Mahasiswa();
        $mahasiswa->id = $user->id;
        $mahasiswa->nama = $request->nama;
        $mahasiswa->nim = $request->nim;
        $mahasiswa->email = $request->email;
        $mahasiswa->save();
        return redirect('/mahasiswa')->with('status', 'Data Mahasiswa Berhasil Ditambahkan');
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
    public function edit($id)
    {
        $data_mahasiswa = DB::table('mahasiswa') 
        -> join ('users',  'users.id', '=', 'mahasiswa.id')
        ->select('mahasiswa.id','mahasiswa.nama','mahasiswa.nim', 'mahasiswa.email')        
        ->where('mahasiswa.id', '=', $id)         
        ->get();
        return view('admin.mahasiswa.edit', compact('data_mahasiswa'));

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
        $u = User::find($id);
        $request->validate([
            'nama' => 'required',
            'nim' => 'required|unique:users,username,'.$u->id.',id', 
            'email' => 'required|unique:users,email,'.$u->id.',id', 
            //'tipe' => 'required',
            // 'password' => 'required',
        ], [
            'nama.required' => 'Nama tidak boleh kosong',
            'nim.required' => 'NIM tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            //'tipe.required' => 'Tipe tidak boleh kosong',
            // 'password.required' => 'Password tidak boleh kosong',
        ]);

        if($request->isMethod('post')){
         
            $data_mahasiswa = $request->all();
            $user = User::find($id);
            $user = User::where('id',$id)->first();
            $user->username = $data_mahasiswa['nim'];
            $user->name = $data_mahasiswa['nama'];
            $user->email = $data_mahasiswa['email'];
            $user->save();

            $mahasiswa = Mahasiswa::find($id);
            $mahasiswa = Mahasiswa::where('id',$id)->first();
            $mahasiswa->nama = $data_mahasiswa['nama'];
            $mahasiswa->nim = $data_mahasiswa['nim'];
            $mahasiswa->email = $data_mahasiswa['email'];
            $mahasiswa->save();
            // $users->push();


            //$user->mahasiswa()->where('id', $id)->update(['name'=>$data_mahasiswa['nama'], 'username'=>$data_mahasiswa['nim'], 'email'=>$data_mahasiswa['email'],'nama'=>$data_mahasiswa['nama'], 'nim'=>$data_mahasiswa['nim'], 'email'=>$data_mahasiswa['email']]);
            //Mahasiswa::where(['id'=> $id])->update(['nama'=>$data_mahasiswa['nama'], 'nim'=>$data_mahasiswa['nim'], 'email'=>$data_mahasiswa['email']]);
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
    public function destroy($id)
    {
        // Mahasiswa::destroy($mahasiswa->mahasiswa_id);
        User::findOrFail($id)->delete();
        return redirect('/mahasiswa')->with('status', 'Data Mahasiswa Berhasil Dihapus');

    }

}