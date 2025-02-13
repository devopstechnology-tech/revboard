<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Module\Board\Board;
use App\Models\Module\Meeting\Meeting;
use App\Notifications\NewMeetingNotification;



class MeetingObserver
{
    /**
     * Handle the Meeting "created" event.
     */
    public function created(Meeting $meeting): void
    {
        //
    }

    /**
     * Handle the Meeting "updated" event.
     */
    public function updated(Meeting $meeting): void
    {
        if ($meeting->wasChanged()) {
            $isUpdate = $meeting->isUpdate;
            $meetingable = $meeting->meetingable;

            // Notify the members
            $this->notifyMeetingMembers($meeting, $meetingable, $isUpdate, $meeting->tempUserIds);
        }
    }

    /**
     * Handle the Meeting "deleted" event.
     */
    public function deleted(Meeting $meeting): void
    {
        //
    }

    /**
     * Handle the Meeting "restored" event.
     */
    public function restored(Meeting $meeting): void
    {
        //
    }

    /**
     * Handle the Meeting "force deleted" event.
     */
    public function forceDeleted(Meeting $meeting): void
    {
        //
    }
    private function notifyMeetingMembers(Meeting $meeting, $meetingable, $isUpdate, array $userIds)
    {
        $users = User::whereIn('id', $userIds)->get();
        foreach ($users as $user) {
            // Dynamically pass either Board or Committee instance
            $user->notify(new NewMeetingNotification($meetingable, $meeting, $isUpdate));
        }
    }
}