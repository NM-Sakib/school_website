<?php

namespace App\Console\Commands;
use App\Models\Transaction;
use App\Models\StatusNotification;
use App\Models\Heartbeat;
use App\Models\BootNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Ratchet\Client\Connector;
use React\EventLoop\Factory as LoopFactory;

use MrShan0\PHPFirestore\FirestoreClient;
use MrShan0\PHPFirestore\Attributes\FirestoreDeleteAttribute;

class ListenWebSocket extends Command
{
    protected $signature = 'websocket:listen';
    protected $description = 'Listen to WebSocket server';

    public function handle()
    {
        $firestoreClient = new FirestoreClient('b-charge-e5574', 'AIzaSyB3tTHPDNzGJfN4xjV-W0zv5iIS9ueo2_8', [
            'database' => '(default)',
        ]);
        $loop = LoopFactory::create();
        $connector = new Connector($loop);
        // WebSocket URL without identity in the path | live ip ws://143.198.91.232:9000
        $connector("ws://143.198.91.232:9000/ocpp/A7F2X9")->then(function($conn) use ($firestoreClient) {
            // Send the identity and status after the connection is established

            $conn->on('message', function($msg) use ($firestoreClient, $conn) {

                $collection = 'transactions/';

                $action = json_decode($msg, true);
                if($action["event"] === "StartTransaction"){
                    //entry start transaction
                    $firestoreClient->updateDocument($collection.$action['transactionId'], [
                        'status' => 'Charging',
                        'startTimestamp' => Carbon::now()->timestamp,
                        'meterStart' => $action["meterStart"],
                    ], true);
                    $start_arr = [
                        'status' => 'Charging',
                        'meterStart'=>$action["meterStart"],
                        'startTimestamp'=>Carbon::now()
                    ];
                    Transaction::where('transactionId',$action['transactionId'])->update($start_arr);

                }else if($action["event"] === "StopTransaction"){
                    //entry stop transaction
                    $firestoreClient->updateDocument($collection.$action['transactionId'], [
                        'status' => 'Finished',
                        'stopTimestamp' => Carbon::now()->timestamp,
                        'meterStop' => $action["meterStop"],
                    ], true);
                    $stop_arr = [
                        'status' => 'Finished',
                        'meterStop'=>$action["meterStop"],
                        'stopTimestamp'=>Carbon::now()
                    ];
                    Transaction::where('transactionId',$action['transactionId'])->update($stop_arr);
                }else if($action["event"] === "StatusNotification"){
                    //entry status notification
                    $notification_arr = [
                        'identity' => $action["identity"],
                        'status' => $action["status"],
                        'connectorId'=>$action["connectorId"],
                        'errorCode'=>$action["errorCode"],
                        'timestamp'=>Carbon::now()
                    ];
                    StatusNotification::create($notification_arr);
                }else if($action["event"] === "BootNotification"){
                    //entry Boot notification
                    $bootNotification_arr = [
                        'identity' => $action["identity"],
                        'chargePointVendor' => $action["chargePointVendor"],
                        'chargePointModel' => $action["chargePointModel"],
                        'chargePointSerialNumber' => $action["chargePointSerialNumber"],
                        'firmwareVersion' => $action["firmwareVersion"],
                        'date_time'=>Carbon::now()
                    ];
                    BootNotification::create($bootNotification_arr);
                }else if($action["event"] === "Heartbeat"){
                    //entry Heartbeat
                    Heartbeat::updateOrCreate(
                        ['identity' => $action["identity"]],
                        [
                            'identity' => $action["identity"],
                            'date_time'=>Carbon::now()
                        ]
                    );
                }

                echo "Received: {$msg}\n";

            });

            $conn->on('close', function($code = null, $reason = null) {
                echo "Connection closed ({$code} - {$reason})\n";
            });
        }, function($e) {
            echo "Could not connect: {$e->getMessage()}\n";
        });
        $loop->run();
    }
}
