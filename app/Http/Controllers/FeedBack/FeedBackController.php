<?php

namespace App\Http\Controllers\FeedBack;
use App\Http\Controllers\Controller;
use App\Models\FeedBearPost;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Monitors;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use App\Services\PwaNotificationService;
use App\Models\User;

//Controller for DNS
class FeedBackController extends Controller
{
    public function FeedBearResponse(Request $request)
    {
            $token = $request->header('token'); 
            $expectedToken = env('FEEDBEAR_WEBHOOK_TOKEN'); 
            
            // Log::info('FeedBear Webhook Token: ' . $token);
            // Log::info('Expected Token: ' . $expectedToken);

            if ($token !== $expectedToken) {
                //  Log::warning('Invalid FeedBear token received', ['token' => $token]);
                return response()->json(['message' => 'Invalid token'], 401);
            }

            $data = $request->all();
            // Log::info('FeedBear POST Data: ' . json_encode($data, JSON_PRETTY_PRINT));

            switch($data['event_name']){
                case 'post_new':
                    $this->handleNewPost($data['payload']);
                    break;
                // case 'post_upvotes':
                //     $this->handlePostUpvote($data['payload']);
                //     break;
            }
            return response()->json(['message' => 'success']);
    }

    protected function handleNewPost(array $payload)
    {
        $feedback = FeedBearPost::updateOrCreate(
            ['post_id' => $payload['post_id']],
            [
                'board_id' => $payload['board_id'],
                'board_name' => $payload['board_name'],
                'title' => $payload['post_title'],
                'content' => $payload['post_content'],
                'author_name' => $payload['author_name'],
                'author_email' => $payload['author_email'],
                'url' => $payload['post_url'],
                'attachments' => $payload['attachments'],
                'created_at' => $payload['created'],
            ]
        );

        $superAdmin = User::role('superadmin')->first();

        if (!$superAdmin) {
            return response()->json(['message' => 'No super admin found'], 404);
        }
        
        app(PwaNotificationService::class)->sendToUser(
            $superAdmin->id,
            'New Feature Request',
            "{$feedback->author_name} has submitted a new feature request: {$feedback->title}",
            "/feedback"
        );
        

    }

    public function showFeatureRequests()
    {
        $feedbearPosts = FeedBearPost::orderBy('created_at', 'desc')->paginate(10);
        return view('feedbear.feature-requests', compact('feedbearPosts'));
    }
   
    public function filter(Request $request)
{
    $query = FeedBearPost::query();

    if ($request->search) {
        $query->where('title', 'like', '%' . $request->search . '%')
              ->orWhere('content', 'like', '%' . $request->search . '%');
    }

    if ($request->start_date && $request->end_date) {
        $query->whereBetween('created_at', [
            Carbon::createFromFormat('d-m-Y', $request->start_date)->startOfDay(),
            Carbon::createFromFormat('d-m-Y', $request->end_date)->endOfDay()
        ]);
    }

    $order = $request->order === 'asc' ? 'asc' : 'desc';
    $posts = $query->orderBy('created_at', $order)->paginate(6); // paginated

    return response()->json($posts);
}

}
