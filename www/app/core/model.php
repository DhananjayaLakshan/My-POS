<?php

/**
 * model class
 */
class Model extends Database
{

	protected function get_allowed_columns($data)//avoid columns
	{
		if(!empty($this->allowed_columns))
		{
			foreach ($data as $key => $value) //get entered values to key
			{
				if(!in_array($key, $this->allowed_columns))
				{
					unset($data[$key]); //unset that key "password_retype" because it is not in the data base column
				}
					
			}
		}
		return $data;
	}


	public function insert($data)// INSERT data to database table
	{
		//$query = "INSERT INTO users (username,email,password,date,role) VALUES (:username,:email,:password,:date,:role)";

		$clean_array = $this->get_allowed_columns($data, $this->table); //get columns
		$keys = array_keys($clean_array);//get keys

		$query = "INSERT INTO $this->table";
		$query .= "(".implode(","/*separater*/, $keys/*array keys*/).") VALUES ";/*(username,email,password,date,role)*/
		$query .= "(:".implode(",:"/*separater*/, $keys/*array keys*/).")";/*(:username,:email,:password,:date,:role)*/
		
		$db = new Database;

		$db->query($query,$clean_array);
	}


	public function update($id,$data)// UPDATE data to database table
	{

		$clean_array = $this->get_allowed_columns($data, $this->table); 
		$keys = array_keys($clean_array);

		$query = "UPDATE $this->table SET ";

		foreach ($keys as $column) 
		{
			$query .= $column . "=:" . $column . ",";
		}

		$query = trim($query,",");//delete "," beginning and end

		$query .= " WHERE id = :id";
		
		$clean_array['id'] = $id;

		$db = new Database;
		$db->query($query,$clean_array);
	}


	public function delete($id)// DETELE data to database table
	{

		//delete from table where id = :id
		$query = "DELETE FROM $this->table WHERE id = :id LIMIT 1";
		$clean_array['id'] = $id;

		$db = new Database;
		$db->query($query,$clean_array);
	}


	public function where($data,$limit = 10,$offset = 0,$order= "desc",$order_column = "id")// WHERE SQL
	{
		
		$keys = array_keys($data);

		$query = "SELECT * FROM $this->table WHERE ";

		foreach ($keys as $key) 
		{
			$query .= "$key = :$key && ";
		}

		$query = trim($query,"&& ");
		$query .= " ORDER BY $order_column $order limit $limit offset $offset";
		
		$db = new Database;
		return $db->query($query,$data);
	}



	public function getAll($limit = 10,$offset = 0,$order= "desc",$order_column = "id")// GET ALL DATA form data base tables
	{

		$query = "SELECT * FROM $this->table ORDER BY $order_column $order LIMIT $limit offset $offset";
		
		$db = new Database;
		return $db->query($query);
	}


	public function first($data)// WHERE SQL return first result only
	{
		

		$keys = array_keys($data);

		$query = "SELECT * FROM $this->table WHERE ";

		foreach ($keys as $key) 
		{
			$query .= "$key = :$key && ";
		}

		$query = trim($query,"&& ");
		
		$db = new Database;
		
		
		if ($res = $db->query($query,$data)) {
			return $res[0];
		}
		return false;

	}


	
}