<?php

namespace App\Console\Commands;

use App\Models\Authority;
use App\Models\Establishment;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class UpdateDatabaseFromApiFHRS extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'updateDatabase:fromApiFHRS';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate database getting data from API FHRS';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->populateAuthorities();

        $this->populateEstablishments();
    }

    public function populateEstablishments()
    {
        $this->info('Starting creating and updating Establishments');

        $header = (array) config('api.FHRS_header');

        $authorities = Authority::withCount('establishments')->orderBy('establishments_count')->get();

        $j = 1;
        foreach ($authorities as $authority) {
            try {
                $establishments_src = Http::withHeaders($header)->get(config('api.FHRS').'/establishments?localAuthorityId='.$authority->id)->json();

                $this->info(PHP_EOL.$j.'. Get Establishment - localAuthorityId: '.$authority->id.' - '.$authority->name.' |--------------------------------');

                $i = 1;
                foreach ($establishments_src['establishments'] as $establishment_src) {
                    $establishment_src['id'] = $establishment_src['FHRSID'];
                    $establishment_src['authority_id'] = $authority->id;
                    $establishment_src['business_name'] = $establishment_src['BusinessName'];
                    $establishment_src['business_type'] = $establishment_src['BusinessType'];
                    $establishment_src['address_line_1'] = $establishment_src['AddressLine1'];
                    $establishment_src['address_line_2'] = $establishment_src['AddressLine2'];
                    $establishment_src['address_line_3'] = $establishment_src['AddressLine3'];
                    $establishment_src['postcode'] = $establishment_src['PostCode'];
                    $establishment_src['rating_value'] = $establishment_src['RatingValue'];

                    $establishment = Establishment::find($establishment_src['id']);

                    if (!$establishment) {
                        $establishment = Establishment::withTrashed()->whereId($establishment_src['id'])->first();

                        if (!$establishment) {
                            $a = Establishment::create($establishment_src);
                            $this->info($i.'. '.$authority->name.' - Created Establishment - business_name: '.$a->business_name);
                        } else {
                            $establishment = $establishment->restore();
                            $this->info($i.'. '.$authority->name.' - Restored Establishment - business_name: '.$establishment_src['business_name']);
                        }
                    } else {
                        $establishment->fill($establishment_src);
                        $establishment = $establishment->update();
                        $this->info($i.'. '.$authority->name.' - Updated Establishment - business_name: '.$establishment_src['business_name']);
                    }
                    ++$i;
                }

                $this->info('Starting remove old authorities');

                $establishments = Establishment::where('authority_id', $authority->id)->get();
                $ids_src = array_column($establishments_src['establishments'], 'FHRSID');

                $y = 1;
                foreach ($establishments as $establishment) {
                    if (!in_array($establishment->id, $ids_src)) {
                        $this->info($y.'. '.$authority->name.' - Removed old establishment - name: '.$establishment->business_name);
                        $establishment->delete();
                    }
                    ++$y;
                }
            } catch (\Exception $e) {
                $this->info($y.'. Error trying to access api.ratings.food.gov.uk');
            }

            ++$j;
        }
    }

    public function populateAuthorities()
    {
        $this->info('Starting creating and updating authorities');

        $header = (array) config('api.FHRS_header');

        $authorities_src = Http::withHeaders($header)->get(config('api.FHRS').'/authorities')->json();

        $i = 1;
        foreach ($authorities_src['authorities'] as $authority_src) {
            $authority_src['id'] = $authority_src['LocalAuthorityId'];
            $authority_src['name'] = $authority_src['Name'];
            $authority_src['local_authority_id_code'] = $authority_src['LocalAuthorityIdCode'];
            $authority_src['region_name'] = $authority_src['RegionName'];

            $authority = Authority::find($authority_src['id']);

            if (!$authority) {
                $authority = Authority::withTrashed()->whereId($authority_src['id'])->first();

                if (!$authority) {
                    $a = Authority::create($authority_src);
                    $this->info($i.'. Created Authority - name: '.$a->name);
                } else {
                    $authority = $authority->restore();
                    $this->info($i.'. Restored Authority - name: '.$authority->name);
                }
            } else {
                $authority->fill($authority_src);
                $authority = $authority->update();
                $this->info($i.'. Updated Authority - name: '.$authority_src['name']);
            }
            ++$i;
        }

        $this->info('Starting remove old authorities');

        $authorities = Authority::all();
        $ids_src = array_column($authorities_src['authorities'], 'LocalAuthorityId');

        $y = 1;
        foreach ($authorities as $authority) {
            if (!in_array($authority->id, $ids_src)) {
                $this->info($y.'. Removed old Authority - name: '.$authority->name);
                $authority->delete();
            }
            ++$y;
        }
    }
}
