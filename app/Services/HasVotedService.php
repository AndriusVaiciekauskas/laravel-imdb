<?php

namespace App\Services;

class HasVotedService
{
    public function hasVoted($user, $movie)
    {
        if ($user !== null && $user->ratings()->where('movie_id', $movie->id)->first()) {
            return true;
        }
        return false;
    }
}