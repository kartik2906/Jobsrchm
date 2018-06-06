<?php

	
class Validation{
    private $passed = false;
	public $fields = array();
    public $field_errors = array();
    



    public function add_field($field_name){

    	$this->fields[] = $field_name;

       	$this->field_errors[$field_name] = array();


    }




    public function add_rule_to_field($field_name, $field_rule){

        	if (!$_POST[$field_name]) {
        		$this->add_error_to_field($field_name,"cannot be ".$field_rule[0]);
        	}
            


    }




    public function add_error_to_field ($field_name, $error){


        $this->passed= true;

       
     

     $this->field_errors[$field_name][$field_name]= $error;

  

   
    }







    public function add_output_field($field_name){
            
    		if (isset($this->field_errors[$field_name])) {
    			foreach ($this->field_errors[$field_name] as $key => $field_error) {
    				
           			echo $key . $field_error;


	    	}


    		}

           

    	
    }

  



    public function all_error(){


    	foreach ($this->fields as $field) {
    		
    		echo $this->add_output_field($field);
    	}
 	

    }


     public function passed (){

        return $this->passed;
    }



   





	}


  ?>


