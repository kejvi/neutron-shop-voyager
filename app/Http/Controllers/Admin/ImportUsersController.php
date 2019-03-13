<?php

namespace  App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Article;
use App\Branch;
use App\Client;
use App\Hshpikat;
use function GuzzleHttp\Psr7\try_fopen;
use Voyager;
use  Auth;
use DB;
use Carbon\Carbon;
use Validator;

class ImportUsersController extends  \TCG\Voyager\Http\Controllers\Controller
{


    public  function  import() {
        $user = Auth::user();
        if ($user){
            if ($user->id !== 1){
                abort(403);
            }
        }else{
            abort(403);
        }
        return view('users.index');
    }


    public  function upload(Request $request) {
        $user = Auth::user();

        if ($user){
            if ($user->id !== 1){
                abort(403);
            }
        }else{
            abort(403);
        }
        $this->validate($request,[
            'file' => 'required|mimes:csv,txt'
        ]);



        if (($handle = fopen($_FILES['file']['tmp_name'], "r")) !== false)
        {
            fgetcsv($handle);
            while(($data = fgetcsv($handle, 100000, ",")) !== false) {

                //gjej id e pikes postare sipas kodit perkates
                $office = DB::table('offices')->where('postal_code', '=', $data[3])->first();
                if ($office)
                {
                    $branch = Branch::where('id', $office->branch_id)->first();

                }else{
                    dd($data[3]);
                }
                $emri = $data[0];
                $mbiemri = $data[1];
                $role_id = $data[4];

                $user = new User();
                $user->name = strtolower($emri . " ". $mbiemri);
                $user->role_id = 11;
                $user->username = $string = preg_replace('/\s+/', '', strtolower($emri . ".". $mbiemri));
                $user->email = $emri . $mbiemri ."@neutron.al";
                $user->password = bcrypt("pass1234.");

                switch ($role_id) {
                    case 3:
                        $user->office_id = $office->id;
                        break;
                    case 4:
                        $user->office_id = $office->id;
                        break;
                    case 5:
                        $user->branch_id = $office->branch_id;
                        break;
                    case 6:
                        $user->site_id = $branch->site_id;
                    case 7:
                        $user->site_id = $branch->site_id;
                    default:
                        break;
                }

                $existingUser = User::where('username', $user->username)->first();


                if ($existingUser)
                {
//                    dd($existingUser);
                    switch ($role_id) {
                        case 3:
                            $existingUser->office_id = $office->id;
                            break;
                        case 4:
                            $existingUser->office_id = $office->id;
                            break;
                        case 5:
                            $existingUser->branch_id = $office->branch_id;
                            break;
                        case 6:
//                            dd('ajkasbdjklbdsfjklh');
                            $existingUser->site_id = $branch->site_id;
                        default:
                            break;
                    }
                    $existingUser->save();
                    DB::insert('insert into user_roles (user_id, role_id) values (?, ?)', [$existingUser->id, $role_id]);
                }else{
                    $user->save();
                    DB::insert('insert into user_roles (user_id, role_id) values (?, ?)', [$user->id, $role_id]);
                }


            }


        }
        return redirect()->route('voyeager.import-users')
            ->with('message', 'Perdoruesit u regjistruan  me sukses');
    }
}
