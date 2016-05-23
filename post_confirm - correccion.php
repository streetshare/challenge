<?php 
	function post_confirm(){
		$id = Input::get('service_id');
		$servicio = Service::find($id);
		if($servicio != NULL){
			if($servicio->status_id == '6'){
				$errorCode = 2;
			} else if($servicio->driver_id == NULL && $servicio->status_id	== '1'){
				$driver_id = Input::get('driver_id');
				$servicio = Service::update($id, array(
					'driver_id' = $driver_id,
					'status_id' = '2'
				));
				Driver::update($driver_id, array(
					'available' => '0'
				));
				$driverTmp = Driver::find($driver_id);
				Service::update($id, array(
					'car_id' => $driverTmp->car_id
				));
				//Notificar a usuario!!
				$pushMessage = 'Tu servicio ha sido confirmado';
				$servicio = Service::find($id);
				$push = Push::make();
				if($servicio->user->uuid != ''){
					if($service->user->type == '1'){//iPhone
						$result = $push->ios($servicio->user->uuid, $pushMessage, 1, 'honk.wav', 'Open', array('serviceId'=>$servicio->id));
					} else {
						$result = $push->android2($servicio->user->uuid, $pushMessage, 1, 'default', 'Open', array('serviceId'=>$servicio->id));
					}
				}
				$errorCode = 0;
			} else {
				$errorCode = 1;
			}
		} else {
			$errorCode = 3;
		}
		return Response::json(array('error'=> $errorCode));
	}
?>