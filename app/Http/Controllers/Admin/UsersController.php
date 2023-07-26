<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user =$user;
       
    }

    public function index()
    {
        // withTrashed() include the soft deleted records
        $all_users = $this->user->withTrashed()->latest()->paginate(3);
        return view('admin.users.index')->with('all_users', $all_users);
    }

   public function deactivate($id)
   {
    // This will soft delete a user. In User.php, we used SoftDeletes; therefore, all users that will be deleted/destroyed are only soft deleted
        $this->user->destroy($id);
        return redirect()->back();
   }

   public function activate($id)
    {
        // onlyTtrashed() select the soft deleted records only
        // restore() reverses the soft delete / deleted_ar column will become NULL
        $this->user->onlyTrashed()->findOrFail($id)->restore();
        return redirect()->back();
   }
}
