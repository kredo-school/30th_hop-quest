<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    private $user;
    
    public function __construct(User $user){
        $this->user = $user;
    }

    public function indexApplied(Request $request){

        $query = User::where('role_id', '!=', 3);
        $sort = $request->input('sort', 'latest');

        if ($sort === 'latest') {
            $query->orderBy('updated_at', 'desc');
        } else { // oldest or default
            $query->orderBy('updated_at', 'asc');
        }

        $applied_users = $this->user->withTrashed()->whereIn('official_certification',[2,3])->paginate(10);
        
        return view('admin.users.appliedusers')->with('applied_users', $applied_users);       
    } 

    public function index(Request $request){
        $query = User::where('role_id', '!=', 3);
        $sort = $request->input('sort', 'latest');

        if ($sort === 'latest') {
            $query->orderBy('created_at', 'desc');
        } else { // oldest or default
            $query->orderBy('created_at', 'asc');
        }

    $users = $query->paginate(10);
        return view('admin.users.allusers', compact('users'));       
    } 


    public function certify(Request $request, User $user){
    $action = $request->input('action');

    switch ($action) {
        case 'approve':
            $user->official_certification = 3;
            break;
        case 'reject':
        case 'revoke':
            $user->official_certification = 1;
            break;
        default:
            abort(400, 'Invalid action.');
    }



    $user->save();

    return redirect()->back();
}


    public function deactivate($id){
        $this->user->destroy($id);
        return redirect()->back();
    }

    public function activate($id){
        $this->user->onlyTrashed()->findOrFail($id)->restore();
        //restore() -- restores a soft-deleted record
        //  onlyTrashed() -- get only soft-deleted records
        return redirect()->back();
    }
}
