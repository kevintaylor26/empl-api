<?php

namespace App\Console\Commands;

use App\Models\Marketings;
use App\Services\ReportServices;
use Carbon\Carbon;
use Goutte\Client;
use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as CommandAlias;
use Symfony\Component\HttpClient\HttpClient;

class GetAvatarUrlCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'GetAvatarUrlCommand';

    /**
     * @var string
     */
    protected $description = 'GetAvatarUrlCommand';

    /**
     * @return int
     */
    public function handle(): int
    {
        $marketings = Marketings::whereNull('avatar_url')
            ->whereNotNull('linkedin_url')
            ->get();
        $client = new Client(HttpClient::create(['timeout' => 60]));
        foreach($marketings as $marketing) {
            if($marketing->linkedin_url) {
                $crawler = $client->request('GET', $marketing->linkedin_url);
                $crawler = $client->waitFor('#');
                $crawler->filter('img')->each(function ($node) {
                    logger()->info('img => src="'.$node->getNode(0)->getAttribute('src')."\" <br/>\n";);
                });
            }
        }
        return CommandAlias::SUCCESS;
    }
}
