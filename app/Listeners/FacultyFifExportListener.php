<?php

namespace App\Listeners;

use App\Exports\FacultyExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class FacultyFifExportListener implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $archiveFile = storage_path('app/fif/fif.zip');
        // $zip_file = 'fif.zip'; // Name of our archive to download

        // Initializing PHP class
        $zip = new \ZipArchive();
        $zip->open( $archiveFile, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        // Adding file: second parameter is what will the path inside of the archive
        // So it will create another folder called "storage/" inside ZIP, and put the file there.
        foreach($event->users as $user) {
            Excel::store(new FacultyExport($user), 'fif/'.str_slug($user->name).'-FacultyInformation.xlsx');
            // $file = (new FacultyExport($user))->store('fif/'.str_slug($user->name).'-FacultyInformation.xlsx');
            $zip->addFile(storage_path('app/fif/'.str_slug($user->name).'-FacultyInformation.xlsx'), str_slug($user->name).'-FacultyInformation-' . time() . '.xlsx');
        }

        $zip->close();
        // return response()->download(base_path('fif.zip'));
        // We return the file immediately after download
        // return response()->store($zip_file);
    }
}
