<?php

declare(strict_types=1);

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Subscriber;
use App\Enums\Status;

class EmailSubscribtionJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected $email;
    protected $name;

    /** Create a new job instance. */
    public function __construct(string $email, string $name)
    {
        $this->email = $email;
        $this->name = $name;
    }

    /** Execute the job. */
    public function handle()
    {
        Subscriber::firstOrCreate(
            ['email' => $this->email],
            [
                'name'   => $this->name,
                'tag'    => 'participant',
                'status' => Status::ACTIVE,
            ]
        );
    }
}
