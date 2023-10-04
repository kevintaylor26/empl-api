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
        
        foreach($marketings as $marketing) {
            if($marketing->linkedin_url) {
                logger()->info($marketing->linkedin_url . " checking......");
                $client = new Client(HttpClient::create(['timeout' => 60]));
                $crawler = $client->request('GET', $marketing->linkedin_url, [
                    'allow_redirects' => true
                ]);
                // $crawler = $client->waitFor('.evi-image');
                $crawler->filter('.evi-image')->each(function ($node) {
                    if($node->getNode(0)->getAttribute('src')) {
                        logger()->info("$marketing->linkedin_url avatar url is " . $node->getNode(0)->getAttribute('src'));
                        $marketing->avatar_url = $node->getNode(0)->getAttribute('src');
                    }
                });
                $marketing->save();
                logger()->info("FINISHED   " . $marketing->linkedin_url . " checking......");
            }
        }
        return CommandAlias::SUCCESS;
    }
}
