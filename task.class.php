<?php

/**
 * This class handles the modification of a task object
 */
 class Task {
    public $TaskId;
    public $TaskName;
    public $TaskDescription;
    public $TaskDataSource;
    public function __construct($Id = null) {
        $this->TaskDataSource = file_get_contents('Task_Data.txt');
        if (strlen($this->TaskDataSource) > 0)
            $this->TaskDataSource = json_decode($this->TaskDataSource); // Should decode to an array of Task objects
        else
            $this->TaskDataSource = array(); // If it does not, then the data source is assumed to be empty and we create an empty array

        if (!$this->TaskDataSource)
            $this->TaskDataSource = array(); // If it does not, then the data source is assumed to be empty and we create an empty array
           // $this->Create();
            
    }
    protected function Create() {
       // This function needs to generate a new unique ID for the task
        // Assignment: Generate unique id for the new task

        $this->TaskId = $this->getUniqueId();
        $this->TaskName = 'New Task';
        $this->TaskDescription = 'New Description';
    }
    public function getUniqueId() {
        $this->TaskDataSource = file_get_contents('Task_Data.txt');
        $array = json_decode($this->TaskDataSource);
        $max = max(array_keys(array_column($array, 'TaskId')));
        $arry2= $array[$max];
        foreach($arry2 as $key => $value)
        {
          if($key=="TaskId")
          {
          $number=$value;
         
          }
        }
        
        // Assignment: Code to get new unique ID
        return $number+1; 
    }
    public function LoadFromId($Id,$TaskN,$TaskD) {
        
        $Datasource = file_get_contents('Task_Data.txt');
        $array = json_decode($Datasource,true);
        for ($x=0;$x<sizeof($array);$x++)
         {
            
            if($array[$x]["TaskId"]==$Id)
            {
                $data=array("TaskId" => $Id,
                "TaskName" => $TaskN,
                "TaskDescription" => $TaskD);
                $array[$x]=$data;
                $file = fopen("Task_Data.txt","w");
                fwrite($file,json_encode($array));
                fclose($file);
                
            }
         }
            
    }

    public function  Save($TaskN,$TaskD,$TaskId) {
      $id = $this->getUniqueId();
      $Datasource = file_get_contents('Task_Data.txt');
      $array = json_decode($Datasource,true);
      if ($TaskId!=-1)
      {
        $this->LoadFromId($TaskId,$TaskN,$TaskD);
         
       
      // for ($x=0;$x<sizeof( $array);$x++)
     //    {
            
      //     if($array[$x]["TaskId"]==$TaskId)
      //      {
       //        $data=array("TaskId" => $TaskId,
        //       "TaskName" => $TaskN,
        //        "TaskDescription" => $TaskD);
       //         $array[$x]=$data;
       //       
       //         $file = fopen("Task_Data.txt","w");
       //         fwrite($file,json_encode($array));
       //         fclose($file);
                
                
        //    }
            
        //}
         



      }
      else
      {
        
        $data= array("TaskId" => $id,
        "TaskName" => $TaskN,
        "TaskDescription" => $TaskD);
        
  
        $array[count($array)]=$data;
        
        $file = fopen("Task_Data.txt","w");
        fwrite($file,json_encode($array));
        fclose($file);
        
      }
      


        //Assignment: Code to save task here
      
        
      
    }
    public function Delete($TaskId) {
      $Datasource = file_get_contents('Task_Data.txt');
      $array = json_decode($Datasource,true);
      
      for ($x=0;$x<sizeof($array);$x++)
         {
            
            if($array[$x]["TaskId"]==$TaskId)
            {
                array_splice($array,$x,1);
                
                
                
                
            }
            


         }
                $file = fopen("Task_Data.txt","w");
                fwrite($file,json_encode($array));
                fclose($file);
    }
}

?>