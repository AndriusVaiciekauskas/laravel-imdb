<?php

namespace App\Services;

class VisitService
{
    public function count($object)
    {
        $visits = $object->visits()->first();

        if ($visits === null) {
            $object->visits()->create(['visit_count' => 1]);
        } else {
            $object->visits()->update(['visit_count' => $visits->visit_count + 1]);
        }
    }
}