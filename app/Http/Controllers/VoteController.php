<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    public function vote(Request $request, Complaint $complaint)
    {
        $request->validate([
            'type' => 'required|in:upvote,downvote',
        ]);

        $user = Auth::user();

        // Check if the user has already voted on this complaint
        $existingVote = Vote::where('user_id', $user->id)
                            ->where('complaint_id', $complaint->id)
                            ->first();

        if ($existingVote) {
            // If the vote type is different, update to the new type
            if ($existingVote->type != $request->type) {
                $existingVote->type = $request->type;
                $existingVote->save();
            }
        } else {
            // Create a new vote
            Vote::create([
                'user_id' => $user->id,
                'complaint_id' => $complaint->id,
                'type' => $request->type,
            ]);
        }

        $upvotes = $complaint->upvotes()->count();
        $downvotes = $complaint->downvotes()->count();
        $userVote = $request->type;

        return response()->json([
            'success' => true,
            'upvotes' => $upvotes,
            'downvotes' => $downvotes,
            'userVote' => $userVote
        ]);
    }
}
