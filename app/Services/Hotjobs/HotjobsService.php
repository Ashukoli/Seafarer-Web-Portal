<?php
// app/Services/Hotjobs/HotjobsService.php
namespace App\Services\Hotjobs;

use App\Models\Hotjob;

class HotjobsService
{
    public function list($filters = [])
    {
        $query = Hotjob::with(['company', 'rank', 'ship']);

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }
        if (!empty($filters['company_id'])) {
            $query->where('company_id', $filters['company_id']);
        }

        return $query->orderByDesc('created_at')->paginate(25);
    }

    public function create(array $data)
    {
        return Hotjob::create($data);
    }

    public function update(Hotjob $hotjob, array $data)
    {
        $hotjob->update($data);
        return $hotjob;
    }

    public function validateHotjob(Hotjob $hotjob)
    {
        $hotjob->status = 'active';
        $hotjob->save();
        return $hotjob;
    }

    public function delete($id, $companyId)
    {
        $hotjob = Hotjob::where('id', $id)->where('company_id', $companyId)->firstOrFail();
        return $hotjob->delete();
    }
}
