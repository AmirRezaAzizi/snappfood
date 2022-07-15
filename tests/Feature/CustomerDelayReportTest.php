<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Modules\DelayReport\Interfaces\DelayReportRepositoryInterface;
use Modules\Order\Entities\Order;
use Modules\Order\Repositories\RedisDelayQueueRepository;
use Tests\TestCase;

class CustomerDelayReportTest extends TestCase
{
    private RedisDelayQueueRepository $delayReportRepository;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        $this->delayReportRepository = app(RedisDelayQueueRepository::class);

        parent::__construct($name, $data, $dataName);

    }

    public function test_report_before_order_delivery_time()
    {
        $order = Order::factory()->create([
            'delivery_time' => now()->addMinutes(30)
        ]);

        $response = $this->post('api/customer/delay-report', ['order_id' => $order->id]);

        $response->assertStatus(403);

        $this->assertDatabaseMissing('delay_reports', ['order_id' => $order->id]);

        $queue = $this->delayReportRepository->getList();

        $this->assertFalse(in_array($order->id, $queue));
    }

    public function test_report_when_order_has_trip()
    {
        $order = $this->createOrderAndTrip(now()->subMinutes(30), 'assigned');

        $response = $this->post('api/customer/delay-report', ['order_id' => $order->id]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('delay_reports', ['order_id' => $order->id, 'status' => 'new_estimated']);

        $queue = $this->delayReportRepository->getList();

        $this->assertFalse(in_array($order->id, $queue));
    }

    public function test_report_when_order_has_trip_with_status_delivered()
    {
        $order = $this->createOrderAndTrip(now()->subMinutes(30), 'delivered');

        $response = $this->post('api/customer/delay-report', ['order_id' => $order->id]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('delay_reports', ['order_id' => $order->id, 'status' => 'pending']);

        $queue = $this->delayReportRepository->getList();

        $this->assertTrue(in_array($order->id, $queue));
    }

    public function test_report_when_order_is_already_queued()
    {
        $order = $this->createOrderAndTrip(now()->subMinutes(30), 'delivered');

        // first time
        $response1 = $this->post('api/customer/delay-report', ['order_id' => $order->id]);
        $response1->assertStatus(200);

        // second time
        $response2 = $this->post('api/customer/delay-report', ['order_id' => $order->id]);
        $response2->assertStatus(409);
    }
}
