<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManageUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index', [
            'title' => 'Users List',
            'users' => User::withTrashed()->where('is_admin', false)->get()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): RedirectResponse
    {
        User::findOrFail($id)->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted');
    }

    public function forceDestroy($id): RedirectResponse
    {
        User::onlyTrashed()->findOrFail($id)->forceDelete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted permanantly');
    }

    public function restore($id): RedirectResponse
    {
        User::onlyTrashed()->findOrFail($id)->restore();

        return redirect()->route('admin.users.index')->with('success', 'User restored');
    }

    public function removeDuplicates(): RedirectResponse
    {
        // $users = User::select('email', DB::raw('count(`email`) as emails'))
        // ->groupBy('email')
        // ->having('emails', '>', 1)
        // ->get();

        // User::whereIn('name', $users->pluck('email'))->each(function ($user) {
        //     User::where('name', $activity->name)->where('id', '!=', $user->id)->delete();
        // });

        $allUsers = User::where('is_admin', false)->get()->map->only(['email', 'id']);

        if (count($allUsers) > 1) {

            $uniqueUsers = [];

            foreach ($allUsers as $user) {
                if (in_array($user['email'], $uniqueUsers)) {
                    User::where('id', $user['id'])->forceDelete();
                } else {
                    array_push($uniqueUsers, $user['email']);
                }
            }

            return redirect()->route('admin.users.index')->with('success', 'Duplicate User Deleted');
        } else {
            return redirect()->route('admin.users.index')->with('error', 'No Duplicate Data available!!!!');
        }
    }
}
