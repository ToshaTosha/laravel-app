<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Post;

class PublishScheduledContent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:publish-scheduled-content';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $posts = Post::where('scheduled_publish_time', '<=', Carbon::now())
            ->where('is_published', false)
            ->get();

        foreach ($posts as $post) {
            $post->is_published = true;
            $post->save();
        }

        $this->info('Scheduled content published successfully.');
    }
}
