<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Redis;
use App\Models\Order;
use App\Repositories\RedisDelayQueueRepository;
use Tests\TestCase;

class AgentDelayReportTest extends TestCase
{
    private RedisDelayQueueRepository $delayReportRepository;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        $this->delayReportRepository = app(RedisDelayQueueRepository::class);

        parent::__construct($name, $data, $dataName);

    }

    public function test_agent_get_order_to_check()
    {
        // flush redis
        Redis::flushDB();

        $order = Order::factory()->create([
            'delivery_time' => now()->subMinutes(30)
        ]);

        $response = $this->post('api/customer/delay-report', ['order_id' => $order->id]);

        $response->assertStatus(200);

        $response = $this->get('api/agent/delay-report');

        $response->assertStatus(200);

        $orderId = $response->json()['data']['id'];

        $this->assertTrue($orderId == $order->id);
    }

    public function test_agent_cannot_get_order_when_already_has_one()
    {
        // first time
        $this->test_agent_get_order_to_check();

        // second time
        $response = $this->get('api/agent/delay-report');

        $response->assertStatus(403);
    }
}
