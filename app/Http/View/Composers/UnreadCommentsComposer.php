<?php
namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Comment;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UnreadCommentsComposer
{
    public function compose(View $view)
    {
        $user = Auth::user();
        $unreadComments = 0;

        if(!$user){
            return;
        }

        $query = Comment::query()
            ->where('is_read', false)
            ->where('user_id', '!=', $user->id) // not written by self
            ->whereHas('user.roles', function ($q) use ($user) {
                // Comments made by someone else
                $q->whereNotIn('name', $user->getRoleNames());
            });

        if ($user->hasRole('user')) {
            $query->whereHas('ticket', function ($q) use ($user) {
                $q->where('user_id', $user->id); // tickets owned by user
            });
        } elseif ($user->hasRole('support')) {
            $query->whereHas('ticket', function ($q) use ($user) {
                $q->where('assigned_user_id', $user->id); // assigned to support
            });
        } elseif ($user->hasRole('superadmin')) {
            $query = Comment::where('is_read', false)
                ->whereHas('user.roles', function ($q) {
                    $q->whereIn('name', ['user', 'support']);
                });
        }

        $unreadComments = $query->count();

        // if ($user->hasRole('superadmin')) {
        //     $unreadComments = Comment::where('is_read', false)
        //         ->whereHas('user.roles', function ($q) {
        //             $q->whereIn('name', ['user', 'support']);
        //         })
        //         ->count();
        // } elseif ($user->hasRole('user')) {
        //     $unreadComments = Comment::where('is_read', false)
        //         ->whereHas('user.roles', function ($q) {
        //             $q->whereIn('name', ['superadmin', 'support']);
        //         })
        //         ->count();
        // } elseif ($user->hasRole('support')) {
        //     $unreadComments = Comment::where('is_read', false)
        //         ->whereHas('user.roles', function ($q) {
        //             $q->whereIn('name', ['superadmin', 'user']);
        //         })
        //         ->count();
        // }

        $view->with('unreadComments', $unreadComments);
    }
}
