<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Sourcetoad\EnhancedResources\Formatting\Attributes\Format;
use Sourcetoad\EnhancedResources\Formatting\Attributes\IsDefault;

class PollResource extends BaseResource
{
    #[Format, IsDefault]
    public function base(): array
    {
        return [
            'id' => $this->resource->getRouteKey(),
            'meeting_id' => $this->resource->meeting_id,
            'meeting' => $this->resource->meeting,
            'board_id' => $this->resource->board_id,
            'board' => $this->resource->board,
            'committee_id' => $this->resource->committee_id,
            'committee' => $this->resource->committee,
            'question' => $this->resource->question,
            'description' => $this->resource->description,
            'questionoptiontype' => $this->resource->questionoptiontype,
            'optionstatus' => $this->resource->optionstatus,
            'duedate' => $this->resource->duedate,
            'assigneetype' => $this->resource->assigneetype,
            'assigneestatus' => $this->resource->assigneestatus,
            'status' => $this->resource->status,
            'options' => $this->resource->options,
            'votes' => $this->resource->votes,
            // 'memberships' => $this->resource->memberships,
            'pollassignees' => $this->resource->pollassignees->map(function ($pollassignee) {
                // dd($pollassignee);
                return [
                    'id' => $pollassignee->id, // Accessing pivot data
                    'assignable' => [
                        'type' => class_basename($pollassignee->assignable_type),  // Extracts simple class name
                        'details' => $pollassignee->assignable,
                    ], // Accessing pivot data
                    'poll_id' => $pollassignee->poll_id,
                    'user' => [
                        'id' =>  $pollassignee->assignable->user->id,
                        'full_name' =>  $pollassignee->assignable->user->full_name,
                    ],
                ];
            }),
        ];
    }

    #[Format('short')]
    public function short(): array
    {
        return [
            // Short resource fields here
        ];
    }
}
