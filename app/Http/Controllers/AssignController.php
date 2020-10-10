<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Setup;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAssignmentsRequest;

class AssignController extends Controller
{
    public function entry($hash = null) {

        if ($hash) {
            $data = DB::table('assignments')
                      ->join('setups', 'assignments.setup_id', '=', 'setups.id')
                      ->where('setups.hash', $hash)
                      ->get(['assigned', 'name']);

            $assignables = $this->sortCollection('assigned', $data);
            $assignees = $this->sortCollection('name', $data);
        }

        return view ('entry', [
                            'hash' => $hash,
                            'assignables' => isset($assignables) ? $assignables : '',
                            'assignees' => isset($assignees) ? $assignees : ''
                        ]);
    }

    protected function sortCollection($field, $collection) {
        $data = $collection->pluck($field)->toArray();
        sort($data);
        return implode(",", $data);
    }

    public function setup(StoreAssignmentsRequest $request) {
        if (!isset($r['hash'])) {
            $setup = Setup::create([
                'hash' => Str::random(10)
            ]);
        } else {
            $setup = Setup::where('hash', $r['hash'])
                       ->first();
        }

        DB::table('assignments')
          ->where('setup_id', $setup->id)
          ->delete();

        $inserts = $this->assign(explode(",", $request->assignables), explode(",", $request->assignees), $setup->id);
        DB::table('assignments')->insert($inserts);

        return redirect("/assignments/{$setup->hash}/outcome");
    }

    protected function assign($assignables, $assignees, $setup_id) {
        foreach ($assignables as $assignable) {
            $assignee_ref = rand(0, count($assignees)-1);
            $inserts[] = [
                            'setup_id' => $setup_id,
                            'assigned' => trim($assignable),
                            'name' => trim($assignees[$assignee_ref])
            ];

            array_splice($assignees, $assignee_ref, 1);
        }
        return $inserts;
    }

    public function outcome($hash) {
        $results = DB::table('setups')
                     ->where('hash', $hash)
                     ->join('assignments', 'setups.id', '=', 'assignments.setup_id')
                     ->pluck('assigned', 'name');

        return view('organiser', ['results' => $results, 'hash' => $hash]);
    }
}
