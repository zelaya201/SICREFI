<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use mysqli;

class SeguridadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return response(view('content.seguridad.index'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create()
    {
      $file = $this->backDb(
        env('DB_HOST'),
        env('DB_USERNAME'),
        env('DB_PASSWORD'),
        env('DB_DATABASE'),
        "cliente,
        cooperativa,
        negocio,
        credito,
        bien,
        referencia,
        tel_referencia,
        tel_cliente,
        tel_negocio,
        rol, usuario,
        bitacora,
        opcion_acceso,
        detalle_acceso,
        conyuge,
        tel_conyuge,
        cuota,
        credito_referencia"
      );

      // Descargar y eliminar el archivo
      return response()->download($file)->deleteFileAfterSend(true);
    }

  public function restore(Request $request)
  {
    // Obtener archivo de la base de datos
    $file = $request->file('file');

    // Guardar el archivo en la carpeta de storage
    $file->storeAs('public', $file->getClientOriginalName());

    // Eliminar relaciones de la base de datos
    $this->dropRel(
      env('DB_HOST'),
      env('DB_USERNAME'),
      env('DB_PASSWORD'),
      env('DB_DATABASE'));

    // Restaurar la base de datos
    $this->restoreDb(env('DB_HOST'),
      env('DB_USERNAME'),
      env('DB_PASSWORD'),
      env('DB_DATABASE'),
      storage_path('app/public/' . $file->getClientOriginalName()));

    return redirect()->route('seguridad.index')->with('success', 'Base de datos restaurada exitosamente.');
  }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    function dropRel($dbHost, $dbUsername, $dbPassword, $dbName){
      // Actualizar on cascade en las tablas
      $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

      $sql = "SELECT table_name, column_name, constraint_name, referenced_table_name, referenced_column_name
              FROM information_schema.key_column_usage
              WHERE referenced_table_name IS NOT NULL
              AND table_schema = '$dbName'";
      $result = $db->query($sql);
      $error = '';
      while($row = $result->fetch_assoc()){
        $sql = "ALTER TABLE " . $row['table_name'] . " DROP FOREIGN KEY " . $row['constraint_name'];
        if(!$db->query($sql)){
          $error .= 'Error dropping foreign key: ' . $row['constraint_name'] . ' on table: ' . $row['table_name'] . '<br />';
        }
      }
      return !empty($error)?$error:true;
    }

    function dropData($dbHost, $dbUsername, $dbPassword, $dbName){
      // Connect & select the database
      $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

      // Get all table names from the database
      $tables = array();
      $result = $db->query('SHOW TABLES');
      while($row = $result->fetch_row()){
        $tables[] = $row[0];
      }

      // Drop each table
      $error = '';
      foreach($tables as $table){
        if(!$db->query('DELETE FROM ' . $table)){
          $error .= 'Error dropping table: ' . $table . '<br />';
        }
      }
      return !empty($error)?$error:true;
    }

    function dropTb($dbHost, $dbUsername, $dbPassword, $dbName){
      // Connect & select the database
      $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

      // Get all table names from the database
      $tables = array();
      $result = $db->query('SHOW TABLES');
      while($row = $result->fetch_row()){
        $tables[] = $row[0];
      }

      // Drop each table
      $error = '';
      foreach($tables as $table){
        if(!$db->query('DROP TABLE IF EXISTS ' . $table)){
          $error .= 'Error dropping table: ' . $table . '<br />';
        }
      }
      return !empty($error)?$error:true;
    }

    function restoreDb($dbHost, $dbUsername, $dbPassword, $dbName, $filePath){
      //connection
      $conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

      //variable use to store queries from our sql file
      $sql = '';

      //get our sql file
      $lines = file($filePath);

      //return message
      $output = array('error'=>false);

      //loop each line of our sql file
      foreach ($lines as $line){

        //skip comments
        if(substr($line, 0, 2) == '--' || $line == ''){
          continue;
        }

        //add each line to our query
        $sql .= $line;

        //check if its the end of the line due to semicolon
        if (substr(trim($line), -1, 1) == ';'){
          //perform our query
          $query = $conn->query($sql);
          if(!$query){
            $output['error'] = true;
            $output['message'] = $conn->error;
          }
          else{
            $output['message'] = 'Database restored successfully';
          }

          //reset our query variable
          $sql = '';

        }
      }

      return $output;
    }

  function backDb($host, $user, $pass, $dbname, $tables = '*'){

    $link = mysqli_connect($host,$user,$pass, $dbname);

    // Check connection
    if (mysqli_connect_errno())
    {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      exit;
    }

    // Check if we want to backup all tables or just specific tables
    if($tables == '*'){
      $tables = array();
      $result = mysqli_query($link, 'SHOW TABLES');
      while($row = mysqli_fetch_row($result)){
        $tables[] = $row[0];
      }
    }else{
      $tables = is_array($tables) ? $tables : explode(',',$tables);
    }

    $return = '';

    // Cycle through each table
    foreach($tables as $table){
      $result = mysqli_query($link, 'SELECT * FROM ' . $table);
      $num_fields = mysqli_num_fields($result);

      $return .= 'DROP TABLE ' . $table . ';';
      $row2 = mysqli_fetch_row(mysqli_query($link, 'SHOW CREATE TABLE ' . $table));
      $return .= "\n\n" . $row2[1] . ";\n\n";

      for ($i = 0; $i < $num_fields; $i++){
        while($row = mysqli_fetch_row($result)){
          $return .= 'INSERT INTO ' . $table . ' VALUES(';
          for($j=0; $j<$num_fields; $j++){
            $row[$j] = addslashes($row[$j]);
            $row[$j] = preg_replace("/\n/","\\n",$row[$j]);
            if (isset($row[$j])) { $return .= '"' . $row[$j] . '"' ; } else { $return .= '""'; }
            if ($j<($num_fields-1)) { $return .= ','; }
          }
          $return .= ");\n";
        }
      }
      $return .= "\n\n\n";
    }

    // Save the SQL script to a backup file
    $fileName = 'backup-' . $dbname . '-' . date('Y-m-d H_i_s') . '.sql';
    $handle = fopen($fileName,'w+');
    fwrite($handle, $return);
    fclose($handle);
    return $fileName;
  }
}
