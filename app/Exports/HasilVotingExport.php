<?php

namespace App\Exports;

use App\Models\Voting;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class HasilVotingExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Voting::select('kandidat_id', DB::raw('count(*) as total_suara'))
            ->groupBy('kandidat_id')
            ->get();
    }
}
