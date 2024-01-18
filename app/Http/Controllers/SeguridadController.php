<?php

namespace App\Http\Controllers;

use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SeguridadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      /*$disk = Storage::disk(config('laravel-backup.backup.destination.disks')[0]);

      $files = $disk->files(config('laravel-backup.backup.name'));
      $backups = [];
      // make an array of backup files, with their filesize and creation date
      foreach ($files as $k => $f) {
        // only take the zip files into account
        if (substr($f, -4) == '.zip' && $disk->exists($f)) {
          $backups[] = [
            'file_path' => $f,
            'file_name' => str_replace(config('laravel-backup.backup.name') . '/', '', $f),
            'file_size' => $disk->size($f),
            'last_modified' => $disk->lastModified($f),
          ];
        }
      }
      // reverse the backups, so the newest one would be on top
      $backups = array_reverse($backups);*/

      //return response(view('content.seguridad.index', compact('backups')));
      return response(view('content.seguridad.index'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create()
    {
      Artisan::call('backup:run',['--only-db'=>true]);
      dd(Artisan::output());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
