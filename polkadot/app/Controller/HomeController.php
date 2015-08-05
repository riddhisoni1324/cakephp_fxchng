<?php
class HomeController extends AppController {

	public $name = 'Home';
	public $uses = array('Order', 'OrderItem','User', 'Courier', 'OrderDispatch','City','State','Coupon','Admin');
	

	public function beforeFilter()
	   {
	       AppController::beforeFilter();

	       // Basic setup
	       $this->Auth->authenticate = array('Form');

	       // Pass settings in
	       $this->Auth->authenticate = array(
	           'Form' => array('userModel' => 'User')
	       );

	       // Check user login session
	       if(sizeof($this->activeUser) <= 0)
	       {
	           $this->Session->setFlash('Sorry! The login session expires, Please check and try again','default',array('class' =>'alert alert-danger'),'bad');
	           $this->redirect(array('controller'=>'admins','action'=>'logout'));
	       }
	   }

    
    /*
    // Objective : This function computes the dashboard display requirements
    // Author : Ishan Sheth
    // Last Edit : 30/7/2014
    */
	public function index() {

		// // This sets the timezone settings and gets the today's date and the one before 30 days
		// date_default_timezone_set('Asia/Calcutta');
		// $todays = new DateTime();
		// $tdate1 = $todays->format('Y-m-d');
		// $threshold = $todays->sub(date_interval_create_from_date_string('+30 days')); 
		// $tdate2 = $threshold->format('Y-m-d');		
		
		// // This gets the count of completed orders and users registered in the last month grouped by date
		// $final_orders = array();
		
		// $startTime = strtotime($tdate2);
		// $endTime = strtotime($tdate1);
		// for ($i = $startTime; $i <= $endTime; $i = $i + 86400) {
		// 	$thisDate = date('Y-m-d', $i);
			
		// 	$orders = $this->Order->query("SELECT COUNT(id) as id_count, SUM(total_amount) as total_amt, SUM(additional_charges) as additional_chg, SUM(discount_value) as discount_val, DATE(modified) as order_date FROM axi_orders WHERE (status = 1 OR status = 2) AND DATE(modified) = '".$thisDate."' GROUP BY DATE(modified);");
		// 	$users = $this->User->query("SELECT COUNT(id) as id_count,DATE(created) as created FROM axi_users WHERE DATE(created) = '".$thisDate."' GROUP BY DATE(created);");

		// 	//pr($users);
			
		// 	if($orders) {
		// 		if($users){
		// 			$orders[0][0]['users'] = $users[0][0]['id_count'];	
		// 		} else {
		// 			$orders[0][0]['users'] = 0;	
		// 		}			

		// 		array_push($final_orders,$orders[0][0]);
		// 	} else {
		// 		$temparray = array();
		// 		$temparray['id_count'] = 0;
		// 		$temparray['total_amt'] = 0;
		// 		$temparray['additional_chg'] = 0;
		// 		$temparray['discount_val'] = 0;
		// 		$temparray['order_date'] = $thisDate;

		// 		if($users){
		// 			$temparray['users'] = $users[0][0]['id_count'];	
		// 		} else {
		// 			$temparray['users'] = 0;	
		// 		}				

		// 		array_push($final_orders,$temparray);
		// 	}			
			
		// }	

		// //pr($final_orders);
		// $this -> set('final_orders', $final_orders);
		


		// // This gets the almost json like string for area chart which shows trends on dashboard
		// $plot_points = "[";
		// foreach($final_orders as $order){
		// 		$the_date = new DateTime($order['order_date']);
		// 		$plot_points .= "{ date :'".$the_date->format('Y-m-d')."',orders :".$order['id_count'].",registrations :".$order['users']."},";
		// 		//$plot_ticks .= $the_date->format('d/m').",";
		// }

		// $plot_points = substr($plot_points,0,-1);																		
		// $plot_points .= "]";

		// //pr($plot_points);
		// $this -> set('plot_points', $plot_points);



		// // This gets all the completed orders till now
		// $all_orders = $this->Order->find('all',array('conditions'=>array('OR' => array(array('Order.status'=>1),array('Order.status'=>2)))));
		
		// // This gets all the shipping addresses of completed orders till now
		// $completed_shipping_cities = array();
		// foreach($all_orders as $order) {
		// 	//pr($order);
		// 	if($order['ShippingAddress']['city_id'] != null) {
		// 		array_push($completed_shipping_cities,$order['ShippingAddress']['city_id']);
		// 	}

		// }
		// //pr($completed_shipping_cities);

		// // This gets the final array of completed order count, grouped by city for all completed orders
		// $weighted_cities = array_count_values($completed_shipping_cities);
		// //pr($weighted_cities);

		// // This sorts the array and maintains index association
		// arsort($weighted_cities);
		// //pr($weighted_cities);
		
		// // This gets all the cities
		// $all_cities = $this->City->find('all',array('fields'=>array('City.id','City.name')));
		// //pr($all_cities);	

		// // This gets the final array of completed order count, grouped by city for all cities
		// $final_cities = array();
		// $zero_cities = array();

		// foreach($all_cities as $city) {
		// 	if (!array_key_exists($city['City']['id'], $weighted_cities)) {
		// 		//$temparray = array();
		// 		//$temparray[$city['City']['name']] = 0;
		// 		//array_push($zero_cities,$temparray);
		// 		$zero_cities[$city['City']['name']] = 0;
		// 	} else {
		// 		//$temparray = array();
		// 		//$temparray[$city['City']['name']] = $weighted_cities[$city['City']['id']];
		// 		//array_push($final_cities,$temparray);
		// 		$final_cities[$city['City']['name']] = $weighted_cities[$city['City']['id']];
		// 	}
		// }
		// //pr($final_cities);

		// // This sorts the array in reverse order and maintains index association
		// arsort($final_cities);
		// //pr($final_cities);
		// //pr($zero_cities);

		// foreach ($zero_cities as $key=>$value) {
		// 	//array_push($final_cities,$city);
		// 	$final_cities[$key] = $value;
		// }
		// //pr($final_cities);
		// //arsort($zero_cities);
		// //pr($final_cities);

		// // This gets the almost json like string for bar chart which shows top 10 sales destinations on dashboard
		// $plot_points1 = "[";
		// $maxcount = 0;
		// foreach($final_cities as $key=>$value){

		// 	if($maxcount < 10){
		// 		$plot_points1 .= "{ city :'".$key."',orders :".$value."},";
		// 	}
		// 	$maxcount++;
		// }
		// $plot_points1 = substr($plot_points1,0,-1);
		// $plot_points1 .= "]";

		// $this -> set('plot_points1', $plot_points1);

		// Set the view variables to controller variable values and layout for the view
		$this -> set('page_title', 'View Dashboard');
		$this -> layout = 'base_layout';




		
		// This gets the count of registered users in the last month grouped by date
		/*
		$final_users = array();
		
		$startTime = strtotime($tdate2);
		$endTime = strtotime($tdate1);
		for ($i = $startTime; $i <= $endTime; $i = $i + 86400) {
			$thisDate = date('Y-m-d', $i);
			
			$users = $this->User->query("SELECT COUNT(id) as id_count,DATE(created) as created FROM axi_users WHERE DATE(created) = '".$thisDate."' GROUP BY DATE(created);");
			
			if($users) {
				array_push($final_users,$users[0][0]);
			} else {
				$temparray = array();
				$temparray['id_count'] = 0;
				$temparray['created'] = $thisDate;
				array_push($final_users,$temparray);
			}			
			
		}	
		pr($final_users);
		$this -> set('final_users', $final_users);
		*/

		/*
		// This gets the last 5 orders
		$this->OrderItem->Behaviors->load('Containable');
		
		$top_orders = $this -> OrderItem -> find('all',array(
		'conditions' => array('Order.status' => 2),
		'contain' => array('Order','Order.User'),
		'order' => array('Order.modified DESC'),
		'limit' => 5
		));
		$this -> set('top_orders', $top_orders);
		//pr($top_orders);
		
		// This gets the last 5 orders
		$top_users = $this -> User -> find('all',array(
		'order' => array('User.created DESC'),
		'limit' => 5
		));
		$this -> set('top_users', $top_users);
		//pr($top_users);		
		*/	
		
	}
    




    /*
    // Objective : This function inserts the states from json to database
    // Author : Ishan Sheth
    // Last Edit : 28/4/2014
    */
    /*public function states(){

        $statesJSON = file_get_contents("http://localhost/states.json");
        $states = json_decode($statesJSON, true);

        $newStates = array();
        foreach($states as $state){
            $newState = array();
            $newState['State']['name'] = $state['name'];
            $newState['State']['country_id'] = "d1d9b829-5f62-11e3-938c-24b6fd3dcdb4";

            echo $newState['State']['name']."<br/>";

            array_push($newStates, $newState);

        }

        $this->State->saveAll($newStates);

        die();
    }*/

}
?>